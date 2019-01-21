<?php 
class Comment extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('comment_model');
	}
	public function create_comment(){
        $this->load->library('ion_auth');
        if (!$this->ion_auth->in_group('members_client')) {
            echo "Vui lòng đăng nhập ok";
            // redirect('/', 'refresh');
        }
		$this->load->helper('date');
		$content = nl2br($_GET['content']);
        $product_id = $_GET['product_id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
		$data = array(
				'content' => $content,
				'product_id' => $product_id,
				'created_at' => date("Y/m/d"),
                'ip_address' => $ip
				);
		$this->comment_model->common_insert($data);

//        $this->load->model('count_comment_model');
//        $this->count_comment_model->save($data);

        $comment = '<div class="media cmt">';
        $comment .= '<div class="media-left">';
        $comment .= '<img class="media-object" src="'.site_url('assets/img/comment_ava.png').'" alt="Comment Avatar" width="64">';
        $comment .= '</div>';
        $comment .= '<div class="media-body">';
        $comment .= '<h3 class="media-heading" style="color: #f4aa1c">'.$this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name.':</h3>';
        $comment .= '<span>'.$content.'</span>';
        $comment .= '<span style="float: right; font-size: 1em">'.date('d-m-Y').'</span>';
        $comment .= '</div>';
        $comment .= '</div>';
		$this->output->set_status_header(200)->set_output(json_encode(array('comment' => $comment)));

	}

	public function see_more_comment(){
        $this->load->model('comment_model');
        $product_id = $_GET['product_id'];
        $type = $_GET['type'];
        $page = $_GET['page'];
        $limit  = 5;
        $start = ($page - 1)*5;
        $count = $this->comment_model->count_all_by_product_id($product_id,$type);
        $comment = $this->comment_model->get_all_by_product_id($product_id, $limit, $start,$type);
        foreach ($comment as $key => $value) {
            $comment[$key]['created_at'] = date_format(date_create($value['created_at']), 'd-m-Y');
        };
        $stop = ceil($count / $limit);
        return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(HTTP_SUCCESS)
                    ->set_output(json_encode(array('status' => HTTP_SUCCESS, 'stop' => $stop, 'comment' => $comment)));

    }
}

?>