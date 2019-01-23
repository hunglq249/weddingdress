<?php 

/**
* 
*/
class Question_model extends MY_Model{
	
	public $table = 'question';

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
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
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
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_by_slug($slug, $order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
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
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->row_array();
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
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->row_array();
    }
    public function get_by_parent_id_num_rows($parent_id){
        if(is_numeric($parent_id)){
            $this->db->where('id', $parent_id);
        }
        return $this->db->count_all_results($this->table);
    }
    public function get_all_with_pagination_search($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title, '. $this->table_lang .'.description');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->like($this->table_lang .'.title', $keywords);
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        if($this->table == 'collection'){
            $this->db->where($this->table .'.id >', 0);
        }
        // $this->db->where("product.price REGEXP '(.)*".'(")'."(1[5-8][0-9]{4}|19[0-8][0-9]{3}|199[0-8][0-9]{2}|1999[0-8][0-9]|19999[0-9]|2[0-9]{5}|300000)".'(")'."(.)*'"); //test có code js built REGEXP
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }
}