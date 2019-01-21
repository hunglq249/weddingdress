<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends MY_Model {

    public $table = 'contact';

    public function __construct() {
        parent::__construct();
    }
    public function get_all_contact() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        return $result = $this->db->get()->result_array();
    }
    public function get_all_group_by() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->group_by('contact');
        return $result = $this->db->get()->result_array();
    }
    public function get_by_slug_contact($slug='') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->where('slug', $slug);
        return $result = $this->db->get()->row_array();
    }
    public function get_by_id_contact($id='') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $id);
        return $result = $this->db->get()->row_array();
    }
    public function get_by_contact($contact='',$lang='vi') {
        $this->db->select($this->table . '.*, '. $this->table_lang . '.title as title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        $this->db->where($this->table . '.is_deleted', 0);
        $this->db->where($this->table . '.contact', $contact);
        $this->db->where($this->table_lang . '.language', $lang);
        return $result = $this->db->get()->result_array();
    }
    public function get_librarycontact_by_id_array($librarycontact = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where_in('id', $librarycontact);
        return $result = $this->db->get()->result_array();
    }
    public function get_librarycontact_by_not_id_array($notlibrarycontact = array(),$contact){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('contact', $contact);
        $this->db->where_not_in('id', $notlibrarycontact);
        return $result = $this->db->get()->result_array();
    }
    public function get_by_id_array($id = array(), $select = array('title','description','content'), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
        }
        if(in_array('content', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where_in($this->table .'.id', $id);
        return $this->db->get()->row_array();
    }
    public function get_by_id_array_lang($id = array(), $select = array('title','description','content'), $lang = 'vi') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
        }
        if(in_array('content', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'content');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. 'content');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where_in($this->table .'.id', $id);
        return $this->db->get()->row_array();
    }
    public function get_all_contact_contact($contact,$id,$limit = '',$lang){
        $this->db->select('contact.*, contact_lang.title as title, contact_lang.description as description, contact_lang.content as content,  contact_lang.language as language');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang . '.' . $this->table . '_id = ' . $this->table . '.id');
        $this->db->where($this->table . '.is_deleted', 0);
        $this->db->where($this->table_lang .'.language', $lang);
        $this->db->where($this->table.'.contact', $contact);
        $this->db->where_not_in($this->table.'.id', $id);
        $this->db->limit($limit);
        return $result = $this->db->get()->result_array();
    }
    public function fetch_row_by_slugs($slug, $lang){
        $this->db->select('contact.*, contact_lang.title as title, contact_lang.content as content,  contact_lang.language as language')
            ->from($this->table)
            ->join($this->table_lang, $this->table_lang . '.' . $this->table . '_id = ' . $this->table . '.id')
            ->where($this->table . '.is_deleted', 0)
            ->where($this->table_lang .'.language', $lang)
            ->where($this->table .'.slug', $slug);

        return $this->db->get()->row_array();
    }

    public function get_all_with_pagination_searchss($order = 'desc',$limit = NULL, $start = NULL, $keywords = '') {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->like('title', $keywords);
        $this->db->where($this->table.'.is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by($this->table.".id", $order);

        return $result = $this->db->get()->result_array();
    }
    public function count_searchs($keyword = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('title', $keyword);
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }
}
