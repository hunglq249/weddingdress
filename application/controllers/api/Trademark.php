<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
/**
 * 
 */
class Trademark extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('trademark_model');
	}

	public function getAllTrademark_get()
	{
		$result = $this->trademark_model->get_all_trademark();
		if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'trademark could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}
}