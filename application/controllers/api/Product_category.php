<?php 
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

/**
 * 
 */
class Product_category extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_category_model');
	}

	public function getAllProductCategory_get()
	{
		$lang = $this->get('lang');
		$result = $this->product_category_model->get_all_api(array(), $lang, 'desc');
		if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Product could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}
}