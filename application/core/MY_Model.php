<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $table = '';
    public $table_lang = '';

    function __construct() {
        parent::__construct();
        $this->table_lang = $this->table . '_lang';
    }

    /**
     * @param $data
     * @return integer|bool
     */
    function common_insert($data) {
        $this->db->set($data)->insert($this->table);

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * @param $data
     * @return mixed
     */
    function insert_with_language($data){
        return $this->db->insert_batch($this->table_lang, $data);
    }

    public function get_all_with_pagination_search($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
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

    public function get_all_with_pagination_searchs($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title,'.$this->table_lang .'.description');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->like($this->table_lang .'.title', $keywords);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        // $this->db->where("product.price REGEXP '(.)*".'(")'."(1[5-8][0-9]{4}|19[0-8][0-9]{3}|199[0-8][0-9]{2}|1999[0-8][0-9]|19999[0-9]|2[0-9]{5}|300000)".'(")'."(.)*'"); //test có code js built REGEXP
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_all_with_pagination_and_sort_search($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->like($this->table_lang .'.title', $keywords);
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_all_with_pagination_and_search_by_parent_id($parent_id,$order = 'desc',$lang = '', $limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->like($this->table_lang .'.title', $keywords);
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.parent_id', $parent_id);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".sort", $order);

        return $result = $this->db->get()->result_array();
    }

    public function count_search($lang = '',$keyword = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->like($this->table_lang .'.title', $keyword);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->group_by($this->table_lang .'.'.$this->table.'_id');
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($id, $select = array(), $lang = '') {
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
        if(in_array('metakeywords', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.metakeywords ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_metakeywords');
        }
        if(in_array('metadescription', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.metadescription ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_metadescription');
        }
        if(in_array('data_lang', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.data_lang ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_data_lang');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.metakeywords ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_metakeywords');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.metadescription ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_metadescription');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.data_lang ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_data_lang');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function get_by_id_wo_lang($id){
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function common_update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update($this->table, $data);
    }

    public function common_delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    public function common_delete_join($id) {
        $this->db->where('product_id', $id);
        return $this->db->delete($this->table_lang);
    }

    public function common_update_multiple($data) {
        return $this->db->update_batch($this->table, $data,'id');
    }
    public function common_update_multiple_lang($data) {
        return $this->db->update_batch($this->table_lang, $data,'id');
    }

    public function multiple_update_by_ids($ids = array(), $data) {
        $this->db->where_in('id', $ids);

        return $this->db->update($this->table, $data);
    }

    public function multiple_update_by_category_ids($category_ids = array(), $data) {
        $this->db->where_in($this->table .'_category_id', $category_ids);

        return $this->db->update($this->table, $data);
    }
    public function multiple_update_by_collection_ids($collection_id, $data) {
        $this->db->where('collection_id', $collection_id);

        return $this->db->update($this->table, $data);
    }
    public function multiple_update_by_banner_ids($banner_id,$type, $data) {
        $this->db->where(array('category_id'=> $banner_id,'type' => $type));

        return $this->db->update($this->table, $data);
    }

    public function count_active(){
        $query = $this->db->from($this->table)->where('is_activated', 1)->get();
        return $query->num_rows();
    }

    public function get_by_multiple_ids($id = array(), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*, '.$this->table_lang .'.*');
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where_in($this->table .'.'. $this->table .'_category_id', $id);
        
        return $this->db->get()->result_array();
    }

    public function get_by_multiple_ids_activated($id = array(), $lang = '') {
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

    function update_with_language($id, $language,  $data){
        $this->db->where($this->table .'_id', $id);
        $this->db->where('language', $language);
        return $this->db->update($this->table_lang, $data);
    }

    public function build_unique_slug($slug, $id = null){
        $count = 0;
        $temp_slug = $slug;
        while(true) {
            $this->db->select('id');
            $this->db->where('slug', $temp_slug);
            if($id != null){
                $this->db->where('id !=', $id);
            }
            $query = $this->db->get($this->table);
            if ($query->num_rows() == 0) break;
            $temp_slug = $slug . '-' . (++$count);
        }
        return $temp_slug;
    }

    public function get_all($order = 'desc',$lang = ''){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }
    
    public function get_by_all($select = array('title'), $lang = 'vi',$order="asc") {
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
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".sort", $order);
        return $this->db->get()->result_array();
    }

    public function find_rows($data=array()){
        $this->db->where($data);
        return $this->db->count_all_results($this->table);
    }
    public function find_results($id_templates){
        // $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.id, '. $this->table .'.data, '. $this->table .'.slug, '.$this->table_lang .'.*');
        // $this->db->select('GROUP_CONCAT('. $this->table_lang .'.id ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_id');
        // $this->db->select('GROUP_CONCAT('. $this->table_lang .'.data_lang ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_data_lang');
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        $this->db->where($this->table.'.templates_id', $id_templates);
        return $this->db->get($this->table)->result_array();
    }
    public function find($id){
        $this->db->where(array('id' => $id,'is_deleted' => 0));
        return $this->db->get($this->table)->row_array();
    }
    public function get_where_array($array){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted',0);
        $this->db->where($array);
        return $result = $this->db->get()->result_array();
    }
}