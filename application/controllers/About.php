<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->load->model('post_model');
        $this->load->model('post_category_model');

    }

    public function index(){
        $this->data['category'] = $this->post_category_model->get_by_id(1,array('title','description','content'),$this->data['lang']);
        $this->data['about'] = $this->post_model->get_by_post_category_id(array(1),array(),$this->data['lang']);
        $this->render('list_about_view');
    }

    public function detail($id){
        $this->data['detail'] = $this->value[$id];

        $this->render('detail_about_view');
    }
}
