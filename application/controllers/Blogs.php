<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends Public_Controller {
	public function __construct() {
        parent::__construct();
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->load->model('post_model');
        $this->load->model('post_category_model');
    }
    public function index(){
        $this->data['blog'] = $this->post_model->get_all_with_pagination_searchs('DESC',$this->data['lang']);
        $this->render('list_blogs_view');
    }
    public function category($slug){
        $this->data['category'] = $this->post_category_model->get_by_slug($slug,'desc',$this->data['lang']);
        $this->data['blog'] = $this->post_model->get_all_with_pagination_post('DESC',$this->data['lang'],NULL,NULL,array($this->data['category']['id']));
        $this->render('list_blogs_view');
    }

    public function detail($slug){
        $this->data['detail'] = $this->post_model->get_by_slug($slug,array(),$this->data['lang']);
        $this->data['category'] = $this->post_category_model->get_by_id($this->data['detail']['post_category_id'],array('title'),$this->data['lang']);
        $this->data['post_related'] = $this->post_model->get_all_with_pagination_post('DESC',$this->data['lang'],4,0,array($this->data['category']['id']));
        $this->render('detail_blogs_view');
    }
}
