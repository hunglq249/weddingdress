<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends Public_Controller {

    public function __construct() {
        parent::__construct();

        $this->value = array(
            [
                'id' => 0,
                'image' => 'sp1.png',
                'cover' => 'sp1-cover.jpeg',
                'title' => 'Speakers',
            ],

            [
                'id' => 1,
                'image' => 'sp2.png',
                'cover' => 'sp1-cover.jpeg',
                'title' => 'Headphones',
            ],

            [
                'id' => 2,
                'image' => 'sp9.png',
                'cover' => '',
                'title' => 'Accessories',
            ]
        );
    }

    public function index(){
        $this->data['result'] = $this->value;

        $this->render('list_support_view');
    }

    public function detail($id){
        $this->data['detail'] = $this->value[$id];

        $this->render('detail_support_view');
    }
}
