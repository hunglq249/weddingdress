<?php 

/**
* 
*/
class Menu extends Admin_Controller{
	
	private $request_language_template = array(
        'title'
    );
    private $author_data = array();
    private $controller = '';

	function __construct(){
		parent::__construct();
        return redirect('admin','refresh');
        $this->load->model('post_category_model');
        $this->load->model('product_category_model');
        $this->load->model('post_model');
        $this->load->model('product_model');
        $this->load->model('menu_model');
		$this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->controller = 'menu';
        $this->data['main_post'] = $this->post_category_model->get_by_parent_id_when_active(null,'asc');
        $this->data['main_product'] = $this->product_category_model->get_by_parent_id_when_active(null,'asc');//product

		$this->author_data = handle_author_common_data();
	}

	public function index(){
		$menus = $this->menu_model->get_by_parent_id(0, 'asc');
		$this->data['menus'] = $menus;
		$this->render('admin/menu/menu_view');
	}

    public function create($id = ''){
        $this->data['id'] = 0;
        $this->data['slug'] = '';
        $this->data['result'] = array();
        $this->data['detail'] = array('slug' => '');
        if(isset($id) && is_numeric($id)){
            $this->data['id'] = $id;
            $detail = $this->menu_model->get_by_id($id, array('title'));
            if(!empty($detail['slug'])){
                $explode_slug = explode('/',$detail['slug']);
                $main = ($explode_slug[0] == 'nhom' || $explode_slug[0] == 'san-pham') ? $this->data['main_product'] : $this->data['main_post'];
                $this->fetch_posts_for_menu($id, $this->controller, $this->page_languages, $main,$detail,$explode_slug);
            }
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/menu/create_menu_view');
        } else {
            if ($this->input->post()) {
                if(!empty($this->input->post('selectMain_shared'))){
                    $explode_slug_category = explode('/', $this->input->post('selectMain_shared'));
                    if($explode_slug_category[0] == 'nhom'){
                        $check_category = $this->product_category_model->get_by_slug_check_active($explode_slug_category[1]);
                    }else{
                        $check_category = $this->post_category_model->get_by_slug_check_active($explode_slug_category[1]);
                    }
                    if(!empty($check_category) && $check_category['is_activated'] == 1){
                        $this->session->set_flashdata('message_error', sprintf(MESSAGE_ERROR_TURN_ON_POST_CATEGORY_FOR_SELECTED, $check_category['title']));
                        redirect('admin/'. $this->controller .'/create/' . $id,'refresh');
                    }
                }
                if(!empty($this->input->post('selectArticle_shared'))){
                    $explode_slug = explode('/', $this->input->post('selectArticle_shared'));
                    if($explode_slug[0] == 'san-pham'){
                        $check = $this->product_model->find_rows(array('slug' => $explode_slug[1], 'is_activated' => 0, 'is_deleted' => 0));
                    }else{
                        $check = $this->post_model->find_rows(array('slug' => $explode_slug[1], 'is_activated' => 0, 'is_deleted' => 0));
                    }
                    if($check == 0){
                        $this->session->set_flashdata('message_error', MESSAGE_ERROR_TURN_ON_ARTICEL_FOR_SELECTED);
                        redirect('admin/'. $this->controller .'/create/' . $id,'refresh');
                    }
                }
                $shared_request = array(
                    'url' => $this->input->post('url_shared'),
                    'is_activated' => $this->input->post('isActived_shared'),
                    'parent_id' => $id,
                    'slug' => $this->input->post('selectMain_shared'),
                    'slug_post' => $this->input->post('selectArticle_shared'),
                );
                $this->db->trans_begin();
                $insert = $this->menu_model->common_insert(array_merge($shared_request,$this->author_data));
                if($insert){
                    $requests = handle_multi_language_request('menu_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages);
                    $this->menu_model->insert_with_language($requests);
                }
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message_error', MESSAGE_CREATE_ERROR);
                    $this->render('admin/'. $this->controller .'/create_menu_view');
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('message_success', MESSAGE_CREATE_SUCCESS);
                    if(isset($id) && is_numeric($id)){
                        redirect('admin/'. $this->controller .'/edit/' . $id,'refresh');
                    }else{
                        redirect('admin/'. $this->controller, 'refresh');
                    }
                }
            }
        }
    }

    public function ajax_menu_posts(){
        if($this->input->post()){
            if($this->input->post('slug')){
                $main_category = $this->post_category_model->get_by_parent_id(null,'asc');
                $detail_category = $this->post_category_model->get_by_slug_check_active($this->input->post('slug'));
                $this->get_posts_with_category($main_category, $detail_category['id'], $ids);
                $new_ids = array_unique($ids);
                $posts = $this->post_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash(),
                    'result' => $posts,
                    'deactive' => MESSAGE_ERROR_TURN_ON_POST_PERSENT
                );
                return $this->return_api(HTTP_SUCCESS,'',$reponse);
            }
        }

    }
    public function ajax_menu_products(){
        if($this->input->post()){
            if($this->input->post('slug')){
                $main_category = $this->product_category_model->get_by_parent_id(null,'asc');
                $detail_category = $this->product_category_model->get_by_slug_check_active($this->input->post('slug'));
                $this->get_posts_with_category($main_category, $detail_category['id'], $ids);
                $new_ids = array_unique($ids);
                $products = $this->product_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash(),
                    'result' => $products,
                    'deactive' => MESSAGE_ERROR_TURN_ON_POST_PERSENT
                );
                return $this->return_api(HTTP_SUCCESS,'',$reponse);
            }
        }

    }

