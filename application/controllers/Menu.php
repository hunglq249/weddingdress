<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->render('list_menu_view');
    }

    public function detail(){
        $this->render('detail_menu_view');
    }
}
