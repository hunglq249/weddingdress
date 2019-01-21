<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

/**
 * 
 */
class Post extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('post_model');
		$this->load->model('post_category_model');
	}

	public function getAllPost_get()
	{
        $slug = $this->get('slug');
		$lang = $this->get('lang');
		$this->load->library('pagination');
		$config = array();

		$base_url = base_url('api/post/getallpost');
		$total_rows  = $this->post_model->count_by_category_id($lang);
        $per_page = 2;
        $uri_segment = 4;

        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $category_id = '';
        if($slug != ''){
            $category = $this->post_category_model->get_by_slug($slug);
            $category_id = $category['id'];
            $total_rows  = $this->post_model->count_by_category_id($lang, $category_id);
        }
        $config = $this->pagination_config($base_url, $total_rows, $per_page, $uri_segment);
        $this->pagination->initialize($config);
		$result = $this->post_model->get_all_with_pagination_search_api('desc', $lang, $per_page, $page, $category_id);
		if (!empty($result))
        {
            $this->set_response(['result' => $result, 'pageTotal' => $total_rows, 'perPage' => $per_page], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Post could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
	}

	public function getPostBySlug_get($slug)
	{
		$lang = $this->get('lang');
        $result = $this->post_model->get_by_slug($slug, array(), $lang);

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