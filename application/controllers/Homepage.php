<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Public_Controller {


	public function __construct(){
		parent::__construct();
		$this->data['lang'] = $this->session->userdata('langAbbreviation');
		$this->load->model('product_model');
		$this->load->model('banner_model');
		$this->load->model('collection_model');
		$this->load->model('product_category_model');
		$this->load->model('post_category_model');
		$this->load->model('post_model');

	}

    public function index(){
    	$this->data['banner'] = $this->banner_model->get_all_banner();
    	foreach ($this->data['banner'] as $key => $value) {
    		if ($value['type'] == 0) {
    			$this->data['banner'][$key]['category'] = $this->product_category_model->get_by_id($value['category_id'],array('title','description', 'content'),$this->data['lang']);
                $this->data['banner'][$key]['folder'] = 'product_category';
    		}else{
    			$this->data['banner'][$key]['category'] = $this->collection_model->get_by_id($value['category_id'],array('title','description', 'content'),$this->data['lang']);
                $this->data['banner'][$key]['folder'] = 'collection';
    		}
    	}
        
    	$this->data['product'] = $this->product_model->get_all_and_by_category(array('title','description', 'content'),$this->data['lang'],5);
    	$this->data['product_hot'] = $this->product_model->get_all_and_by_category(array('title','description', 'content'),$this->data['lang'],15,1);
       
    	$this->data['about'] = $this->post_model->get_by_post_category_id(array(1),array('title','description', 'content'),$this->data['lang'],2);
        $this->data['search'] = $this->product_model->get_all_search(6800000);
        $this->render('homepage_view');
    }
    public function change_language(){
        if($this->session->userdata('langAbbreviation') == $this->input->get('lang')){
            return $this->return_api(HTTP_SUCCESS, MESSAGE_CHANGE_LANGUAGE_FAIL, $this->session->userdata('langAbbreviation'), null);
        }else{
            $this->session->set_userdata('langAbbreviation', $this->input->get('lang'));
            if($this->session->userdata('langAbbreviation') == $this->input->get('lang')){
                return $this->return_api(HTTP_SUCCESS, MESSAGE_CHANGE_LANGUAGE_SUCCESS, $this->session->userdata('langAbbreviation'), null);
            }else{
                return $this->return_api(HTTP_SUCCESS, MESSAGE_CHANGE_LANGUAGE_FAIL, $this->session->userdata('langAbbreviation'), null);
            }
        }
    }
}
