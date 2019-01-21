<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends Public_Controller{
	public function __construct() {
        parent::__construct();
        $this->load->model('rating_model');
    }

	public function index(){
		$client_id = $this->input->get('client_id');
		$product_id = $this->input->get('product_id');
		$rating = $this->input->get('rating');
		
		$data = array(
			'product_id' => $product_id,
			'users_id' => $client_id,
			'rating' => $rating
		);
		$insert  = $this->rating_model->common_insert($data);
		if($insert){
			$isExits = true;
		}else{
			$isExits = false;
		}

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array('status' => 200, 'reponse' => $reponse, 'isExits' => $isExits)));
	}

}

/* End of file Rating.php */
/* Location: ./application/controllers/Rating.php */