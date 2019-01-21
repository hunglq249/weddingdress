<?php 

/**
* 
*/
class Collection extends Admin_Controller{
    private $request_language_template = array(
        'title','description', 'content', 'metakeywords', 'metadescription'
    );
    private $author_data = array();

    function __construct(){
        parent::__construct();
        $this->load->model('collection_model');
        $this->load->model('banner_model');
        $this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->data['controller'] = $this->collection_model->table;
        $this->author_data = handle_author_common_data();
    }

    public function index(){
        $keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $total_rows  = $this->collection_model->count_search('vi');
        if($keywords != ''){
            $total_rows  = $this->collection_model->count_search('vi', $keywords);
        }

        
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/'. $this->data['controller'] .'/index');
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();

        $result = $this->collection_model->get_all_with_pagination_search('asc','vi' , $per_page, $this->data['page']);
        if($keywords != ''){
            $result = $this->collection_model->get_all_with_pagination_search('asc','vi' , $per_page, $this->data['page'], $keywords);
        }
        foreach ($result as $key => $value) {
            $parent_title = $this->build_parent_title($value['parent_id']);
            $result[$key]['parent_title'] = $parent_title;
        }
        $this->data['result'] = $result;
        $this->data['check'] = $this;
        $this->render('admin/'. $this->data['controller'] .'/list_collection_view');
    }

