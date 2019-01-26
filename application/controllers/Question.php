<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->load->model('question_model');

    }

    public function index(){
        $this->data['question'] = $this->question_model->get_all_with_pagination_search('asc',$this->data['lang']);
        echo "<pre>";
        print_r($this->data['question']);
        echo "<pre>";

        echo 'data question';die;
        // $this->render('list_question_view');
    }
}
