<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->render('admin/products/overview_view');
    }

    public function products(){
        $this->render('admin/products/products/list_products_view');
    }

    public function creatProducts(){
        $this->render('admin/products/products/creat_products_view');
    }

    public function editProducts(){
        $this->render('admin/products/products/edit_products_view');
    }

    public function category_1(){
        $this->render('admin/products/category/list_category_1_view');
    }

    public function creatCategory_1(){
        $this->render('admin/products/category/creat_category_1_view');
    }

    public function editCategory_1(){
        $this->render('admin/products/category/edit_category_1_view');
    }

    public function category_2(){
        $this->render('admin/products/category/list_category_2_view');
    }

    public function creatCategory_2(){
        $this->render('admin/products/category/creat_category_2_view');
    }

    public function editCategory_2(){
        $this->render('admin/products/category/edit_category_2_view');
    }

    public function detail(){
        $this->render('admin/products/products/detail_products_view');
    }

}