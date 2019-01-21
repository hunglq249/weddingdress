<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends Admin_Controller {
    private $request_language_template = array(
        'title', 'description', 'content', 'metakeywords', 'metadescription'
    );
    function __construct(){
        parent::__construct();
        return redirect('admin','refresh');
        $this->load->model('templates_model');
        $this->load->helper('common');
        $this->load->helper('file');
        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->data['controller'] = $this->templates_model->table;
        $this->data['controller_use'] = '';
    }

    public function index(){
        $this->data['keyword'] = '';
        if($this->input->get('search')){
            $this->data['keyword'] = $this->input->get('search');
        }
        $this->load->library('pagination');
        $per_page = 10;
        $total_rows  = $this->templates_model->count_search_not_lang($this->data['keyword']);
        $config = $this->pagination_config(base_url('admin/'.$this->data['controller'].'/index'), $total_rows, $per_page, 4);
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->templates_model->get_all_with_pagination_search_not_lang('desc', $per_page, $this->data['page'], $this->data['keyword']);
        $this->render('admin/templates/list_templates_view');
    }

    //DESCRIPTION PART
    public function create($type){
        if($type &&  is_numeric($type) && ($type > 0 && $type <= 2) ) {
            $this->data['number_field'] = ($type == 1) ? '6' : '6';
            if($this->input->post()){
                if($this->input->post('name_configuration') == ''){
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                }
                foreach ($this->page_languages as $key => $value) {
                    for ($i=0; $i < count($this->input->post('title_'.$value)); $i++) { 
                        if($this->input->post('title_'.$value)[$i] == ''){
                            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                        }
                    }
                }
                $insert = array();
                $count = 0;
                $required = 0;
                $multiple = 0;
                for ($i=0; $i < count($this->input->post('check_language')); $i++) {
                    if($this->input->post('type')[$i] == 'file' || $this->input->post('type')[$i] == 'radio' || $this->input->post('type')[$i] == 'checkbox' || $this->input->post('type')[$i] == 'select'){
                        if($this->input->post('check_language')[$i] != 'true'){
                            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                        }
                    }
                    $arr = array(
                        'description' => $this->input->post('description')[$i],
                        'type' => $this->input->post('type')[$i],
                        'check_language' => $this->input->post('check_language')[$i],
                    );
                    $lang_title = array();
                    foreach ($this->page_languages as $key => $value) {
                        $lang_title[$value] = $this->input->post('title_'.$value)[$i];
                    }
                    $arr = array_merge($arr, array('title' => $lang_title));
                    if($this->input->post('type')[$i] == 'radio' || $this->input->post('type')[$i] == 'checkbox' || $this->input->post('type')[$i] == 'select'){
                        $lang_textarea = array();
                        $check_number_list = 0;
                        foreach ($this->page_languages as $key => $value) {
                            $lang_textarea[$value] = explode(';;;', $this->input->post('number_list_'.$value)[$count]);
                            if($check_number_list != 0){
                                if($check_number_list != count($lang_textarea[$value])){
                                    $reponse = array(
                                        'csrf_hash' => $this->security->get_csrf_hash(),
                                    );
                                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_CONFIG_ERROR,$reponse);
                                }
                            }
                            $check_number_list = count($lang_textarea[$value]);
                        }
                        $arr = array_merge($arr, array('choice' => $lang_textarea));
                        $count++;
                    }
                    if($this->input->post('required_check')[$i] == 'true'){
                        $arr = array_merge($arr, array('required' => $this->input->post('required_content')[$required]));
                        $required++;
                    }
                    if($this->input->post('type')[$i] == 'select' || $this->input->post('type')[$i] == 'file' || $this->input->post('type')[$i] == 'textarea'){
                        if($this->input->post('check_multiple')[$multiple] == 'true'){
                            $arr = array_merge($arr, array('check_multiple' => $this->input->post('check_multiple')[$multiple]));
                        }
                        $multiple++;
                    }
                    array_push($insert, $arr);
                }
                $result = array_combine($this->input->post('slug'), $insert);
                $data = array(
                    'title' => $this->input->post('name_configuration'),
                    'type' => $type,
                    'data' => json_encode($result),
                );
                $insert = $this->templates_model->common_insert($data);
                if($insert){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash(),
                        'content' => $result,
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_CREATE_SUCCESS,$reponse);
                }else{
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR);
                }
            }
            $this->render('admin/templates/create_templates_view');
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
    }

    public function edit($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            if($this->templates_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/templates', 'refresh');
            }
            $detail = $this->templates_model->get_by_id_templates($id);
            $this->data['controller_use'] = ($detail['type'] == 1) ? 'post' : 'product';
            $this->data['number_field'] = ($detail['type'] == 1) ? '6' : '6';
            $this->data['detail'] = $detail;
            if($this->input->post()){
                if($this->input->post('name_configuration') == ''){
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_UPDATE_ERROR_VALIDATE);
                }
                foreach ($this->page_languages as $key => $value) {
                    for ($i=0; $i < count($this->input->post('title_'.$value)); $i++) { 
                        if($this->input->post('title_'.$value)[$i] == ''){
                            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                        }
                    }
                }
                $updates = array();
                $arr_rcs = array();//check list radio, checkbox, select
                $slug = $this->input->post('slug');
                $detail_rcs = array_values(json_decode($this->input->post('detail'),true));//check list radio, checkbox, select
                $count = 0;
                $required = 0;
                $multiple = 0;
                for ($i=0; $i < count($this->input->post('check_language')); $i++) {
                    if($this->input->post('type')[$i] == 'file' || $this->input->post('type')[$i] == 'radio' || $this->input->post('type')[$i] == 'checkbox' || $this->input->post('type')[$i] == 'select'){
                        if($this->input->post('check_language')[$i] != 'true'){
                            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                        }
                    }
                    $arr = array(
                        'description' => $this->input->post('description')[$i],
                        'type' => $this->input->post('type')[$i],
                        'check_language' => $this->input->post('check_language')[$i],
                    );
                    $lang_title = array();
                    foreach ($this->page_languages as $key => $value) {
                        $lang_title[$value] = $this->input->post('title_'.$value)[$i];
                    }
                    $arr = array_merge($arr, array('title' => $lang_title));
                    if($this->input->post('type')[$i] == 'radio' || $this->input->post('type')[$i] == 'checkbox' || $this->input->post('type')[$i] == 'select'){
                        $lang_textarea = array();
                        $check_number_list = 0;
                        foreach ($this->page_languages as $key => $value) {
                            $lang_textarea[$value] = explode(';;;', $this->input->post('number_list_'.$value)[$count]);
                            if($check_number_list != 0){
                                if($check_number_list != count($lang_textarea[$value])){
                                    $reponse = array(
                                        'csrf_hash' => $this->security->get_csrf_hash(),
                                    );
                                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_CONFIG_ERROR,$reponse);
                                }
                            }
                            $check_number_list = count($lang_textarea[$value]);
                        }
                        $arr = array_merge($arr, array('choice' => $lang_textarea));
                        if($i > 7){
                            $arr_rcs[$i] = array('count' => count($lang_textarea['vi']),'slug' => $slug[$i]);
                        }
                        $count++;
                    }
                    if($this->input->post('required_check')[$i] == 'true'){
                        $arr = array_merge($arr, array('required' => $this->input->post('required_content')[$required]));
                        $required++;
                    }
                    if($this->input->post('type')[$i] == 'select' || $this->input->post('type')[$i] == 'file' || $this->input->post('type')[$i] == 'textarea'){
                        if($this->input->post('check_multiple')[$multiple] == 'true'){
                            $arr = array_merge($arr, array('check_multiple' => $this->input->post('check_multiple')[$multiple]));
                        }
                        $multiple++;
                    }
                    array_push($updates, $arr);
                }
                $result = array_combine($slug, $updates);
                $data = array(
                    'title' => $this->input->post('name_configuration'),
                    'data' => json_encode($result),
                );
                $update = $this->templates_model->common_update($id,$data);
                if($update){
                    $this->load->model('post_model');
                    $this->load->model('product_model');
                    $result_post = $this->post_model->find_results($id);
                    $result_product = $this->product_model->find_results($id);
                    $result_common = ($this->data['controller_use'] == 'post') ? $result_post : $result_product;
                    $new_detail = $this->templates_model->get_by_id_templates($id)['data'];
                    // $fontend_detail = json_decode($this->input->post('detail'),true);
                    $remove = json_decode($this->input->post('remove'),true);
                    $add_field = json_decode($this->input->post('add_field'),true);
                    $rename_field = array_combine(array_keys(json_decode($this->input->post('detail'),true)), array_keys($result));
                    foreach ($rename_field as $key => $value) {
                        if($key == $value){
                           unset($rename_field[$key]);
                        }
                    }
                    $update_field = array();
                    $update_data_lang = array();
                    foreach ($result_common as $k => $val) {
                        if($val['language'] == 'vi'){
                            $update_data =  json_decode($val['data'],true);
                            foreach ($remove as $key => $value) {
                                if(json_decode($detail['data'],true)[$value]['type'] == 'file'){
                                    $img = isset(json_decode($detail['data'],true)[$value]['check_multiple']) ? $update_data[$value] : [$update_data[$value]];
                                    if(!empty($img)){
                                        foreach ($img as $ks => $vals) {
                                            $this->remove_img($val['slug'],$vals);
                                        }
                                    }

                                }
                                unset($update_data[$value]);
                            }
                            $update_data =  empty($update_data) ? '{}' : json_encode($update_data,true);
                        }
                        $table_lang_data[$k] = array_diff_key(json_decode($val['data_lang'],true),array_flip($remove));
                        $table_lang_data[$k] = empty($table_lang_data[$k]) ? '{}' : json_encode($table_lang_data[$k],true);
                        foreach ($rename_field as $key => $value) {
                            if($val['language'] == 'vi'){
                                $update_data = str_replace('"'.$key.'":', '"'.$value.'":', $update_data);
                            }
                            $table_lang_data[$k] = str_replace('"'.$key.'":', '"'.$value.'":', $table_lang_data[$k]);
                        }
                        foreach ($add_field as $key => $value) {
                            if($result[$value]['check_language'] == 'true'){
                                if($val['language'] == 'vi'){
                                    $check_empty = ($update_data == '[]' || $update_data == '{}') ? '' : ',';
                                    if((($result[$value]['type'] == 'file' || $result[$value]['type'] == 'select') && isset($result[$value]['check_multiple'])) || $result[$value]['type'] == 'checkbox'){
                                        $update_data = substr_replace($update_data,$check_empty.'"'.$value.'":[]',-1,0);
                                    }else{
                                        $update_data = substr_replace($update_data,$check_empty.'"'.$value.'":""',-1,0);
                                    }
                                }
                            }else{
                                $check_empty_lang = ($table_lang_data[$k] == '[]' || $table_lang_data[$k] == '{}') ? '' : ',';
                                if($result[$value]['type'] == 'file' && isset($result[$value]['check_multiple'])){
                                    $table_lang_data[$k] = substr_replace($table_lang_data[$k],$check_empty_lang.'"'.$value.'":[]',-1,0);
                                }else{
                                    $table_lang_data[$k] = substr_replace($table_lang_data[$k],$check_empty_lang.'"'.$value.'":""',-1,0);
                                }
                            }
                        }
                        if($val['language'] == 'vi'){
                            $update_data = json_decode($update_data,true);
                                foreach ($arr_rcs as $key => $value) {
                                    if (!is_array($update_data[$value['slug']])) {
                                        $update_data[$value['slug']] = [$update_data[$value['slug']]];
                                        $update_data[$value['slug']] = empty(array_intersect($update_data[$value['slug']],range(0, $value['count'] - 1))) ? '' : array_intersect($update_data[$value['slug']],range(0, $value['count'] - 1))[0];
                                    }else{
                                        $update_data[$value['slug']] = array_intersect($update_data[$value['slug']],range(0, $value['count'] - 1));
                                    }
                                }
                            $update_data =  empty($update_data) ? '{}' : json_encode($update_data,true);
                            $update_field[] =  array('id' => $val[$this->data['controller_use'].'_id'], 'data' => $update_data);
                        }
                        $update_data_lang[] = array('id' => $val['id'], 'data_lang' => $table_lang_data[$k]);
                    }

                    if($this->data['controller_use'] == 'product'){
                        if(!empty($update_field)){
                            $this->product_model->common_update_multiple($update_field);
                        }
                        if(!empty($update_data_lang)){
                            $this->product_model->common_update_multiple_lang($update_data_lang);
                        }
                    }else{
                        if(!empty($update_field)){
                            $this->post_model->common_update_multiple($update_field);
                        }
                        if(!empty($update_data_lang)){
                            $this->post_model->common_update_multiple_lang($update_data_lang);
                        }
                    }
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash(),
                        'detail' => $new_detail
                    );
                    return $this->return_api(HTTP_SUCCESS,MESSAGE_UPDATE_SUCCESS,$reponse);
                }else{
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_UPDATE_ERROR);
                }
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            redirect('admin/'. $this->data['controller'] .'', 'refresh');
        }
        $this->render('admin/templates/edit_templates_view');
    }

    public function detail($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->templates_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->helper('form');
                $this->load->library('form_validation');
                $detail = $this->templates_model->get_by_id_templates($id);
                $this->data['detail'] = $detail;
                $this->render('admin/templates/detail_templates_view');
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/templates', 'refresh');
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            return redirect('admin/'.$this->data['controller'],'refresh');
        }
    }

    public function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $template = $this->templates_model->find($id);
            if(empty($template) || $template == 0){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_ISSET_ERROR);
            }
            if($template['type'] == 1){
                $this->load->model('post_model');
                $check_count = $this->post_model->get_where_array(array('templates_id' => $id));
            }else{
                $this->load->model('product_model');
                $check_count = $this->product_model->get_where_array(array('templates_id' => $id));
            }
            if(count($check_count) > 0){
                $title = ($template['type'] == 1) ? ' bài viết' : ' sản phẩm';
                return $this->return_api(HTTP_NOT_FOUND,sprintf(MESSAGE_ERROR_REMOVE_CONFIG, count($check_count).$title));
            }
            $data = array('is_deleted' => 1);
            $update = $this->templates_model->common_update($id, $data);
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

    public function active(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->templates_model->find_rows(array('is_activated' => 1)) == 0){
                $update = $this->templates_model->common_update($id,array('is_activated' => 1));
                if($update){
                    return $this->return_api(HTTP_SUCCESS, 'Bật cấu hình thành công');
                }
            }
            return $this->return_api(HTTP_NOT_FOUND,'Bạn chỉ được activated 1 Cấu hình, Vui lòng tắt Cấu hình đang sử dụng để activated cấu hình hiện tại');
        }
        return $this->return_api(HTTP_NOT_FOUND);
    }
    public function deactive(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            $update = $this->templates_model->common_update($id,array('is_activated' => 0));
            if($update){
                return $this->return_api(HTTP_SUCCESS, 'Tắt cấu hình thành công');
            }
            return $this->return_api(HTTP_NOT_FOUND,'Lỗi deactive cấu hình, Vui lòng thao tác lại');
        }
        return $this->return_api(HTTP_NOT_FOUND);
    }

    protected function remove_img($unique_slug = '',$image= ''){
        if(file_exists('assets/upload/' .$this->data['controller_use']. '/'.$unique_slug.'/'.$image)){
            unlink('assets/upload/' .$this->data['controller_use']. '/'.$unique_slug.'/'.$image);
            $new_array = explode('.', $image);
            $typeimg = array_pop($new_array);
            $nameimg = str_replace(".".$typeimg, "", $image);
            if(file_exists('assets/upload/' .$this->data['controller_use']. '/'.$unique_slug.'/thumb/'.$nameimg.'_thumb.'.$typeimg)){
                unlink('assets/upload/' .$this->data['controller_use']. '/'.$unique_slug.'/thumb/'.$nameimg.'_thumb.'.$typeimg);
            }
        }
    }

}