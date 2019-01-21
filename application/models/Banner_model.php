<?php 

/**
* 
*/
class Banner_model extends MY_Model{
    
    public $table = 'banner';

    public function get_all_banner() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_activated', 0);
        $this->db->where('is_deleted', 0);
        return $result = $this->db->get()->result_array();
    }
    public function get_by_parent_id($parent_id, $order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        if(is_numeric($parent_id)){
            $this->db->where($this->table .'.id', $parent_id);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->row_array();
    }
    public function get_all_lang($select = array(), $lang = '',$order="desc") {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
        }
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".id", $order);
        return $this->db->get()->result_array();
    }
}