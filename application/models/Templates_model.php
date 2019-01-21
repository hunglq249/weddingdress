<?php
/**
* 
*/
class Templates_model extends MY_Model{
	public $table = 'templates';
	function __construct(){
		parent::__construct();
	}

    function common_insert($data) {
        $this->db->set($data)->insert($this->table);

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }
    public function common_update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update($this->table, $data);
    }
    public function count_search_not_lang($keyword = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('title', $keyword);
        $this->db->group_by('id');
        $this->db->where('is_deleted', 0);
        return $result = $this->db->get()->num_rows();
    }
    public function get_all_with_pagination_search_not_lang($order = 'desc',$limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('title', $keywords);
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->group_by('id');
        $this->db->order_by("id", $order);
        return $result = $this->db->get()->result_array();
    }
    public function get_all($order = 'desc',$type=1) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->where('type', $type);
        $this->db->group_by('id');
        $this->db->order_by("id", $order);
        return $result = $this->db->get()->result_array();
    }
    
    public function find_rows($data=array()){
        $this->db->where($data);
        return $this->db->count_all_results($this->table);
    }

    public function get_by_id_templates($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.id', $id);
        $this->db->limit(1);
        
        return $this->db->get()->row_array();
    }
    public function get_by_activated_contact() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 1);
        $this->db->limit(1);
        
        return $this->db->get()->row_array();
    }
}