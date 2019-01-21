<?php 

/**
* 
*/
class Banner extends Admin_Controller{
	private $request_language_template = array(
        'title', 'description'
    );
    private $author_data = array();

	function __construct(){
		parent::__construct();
        $this->load->model('banner_model');
        $this->load->model('product_category_model');
		$this->load->model('collection_model');
		$this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->data['controller'] = $this->banner_model->table;
		$this->author_data = handle_author_common_data();
	}

    public function index(){
        $this->data['keyword'] = '';
        if($this->input->get('search')){
            $this->data['keyword'] = $this->input->get('search');
        }
        $this->load->library('pagination');
        $per_page = 10;
        $total_rows  = $this->banner_model->count_search($this->data['keyword']);
        $config = $this->pagination_config(base_url('admin/'.$this->data['controller'].'/index'), $total_rows, $per_page, 4);
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->banner_model->get_all_with_pagination_search('desc','vi' , $per_page, $this->data['page'], $this->data['keyword']);
        foreach ($this->data['result'] as $key => $value) {
            if ($this->data['result'][$key]['type'] == 0) {
                $this->data['result'][$key]['category'] = $this->product_category_model->get_by_id($this->data['result'][$key]['category_id'],array('title'),'vi');
            }else{
                $this->data['result'][$key]['category'] = $this->collection_model->get_by_id($this->data['result'][$key]['category_id'],array('title'),'vi');
            }
        }
        $this->render('admin/banner/list_banner_view');
    }

