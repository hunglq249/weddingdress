<?php 

/**
* 
*/
class Post extends Admin_Controller{
	private $request_language_template = array(
        'title', 'description', 'content'
    );
    private $author_data = array();
    private $controller = '';

	function __construct(){
		parent::__construct();
        $this->load->model('post_model');
        $this->load->model('post_category_model');
        $this->load->model('templates_model');
		$this->load->helper('common');
        $this->load->helper('file');
        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->controller = 'post';
        $this->data['number_field'] = 6;
        $this->data['controller'] = $this->controller;

		$this->author_data = handle_author_common_data();
	}

    public function index(){
        $keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $total_rows  = $this->post_model->count_search('vi');
        if($keywords != ''){
            $total_rows  = $this->post_model->count_search('vi', $keywords);
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
        $this->data['templates'] = $this->templates_model->get_all();

        $result = $this->post_model->get_all_with_pagination_search('desc','vi' , $per_page, $this->data['page']);
        if($keywords != ''){
            $result = $this->post_model->get_all_with_pagination_search('desc','vi' , $per_page, $this->data['page'], $keywords);
        }
        foreach ($result as $key => $value) {
            $parent_title = $this->build_parent_title($value['post_category_id']);
            $result[$key]['parent_title'] = $parent_title;
        }
        $this->data['result'] = $result;
        $this->render('admin/post/list_post_view');
    }

	public function create($id_template = 24){
        if($id_template &&  is_numeric($id_template) && ($id_template > 0)){
            $this->load->helper('form');
            $this->load->library('form_validation');
            if($this->templates_model->find_rows(array('is_deleted' => 0, 'id' => $id_template,'type' => '1')) != 0){
                $this->data['detail'] = $this->templates_model->get_by_id_templates($id_template);
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_CONFIG_ERROR);
                redirect('admin/'. $this->data['controller'] .'', 'refresh');
            }
            $post_category = $this->post_category_model->get_by_parent_id(null,'asc');
            $this->data['post_category'] = $post_category;
        	if($this->input->post()){
                if($this->check_all_file_img($_FILES) === false){
                    return false;
                }
            	$slug = $this->input->post('slug_shared');
                $unique_slug = $this->post_model->build_unique_slug($slug);
                $templates = array_slice(json_decode($this->data['detail']['data'],true), $this->data['number_field']);
                $request_data = handle_multi_language_requests($this->input->post(), $this->page_languages, $templates);
                if(!file_exists("assets/upload/".$this->data['controller']."/".$unique_slug)){
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug, 0777);
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug.'/thumb', 0777);
                }
                $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'. $this->controller.'/'.$unique_slug, 'assets/upload/'.$this->controller.'/'.$unique_slug.'/thumb');
                unset($_FILES['image_shared']);
                $check_file = $this->all_file_common($_FILES, $templates,$unique_slug);//json_decode($this->data['detail']['data'],true)
                $shared_request = array(
                    'slug' => $unique_slug,
                    'image' => $image,
                    'post_category_id' => $this->input->post('parent_id_shared'),
                    'templates_id' => $id_template,
                    'data' => json_encode(array_merge($request_data['data'], $check_file)),
                    'created_at' => $this->author_data['created_at'],
                    'created_by' => $this->author_data['created_by'],
                    'updated_at' => $this->author_data['updated_at'],
                    'updated_by' => $this->author_data['updated_by']
                );
                $this->db->trans_begin();
                $insert = $this->post_model->common_insert($shared_request);
                if($insert){
                    $requests = handle_multi_language_request('post_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages, $request_data['data_lang']);
                    $this->post_model->insert_with_language($requests);
                }
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR);
                } else {
                    $this->db->trans_commit();
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_CREATE_SUCCESS,$reponse);
                }
        	}
            $this->render('admin/post/create_post_view');
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
	}

    public function detail($id){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $detail = $this->post_model->get_by_id($id, array('title', 'description', 'content','data_lang'));
        $templates = $this->templates_model->get_by_id_templates($detail['templates_id']);
        $detail = build_language($this->controller, $detail, array('title', 'description', 'content','data_lang'), $this->page_languages);
        $parent_title = $this->build_parent_title($detail['post_category_id']);
        $detail['parent_title'] = $parent_title;
        $this->data['detail'] = $detail;
        $this->data['templates'] = array_slice(json_decode($templates['data'],true), $this->data['number_field']);
        $this->data['templates_all'] = json_decode($templates['data'],true);
        $this->render('admin/post/detail_post_view');
    }

    public function edit($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $detail = $this->post_model->get_by_id($id, array('title', 'description', 'content', 'data_lang'));
        $detail = build_language($this->controller, $detail, array('title', 'description', 'content', 'data_lang'), $this->page_languages);
        $this->data['templates'] = array();
        $this->data['templates_all'] = array();
        if($this->templates_model->find_rows(array('is_deleted' => 0, 'id' => $detail['templates_id'])) != 0){
            $this->data['templates_all'] = json_decode($this->templates_model->get_by_id_templates($detail['templates_id'])['data'],true);
            $this->data['templates'] = array_slice($this->data['templates_all'],$this->data['number_field']);
        }
        $category = $this->post_category_model->get_by_parent_id(null,'asc');
        $detail['data'] = json_decode($detail['data'],true);
        $this->data['post_category'] = $category;
        $this->data['detail'] = $detail;
        if($this->input->post()){
            if($this->check_all_file_img($_FILES) === false){
                return false;
            }
            $slug = $this->input->post('slug_shared');
            $unique_slug = $this->post_model->build_unique_slug($slug, $id);
            if($unique_slug !== $detail['slug']){
                if(file_exists("assets/upload/".$this->data['controller']."/".$detail['slug'])) {
                    rename("assets/upload/".$this->data['controller']."/".$detail['slug'], "assets/upload/".$this->data['controller']."/".$unique_slug);
                }
            }
            $request_data = handle_multi_language_requests($this->input->post(), $this->page_languages, $this->data['templates']);
            $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'. $this->controller .'/'.$unique_slug, 'assets/upload/'. $this->controller . '/' .$unique_slug. '/thumb');
            unset($_FILES['image_shared']);
            $check_file = $this->all_file_common($_FILES, $this->data['templates'],$unique_slug,$detail['data']);
            $shared_request = array(
                'slug' => $unique_slug,
                'post_category_id' => $this->input->post('parent_id_shared'),
                'data' => json_encode(array_merge($request_data['data'], $check_file)),
                'created_at' => $this->author_data['created_at'],
                'created_by' => $this->author_data['created_by'],
                'updated_at' => $this->author_data['updated_at'],
                'updated_by' => $this->author_data['updated_by']
            );
            if($image){
                $shared_request['image'] = $image;
            }
            $this->db->trans_begin();

            $update = $this->post_model->common_update($id, $shared_request);
            if($update){
                $requests = handle_multi_language_request('post_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages,$request_data['data_lang']);
                foreach ($requests as $key => $value){
                    $this->post_model->update_with_language($id, $requests[$key]['language'], $value);
                }
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_EDIT_ERROR);
            } else {
                $this->db->trans_commit();
                if($image != '' && !empty($detail['image'])) {
                    $this->remove_img($unique_slug,$detail['image']);
                }
                foreach ($check_file as $key => $value) {
                    if(!isset($this->data['templates'][$key]['check_multiple'])){
                        if($value != $detail['data'][$key]){
                            $this->remove_img($unique_slug,$detail['data'][$key]);
                        }
                        
                    }
                }
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                return $this->return_api(HTTP_SUCCESS,MESSAGE_EDIT_SUCCESS,$reponse);
            }
        }
        $this->render('admin/post/edit_post_view');
    }

    public function remove(){
        $id = $this->input->post('id');
        $post = $this->post_model->find($id);
        $this->load->model("menu_model");
        $menu_model = $this->menu_model->get_where_array(array('slug_post' => 'bai-viet/'.$post['slug']));
        if(count($menu_model) > 0){
            return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_ERROR_REMOVE, count($menu_model)));
        }
        $data = array('is_deleted' => 1);
        $update = $this->post_model->common_update($id, $data);
        if($update == 1){
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
    }

    public function active(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $post = $this->post_model->find($id);
            $post_category = $this->post_category_model->find($post['post_category_id']);
            if($post_category['is_activated'] == 1){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ERROR_ACTIVE_POST);
            }
            if($this->post_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $update = $this->post_model->common_update($id,array_merge(array('is_activated' => 0),$this->author_data));
                if($update){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,'',$reponse);
                }
                return $this->return_api(HTTP_BAD_REQUEST);
            }
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }
    
    public function deactive(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->post_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->model("menu_model");
                $post = $this->post_model->find($id);
                $menu_model = $this->menu_model->get_row_where_array(array('slug_post' => 'bai-viet/'.$post['slug']));
                if(!empty($menu_model)){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash(),
                        'id' => $menu_model['id']
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_TURN_OFF_POST_MENU,$reponse);
                }
                $update = $this->post_model->common_update($id,array_merge(array('is_activated' => 1),$this->author_data));
                if($update){
                    // $this->load->model("menu_model");
                    // $post = $this->post_model->find($id);
                    // $menu_model = $this->menu_model->get_where_array(array('slug_post' => 'bai-viet/'.$post['slug']));
                    // if(count($menu_model) > 0){
                    //     $data = array('is_activated' => 1);
                    //     foreach ($menu_model as $key => $value) {
                    //         foreach ($this->get_id_children_and_id($value['id']) as $k => $val) {
                    //             $this->menu_model->common_update($val, array_merge($data,$this->author_data));
                    //         }
                    //     }
                    // }
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_SUCCESS_TURN_OFF_ALL,$reponse);
                }
                return $this->return_api(HTTP_BAD_REQUEST);
            }
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }

    /**
     * [build_parent_title description]
     * @param  [type] $parent_id [description]
     * @return [type]            [description]
     */
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


    public function get_by_menu_post_url($url,&$newarray){
        if(count($this->menu_model->get_by_check_menu_children(0))>0){
            foreach ($this->menu_model->get_by_check_menu_children(0) as $key => $value) {
                $url = explode("/", rtrim(str_replace(base_url(),'',$value['url']),"/"));
                $newarray[] = $url;
            }
        }else{
            echo 2;die;
        }
    }

    protected function check_img($filename, $filesize){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        if(!($fileextension == 'jpg' || $fileextension == 'jpeg' || $fileextension == 'png' || $fileextension == 'gif')){
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_FILE_EXTENSION_ERROR,$reponse);
        }
        if ($filesize > 1228800) {
            return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_PHOTOS_ERROR, 1200),$reponse);
        }
        return true;
    }
    protected function check_imgs($filename, $filesize){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $images = array('jpg', 'jpeg', 'png', 'gif');
        foreach ($filename as $key => $value) {
            $map[] = explode('.',$value);
        }
        foreach ($map as $key => $value) {
            $new_map[] = $value[1];
        }
        if(array_diff($new_map, $images) != null){
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_FILE_EXTENSION_ERROR,$reponse);
        }
        $image_size = array('success');

        foreach ($filesize as $key => $value) {
            if ($value > 1228800) {
                $check_size[] = 'error';
            }else{
                $check_size[] = 'success';
            }
        }
        if (array_diff($check_size, $image_size) != null) {
            return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_PHOTOS_ERROR, 1200),$reponse);
        }
        return true;
    }

    public function remove_image_multiple(){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $id = $this->input->post('id');
        $image = $this->input->post('image');
        $key = $this->input->post('key');
        $detail = $this->post_model->get_by_id($id);
        $data = json_decode($detail['data'],true);
        $k = array_search($image, $data[$key]);
        unset($data[$key][$k]);
        $data[$key] = array_values($data[$key]);
        $data = array('data' => json_encode($data));
        $update = $this->post_model->common_update($id, $data);
        if($update == 1){
            if($image != '' && file_exists('assets/upload/'.$this->data['controller'].'/'.$detail['slug'].'/'.$image)){
                $this->remove_img($detail['slug'],$image);
            }
            return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
        }
        return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_ERROR,$reponse);
    }

    protected function remove_img($unique_slug = '',$image= ''){
        if(file_exists('assets/upload/'. $this->data['controller'] .'/'.$unique_slug.'/'.$image)){
            unlink('assets/upload/'. $this->data['controller'] .'/'.$unique_slug.'/'.$image);
            $new_array = explode('.', $image);
            $typeimg = array_pop($new_array);
            $nameimg = str_replace(".".$typeimg, "", $image);
            if(file_exists('assets/upload/'. $this->data['controller'] .'/'.$unique_slug.'/thumb/'.$nameimg.'_thumb.'.$typeimg)){
                unlink('assets/upload/'. $this->data['controller'] .'/'.$unique_slug.'/thumb/'.$nameimg.'_thumb.'.$typeimg);
            }
        }
    }
    protected function check_all_file($file, $templates, $slug = '',$upload = array()) {
        $image = array();
        foreach ($file as $key => $value) {
            if(isset($templates[$key]['check_multiple'])){
                $image[$key] = array();
                if(!empty($value['name'][0])){
                    $this->check_imgs($value['name'], $value['size']);
                    $image[$key] = $this->upload_file('./assets/upload/'. $this->controller.'/'.$slug, $key, 'assets/upload/'.$this->controller.'/'.$slug.'/thumb');
                    if(!empty($upload)){
                        if(isset($upload[$key]) && !empty($upload[$key])){
                            $image[$key] = array_merge($image[$key],$upload[$key]);
                        }
                    }
                }else{
                    if(isset($upload[$key]) && !empty($upload[$key])){
                        $image[$key] = $upload[$key];
                    }
                }
            }else{
                $image[$key] = '';
                if(!empty($value['name'])){
                    $this->check_img($value['name'], $value['size']);
                    $image[$key] = $this->upload_image($key, $_FILES[$key]['name'], 'assets/upload/'. $this->controller.'/'.$slug, 'assets/upload/'.$this->controller.'/'.$slug.'/thumb');
                }else{
                    if(isset($upload[$key]) && !empty($upload[$key])){
                        $image[$key] = $upload[$key];
                    }
                }
            }
        }
        return $image;
    }
    protected function all_file_common($file, $templates, $slug = '',$upload = array()) {
        $image = array();
        foreach ($file as $key => $value) {
            if(isset($templates[$key]['check_multiple'])){
                $image[$key] = array();
                if(!empty($value['name'][0])){
                    $image[$key] = $this->upload_file('./assets/upload/'. $this->data['controller'].'/'.$slug, $key, 'assets/upload/'.$this->data['controller'].'/'.$slug.'/thumb');
                    if(!empty($upload)){
                        if(isset($upload[$key]) && !empty($upload[$key])){
                            $image[$key] = array_merge($image[$key],$upload[$key]);
                        }
                    }
                }else{
                    if(isset($upload[$key]) && !empty($upload[$key])){
                        $image[$key] = $upload[$key];
                    }
                }
            }else{
                $image[$key] = '';
                if(!empty($value['name'])){
                    $image[$key] = $this->upload_image($key, $_FILES[$key]['name'], 'assets/upload/'. $this->data['controller'].'/'.$slug, 'assets/upload/'.$this->data['controller'].'/'.$slug.'/thumb');
                }else{
                    if(isset($upload[$key]) && !empty($upload[$key])){
                        $image[$key] = $upload[$key];
                    }
                }
            }
        }
        return $image;
    }
    protected function check_all_file_img($file) {
        foreach ($file as $key => $value) {
            if(is_array($value['name'])){
                if(!empty($value['name'][0])){
                    if($this->check_imgs($value['name'], $value['size']) !== true){
                        return false;
                    }
                }
            }else{
                if(!empty($value['name'])){
                    if($this->check_img($value['name'], $value['size']) !== true){
                        return false;
                    }
                }
            }
        }
        return true;
    }

}