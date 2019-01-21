<?php 

/**
* 
*/
class Product extends Admin_Controller{
	private $request_language_template = array(
        'title', 'description', 'content'
    );
    private $author_data = array();

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
        $this->load->model('product_category_model');
        $this->load->model('templates_model');
        $this->load->model('collection_model');
		$this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->data['controller'] = $this->product_model->table;
        $this->data['number_field'] = 6;
		$this->author_data = handle_author_common_data();
	}

    public function index(){
        $this->data['keyword'] = '';
        if($this->input->get('search')){
            $this->data['keyword'] = $this->input->get('search');
        }
        $this->load->library('pagination');
        $per_page = 10;
        $total_rows  = $this->product_model->count_search('vi', $this->data['keyword']);
        $config = $this->pagination_config(base_url('admin/'.$this->data['controller'].'/index'), $total_rows, $per_page, 4);
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->product_model->get_all_with_pagination_search('desc','vi' , $per_page, $this->data['page'], $this->data['keyword']);
        $this->data['templates'] = $this->templates_model->get_all('desc',2);
        foreach ($this->data['result'] as $key => $value) {
            $parent_title = $this->build_parent_title($value['product_category_id']);
            $this->data['result'][$key]['parent_title'] = $parent_title;
        }
        $this->render('admin/product/list_product_view');
    }

	public function create($id_template = 23){
        if($id_template &&  is_numeric($id_template) && ($id_template > 0)){
    		$this->load->helper('form');
            if($this->templates_model->find_rows(array('is_deleted' => 0, 'id' => $id_template, 'type' => '2')) != 0){
                $this->data['detail'] = $this->templates_model->get_by_id_templates($id_template);
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_CONFIG_ERROR);
                redirect('admin/'. $this->data['controller'] .'', 'refresh');
            }
            $this->data['collection'] = $this->collection_model->get_by_parent_id(null,'asc');
            $type_dress = $this->product_category_model->get_by_type(0,'asc');
            $type_accessories = $this->product_category_model->get_by_type(1,'asc');
            $this->build_new_category($type_dress,0,$this->data['type_dress']);
            $this->build_new_category($type_accessories,0,$this->data['type_accessories']);
            if($this->input->post()){
                $this->load->library('form_validation');
                if($this->check_all_file_img($_FILES) === false){
                    return false;
                }
                $slug = $this->input->post('slug_shared');
                $unique_slug = $this->product_model->build_unique_slug($slug);
                $templates = array_slice(json_decode($this->data['detail']['data'],true), $this->data['number_field']);
                $request_data = handle_multi_language_requests($this->input->post(), $this->page_languages, $templates);
                if(!file_exists("assets/upload/".$this->data['controller']."/".$unique_slug)){
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug, 0755);
                    mkdir("assets/upload/".$this->data['controller']."/".$unique_slug.'/thumb', 0755);
                }
                $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'. $this->data['controller'].'/'.$unique_slug, 'assets/upload/'.$this->data['controller'].'/'.$unique_slug.'/thumb');
                unset($_FILES['image_shared']);
                $collection = array();
                if (!empty($_FILES['collection_shared']['name'][0])) {
                	$collection = $this->upload_file('./assets/upload/'. $this->data['controller'].'/'.$unique_slug, 'collection_shared', 'assets/upload/'.$this->data['controller'].'/'.$unique_slug.'/thumb');
                }
                unset($_FILES['collection_shared']);
                $check_file = $this->all_file_common($_FILES, $templates,$unique_slug);
                $data = array_merge($request_data['data'], $check_file);
                $common = array(
                    'sale' => $this->input->post('sale'),
                	'rent' => $this->input->post('rent'),
                	'rent_sale' => $this->input->post('rent_sale'),
                	'showpromotion' => $this->input->post('showpromotion'),
                	'showpromotion_rent' => $this->input->post('showpromotion_rent'),
                );
                $shared_request = array(
                    'slug' => $unique_slug,
                    'image' => $image,
                    'collection' => json_encode($collection),
                    'product_category_id' => $this->input->post('parent_id_shared'),
                    'templates_id' => $id_template,
                    'data' => (empty($data) ? '{}' : json_encode($data)),
                    'date' => $this->input->post('date'),
                    'price' => $this->input->post('price'),
                    'price_rent' => $this->input->post('price_rent'),
                    'pricepromotion' => $this->input->post('pricepromotion'),
                    'pricepromotion_rent' => $this->input->post('pricepromotion_rent'),
                    'common' => json_encode($common),
                    'type' => $this->input->post('type'),
                    'collection_id' => $this->input->post('collection_id'),
                    'hot' => $this->input->post('hot'),
                );
                $this->db->trans_begin();
                $insert = $this->product_model->common_insert(array_merge($shared_request,$this->author_data));
                if($insert){
                    $requests = handle_multi_language_request('product_id', $insert, $this->request_language_template, $this->input->post(), $this->page_languages, $request_data['data_lang']);
                    $this->product_model->insert_with_language($requests);
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
            $this->render('admin/product/create_product_view');
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
	}

    public function detail($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->product_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->helper('form');
                $this->load->library('form_validation');
                $detail = $this->product_model->get_by_id($id, array('title', 'description', 'content','data_lang'));
                $templates = $this->templates_model->get_by_id_templates($detail['templates_id']);
                $detail = build_language($this->data['controller'], $detail, array('title', 'description', 'content','data_lang'), $this->page_languages);
                $parent_title = $this->build_parent_title($detail['product_category_id']);
                $detail['parent_title'] = $parent_title;
                $this->data['detail'] = $detail;
                $this->data['collection'] = $this->collection_model->get_by_id($detail['collection_id'], array('title'),'vi');
                $this->data['templates'] = array_slice(json_decode($templates['data'],true), $this->data['number_field']);
                $this->data['templates_all'] = json_decode($templates['data'],true);
                $this->render('admin/product/detail_product_view');
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/product', 'refresh');
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            return redirect('admin/'.$this->data['controller'],'refresh');
        }
    }

    function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $product = $this->product_model->find($id);
            $templates = array_slice(json_decode($this->templates_model->find($product['templates_id'])['data'],true), $this->data['number_field']);
            if($this->product_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR,$reponse);
            }
            $this->load->model("menu_model");
            $menu_model = $this->menu_model->get_where_array(array('slug_post' => 'san-pham/'.$product['slug']));
            if(count($menu_model) > 0){
                return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_ERROR_REMOVE, count($menu_model)));
            }
            $data = array('is_deleted' => 1);
            $update = $this->product_model->common_update($id, $data);
            if($update){
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
            }
            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);

            // $delete = $this->product_model->common_delete($id);//chưa xong
            // if($delete){
            //     $reponse = array(
            //         'csrf_hash' => $this->security->get_csrf_hash()
            //     );
            //     array_map('unlink', glob('./assets/upload/product/'.$product['slug'].'/thumb/*.*'));
            //     array_map('unlink', glob('./assets/upload/product/'.$product['slug'].'/*.*'));
            //     rmdir('./assets/upload/product/'.$product['slug'].'/thumb');
            //     rmdir('./assets/upload/product/'.$product['slug']);
            //     return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
            // }
            // return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ID_ERROR);
    }

    public function edit($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            if($this->product_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/product', 'refresh');
            }
            $detail = $this->product_model->get_by_id($id, array('title','description','content', 'data_lang'));
            $this->data['templates'] = array();
            $this->data['templates_all'] = array();
            if($this->templates_model->find_rows(array('is_deleted' => 0, 'id' => $detail['templates_id'])) != 0){
                $this->data['templates_all'] = json_decode($this->templates_model->get_by_id_templates($detail['templates_id'])['data'],true);
                $this->data['templates'] = array_slice($this->data['templates_all'],$this->data['number_field']);
            }
            $subs = $this->product_model->get_by_parent_id($id, 'asc');

            $type_dress = $this->product_category_model->get_by_type(0,'asc');
            $type_accessories = $this->product_category_model->get_by_type(1,'asc');
            $this->build_new_category($type_dress,0,$this->data['type_dress']);
            $this->build_new_category($type_accessories,0,$this->data['type_accessories']);
            $this->data['detail'] = build_language($this->data['controller'], $detail, array('title','description','content', 'data_lang'), $this->page_languages);
            $this->data['collection'] = $this->collection_model->get_by_parent_id(null,'asc');
            if($this->input->post()){
                $this->load->library('form_validation');
                if($this->check_all_file_img($_FILES) === false){
                    return false;
                }
                $slug = $this->input->post('slug_shared');
                $unique_slug = $this->product_model->build_unique_slug($slug, $id);
                if($unique_slug !== $detail['slug']){
                    if(file_exists("assets/upload/".$this->data['controller']."/".$detail['slug'])) {
                        rename("assets/upload/".$this->data['controller']."/".$detail['slug'], "assets/upload/".$this->data['controller']."/".$unique_slug);
                    }
                }
                $request_data = handle_multi_language_requests($this->input->post(), $this->page_languages, $this->data['templates']);
                $image = $this->upload_image('image_shared', $_FILES['image_shared']['name'], 'assets/upload/'. $this->data['controller'] .'/'.$unique_slug, 'assets/upload/'. $this->data['controller'] . '/' .$unique_slug. '/thumb');
                unset($_FILES['image_shared']);
                $collection = array();
                if (!empty($_FILES['collection_shared']['name'][0])) {
                    $collection = $this->upload_file('./assets/upload/'. $this->data['controller'].'/'.$unique_slug, 'collection_shared', 'assets/upload/'.$this->data['controller'].'/'.$unique_slug.'/thumb');
                }
                unset($_FILES['collection_shared']);
                $check_file = $this->all_file_common($_FILES, $this->data['templates'],$unique_slug,$detail['data']);
                $common = array(
                    'sale' => $this->input->post('sale'),
                    'rent' => $this->input->post('rent'),
                    'rent_sale' => $this->input->post('rent_sale'),
                    'showpromotion' => $this->input->post('showpromotion'),
                    'showpromotion_rent' => $this->input->post('showpromotion_rent'),
                );
                $shared_request = array(
                    'slug' => $unique_slug,
                    'product_category_id' => $this->input->post('parent_id_shared'),
                    'data' => json_encode(array_merge($request_data['data'], $check_file)),
                    'date' => $this->input->post('date'),
                    'price' => $this->input->post('price'),
                    'price_rent' => $this->input->post('price_rent'),
                    'pricepromotion' => $this->input->post('pricepromotion'),
                    'pricepromotion_rent' => $this->input->post('pricepromotion_rent'),
                    'common' => json_encode($common),
                    'type' => $this->input->post('type'),
                    'collection_id' => $this->input->post('collection_id'),
                    'hot' => $this->input->post('hot'),
                );
                if($image){
                    $shared_request['image'] = $image;
                }
                if(!empty($collection)){
                    $shared_request['collection'] = json_encode(array_merge(json_decode($detail['collection']),$collection));
                }
                $this->db->trans_begin();
                $update = $this->product_model->common_update($id,array_merge($shared_request,$this->author_data));
                if($update){
                    $requests = handle_multi_language_request('product_id', $id, $this->request_language_template, $this->input->post(), $this->page_languages,$request_data['data_lang']);
                    foreach ($requests as $key => $value) {
                        $this->product_model->update_with_language($id, $requests[$key]['language'],$value);
                    }
                }
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_EDIT_ERROR);
                } else {
                    $this->db->trans_commit();
                    if($image != '' && !empty($detail['image'])) {
                        $this->remove_img_one($unique_slug,$detail['image']);
                    }
                    foreach ($check_file as $key => $value) {
                        if(!isset($this->data['templates'][$key]['check_multiple'])){
                            if($value != $detail['data'][$key]){
                                $this->remove_img_one($unique_slug,$detail['data'][$key]);
                            }
                            
                        }
                    }
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash()
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_EDIT_SUCCESS,$reponse);
                }
            }
            $this->render('admin/product/edit_product_view');
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
    }

    protected function remove_img_one($unique_slug = '',$image= ''){
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
    public function remove_image_multiple(){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $id = $this->input->post('id');
        $image = $this->input->post('image');
        $key = $this->input->post('key');
        $column = $this->input->post('column');
        $detail = $this->product_model->get_by_id($id,$this->request_language_template);
        if($column == 'collection'){
            $data = json_decode($detail[$column],true);
            $k = array_search($image, $data);
            unset($data[$k]);
            $data = array_values($data);
        }else{
            $data = json_decode($detail[$column],true);
            $k = array_search($image, $data[$key]);
            unset($data[$key][$k]);
            $data[$key] = array_values($data[$key]);
        }
        $data = array($column => json_encode($data));
        $update = $this->product_model->common_update($id, $data);
        if($update == 1){
            if($image != '' && file_exists('assets/upload/'.$this->data['controller'].'/'.$detail['slug'].'/'.$image)){
                $this->remove_img_one($detail['slug'],$image);
            }
            return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
        }
        return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_ERROR,$reponse);
    }
    public function active(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $product = $this->product_model->find($id);
            $product_category = $this->product_category_model->find($product['product_category_id']);
            $collection = $this->collection_model->find($product['collection_id']);
            if($product_category['is_activated'] == 1 || $collection['is_activated'] == 1){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array('status' => 404,'message' => MESSAGE_ERROR_ACTIVE_PRODUCT)));
            }
            if($this->product_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $update = $this->product_model->common_update($id,array_merge(array('is_activated' => 0),$this->author_data));
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
            if($this->product_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->model("menu_model");
                $product = $this->product_model->find($id);
                $menu_model = $this->menu_model->get_row_where_array(array('slug_post' => 'san-pham/'.$product['slug']));
                if(!empty($menu_model)){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash(),
                        'id' => $menu_model['id']
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_TURN_OFF_PRODUCT_MENU,$reponse);
                }
                $update = $this->product_model->common_update($id,array_merge(array('is_activated' => 1),$this->author_data));
                if($update){
                    // $this->load->model("menu_model");
                    // $product = $this->product_model->find($id);
                    // $menu_model = $this->menu_model->get_where_array(array('slug_post' => 'san-pham/'.$product['slug']));
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

    public function remove_image(){
        if($this->input->post()){
            $id = 37;
            $image = $this->input->post('image');
            $detail = $this->product_model->get_by_id($id);
            $upload = json_decode($detail['collection'],true);
            $key = array_search($image, $upload['image']);
            unset($upload['image'][$key]);
            $upload['image'] = array_values($upload['image']);
            $update = $this->product_model->common_update($id, array('collection' => json_encode($upload)));
            if($update == 1){
                $reponse = array(
                    'csrf_hash' => $this->security->get_csrf_hash()
                );
                if($image != '' && file_exists('assets/upload/banner/'.$image)){
                    unlink('assets/upload/banner/'.$image);
                }
                return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
            }
            return $this->return_api(HTTP_BAD_REQUEST,MESSAGE_REMOVE_ERROR);
        }else{
            redirect('admin/'. $this->data['controller'] .'/detail', 'refresh');
        }
        
    }
    // public function remove_image(){
    //     $id = $this->input->post('id');
    //     $image = $this->input->post('image');
    //     $detail = $this->product_model->get_by_id($id);
    //     $upload = [];
    //     $upload = json_decode($detail['collection']);
    //     $key = array_search($image, $upload);
    //     unset($upload[$key]);
    //     $newUpload = [];
    //     foreach ($upload as $key => $value) {
    //         $newUpload[] = $value;
    //     }
    //     $image_json = json_encode($newUpload);
    //     $data = array('image' => $image_json);
    //     $update = $this->product_model->common_update($id, $data);
    //     if($update == 1){
    //         $reponse = array(
    //             'csrf_hash' => $this->security->get_csrf_hash()
    //         );
    //         if($image != '' && file_exists('assets/upload/product/'.$detail['slug'].'/'.$image)){
    //             unlink('assets/upload/product/'.$detail['slug'].'/'.$image);
    //         }
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(HTTP_SUCCESS)
    //             ->set_output(json_encode(array('status' => HTTP_SUCCESS, 'reponse' => $reponse)));
    //     }
    //         return $this->output
    //                 ->set_content_type('application/json')
    //                 ->set_status_header(HTTP_BAD_REQUEST)
    //                 ->set_output(json_encode(array('status' => HTTP_BAD_REQUEST)));
    // }


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
    function build_new_category($categorie, $parent_id = 0,&$result, $id = "",$char=""){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            $select = ($value['id'] == $id)? 'selected' : '';
            $result.='<option value="'.$value['id'].'"'.$select.'>'.$char.$value['title'].'</option>';
            $this->build_new_category($categorie, $value['id'],$result, $id, $char.'---|');
            }
        }
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