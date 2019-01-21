<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config_contact extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('config_contact_model');
        $this->data['controller'] = $this->config_contact_model->table;
    }

    public function index(){
        $this->data['keyword'] = '';
        if($this->input->get('search')){
            $this->data['keyword'] = $this->input->get('search');
        }
        $this->load->library('pagination');
        $per_page = 10;
        $total_rows  = $this->config_contact_model->count_search($this->data['keyword']);
        $config = $this->pagination_config(base_url('admin/'.$this->data['controller'].'/index'), $total_rows, $per_page, 4);
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->config_contact_model->get_all_with_pagination_search('desc', $per_page, $this->data['page'], $this->data['keyword']);
        $this->render('admin/config_contact/list_config_contact_view');
    }

    //DESCRIPTION PART
    public function create(){
        if($this->input->post()){
            if($this->input->post('name_configuration') == ''){
                return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
            }
            foreach ($this->page_languages as $key => $value) {
                for ($i=0; $i < count($this->input->post('title_vi')); $i++) { 
                    if($this->input->post('title_'.$value)[$i] == ''){
                        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                    }
                }
            }
            $insert = array();
            $count = 0;
            $required = 0;
            $multiple = 0;
            for ($i=0; $i < count($this->input->post('required_check')); $i++) {
                $arr = array(
                    'type' => $this->input->post('type')[$i],
                );
                $lang_title = array();
                $lang_description = array();
                foreach ($this->page_languages as $key => $value) {
                    $lang_title[$value] = $this->input->post('title_'.$value)[$i];
                    $lang_description[$value] = $this->input->post('description_'.$value)[$i];
                }
                $arr = array_merge($arr, array('title' => $lang_title, 'description' => $lang_description));
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
                    $lang_required = array();
                    foreach ($this->page_languages as $key => $value) {
                        
                        $lang_required[$value] = $this->input->post('required_content_'.$value)[$required];
                    }
                    $arr = array_merge($arr, array('required' => $lang_required));
                    $required++;
                }
                if($this->input->post('type')[$i] == 'select'){
                    if($this->input->post('check_multiple')[$multiple] == 'true'){
                        $arr = array_merge($arr, array('check_multiple' => $this->input->post('check_multiple')[$multiple]));
                    }
                    $multiple++;
                }
                array_push($insert, $arr);
            }
            $result = array_combine(explode(',', $this->input->post()['slug']), $insert);
            $data = array(
                'title' => $this->input->post('name_configuration'),
                'data' => json_encode($result),
                'config_send_mail' => json_encode($this->input->post('config_send_mail'))
            );
            $insert = $this->config_contact_model->common_insert($data);
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
        $this->render('admin/config_contact/create_config_contact_view');
    }

    public function edit($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            $this->load->helper('form');
            if($this->config_contact_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/config_contact', 'refresh');
            }
            $detail = $this->config_contact_model->get_by_id($id);
            $this->data['detail'] = $detail;
            if($this->input->post()){
                if($this->input->post('name_configuration') == ''){
                    return $this->return_api(HTTP_NOT_FOUND,MESSAGE_UPDATE_ERROR_VALIDATE);
                }
                foreach ($this->page_languages as $key => $value) {
                    for ($i=0; $i < count($this->input->post('title_vi')); $i++) { 
                        if($this->input->post('title_'.$value)[$i] == ''){
                            return $this->return_api(HTTP_NOT_FOUND,MESSAGE_CREATE_ERROR_VALIDATE);
                        }
                    }
                }
                $update = array();
                $count = 0;
                $required = 0;
                $multiple = 0;
                for ($i=0; $i < count($this->input->post('required_check')); $i++) {
                    $arr = array(
                        'type' => $this->input->post('type')[$i],
                    );
                    $lang_title = array();
                    $lang_description = array();
                    foreach ($this->page_languages as $key => $value) {
                        $lang_title[$value] = $this->input->post('title_'.$value)[$i];
                        $lang_description[$value] = $this->input->post('description_'.$value)[$i];
                    }
                    $arr = array_merge($arr, array('title' => $lang_title, 'description' => $lang_description));
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
                        $lang_required = array();
                        foreach ($this->page_languages as $key => $value) {
                            
                            $lang_required[$value] = $this->input->post('required_content_'.$value)[$required];
                        }
                        $arr = array_merge($arr, array('required' => $lang_required));
                        $required++;
                    }
                    if($this->input->post('type')[$i] == 'select'){
                        if($this->input->post('check_multiple')[$multiple] == 'true'){
                            $arr = array_merge($arr, array('check_multiple' => $this->input->post('check_multiple')[$multiple]));
                        }
                        $multiple++;
                    }
                    array_push($update, $arr);
                }
                $result = array_combine(explode(',', $this->input->post()['slug']), $update);
                $data = array(
                    'title' => $this->input->post('name_configuration'),
                    'data' => json_encode($result),
                    'config_send_mail' => json_encode($this->input->post('config_send_mail'))
                );
                $update = $this->config_contact_model->common_update($id,$data);
                if($update){
                    $reponse = array(
                        'csrf_hash' => $this->security->get_csrf_hash(),
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
        $this->render('admin/config_contact/edit_config_contact_view');
    }

    public function detail($id){
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->config_contact_model->find_rows(array('id' => $id,'is_deleted' => 0)) != 0){
                $this->load->helper('form');
                $this->load->library('form_validation');
                $detail = $this->config_contact_model->get_by_id($id);
                $this->data['detail'] = $detail;
                $this->render('admin/config_contact/detail_config_contact_view');
            }else{
                $this->session->set_flashdata('message_error',MESSAGE_ISSET_ERROR);
                redirect('admin/config_contact', 'refresh');
            }
        }else{
            $this->session->set_flashdata('message_error',MESSAGE_ID_ERROR);
            return redirect('admin/'.$this->data['controller'],'refresh');
        }
    }

    public function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->config_contact_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array('status' => 404,'message' => MESSAGE_ISSET_ERROR)));
            }
            $data = array('is_deleted' => 1);
            $update = $this->config_contact_model->common_update($id, $data);
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
            if($this->config_contact_model->find_rows(array('is_activated' => 1)) == 0){
                $update = $this->config_contact_model->common_update($id,array('is_activated' => 1));
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
            $update = $this->config_contact_model->common_update($id,array('is_activated' => 0));
            if($update){
                return $this->return_api(HTTP_SUCCESS, 'Tắt cấu hình thành công');
            }
            return $this->return_api(HTTP_NOT_FOUND,'Lỗi deactive cấu hình, Vui lòng thao tác lại');
        }
        return $this->return_api(HTTP_NOT_FOUND);
    }

}