	public function create(){
		$this->load->helper('form');
        $product_category = $this->product_category_model->get_by_parent_id(null,'asc');
        $this->data['collection'] = $this->collection_model->get_by_parent_id(null,'asc','vi');
        $this->build_new_category($product_category,0,$this->data['product_category']);
        if($this->input->post() == TRUE){
            if(empty($_FILES['image_shared']['name'])){
                $this->session->set_flashdata('message_error', MESSAGE_EMPTY_IMAGE_ERROR);
                redirect('admin/'.$this->data['controller']);
            }
            if(!empty($_FILES['image_shared']['name'])){
                $this->check_img($_FILES['image_shared']['name'], $_FILES['image_shared']['size']);
            }
            $image = '';
            if(!empty($_FILES['image_shared']['name'])){
                $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'.$this->data['controller'], 'assets/upload/'.$this->data['controller'].'/thumb');
            }
            $shared_request = [
                'image' => $image,
                'type' => $this->input->post('type'),
                'category_id' => $this->input->post('category_id')
            ];
            if($this->banner_model->find_rows(array("is_activated" => 0, "is_deleted" => 0)) == 0){
                $shared_request['is_activated'] = 0;
            }
            $this->db->trans_begin();
            $insert = $this->banner_model->common_insert(array_merge($shared_request,$this->author_data));
            if($insert){
                $requests = handle_multi_language_request('banner_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages);
                $this->banner_model->insert_with_language($requests);
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message_error', MESSAGE_CREATE_ERROR);
                $this->render('admin/banner/create_banner_view');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('message_success', MESSAGE_CREATE_SUCCESS);
                redirect('admin/'. $this->data['controller'] .'', 'refresh');
            }
        }
        $this->render('admin/banner/create_banner_view');
	}
    public function active(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $banner = $this->banner_model->find($id);
            if ($banner['type'] == 0) {
                $category = $this->product_category_model->find($banner['category_id']);
            }else{
                $category = $this->collection_model->find($banner['category_id']);
            }
            if($category['is_activated'] == 1){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array('status' => 404,'message' => sprintf(MESSAGE_ERROR_ACTIVE_BANNER,($banner['type'] == 0 ? 'danh mục' : 'bộ sưu tập')))));
            }
            $update = $this->banner_model->common_update($id,array_merge(array('is_activated' => 0),$this->author_data));
            if($update){
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                return $this->return_api(HTTP_SUCCESS,'',$reponse);
            }
            return $this->return_api(HTTP_BAD_REQUEST);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }
    public function deactive(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $update = $this->banner_model->common_update($id,array_merge(array('is_activated' => 1),$this->author_data));
            if($update){
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                return $this->return_api(HTTP_SUCCESS,'',$reponse);
            }
            return $this->return_api(HTTP_BAD_REQUEST);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }

    public function detail($id){
        return redirect('admin','refresh');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->banner_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->helper('form');
                $this->load->library('form_validation');
                $detail = $this->banner_model->get_by_id($id, array('title', 'description'));
                $detail = build_language($this->data['controller'], $detail, array('title', 'description'), $this->page_languages);
                $this->data['detail'] = $detail;
                $this->render('admin/banner/detail_banner_view');
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/banner', 'refresh');
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            return redirect('admin/'.$this->data['controller'],'refresh');
        }
    }
    function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->banner_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array('status' => 404,'message' => MESSAGE_ISSET_ERROR)));
            }
            $data = array('is_deleted' => 1);
            $update = $this->banner_model->common_update($id, $data);
            if($update){
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
            }
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }

    public function edit($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            if($this->banner_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/banner', 'refresh');
            }
            $detail = $this->banner_model->get_by_id($id, array('title','description'));
            $this->data['detail'] = build_language($this->data['controller'], $detail, array('title','description'), $this->page_languages);
            $product_category = $this->product_category_model->get_by_parent_id(null,'asc');
            $this->data['collection'] = $this->collection_model->get_by_parent_id(null,'asc','vi');
            $this->build_new_category($product_category,0,$this->data['product_category']);
            if($this->input->post()){
                    if(!empty($_FILES['image_shared']['name'])){
                        $this->check_img($_FILES['image_shared']['name'], $_FILES['image_shared']['size']);
                    }
                    if(!empty($_FILES['image_shared']['name'])){                        
                        $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'.$this->data['controller'], 'assets/upload/'.$this->data['controller'].'/thumb');
                    }

                    $shared_request = array(
                        'type' => $this->input->post('type'),
                        'category_id' => $this->input->post('category_id'),
                    );
                    if(isset($image)){
                        $shared_request['image'] = $image;
                    }
                    $this->db->trans_begin();
                    $update = $this->banner_model->common_update($id,array_merge($shared_request,$this->author_data));
                    if($update){
                        $requests = handle_multi_language_request('banner_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages);
                        foreach ($requests as $key => $value) {
                            $this->banner_model->update_with_language($id, $requests[$key]['language'],$value);
                        }
                    }
                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('message_error', MESSAGE_EDIT_ERROR);
                        $this->render('admin/'. $this->data['controller'] .'/edit_product_category_view');
                    } else {
                        $this->db->trans_commit();
                        $this->session->set_flashdata('message_success', MESSAGE_EDIT_SUCCESS);
                        if(isset($image) && !empty($this->data['detail']['image'])){
                            if(file_exists('assets/upload/'. $this->data['controller'] .'/'.$this->data['detail']['image']))
                            unlink('assets/upload/'. $this->data['controller'] .'/'.$this->data['detail']['image']);
                        }
                        redirect('admin/'. $this->data['controller'] .'', 'refresh');
                    }
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
        $this->render('admin/banner/edit_banner_view');
    }

    public function remove_image(){
        $id = $this->input->post('id');
        $image = $this->input->post('image');
        $detail = $this->banner_model->get_by_id($id);
        $upload = [];
        $upload = json_decode($detail['image']);
        $key = array_search($image, $upload);
        unset($upload[$key]);
        $newUpload = [];
        foreach ($upload as $key => $value) {
            $newUpload[] = $value;
        }
        
        $image_json = json_encode($newUpload);
        $data = array('image' => $image_json);

        $update = $this->banner_model->common_update($id, $data);
        if($update == 1){
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            if($image != '' && file_exists('assets/upload/product/'.$detail['slug'].'/'.$image)){
                unlink('assets/upload/product/'.$detail['slug'].'/'.$image);
            }
            return $this->return_api(HTTP_SUCCESS,'',$reponse);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }


    /**
     * [build_parent_title description]
     * @param  [type] $parent_id [description]
     * @return [type]            [description]
     */
    protected function build_parent_title($parent_id){
        $sub = $this->product_category_model->get_by_id($parent_id, array('title'));

        if($parent_id != 0){
            $title = explode('|||', $sub['product_category_title']);
            $sub['title_en'] = $title[0];
            $sub['title_vi'] = $title[1];

            $title = $sub['title_vi'];
        }else{
            $title = 'Danh mục gốc';
        }
        return $title;
    }
    protected function check_img($filename, $filesize){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        if(!($fileextension == 'jpg' || $fileextension == 'jpeg' || $fileextension == 'png' || $fileextension == 'gif')){
            $this->session->set_flashdata('message_error', MESSAGE_FILE_EXTENSION_ERROR);
            redirect('admin/'.$this->data['controller']);
        }
        if ($filesize > 1228800) {
            $this->session->set_flashdata('message_error', sprintf(MESSAGE_PHOTOS_ERROR, 1200));
            redirect('admin/'.$this->data['controller']);
        }
    }

    function build_new_category($categorie, $parent_id = 0,&$result, $parent_id_edit = "",$id_edit = "",$char=""){
        $cate_child = array();
        if($parent_id == 0){
            $result.='<option value="" selected>Click để chọn</option>';
        }
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
                    $select = ($value['id'] == $parent_id_edit)? 'selected' : '';
                if($value['id'] != $id_edit){
                    $result.='<option value="'.$value['id'].'"'.$select.'>'.$char.$value['title'].'</option>';
                    $this->build_new_category($categorie, $value['id'],$result, $parent_id_edit,$id_edit, $char.'---|');
                }
            }
        }
    }
}