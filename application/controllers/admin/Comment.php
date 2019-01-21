<?php 

/**
* 
*/
class Comment extends Admin_Controller{
	private $request_language_template = array();
    private $author_data = array();

	function __construct(){
		parent::__construct();
        return redirect('admin','refresh');
		$this->load->model('comment_model');
		$this->load->helper('common');
        $this->load->helper('file');

        $this->data['template'] = build_template();
        $this->data['request_language_template'] = $this->request_language_template;
        $this->data['controller'] = $this->comment_model->table;
		$this->author_data = handle_author_common_data();
	}

    public function remove(){
        $id = $this->input->post('id');
        $comment = $this->comment_model->find($id);
        $data = array('is_deleted' => 1);
        $update = $this->comment_model->common_update($comment['id'], $data);
        if($update == 1){
            $reponse = array(
                'csrf_hash' => $this->security->get_csrf_hash()
            );
            return $this->return_api(HTTP_SUCCESS,MESSAGE_REMOVE_SUCCESS,$reponse);
        }
        return $this->return_api(HTTP_NOT_FOUND,MESSAGE_REMOVE_ERROR);
    }

    
}