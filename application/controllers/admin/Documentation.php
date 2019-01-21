<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends Admin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        //echo 1;die;
        //$this->render('admin/documentation_view');
        $this->load->view('admin/documentation_view');
    }
}