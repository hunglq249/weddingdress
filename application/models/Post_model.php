<?php 

/**
* 
*/
class Post_model extends MY_Model{
	public $table = 'post';
    public function get_by_post_category_id($post_category_id = array(), $select = array(), $lang = '', $limit = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
        }
        if(in_array('content', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id','left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where_in($this->table .'.post_category_id', $post_category_id);
        $this->db->group_by($this->table .".id");
        if($limit != ''){
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }
    public function get_by_slug($slug, $select = array(), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
        }
        if(in_array('content', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where($this->table .'.slug', $slug);

        return $this->db->get()->row_array();
    }
    public function get_by_multiple_ids_when_active($id = array(), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*, '.$this->table_lang .'.*');
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where_in($this->table .'.'. $this->table .'_category_id', $id);
        
        return $this->db->get()->result_array();
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

        return $result = $this->db->get()->row_array();
    }
    public function get_all_with_pagination_post($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $category = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where_in($this->table .'.post_category_id', $category);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_all_with_pagination_search_api($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $category = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($category != ''){
            $this->db->where($this->table .'.post_category_id', $category);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function count_by_category_id($lang = '',$category_id = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        if($category_id != ''){
            $this->db->where($this->table .'.post_category_id', $category_id);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->group_by($this->table_lang .'.'.$this->table.'_id');
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }
}