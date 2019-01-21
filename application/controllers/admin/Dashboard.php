<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct(){
        parent::__construct();
		$this->load->model('post_model');
		$this->load->model('product_model');
		$this->load->model('collection_model');
    }

    public function index(){
//        $this->load->view('admin/dashboard_view');
    	$this->data['product_number'] = $this->product_model->find_rows(array('is_deleted' => 0));
    	$this->data['post_number'] = $this->post_model->find_rows(array('is_deleted' => 0));
    	$this->data['collection_number'] = $this->collection_model->find_rows(array('is_deleted' => 0));
        $this->render('admin/dashboard_view');

        // use library
        // $this->load->library('str_slug');
        // echo $this->str_slug->str_slug('aasddsa aaa asdsadads.dox','-','image');
    }
}