// cần sửu nữa chưa xong
    public function edit($id){
        $this->load->model('post_category_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $subs = $this->menu_model->get_by_parent_id($id, 'asc');
        $this->data['subs'] = $subs;
        $detail_menu = $this->menu_model->get_by_id($id, array('title'));
        $detail = build_language($this->controller, $detail_menu, array('title'), $this->page_languages);
        if(!empty($detail_menu['slug'])){
            $explode_slug = explode('/', $detail_menu['slug']);
            $main = ($explode_slug[0] == 'nhom' || $explode_slug[0] == 'san-pham') ? $this->data['main_product'] : $this->data['main_post'];
            if($explode_slug[0] == 'nhom' || $explode_slug[0] == 'san-pham'){
                $detail_category = $this->product_category_model->get_by_slug_check_active($explode_slug[1]);
                $this->get_posts_with_category($main, $detail_category['id'], $ids);
                $new_ids = array_unique($ids);
                $result = $this->product_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
            }else{
                $detail_category = $this->post_category_model->get_by_slug_check_active($explode_slug[1]);
                $this->get_posts_with_category($main, $detail_category['id'], $ids);
                $new_ids = array_unique($ids);
                $result = $this->post_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
            }
            $this->data['result'] = $result;
            $this->data['slug'] = $detail_category['slug'];
        }else{
            $this->data['result'] = array();
            $this->data['slug'] = '';
        }
        $this->data['detail'] = $detail;
        $this->data['count_sub'] = count($this->menu_model->get_by_parent_id_when_active($id));
        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/'. $this->controller .'/edit_menu_view');
        } else {
            if ($this->input->post()) {
                $parent = $this->menu_model->get_by_id($detail['parent_id'],array('title'));
                if(!empty($parent['id']) && $this->input->post('isActived_shared') == 0 && $parent['is_activated'] == 1){
                    $this->session->set_flashdata('message_error', MESSAGE_ERROR_UPDATE_TURN_ON);
                    redirect('admin/'. $this->controller .'/edit/'.$detail['id'], 'refresh');
                }
                $shared_request = array(
                    'is_activated' => $this->input->post('isActived_shared'),
                    'url' => $this->input->post('url_shared'),
                    'slug' => $this->input->post('selectMain_shared'),
                    'slug_post' => $this->input->post('selectArticle_shared'),
                );
                if($this->input->post('isActived_shared') == 0){
                    if(!empty($this->input->post('selectMain_shared'))){
                        $explode_slug_category = explode('/', $this->input->post('selectMain_shared'));
                        if($explode_slug_category[0] == 'san-pham' || $explode_slug_category[0] == 'nhom'){
                            $check_category = $this->product_category_model->get_by_slug_check_active($explode_slug_category[1]);
                        }else{
                            $check_category = $this->post_category_model->get_by_slug_check_active($explode_slug_category[1]);
                        }
                        if(!empty($check_category) && $check_category['is_activated'] == 1){
                            $this->session->set_flashdata('message_error', sprintf(MESSAGE_ERROR_TURN_ON_POST_CATEGORY_FOR_SELECTED, $check_category['title']));
                            redirect('admin/'. $this->controller .'/edit/' . $id,'refresh');
                        }
                    }
                    if(!empty($this->input->post('selectArticle_shared'))){
                        $explode_slug = explode('/', $this->input->post('selectArticle_shared'));
                        if($explode_slug[0] == 'san-pham'){
                            $check = $this->product_model->find_rows(array('slug' => $explode_slug[1], 'is_activated' => 0, 'is_deleted' => 0));
                        }else{
                            $check = $this->post_model->find_rows(array('slug' => $explode_slug[1], 'is_activated' => 0, 'is_deleted' => 0));
                        }
                        if($check == 0){
                            $this->session->set_flashdata('message_error', MESSAGE_ERROR_TURN_ON_ARTICEL_FOR_SELECTED);
                            redirect('admin/'. $this->controller .'/edit/' . $id,'refresh');
                        }
                    }
                }
                $this->db->trans_begin();
                $update = $this->menu_model->common_update($id,array_merge($shared_request,$this->author_data));
                if($update){
                    $requests = handle_multi_language_request('menu_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages);
                    foreach ($requests as $key => $value){
                        $this->menu_model->update_with_language($id, $requests[$key]['language'], $value);
                    }
                }
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message_error', MESSAGE_EDIT_ERROR);
                    $this->render('admin/'. $this->controller .'/create_menu_view');
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('message_success', MESSAGE_EDIT_SUCCESS);
                    if($this->input->post('isActived_shared') == 1){
                        foreach ($this->get_id_children_and_id($id) as $key => $value) {
                            $this->menu_model->common_update($value, array_merge(array('is_activated' => 1),$this->author_data));
                        }
                    }
                    redirect('admin/'. $this->controller .'/edit/' . $id,'refresh');
                }
            }
        }
        
    }

    public function remove(){
        $id = $this->input->get('id');
        $list_menus = $this->menu_model->get_by_parent_id(null, 'asc');
        
        $detail_menu = $this->menu_model->get_by_id_wo_lang($id);
        $this->get_posts_with_category($list_menus, $detail_menu['id'], $ids);
        $ids = array_unique($ids);
        $new_id = array(0 => $id);
        if(array_diff($ids, $new_id) == null){
            $data = array('is_deleted' => 1);
            $update = $this->menu_model->common_update($id, $data);
            if($update == 1){ 
                return $this->return_api(HTTP_SUCCESS,'');
            }
        }else{
            return $this->return_api(HTTP_SUCCESS,null,'',false);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }

    public function sort(){
        $params = array();
        parse_str($this->input->get('sort'), $params);
        $i = 1;
        foreach($params as $value){
            $this->menu_model->update_sort($i, $value[0]);
            $i++;
        }
   }

   public function active(){
        $id = $this->input->post('id');
        $detail = $this->menu_model->get_by_id_wo_lang($id);
        $parent = $this->menu_model->get_by_id_wo_lang($detail['parent_id']);
        $children = $this->get_id_children_and_id($id);
        if(!empty($parent) && $detail['is_activated'] == 1 && $parent['is_activated'] == 1){
            $message_warning = MESSAGE_ERROR_TURN_ON_MENU_PRESENT;
            return $this->return_api(HTTP_NOT_FOUND,$message_warning);
        }
        if($detail['is_activated'] == 0){
            $data = array('is_activated' => 1);
            foreach ($this->get_id_children_and_id($id) as $key => $value) {
                $update = $this->menu_model->common_update($value, $data);
            }
            $message_success = MESSAGE_SUCCESS_TURN_OFF;
        }else{
            if(explode('/',$detail['slug'])[0] == 'nhom'){
                $check_category = $this->product_category_model->get_by_slug_check_active(explode('/',$detail['slug'])[1]);
            }else{
                $check_category = $this->post_category_model->get_by_slug_check_active(explode('/',$detail['slug'])[1]);
            }
            if(!empty($check_category) && $check_category['is_activated'] == 1){
                $message_warning = sprintf(MESSAGE_ERROR_TURN_ON_POST_CATEGORY_FOR_SELECTED, $check_category['title']);
                return $this->return_api(HTTP_NOT_FOUND,$message_warning);
            }
            if(!empty($detail['slug_post'])){
                if(explode('/',$detail['slug_post'])[0] == 'san-pham'){
                    $check = $this->product_model->find_rows(array('slug' => explode('/',$detail['slug_post'])[1], 'is_activated' => 0, 'is_deleted' => 0));
                }else{
                    $check = $this->post_model->find_rows(array('slug' => explode('/',$detail['slug_post'])[1], 'is_activated' => 0, 'is_deleted' => 0));
                }
                if($check == 0){
                    $message_warning = MESSAGE_ERROR_TURN_ON_POST_FOR_SELECTED;
                    return $this->return_api(HTTP_NOT_FOUND,$message_warning);
                }
            }
            $data = array('is_activated' => 0);
            $update = $this->menu_model->common_update($id, $data);
            $message_success = MESSAGE_SUCCESS_TURN_ON;
        }
        if ($update == 0) {
            return $this->return_api(HTTP_BAD_REQUEST);
        } else {
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,$message_success,$reponse);
        }
        
    }

    protected function build_parent_title($parent_id){
        $sub = $this->post_category_model->get_by_id($parent_id, array('title'));

        if($parent_id != 0){
            $title = explode('|||', $sub['post_category_title']);
            $sub['title_en'] = $title[0];
            $sub['title_vi'] = $title[1];

            $title = $sub['title_vi'];
        }else{
            $title = 'Danh mục gốc';
        }
        return $title;
    }

    function fetch_posts_for_menu($id, $controller, $page_languages, $main_category, $detail,$explode_slug){
        $detail = build_language($this->controller, $detail, array('title'), $this->page_languages);
        if($explode_slug[0] == 'nhom' || $explode_slug[0] == 'san-pham'){
            $detail_category = $this->product_category_model->get_by_slug($explode_slug[1]);
            $this->get_posts_with_category($main_category, $detail_category['id'], $ids);
            $new_ids = array_unique($ids);
            $result = $this->product_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
        }else{
            $detail_category = $this->post_category_model->get_by_slug($explode_slug[1]);
            $this->get_posts_with_category($main_category, $detail_category['id'], $ids);
            $new_ids = array_unique($ids);
            $result = $this->post_model->get_by_multiple_ids_activated(array_unique($new_ids), 'vi');
        }
        $this->data['detail'] = $detail;
        $this->data['result'] = $result;
        $this->data['slug'] = $detail_category['slug'];
    }



}