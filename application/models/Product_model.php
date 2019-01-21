<?php 

/**
* 
*/
class Product_model extends MY_Model{
	
	public $table = 'product';
	public function get_by_parent_id($parent_id, $order = 'desc',$lang = ''){
		$this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
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
    public function get_by_product_category_id($product_category_id = array(), $select = array(), $lang = '') {
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
        $this->db->where_in($this->table .'.product_category_id', $product_category_id);
        $this->db->group_by($this->table .".id");
        return $this->db->get()->result_array();
    }
    public function get_product_by_category_id_api($category_id, $id,$lang = '') {
        $this->db->select($this->table .'.*, product_lang.title as title, product_lang.description as description, product_lang.content as content, product_lang.data_lang as data_lang');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where($this->table .'.product_category_id', $category_id);
        $this->db->where($this->table .'.id !=', $id);

        return $this->db->get()->result_array();
    }
    public function get_all($select = array(), $lang = '',$order="asc") {
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
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".sort", $order);
        return $this->db->get()->result_array();
    }
    public function get_all_and_by_category($select = array(), $lang = '',$limit = '',$hot = '', $order="DESC",$category_id = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*, product_category_lang.title as category');
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
        $this->db->join('product_category_lang', 'product_category_lang.product_category_id = '. $this->table .'.'. $this->table.'_category_id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
            $this->db->where('product_category_lang.language', $lang);
        }
        if($hot != ''){
            $this->db->where($this->table .'.hot', $hot);
        }
        if($category_id != ''){
            $this->db->where($this->table .'.product_category_id', $category_id);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->group_by($this->table .".id");
        $this->db->order_by($this->table .".id", $order);
        if($limit != ''){
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    public function get_by_slug($slug, $select = array(), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*,'.$this->table.'_category_lang.title as parent_title, collection_lang.title as collection_title');
        if(in_array('title', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
        }
        if(in_array('description', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
        }
        if(in_array('content', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
        }
        if(in_array('data_lang', $select)){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.data_lang ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_data_lang');
        }
        if($select == null){
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.title ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_title');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.description ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_description');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.content ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_content');
            $this->db->select('GROUP_CONCAT('. $this->table_lang .'.data_lang ORDER BY '. $this->table_lang .'.language separator \' ||| \') as '. $this->table .'_data_lang');
        }
        
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'left');
        $this->db->join('product_category_lang', 'product_category_lang.product_category_id = '. $this->table .'.'. $this->table.'_category_id', 'left');
        $this->db->join('collection_lang', 'collection_lang.collection_id = '. $this->table .'.collection_id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
            $this->db->where('product_category_lang.language', $lang);
            $this->db->where('collection_lang.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where($this->table .'.slug', $slug);

        return $this->db->get()->row_array();
    }

    public function get_by_slug_api($slug, $lang = '') {
        $this->db->select($this->table .'.*, product_lang.title as title, product_lang.description as description, product_lang.content as content, product_lang.data_lang as data_lang');
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
    public function get_by_id($id, $select = array(), $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select($this->table .'.*, templates.data as data_templates');
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
        $this->db->join('templates', 'templates.id = '. $this->table .'.templates_id', 'left');
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }
    public function get_all_with_pagination_product($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $category = '') {
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where_in($this->table .'.product_category_id', $category);
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

    public function get_all_for_remove($id_color='',$tables = 'color') {
        $sql = "SELECT product.* FROM product WHERE is_deleted = ? AND ($tables LIKE ? OR $tables LIKE ? OR $tables LIKE ? OR $tables LIKE ?)";
        $execute = $this->db->query($sql, array(0,'%"'.$this->db->escape_like_str($id_color).'"%', '%,'.$this->db->escape_like_str($id_color).'"%', '%"'.$this->db->escape_like_str($id_color).',%', '%,'.$this->db->escape_like_str($id_color).',%'));
        return $execute->result_array();
    }

    public function get_all_search($number = 0,$sale='sale":"true',$notSale = 'sale":"false',$showpromotion = 'showpromotion":"true') {
        $sql = "SELECT product.* FROM product WHERE is_deleted = ? AND is_activated = ? AND ((common LIKE ? AND price > ?) OR (common LIKE ? AND  common LIKE ? AND pricepromotion > ?))";
        $execute = $this->db->query($sql, array(0,0,'%"'.$notSale.'"%', $number, '%"'.$sale.'"%','%"'.$showpromotion.'"%', $number));
        return $execute->result_array();
    }



    public function get_all_search_sale($category_id = '',$lang='vi',$number_one = 0,$number_tow = 1000000000,$sale='sale":"true',$notSale = 'sale":"false',$showpromotion = 'showpromotion":"true') {
        $sql = "SELECT product.*,product_lang.title FROM product INNER JOIN product_lang ON product_lang.product_id = product.id WHERE product.is_deleted = ? AND product.is_activated = ? AND product_lang.language = ? AND product.product_category_id = ? AND ((product.common LIKE ? AND product.price > ? AND product.price < ?) OR (product.common LIKE ? AND  product.common LIKE ? AND product.pricepromotion > ? AND product.pricepromotion < ?))";
        $execute = $this->db->query($sql, array(0,0,$lang,$category_id,'%"'.$notSale.'"%', (int)($number_one), (int)($number_tow), '%"'.$sale.'"%','%"'.$showpromotion.'"%', (int)($number_one), (int)($number_tow)));
        return $execute->result_array();
    }

    public function get_all_search_home($lang='vi',$number_one = 0,$number_tow = 1000000000,$sale='sale":"true',$notSale = 'sale":"false',$showpromotion = 'showpromotion":"true') {
        $sql = "SELECT product.*,product_lang.title FROM product INNER JOIN product_lang ON product_lang.product_id = product.id WHERE product.is_deleted = ? AND product.is_activated = ? AND product_lang.language = ? AND ((product.common LIKE ? AND product.price > ? AND product.price < ?) OR (product.common LIKE ? AND  product.common LIKE ? AND product.pricepromotion > ? AND product.pricepromotion < ?))";
        $execute = $this->db->query($sql, array(0,0,$lang,'%"'.$notSale.'"%', (int)($number_one), (int)($number_tow), '%"'.$sale.'"%','%"'.$showpromotion.'"%', (int)($number_one), (int)($number_tow)));
        return $execute->result_array();
    }

    public function get_all_search_rent($category_id = '',$lang='vi',$number_one = 0,$number_tow = 1000000000,$rent='rent":"true',$sale='rent_sale":"true',$notSale = 'rent_sale":"false',$showpromotion = 'showpromotion_rent":"true') {
        $sql = "SELECT product.*,product_lang.title FROM product INNER JOIN product_lang ON product_lang.product_id = product.id WHERE product.is_deleted = ? AND product.is_activated = ? AND product_lang.language = ? AND common LIKE ? AND product.product_category_id = ? AND ((product.common LIKE ? AND product.price > ? AND product.price < ?) OR (product.common LIKE ? AND  product.common LIKE ? AND product.pricepromotion > ? AND product.pricepromotion < ?))";
        $execute = $this->db->query($sql, array(0,0,$lang,'%"'.$rent.'"%',$category_id,'%"'.$notSale.'"%', (int)$number_one, (int)$number_tow, '%"'.$sale.'"%','%"'.$showpromotion.'"%', (int)$number_one, (int)$number_tow));
        return $execute->result_array();
    }



    public function count_by_category_id($lang = '',$category_id = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        if($category_id != ''){
            $this->db->where($this->table .'.product_category_id', $category_id);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->group_by($this->table_lang .'.'.$this->table.'_id');
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function count_by_trademark_id($lang = '',$trademark_id = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        if($trademark_id != ''){
            $this->db->where($this->table .'.trademark_id', $trademark_id);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->group_by($this->table_lang .'.'.$this->table.'_id');
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_trademark_id_with_pagination_api($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $trademark_id = '') {
        $trademark = ($lang != '')? 'trademark.'.$lang.' as trademark' : '';
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*, '.$trademark);
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->join('trademark', 'trademark.id = '. $this->table .'.trademark_id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($trademark_id != ''){
            $this->db->where($this->table .'.trademark_id', $trademark_id);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function get_product_by_change_with_pagination_api($order = 'desc', $type = 0,$lang = '', $limit = NULL, $start = NULL, $feature_id = array(), $trademark_id = '', $price = null ,$category = '') {
        $trademark = ($lang != '')? 'trademark.'.$lang.' as trademark,' : '';
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*, '.$trademark. $this->table.'.id as id');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id', 'inner');
        $this->db->join('trademark', 'trademark.id = '. $this->table .'.trademark_id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where($this->table .'.type', $type);
        if($feature_id != null){
            foreach ($feature_id as $key => $value) {
                $this->db->like($this->table .'.features', $value);
            }
        }
        if($trademark_id != ''){
            $this->db->where($this->table .'.trademark_id', $trademark_id);
        }
        if($category != ''){
            $this->db->where($this->table .'.product_category_id', $category);
        }
        if ($price != null) {
            switch ($price) {
                case 0:
                    $this->db->where("product.price REGEXP '(.)*".'(")'."([0-9]|[1-8][0-9]|9[0-9]|1[0-9]{2}|200)".'(")'."(.)*'");
                    break;
                case 1:
                    $this->db->where("product.price REGEXP '(.)*".'(")'."(20[1-9]|2[1-9][0-9]|[34][0-9]{2}|500)".'(")'."(.)*'");
                    break;
                case 2:
                    $this->db->where("product.price REGEXP '(.)*".'(")'."(50[1-9]|5[1-9][0-9]|[6-9][0-9]{2}|1000)".'(")'."(.)*'");
                    break;
                case 3:
                    $this->db->where("product.price REGEXP '(.)*".'(")'."(100[1-9]|10[1-9][0-9]|1[1-9][0-9]{2}|[2-9][0-9]{3}|[1-8][0-9]{4}|9[0-8][0-9]{3}|99[0-8][0-9]{2}|999[0-8][0-9]|9999[0-9]|[1-8][0-9]{5}|9[0-8][0-9]{4}|99[0-8][0-9]{3}|999[0-8][0-9]{2}|9999[0-8][0-9]|99999[0-9]|[1-8][0-9]{6}|9[0-8][0-9]{5}|99[0-8][0-9]{4}|999[0-8][0-9]{3}|9999[0-8][0-9]{2}|99999[0-8][0-9]|999999[0-9]|[1-8][0-9]{7}|9[0-8][0-9]{6}|99[0-8][0-9]{5}|999[0-8][0-9]{4}|9999[0-8][0-9]{3}|99999[0-8][0-9]{2}|999999[0-8][0-9]|9999999[0-9]|100000000)".'(")'."(.)*'");
                    break;
                default:
                    $this->db->like($this->table .'.price', '');
                    break;
            }
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }

    public function count_product_by_change($type, $lang = '',$feature_id = array(), $trademark_id = '', $category = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.type', $type);
        if($feature_id != null){
            foreach ($feature_id as $key => $value) {
                $this->db->like($this->table .'.features', $value);
            }
        }
        if($trademark_id != ''){
            $this->db->where($this->table .'.trademark_id', $trademark_id);
        }
        if($category != ''){
            $this->db->where($this->table .'.product_category_id', $category);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->group_by($this->table_lang .'.'.$this->table.'_id');
        $this->db->where($this->table .'.is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_all_with_pagination_search_api($order = 'desc',$lang = '', $limit = NULL, $start = NULL, $category = '') {
        $trademark = ($lang != '')? 'trademark.'.$lang.' as trademark' : '';
        $this->db->select($this->table .'.*, '. $this->table_lang .'.*, '.$trademark);
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->join('trademark', 'trademark.id = '. $this->table .'.trademark_id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        if($category != ''){
            $this->db->where($this->table .'.product_category_id', $category);
        }
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        $this->db->limit($limit, $start);
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }
    public function get_all_front_end($order = 'desc',$lang = '',$collection_id){
        $this->db->select($this->table .'.*, '. $this->table_lang .'.title');
        $this->db->from($this->table);
        $this->db->join($this->table_lang, $this->table_lang .'.'. $this->table .'_id = '. $this->table .'.id');
        $this->db->where($this->table .'.is_deleted', 0);
        $this->db->where($this->table .'.is_activated', 0);
        $this->db->where($this->table .'.collection_id', $collection_id);
        if($lang != ''){
            $this->db->where($this->table_lang .'.language', $lang);
        }
        
        $this->db->group_by($this->table_lang .'.'. $this->table .'_id');
        $this->db->order_by($this->table .".id", $order);

        return $result = $this->db->get()->result_array();
    }
}