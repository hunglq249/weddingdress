<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->load->model('product_category_model');
        $this->load->model('collection_model');
        $this->load->model('templates_model');
        $this->load->model('product_model');
        $this->data['number_field'] = 6;
    }
    public function category($slug = ''){
        if($slug != '' && $this->product_category_model->find_rows(array('slug' => $slug,'is_deleted' => 0,'is_activated' => 0)) == 0){
            redirect('/', 'refresh');
        }else{
            if($slug != ''){
                $this->data['product_category'] = $this->product_category_model->get_by_slug($slug,'desc',$this->data['lang']);
                if(!empty($this->input->post()) && !empty($this->input->post('salerent'))){
                    $search = explode('_',$this->input->post('salerent'));
                    $number = explode('-',$search[1]);
                    if($search[0] == 'sale'){
                        $this->data['product'] = $this->product_model->get_all_search_sale($this->data['product_category']['id'],$this->data['lang'],$number[0],$number[1]);
                    }else{
                        $this->data['product'] = $this->product_model->get_all_search_rent($this->data['product_category']['id'],$this->data['lang'],$number[0],$number[1]);
                    }
                }else{
                    $this->data['product'] = $this->product_model->get_all_search_sale($this->data['product_category']['id'],$this->data['lang']);
                }
            }else{
                if(!empty($this->input->post()) && !empty($this->input->post('number_search'))){
                    $this->data['product'] = $this->product_model->get_all_search_home($this->data['lang'],$this->input->post('number_search'));
                }elseif(!empty($this->input->post()) && !empty($this->input->post('salerent'))){
                    $search = explode('_',$this->input->post('salerent'));
                    $number = explode('-',$search[1]);
                    $this->data['product'] = $this->product_model->get_all_search_home($this->data['lang'],$number[0],$number[1]);
                }else{
                    $this->data['product'] = $this->product_model->get_all_search_home($this->data['lang']);
                }
                
            }
        }
        if(count($this->data['product']) == 0){
            $this->data['message'] = ($this->data['lang'] == 'vi') ? 'Không có sản phẩm nào được tìm thấy' : 'No products were found';
        }
        if(empty($this->data['product_category'])){
            $this->data['message_category'] = ($this->data['lang'] == 'vi') ? 'Không có dữ liệu' : 'No data';
        }
        $this->render('list_products_view');
    }
    public function search(){
        if(!empty($this->input->post()) && !empty($this->input->post('number_search'))){
            $this->data['product'] = $this->product_model->get_all_search_home($this->data['lang'],$this->input->post('number_search'));
        }else{
            redirect('/', 'refresh');
        }
        $this->render('list_products_view');
    }

    // public function detail(){
    //     $this->render('detail_product_view');
    // }

   public function detail($slug){
       $detail = $this->product_model->get_by_slug($slug, array('title', 'description', 'content','data_lang'),$this->data['lang']);
       $detail['product_data_lang'] = json_decode($detail['product_data_lang'],true);
       $detail['metakeywords'] = $detail['product_data_lang']['tu_khoa_meta'];
       $detail['metadescription'] = $detail['product_data_lang']['mo_ta_meta'];
       $detail['collection'] = json_decode($detail['collection'],true);
       $detail['common'] = json_decode($detail['common'],true);
       $detail['data'] = json_decode($detail['data'],true);
       $detail['date'] = explode(',', $detail['date']);

       $detail['product_related'] = $this->product_model->get_all_and_by_category(array('title','description', 'content'),$this->data['lang'],4,'','DESC',$detail['product_category_id']);
       $this->data['detail'] = $detail;
       
       $this->render('detail_product_view');
   }
    public function created_rating(){
        $ip = $this->getRealIPAddress();
        if($this->session->has_userdata($ip) && in_array($this->input->get('product_id'), $this->session->userdata($ip))){
            return $this->return_api(HTTP_SUCCESS,'Bạn đã đánh giá cho sản phẩm này rồi.');
        }else{
            $this->load->model('product_model');
            $product_id = $this->input->get('product_id');
            $new_rating = $this->input->get('rating');
            $product_detail = $this->product_model->find($product_id);
            $total_rating = $product_detail['total_rating'];
            $count_rating = $product_detail['count_rating'];
            $total_rating = $total_rating + $new_rating;
            $count_rating = $count_rating + 1;
            $data = array(
                'total_rating' => $total_rating,
                'count_rating' => $count_rating
            );
            $update  = $this->product_model->common_update($product_id, $data);
            if($update){
                $this->session->set_userdata($ip, array($ip, $this->input->get('product_id')));
                $this->session->mark_as_temp($ip, 3600);
                $this->data['session_id'] = session_id();
            }
        }
        return $this->return_api(HTTP_SUCCESS,'Đánh giá cho sản phẩm thành công.');
    }

    function getRealIPAddress(){  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 
    public function created_captcha(){
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url('captcha'),
            'img_width' => '120',
            'img_height' => 35,
            'expiration' => 0,
            'word_length' => 6,
            'font_size' => 25,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors' => array(
                'background' => array(235, 235, 235),
                'border' => array(51, 51, 51),
                'text' => array(255, 0, 0),
                'grid' => array(255, 255, 255)
            )
        );
        $captcha = create_captcha($vals);
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array('status' => 200, 'captcha' => $captcha)));
    }
    protected function build_parent_title($parent_id){
        $sub = $this->product_category_model->get_by_id($parent_id, array('title'));

        if($parent_id != 0){
            $title = explode('|||', $sub['product_category_title']);
            $sub['title_en'] = $title[0];
            $sub['title_vi'] = $title[1];

            $title = $sub['title_vi'];
        }else{
            $title = 'Danh mục gốc';
        }
        return $title;
    }
}
