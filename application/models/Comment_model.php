<?php 

/**
* 
*/
class Comment_model extends MY_Model{
    
    public $table = 'comment';

    public function get_all_by_product_id($product_id, $limit = NULL, $start = NULL)
    {
        $this->db->select('comment.*, users.last_name, users.first_name, users.email');
        $this->db->from($this->table);
    	$this->db->join('users','users.id = comment.user_id');
        $this->db->where(array('product_id' => $product_id,'is_deleted' => 0,'is_activated' => 0));
        $this->db->limit($limit, $start);
        $this->db->order_by('comment.id', 'desc');
        return $result = $this->db->get()->result_array();

    	// $this->db->where()->limit($limit, $start);
        // return $this->db->get($this->table)->result_array();
    }
    public function get_comment_by_id($id)
    {
        $this->db->select('comment.*, users.last_name, users.first_name, users.email');
        $this->db->from($this->table);
        $this->db->join('users','users.id = comment.user_id');
        $this->db->where(array('comment.id' => $id,'is_deleted' => 0,'is_activated' => 0));
        return $result = $this->db->get()->row_array();
    }
    public function count_search_without_by_product_id($product_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.product_id', $product_id);

        return $result = $this->db->get()->num_rows();
    }

    public function count_all_by_product_id($product_id)
    {
    	$this->db->where(array('product_id' => $product_id,'is_deleted' => 0,'is_activated' => 0))->from($this->table);
        return $this->db->count_all_results();
    }
}