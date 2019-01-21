<?php 

/**
* 
*/
class Product_category_model extends MY_Model{
	
	public $table = 'product_category';


	public function update_sort($sort, $id){
        $this->db->set(array('sort' => $sort))
            ->where('id', $id)
            ->update('product_category');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }
    public function get_by_parent_id_when_active($parent_id, $order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        if(is_numeric($parent_id)){
            $this->db->where($this->table .'.parent_id', $parent_id);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_by_slug_check_active($slug, $order = 'desc',$lang = 'vi'){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        if($slug != ''){
            $this->db->where($this->table .'.slug', $slug);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->row_array();
    }
    
    public function get_by_slug($slug, $order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title, '. $this->table_lang .'.content');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        if($slug != ''){
            $this->db->where($this->table .'.slug', $slug);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->row_array();
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
            $this->db->where($this->table .'.parent_id', $parent_id);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->result_array();
    }
    public function get_by_type($type, $order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.type', $type);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->result_array();
    }
    public function get_all($select = array(), $lang = '',$order="asc") {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".sort", $order);
        return $this->db->get()->result_array();
    }
    public function get_all_api($select = array(), $lang = '',$order="asc") {
        $this->db->select($this->table .'.*, product_category_lang.title as title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".sort", $order);
        return $this->db->get()->result_array();
    }
}