    public function create($id = ''){
        if(isset($id) && is_numeric($id)){
            $this->data['id'] = $id;
        }else{
            $this->data['id'] = 0;
        }
        $this->load->helper('form');
        $collection = $this->collection_model->get_by_parent_id(null,'asc');
        $this->build_new_category($collection,0,$this->data['collection']);
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('title_en', 'Title', 'required');
            if($this->form_validation->run() == TRUE){
                if(!empty($_FILES['image_left']['name'])){
                    $this->check_img($_FILES['image_left']['name'], $_FILES['image_left']['size']);
                }
                $slug = $this->input->post('slug_shared');
                if(!empty($_FILES['image_right']['name'])){
                    $this->check_img($_FILES['image_right']['name'], $_FILES['image_right']['size']);
                }
                $slug = $this->input->post('slug_shared');
                
                $unique_slug = $this->collection_model->build_unique_slug($slug);
                if(!file_exists("assets/upload/".$this->data['controller']."/".$unique_slug)){
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug, 0755);
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug.'/thumb', 0755);
                }
                if(!empty($_FILES['image_left']['name'])){
                    $image_left = $this->upload_image('image_left', $_FILES['image_left']['name'], 'assets/upload/'.$this->data['controller']."/".$unique_slug, 'assets/upload/'.$this->data['controller']."/".$unique_slug .'/thumb');
                }
                if(!empty($_FILES['image_right']['name'])){
                    $image_right = $this->upload_image('image_right', $_FILES['image_right']['name'], 'assets/upload/'.$this->data['controller']."/".$unique_slug, 'assets/upload/'.$this->data['controller']."/".$unique_slug .'/thumb');
                }
                $shared_request = array(
                    'slug' => $unique_slug,
                );
                if(isset($image_left)){
                    $shared_request['image_left'] = $image_left;
                }
                if(isset($image_right)){
                    $shared_request['image_right'] = $image_right;
                }
                $this->db->trans_begin();
                $insert = $this->collection_model->common_insert(array_merge($shared_request,$this->author_data));
                if($insert){
                    $requests = handle_multi_language_request('collection_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages);
                    $this->collection_model->insert_with_language($requests);
                }
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message_error', MESSAGE_CREATE_ERROR);
                    $this->render('admin/'. $this->data['controller'] .'/create_collection_view');
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('message_success', MESSAGE_CREATE_SUCCESS);
                    if(isset($id) && is_numeric($id)){
                        redirect('admin/'. $this->data['controller'] .'/detail/' . $id,'refresh');
                    }else{
                        redirect('admin/'. $this->data['controller'], 'refresh');
                    }
                    
                }
            }
        }
        $this->render('admin/'. $this->data['controller'] .'/create_collection_view');
    }
    public function edit($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            $collection = $this->collection_model->get_by_parent_id(null,'asc');
            $this->data['category'] = build_array_for_dropdown($this->collection_model->get_all_with_pagination_search(),$id);
            if($this->collection_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/'. $this->data['controller'] .'', 'refresh');
            }
            $detail = $this->collection_model->get_by_id($id, $this->request_language_template);
            $this->build_new_category($collection,0,$this->data['collection'],$detail['parent_id'],$id);
            $this->data['detail'] = build_language($this->data['controller'], $detail, $this->request_language_template, $this->page_languages);
            if($this->input->post()){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
                $this->form_validation->set_rules('title_en', 'Title', 'required');
                if($this->form_validation->run() == TRUE){
                    if(!empty($_FILES['image_left']['name'])){
                        $this->check_img($_FILES['image_left']['name'], $_FILES['image_left']['size']);
                    }
                    if(!empty($_FILES['image_right']['name'])){
                        $this->check_img($_FILES['image_right']['name'], $_FILES['image_right']['size']);
                    }
                    $unique_slug = $this->data['detail']['slug'];
                    if($unique_slug !== $this->input->post('slug_shared')){
                        $unique_slug = $this->collection_model->build_unique_slug($this->input->post('slug_shared'));
                        if(file_exists("assets/upload/".$this->data['controller']."/".$detail['slug'])) {
                            rename("assets/upload/".$this->data['controller']."/".$detail['slug'], "assets/upload/".$this->data['controller']."/".$unique_slug);
                        }
                    }
                    if(!empty($_FILES['image_left']['name'])){
                        $image_left = $this->upload_image('image_left', $_FILES['image_left']['name'], 'assets/upload/'.$this->data['controller']."/".$unique_slug, 'assets/upload/'.$this->data['controller']."/".$unique_slug .'/thumb');
                    }
                    if(!empty($_FILES['image_right']['name'])){
                        $image_right = $this->upload_image('image_right', $_FILES['image_right']['name'], 'assets/upload/'.$this->data['controller']."/".$unique_slug, 'assets/upload/'.$this->data['controller']."/".$unique_slug .'/thumb');
                    }
                    $shared_request = [];
                    if($unique_slug != $this->data['detail']['slug']){
                        $shared_request['slug'] = $unique_slug;
                    }
                    if(isset($image_left)){
                        $shared_request['image_left'] = $image_left;
                    }
                    if(isset($image_right)){
                        $shared_request['image_right'] = $image_right;
                    }
                    $this->db->trans_begin();
                    $update = $this->collection_model->common_update($id,array_merge($shared_request,$this->author_data));
                    if($update){
                        $requests = handle_multi_language_request('collection_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages);
                        foreach ($requests as $key => $value) {
                            $this->collection_model->update_with_language($id, $requests[$key]['language'],$value);
                        }
                    }
                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('message_error', MESSAGE_EDIT_ERROR);
                        $this->render('admin/'. $this->data['controller'] .'/edit_collection_view');
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
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
        $this->render('admin/'. $this->data['controller'] .'/edit_collection_view');
    }

    function remove(){
        $id = $this->input->post('id');
        $this->load->model("menu_model");
        $this->load->model('product_model');
        if($id &&  is_numeric($id) && ($id > 0)){
            $detail = $this->collection_model->find($id);
            if(empty($detail)){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR);
            }
            $where = array('collection_id' => $id,'is_deleted' => 0);
            $product = $this->product_model->find_rows($where);// lấy số bài viết thuộc về category
            $where = array('parent_id' => $id);
            $parent_id = $this->collection_model->find_rows($where);//lấy số con của category
            if($product == 0 && $parent_id == 0){
                $data = array('is_deleted' => 1);
                $update = $this->collection_model->common_update($id, $data);
                if($update){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
                }
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
            }else{
                return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_FOREIGN_KEY_LINK_COLLECTION_ERROR,$product,$parent_id));
            }
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }

    public function detail($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            $this->load->library('form_validation');
            $sub_category = $this->collection_model->get_by_parent_id($id);
            $this->data['sub_category'] = $sub_category;
            if($this->collection_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/'. $this->data['controller'] .'', 'refresh');
            }
            $detail = $this->collection_model->get_by_id($id, $this->request_language_template);
            $detail = build_language($this->data['controller'], $detail, $this->request_language_template, $this->page_languages);
            $parent_title = $this->build_parent_title($detail['parent_id']);
            $detail['parent_title'] = $parent_title;
            $this->data['detail'] = $detail;
            $this->render('admin/'. $this->data['controller'] .'/detail_collection_view');
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            return redirect('admin/'.$this->data['controller'],'refresh');
        }
    }

    public function active(){
        $this->load->model('product_model');
        $id = $this->input->post('id');
        $product_cateogry = $this->collection_model->find($id);
        if($product_cateogry['parent_id'] != 0){
            $parent_id = $this->collection_model->find($product_cateogry['parent_id']);
            if($parent_id['is_activated'] == 1){ 
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ERROR_ACTIVE_CATEGORY);
            }
        }

        $data = array('is_activated' => 0);
        $update = $this->collection_model->multiple_update_by_ids($id, $data);

        if ($update == 1) {
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,'',$reponse);
        }
        return $this->return_api(HTTP_BAD_REQUEST);
    }

    public function deactive(){
        $this->load->model('product_model');
        $id = $this->input->post('id');
        $data = array('is_activated' => 1);
        $this->db->trans_begin();
        $update = $this->collection_model->multiple_update_by_ids($id, $data);
        if ($update == 1) {
            $this->product_model->multiple_update_by_collection_ids($id, $data);
            $this->banner_model->multiple_update_by_banner_ids($id, 1,$data);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return $this->return_api(HTTP_BAD_REQUEST);
        } else {
            $this->db->trans_commit();
            $this->load->model("menu_model");
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,'',$reponse);
        }
    }


    protected function build_parent_title($parent_id){
        $sub = $this->collection_model->get_by_id($parent_id, array('title'));

        if($parent_id != 0){
            $title = explode('|||', $sub['collection_title']);
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

    function get_multiple_products_with_category($categories, $parent_id = 0, &$ids){
        foreach ($categories as $key => $item){
            $ids[] = $parent_id;
            if ($item['parent_id'] == $parent_id){
                $ids[] = $item['id'];
                $this->get_multiple_products_with_category($categories, $item['id'], $ids);
            }
        }
    }
    function build_new_category($categorie, $parent_id = 0,&$result, $parent_id_edit = "",$id_edit = "",$char=""){
        $cate_child = array();
        if($parent_id == 0){
            $result.='<option value="0" selected>Danh mục gốc</option>';
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

    public function check_sub_category($id){
        $check_sub_category = $this->collection_model->get_by_parent_id($id);
        if ($check_sub_category) {
            return true;
        }
        return false;
    }
}