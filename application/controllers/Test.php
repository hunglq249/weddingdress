<?php
/**
* 
*/
class Test extends Public_Controller
{
	private $request_language_template = array(
        'title', 'description', 'content'
    );
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','common'));
		$this->load->model("menu_model");
		$this->load->model("post_model");
		$this->load->model("post_category_model");
		$this->load->model("product_category_model");
		$this->load->model("product_model");
	}
	public function index($uri1 = '', $uri2 = ''){
		foreach ($this->menu_model->get_all() as $key => $value) {
			$detail[] = build_language('menu', $value, array('title'), $this->page_languages);
		}
		$this->build_new_category($detail,0,$detail1);
		echo "<pre>";
		print_r($detail1);
		echo "<pre>";
		if($uri1 == 'trang-chu' || $uri1 == ''){
			echo 'day la trang chu';
			return;
		}
		if($uri1 == 'thuc-don'){
			$product_category = $this->product_category_model->get_all(array('title'));
			$product = $this->product_model->get_all(array('title','description','content'));
			echo '<pre>';
			print_r($product_category);
			echo '</pre>';die;
			echo 'thuc-don';
			return;
		}
		if($uri1 != ''){
			$result = $this->get_by_post_for_menu($uri1,$uri2);
			echo '<pre>';
			print_r($result);
			echo '</pre>';
		}
		
	}

    public function build_new_category($categorie, $parent_id = 0,&$result, $id = "",$char=""){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            $select = ($value['id'] == $id)? 'selected' : '';
            $result.='<option value="'.$value['id'].'"'.$select.'>'.$char.$value['title_vi'].'</option>';
            $this->build_new_category($categorie, $value['id'],$result, $id, $char.'---|');
            }
        }
    }
	public function get_by_post_for_menu($uri1 = '',$uri2 = ''){
			$this->get_by_menu_post_url($uri1,$newarray);
			$check = 0;
			foreach ($newarray as $key => $value) {
				if($value[0] == $uri1 && !isset($value[1])){
					$url[] = $value;
					$check = 1;
				}
				if($value[0] == $uri1 && isset($value[1]) && $uri2 != ''){
					foreach ($this->show_posts1($uri1) as $k => $val) {
						if($uri2 == $value[1] && $value[1] == $val['slug'] && $val['is_activated'] == 0){
							return $val;
						}
					}
				}
			}
			if($check == 1){
				if($uri2 != ''){
					foreach ($this->show_posts1($uri1) as $key => $value) {
						if($uri2 == $value['slug']){
							return $value;
						}
					}
				}else{
					return $this->show_posts1($uri1);
				}
			}
			return 'url k ton tai';
	}
	public function get_by_product_for_menu($uri1 = '',$uri2 = ''){
		if($uri2 == ''){
			$this->get_by_menu_product(0,$newarray);
			if(isset($newarray) && count($newarray)>0){
				foreach ($newarray as $key => $value) {
					$where_in[] = $value['id']; 
				}
				$result= $this->product_model->get_by_product_category_id($where_in,array('title','description','content'));
				echo "<pre>";
				print_r($result);
				echo "<pre>";
				return;
			}
			redirect('/', 'refresh');
		}
		redirect($uri1, 'refresh');
	}
	public function get_by_menu_post_url($url,&$newarray){
		if(count($this->menu_model->get_by_check_menu_children(0))>0){
			foreach ($this->menu_model->get_by_check_menu_children(0) as $key => $value) {
				$url = explode("/", rtrim(str_replace(base_url(),'',$value['url']),"/"));
				$newarray[] = $url;
			}
		}else{
			echo 2;die;
		}
	}
	public function get_by_menu_product($parent_id=0,&$newarray){
	    $product_category = $this->product_category_model->get_by_parent_id($parent_id);
	    if(count($product_category)>0){
	        foreach ($product_category as $key => $value) {
	            if(count($this->product_category_model->get_by_parent_id($value['id'])) == 0){
	                $newarray[] = $value;
	            }
	            $this->get_by_menu_product($value['id'],$newarray);
	        }
	    }
	}
    function get_posts_with_category($categories, $parent_id = 0, &$ids){
        foreach ($categories as $key => $item){
            $ids[] = $parent_id;
            if ($item['parent_id'] == $parent_id){
                $ids[] = $item['id'];
                $this->get_posts_with_category($categories, $item['id'], $ids);
            }
        }
    }
    public function show_posts1($slug){
        $category_post = $this->post_category_model->get_by_parent_id(null, 'asc');
        $detail = $this->post_category_model->get_by_slug($slug);
        
        $this->get_posts_with_category($category_post, $detail['id'], $ids);
        $new_ids = array_unique($ids);
        return $this->post_model->get_by_multiple_ids_when_active($new_ids, 'vi');
    }


}