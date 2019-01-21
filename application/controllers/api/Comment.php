<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

/**
 * 
 */
class Comment extends REST_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->model('comment_model');
		$this->load->model('product_model');
	}

	public function getAllCommentByProductSlug_get(){
		$slug = $this->get('slug');
		$product = $this->product_model->get_by_slug_api($slug);
		$this->load->library('pagination');
		$config = array();

		$base_url = base_url('api/comment/getallcommentbyproductslug');
		$total_rows  = $this->comment_model->count_all_by_product_id($product['id']);
        $per_page = 2;
        $uri_segment = 4;

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config = $this->pagination_config($base_url, $total_rows, $per_page, $uri_segment);
        $this->pagination->initialize($config);
		$result = $this->comment_model->get_all_by_product_id($product['id'], $per_page, $page);
		if (!empty($result))
        {
            $this->set_response(['result' => $result, 'pageTotal' => $total_rows, 'perPage' => $per_page], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'result' => array(),
                'message' => 'comment could not be found'
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
	}
}