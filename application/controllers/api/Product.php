<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST,OPTIONS");

/**
 * 
 */
class Product extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('features_model');
        $this->load->model('product_category_model');
		$this->load->model('color_model');
        $this->load->helper('date');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
	}

	public function getAllProduct_post()
	{
        $slug = $this->get('slug');
		$lang = $this->get('lang');
		$this->load->library('pagination');
		$config = array();

		$base_url = base_url('api/product/getallproduct');
		$total_rows  = $this->product_model->count_by_category_id($lang);
        $per_page = 2;
        $uri_segment = 4;

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $category_id = '';
        if($slug != ''){
            $category = $this->product_category_model->get_by_slug($slug);
            $category_id = $category['id'];
            $total_rows  = $this->product_model->count_by_category_id($lang, $category_id);
        }
        $config = $this->pagination_config($base_url, $total_rows, $per_page, $uri_segment);
        $this->pagination->initialize($config);
		$result = $this->product_model->get_all_with_pagination_search_api('desc', $lang, $per_page, $page, $category_id);
		foreach ($result as $key => $value) {
        	$result[$key]['features'] = $this->features_model->get_libraryfeatures_by_id_array(json_decode($result[$key]['features']));
            $result[$key]['common'] = json_decode($result[$key]['common'],true);
        	$result[$key]['color'] = $this->color_model->get_librarycolor_by_id_array(json_decode($result[$key]['color']));
		}
		if (!empty($result))
        {
            $this->set_response(['result' => $result, 'pageTotal' => $total_rows, 'perPage' => $per_page], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}

	public function getProductBySlug_get($slug)
	{
		$lang = $this->get('lang');
        $result = $this->product_model->get_by_slug_api($slug, $lang);
        $result['features'] = $this->features_model->get_libraryfeatures_by_id_array(json_decode($result['features']));
        $result['color'] = $this->color_model->get_librarycolor_by_id_array(json_decode($result['color']));
        // $result['color'] = $this->biuld_color($result['color'], $lang);
        $result['common'] = json_decode($result['common'],true);
        $result['data_lang'] = json_decode($result['data_lang'],true);
        $result['data'] = json_decode($result['data'],true);
        if ($result['count_rating'] > 0) {
            $result['rating'] = round($result['total_rating'] / $result['count_rating'] * 2)/2;
        }else{
            $result['rating'] = 0;
        }
        
        if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}

    public function getProductRelated_get($slug)
    {
        $lang = $this->get('lang');
        $detail = $this->product_model->get_by_slug_api($slug, $lang);
        $result = $this->product_model->get_product_by_category_id_api($detail['product_category_id'], $detail['id'], $lang);
        if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function getProductByTrademarkId_get()
    {
        $lang = $this->get('lang');
        $trademark_id = $this->get('trademark');
        $this->load->library('pagination');
        $config = array();

        $base_url = base_url('api/product/getproductbytrademarkid');
        $total_rows  = $this->product_model->count_by_trademark_id($lang, $trademark_id);
        $per_page = 2;
        $uri_segment = 5;

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $config = $this->pagination_config($base_url, $total_rows, $per_page, $uri_segment);
        $this->pagination->initialize($config);
        $result = $this->product_model->get_by_trademark_id_with_pagination_api('desc', $lang, $per_page, $page, $trademark_id);
        foreach ($result as $key => $value) {
            $result[$key]['features'] = $this->features_model->get_libraryfeatures_by_id_array(json_decode($result[$key]['features']));
            $result[$key]['common'] = json_decode($result[$key]['common'],true);
            $result[$key]['color'] = $this->color_model->get_librarycolor_by_id_array(json_decode($result[$key]['color']));
        }
        if (!empty($result))
        {
            $this->set_response(['result' => $result, 'pageTotal' => $total_rows, 'perPage' => $per_page], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function getAllProduct_get()
    {
        $lang = $this->get('lang');
        $slug = $this->get('slug');
        $price = $this->get('price');
        $type = $this->get('type');
        $trademark = $this->get('trademark');
        $features = $this->get('features');
        if ($features != null) {
            foreach ($features as $key => $value) {
                $features[$key] = '"' . $value . '"';
            };
        }
        $category_id = '';
        $this->load->library('pagination');
        $config = array();

        $base_url = base_url('api/product/getproductbyfeatures');
        $total_rows  = $this->product_model->count_product_by_change($type, $lang, $features, $trademark, $category_id);
        $per_page = 2;
        $uri_segment = 4;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        
        if($slug != ''){
            $category = $this->product_category_model->get_by_slug($slug);
            $category_id = $category['id'];
            $total_rows  = $this->product_model->count_by_category_id($lang, $category_id);
        }

        $config = $this->pagination_config($base_url, $total_rows, $per_page, $uri_segment);
        $this->pagination->initialize($config);
        $result = $this->product_model->get_product_by_change_with_pagination_api('desc', $type, $lang, $per_page, $page, $features, $trademark, $price, $category_id);
        foreach ($result as $key => $value) {
            $result[$key]['features'] = $this->features_model->get_libraryfeatures_by_id_array(json_decode($result[$key]['features']));
            $result[$key]['common'] = json_decode($result[$key]['common'],true);
            $result[$key]['color'] = $this->color_model->get_librarycolor_by_id_array(json_decode($result[$key]['color']));
        }
        if (!empty($result))
        {
            $this->set_response(['result' => $result, 'pageTotal' => $total_rows, 'perPage' => $per_page], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'product could not be found'
            ], REST_Controller::HTTP_NO_CONTENT); // NOT_FOUND (204) being the HTTP response code
        }
    }

    public function addComment_get()
    {
        $this->load->model('comment_model');
        $user_id = $this->get('userId');
        $product_id = $this->get('productId');
        $rating = $this->get('rating');
        $message = nl2br($this->get('message'));
        // echo $user_id;die;
        $product = $this->product_model->get_by_id_wo_lang($product_id);
        $count_rating = $product['count_rating'] + 1;
        $total_rating = $product['total_rating'] + $rating;
        $this->db->trans_begin();
        $data_comment = array(
            'product_id' => $product_id,
            'user_id' => $user_id,
            'content' => $message,
            'rating' => $rating,
            'created_at' => date('Y-m-d H:i:s', now()),
            'updated_at' => date('Y-m-d H:i:s', now()),
        );
        $insert_comment = $this->comment_model->common_insert($data_comment);
        $comment = array();
        if($insert_comment){
            $comment = $this->comment_model->get_comment_by_id($insert_comment);
            $data_product = array(
                'count_rating' => $count_rating,
                'total_rating' => $total_rating,
            );
            $update_product = $this->product_model->common_update($product_id, $data_product);
            if($update_product && $count_rating != 0){
                $total = round($total_rating / $count_rating, 1);
            }
        };
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->set_response(['total' => $total, 'message' => 'error'], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->db->trans_commit();
            $this->set_response(['comment' => $comment, 'total' => $total, 'message' => 'success'], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function biuld_color($color, $lang)
    {
        $new_color = array();
        foreach ($color as $key => $value) {
            $new_color[$key] = array($value[$lang] => $value['code_color']);
        };
        return $new_color;
    }
}