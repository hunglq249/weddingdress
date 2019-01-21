<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends Public_Controller {
	public function __construct() {
        parent::__construct();
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->load->model('product_category_model');
        $this->load->model('collection_model');
        $this->load->model('templates_model');
        $this->load->model('product_model');
        $this->data['number_field'] = 6;
    }

    public function index(){
    	$this->data['collection1'] = $this->collection_model->get_all_with_pagination_search('asc',$this->data['lang'],1,0);
    	$this->data['collection2'] = $this->collection_model->get_all_with_pagination_search('asc',$this->data['lang'],2,1);
    	$this->data['collection3'] = $this->collection_model->get_all_with_pagination_search('asc',$this->data['lang'],1,3);
        $this->render('list_collections_view');
    }

    public function detail($slug){
        $this->data['collection'] = $this->collection_model->get_by_slug($slug,'desc',$this->data['lang']);
        $this->data['product'] = $this->product_model->get_all_front_end('desc',$this->data['lang'],$this->data['collection']['id']);
        if(count($this->data['product']) == 0){
            $this->data['message'] = ($this->data['lang'] == 'vi') ? 'Không có dữ liệu' : 'No data';
        }
        $this->render('detail_collection_view');
    }
}
