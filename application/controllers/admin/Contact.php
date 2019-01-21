<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('product_model');
        $this->load->model('product_category_model');
        $this->load->helper('common');
        $this->data['template'] = build_template();
        $this->data['controller'] = $this->contact_model->table;
    }

    public function index() {
        $this->data['keyword'] = '';
        if($this->input->get('search')){
            $this->data['keyword'] = $this->input->get('search');
        }
        $this->load->library('pagination');
        $per_page = 10;
        $total_rows  = $this->contact_model->count_searchs($this->data['keyword']);
        $config = $this->pagination_config(base_url('admin/'.$this->data['controller'].'/index'), $total_rows, $per_page, 4);
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->contact_model->get_all_with_pagination_searchss('desc',$per_page, $this->data['page'], $this->data['keyword']);
        $this->render('admin/contact/list_contact_view');
    }
    public function create(){
        $this->load->helper('form');
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Màu tiếng Việt', 'required');
            if($this->form_validation->run() == TRUE){
                $contact_request = array(
                    'title' => $this->input->post('title'),
                    'tel' => $this->input->post('tel'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email')
                );
                $insert = $this->contact_model->common_insert($contact_request);
                if($insert){
                    $this->session->set_flashdata('message_success', MESSAGE_CREATE_SUCCESS);
                    redirect('admin/'. $this->data['controller'] .'', 'refresh');
                }else {
                    $this->session->set_flashdata('message_error', MESSAGE_CREATE_ERROR);
                    $this->render('admin/'. $this->data['controller'] .'/create_contact_view');
                }
            }
        }
        $this->render('admin/contact/create_contact_view');
    }
    public function edit($id = null){
        $this->data['detail'] = $this->contact_model->get_by_id_contact($id);
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post()){
            $this->form_validation->set_rules('title', 'Màu tiếng Việt', 'required');
            if($this->form_validation->run() === true){
                $contact_request = array(
                    'title' => $this->input->post('title'),
                    'tel' => $this->input->post('tel'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email')
                );
                $update = $this->contact_model->common_update($id, $contact_request);
                if($update){
                    $this->session->set_flashdata('message_success', MESSAGE_UPDATE_SUCCESS);
                    redirect('admin/contact', 'refresh');
                }else {
                    $this->session->set_flashdata('message_error', MESSAGE_UPDATE_ERROR);
                    $this->render('admin/contact/edit/'.$id);
                }
            }
        }
        $this->render('admin/contact/edit_contact_view');
    }
    function remove(){
        $id = $this->input->post('id');
        if($id &&  is_numeric($id) && ($id > 0)){
            if($this->contact_model->find_rows(array('id' => $id,'is_deleted' => 0)) == 0){
                return $this->return_api(HTTP_NOT_FOUND, MESSAGE_ISSET_ERROR);
            }else{
                $delete = $this->contact_model->common_delete($id);
                if($delete){
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
}
