<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends Admin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->render('admin/works/overview_view');
    }

    public function works(){
        $this->render('admin/works/works/list_works_view');
    }

    public function creatWorks(){
        $this->render('admin/works/works/creat_works_view');
    }

    public function editWorks(){
        $this->render('admin/works/works/edit_works_view');
    }

    public function field(){
        $this->render('admin/works/field/list_field_view');
    }

    public function creatField(){
        $this->render('admin/works/field/creat_field_view');
    }

    public function editField(){
        $this->render('admin/works/field/edit_field_view');
    }

}