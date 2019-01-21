<?php 
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

/**
 * 
 */
class Post_category extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('post_category_model');
	}

	public function getAllPostCategory_get()
	{
		$lang = $this->get('lang');
		$result = $this->post_category_model->get_all('desc', $lang);
		if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Post could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}
}