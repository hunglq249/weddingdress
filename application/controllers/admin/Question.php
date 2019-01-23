<?php 

/**
* 
*/
class Question extends Admin_Controller{
	private $request_language_template = array(
        'title', 'description'
    );
    private $author_data = array();
    private $controller = '';
	function __construct(){
		parent::__construct();
		$this->load->model('question_model');
		$this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->controller = 'question';
        $this->data['controller'] = $this->controller;
		$this->author_data = handle_author_common_data();
	}
    public function index(){
        $keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $total_rows  = $this->question_model->count_search('vi');
        if($keywords != ''){
            $total_rows  = $this->question_model->count_search('vi', $keywords);
        }
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/'. $this->controller .'/index');
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();

        $result = $this->question_model->get_all_with_pagination_search('asc','vi' , $per_page, $this->data['page']);
        if($keywords != ''){
            $result = $this->question_model->get_all_with_pagination_search('asc','vi' , $per_page, $this->data['page'], $keywords);
        }
        $this->data['result'] = $result;
        $this->data['check'] = $this;
        
        $this->render('admin/'. $this->controller .'/list_question_view');
    }
	public function create(){
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title_vi', 'Câu hỏi', 'required');
        $this->form_validation->set_rules('title_en', 'Question', 'required');

        if ($this->form_validation->run() == FALSE) {
        	$this->render('admin/'. $this->controller .'/create_question_view');
        } else {
        	if($this->input->post()){
                $shared_request = array(
                    'created_at' => $this->author_data['created_at'],
                    'created_by' => $this->author_data['created_by'],
                    'updated_at' => $this->author_data['updated_at'],
                    'updated_by' => $this->author_data['updated_by']
                );
                $this->db->trans_begin();

                $insert = $this->question_model->common_insert($shared_request);
                if($insert){
                    $requests = handle_multi_language_request('question_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages);
                    $this->question_model->insert_with_language($requests);
                }

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $this->load->libraries('session');
                    $this->session->set_flashdata('message_error', MESSAGE_CREATE_ERROR);
                    $this->render('admin/'. $this->controller .'/create_question_view');
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('message_success', MESSAGE_CREATE_SUCCESS);
                    redirect('admin/'. $this->controller .'', 'refresh');
                }
        	}
        }
        
	}

    public function detail($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $detail = $this->question_model->get_by_id($id, $this->request_language_template);
       
        $detail = build_language($this->controller, $detail, $this->request_language_template, $this->page_languages);
        $this->data['detail'] = $detail;
        $this->render('admin/'. $this->controller .'/detail_question_view');
    }

    public function edit($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
      
        $detail = $this->question_model->get_by_id($id, $this->request_language_template);
        $detail = build_language($this->controller, $detail, $this->request_language_template, $this->page_languages);
        $category = $this->question_model->get_by_parent_id(null,'asc');

        $this->data['category'] = $category;
        
        $this->data['detail'] = $detail;

        $this->form_validation->set_rules('title_vi', 'Câu hỏi', 'required');
        $this->form_validation->set_rules('title_en', 'Question', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/'. $this->controller .'/edit_question_view');
        } else {
            if($this->input->post()){
                $shared_request = array(
                    'created_at' => $this->author_data['created_at'],
                    'created_by' => $this->author_data['created_by'],
                    'updated_at' => $this->author_data['updated_at'],
                    'updated_by' => $this->author_data['updated_by']
                );
                $this->db->trans_begin();

                $update = $this->question_model->common_update($id, $shared_request);
                if($update){
                    $requests = handle_multi_language_request('question_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages);
                    foreach ($requests as $key => $value){
                        $this->question_model->update_with_language($id, $requests[$key]['language'], $value);
                    }
                }

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $this->load->libraries('session');
                    $this->session->set_flashdata('message_error', MESSAGE_EDIT_ERROR);
                    $this->render('admin/'. $this->controller .'/edit/'.$id);
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('message_success', MESSAGE_EDIT_SUCCESS);
                    redirect('admin/'. $this->controller .'', 'refresh');
                }
            }
        }
    }

    function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $detail = $this->question_model->find($id);
            if(empty($detail)){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR);
            }else{
                $data = array('is_deleted' => 1);
                $update = $this->question_model->common_update($id, $data);
                if($update){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
                }
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
            }
          
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }

    public function active(){
        $this->load->model('post_model');
        $id = $this->input->post('id');
        $data = array('is_activated' => 0);
        $update = $this->question_model->common_update($id, $data);
        if ($update == 1) {
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,'',$reponse);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }

    public function deactive(){
        $id = $this->input->post('id');
        $data = array('is_activated' => 1);
        $question = $this->question_model->find($id);
        $this->db->trans_begin();
        $update = $this->question_model->common_update($id, $data);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return $this->return_api(HTTP_BAD_REQUEST);
        } else {
            $this->db->trans_commit();
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,MESSAGE_SUCCESS_TURN_OFF_ALL,$reponse);
        }
    }


    protected function build_parent_title($parent_id){
        $sub = $this->question_model->get_by_id($parent_id, $this->request_language_template);

        if($parent_id != 0){
            $title = explode('|||', $sub['question_title']);
            $sub['title_en'] = $title[0];
            $sub['title_vi'] = $title[1];

            $title = $sub['title_vi'];
        }else{
            $title = 'Danh mục gốc';
        }
        return $title;
    }

    function build_new_category($categorie, $parent_id = 0, &$new_categorie){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $item){
                $new_categorie[] = $item;
                $this->build_new_category($categorie, $item['id'], $new_categorie);
            }
        }
    }

    public function sort(){
        $params = array();
        parse_str($this->input->get('sort'), $params);
        $i = 1;
        foreach($params as $value){
            $this->question_model->update_sort($i, $value[0]);
            $i++;
        }
    }

    public function check_sub_category($id){
        $check_sub_category = $this->question_model->get_by_parent_id($id);
        if ($check_sub_category) {
            return true;
        }
        return false;
    }

    function get_multiple_posts_with_category($categories, $parent_id = 0, &$ids){
        foreach ($categories as $key => $item){
            $ids[] = $parent_id;
            if ($item['parent_id'] == $parent_id){
                $ids[] = $item['id'];
                $this->get_multiple_posts_with_category($categories, $item['id'], $ids);
            }
        }
    }
}