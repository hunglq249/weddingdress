<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Admin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->render('admin/homepage/overview_view');
    }

    public function slider(){
        $this->render('admin/homepage/slider/list_slider_view');
    }

    public function creatSlider(){
        $this->render('admin/homepage/slider/creat_slider_view');
    }

    public function editSlider(){
        $this->render('admin/homepage/slider/edit_slider_view');
    }

    public function featured(){
        $this->render('admin/homepage/featured/list_featured_view');
    }

    public function creatFeatured(){
        $this->render('admin/homepage/featured/creat_featured_view');
    }

    public function editFeatured(){
        $this->render('admin/homepage/featured/edit_featured_view');
    }
}