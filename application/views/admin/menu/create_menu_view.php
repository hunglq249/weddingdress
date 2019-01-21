<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        <div class="container col-md-12">
            <?php if ($this->session->flashdata('message_error')): ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('message_error'); ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('message_success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('message_success'); ?>
                </div>
            <?php endif ?>
            <h2>Thêm menu chính</h2>
            <div class="modified-mode">
                <div class="col-lg-10 col-lg-offset-0" style="padding: 0px;">
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'menu-form'));
                    ?>
                    <div class="form-group">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <?php $i = 0; ?>
                            <?php foreach ($page_languages as $key => $value): ?>
                                <li role="presentation" class="<?php echo ($i == 0)? 'active' : '' ?>">
                                    <a href="#<?php echo $key ?>" aria-controls="<?php echo $key ?>" role="tab" data-toggle="tab">
                                        <span class="badge"><?php echo $i + 1 ?></span> <?php echo $value ?>
                                    </a>
                                </li>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <hr>
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        <?php foreach ($template as $key => $value): ?>
                            <div role="tabpanel" class="form-group tab-pane <?php echo ($i == 0)? 'active' : '' ?>" id="<?php echo $key ?>">
                                <?php foreach ($value as $k => $val): ?>
                                    
                                        <?php
                                        if($k == 'title' && in_array($k, $request_language_template)){
                                            echo '<div class="form-group col-xs-12 required" >';
                                            echo form_label($val, $k .'_'. $key);
                                            echo form_input($k .'_'. $key, set_value($k .'_'. $key), 'class="form-control title" id="title_'.$key.'"');
                                            echo '<span class="help-block hidden">Bạn phải nhập tiêu đề cho menu.</span></div>';
                                        }
                                        ?>
                                        
                                <?php endforeach ?>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </div>
                    <hr class="form-group" style="border: solid 0.5px lightgrey">
                    <h3 class="form-group">Dựng đường dẫn cho menu</h3>
                    <div class="form-group sub-cat">
                        <?php
                        echo form_label('Chọn category cho menu chính', 'selectMain_shared');
                        echo form_error('selectMain_shared');
                        ?>
                        <select name="selectMain_shared" class="form-control" id="select_main" onchange="list_post(this.selectedIndex, this.id)">
                            <option value="">Chọn danh mục</option>
                            <optgroup label="Post category">
                                <?php build_new_category($main_post, 0, $slug, '','danh-muc/') ?>
                            </optgroup>
                            <optgroup label="Product category">
                                <?php build_new_category($main_product, 0, $slug, '','nhom/') ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group sub-cat">
                        <?php
                        echo form_label('Chọn bài viết (nếu không chọn, menu sẽ trỏ đến danh sách bài viết trong danh mục phía trên)', 'selectArticle_shared');
                        echo form_error('selectArticle_shared');
                        // echo form_dropdown('selectArticle_shared', $result, '', 'class="form-control" id="select_article"');
                        ?>
                        <select name="selectArticle_shared" class="form-control" id="select_article" onchange="list_post(this.selectedIndex, this.id)">
                            <option value="">Click để chọn</option>
                            <?php if (!empty($result)): ?>
                                <?php $param_url = (explode('/',$detail['slug'])[0] == 'nhom' || explode('/',$detail['slug'])[0] == 'san-pham') ? 'san-pham' : 'bai-viet'; ?>
                                <?php foreach ($result as $key => $value): ?>
                                    <option value="<?php echo $param_url;?>/<?php echo $value['slug'];?>"><?php echo $value['title'];?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php $url = ($id > 0 && !empty($detail['slug'])) ? 'http://localhost/weddingdress/'.$detail['slug'] : '' ?>
                        <?php
                        echo form_label('Đường dẫn hoàn chỉnh của menu', 'url_shared');
                        echo form_error('url_shared');
                        echo form_input('url_shared',$url, 'class="form-control" id="url" readonly="readonly"');
                        ?>
                    </div>
                    <!-- <hr class="form-group" style="border: solid 0.5px lightgrey"> -->
                    <div class="form-group picture sub-cat">
                        <?php
                        echo form_label('Bật / Tắt menu', 'isActived_shared');
                        echo form_error('isActived_shared');
                        echo form_dropdown('isActived_shared', array('0' => 'Bật', '1' => 'Tắt'), set_value('isActived_shared', 0), 'class="form-control" id="is_actived"');
                        ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <?php
                        echo form_submit('submit', 'OK', 'class="btn btn-primary" id="checksubmit" style="float:right"');
                        echo form_close();
                        ?>
                        <a class="btn btn-primary cancel left" href="javascript:window.history.go(-1);">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
    function build_new_category($categorie, $parent_id = 0,$slug = '', $char = '',$type = ''){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }

        if ($cate_child){
            foreach ($cate_child as $key => $value){
            ?>
            <option value="<?php echo $type.$value['slug'] ?>" slug="<?php echo $value['slug']; ?>" type="<?php echo $type; ?>" <?php echo ($value['slug'] == $slug)? 'selected' : '' ?> ><?php echo $char.$value['title'] ?></option>
            <?php build_new_category($categorie, $value['id'], $slug, $char.'---|',$type) ?>
            <?php
            }
        }
    }
?>
<script type="text/javascript">
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAME = 'http://diamondtour.vn/';
            break;
        default:
            var HOSTNAME = 'http://localhost/weddingdress/';
    }
    function list_post(index,id){
        value = document.querySelectorAll(`#${id} option`)[index].getAttribute('value');
        if(id == 'select_main'){
            if(value == ''){
                document.getElementById('select_article').innerHTML = '<option value="">Click để chọn</option>';
                document.getElementById('url').value = '';
                return false;
            }
            let data = new FormData();
            let type = 'ajax_menu_posts';
            let type_children = 'bai-viet';
            data.append('slug',document.querySelectorAll(`#${id} option`)[index].getAttribute('slug'));
            data.append('csrf_sitecom_token', document.querySelector('[name="csrf_sitecom_token"]').value);
            if(document.querySelectorAll(`#${id} option`)[index].getAttribute('type') != 'danh-muc/'){
                type = 'ajax_menu_products';
                type_children = 'san-pham';
            }
            fetch(`${HOSTNAME}admin/menu/${type}`,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    let html_select = '<option value="">Click để chọn</option>';
                    for (var i = 0; i < html.reponse.result.length; i++) {
                        let check_activated = (html.reponse.result[i].is_activated == 0) ? html.reponse.result[i].title : html.reponse.result[i].title+html.reponse.deactive;
                        html_select += `<option value="${type_children}/${html.reponse.result[i].slug}">${check_activated}</option>`;
                    }
                    document.getElementById('select_article').innerHTML = html_select;
                    document.querySelector('[name="csrf_sitecom_token"]').value = html.reponse.csrf_hash;
                }

            );
        }else{
            if(value == ''){
                value = document.getElementById('select_main').value;
            }
        }
        document.getElementById('url').value = `${HOSTNAME}${value}`;
    }
    function check_validate(ev){
        if(ev.querySelector('input').value == ''){
            ev.closest('.required').classList.add("has-error");
            ev.closest('.required').querySelector('span.help-block').classList.remove("hidden");
        }else{
            ev.closest('.required').querySelector('span.help-block').classList.add("hidden");
            ev.closest('.required').classList.remove("has-error");
        }
    }
    $("#checksubmit").click(function(){
        for (var i = 0; i < document.querySelectorAll('.tab-content div.required').length; i++) {
            if(document.querySelectorAll('.tab-content div.required')[i].querySelector('input').value == ''){
                document.querySelectorAll('.tab-content div.required')[i].classList.add("has-error");
                document.querySelectorAll('.tab-content div.required')[i].setAttribute('oninput',`check_validate(this)`);
                document.querySelectorAll('.tab-content div.required')[i].querySelector('span').classList.remove("hidden");
            }
        }
        if(document.querySelectorAll('.has-error').length > 0){
            id_parent = document.querySelectorAll('.form-horizontal .has-error')[0].closest('.tab-pane').id;
            document.querySelector(`.form-horizontal .nav.nav-justified li.active a`).setAttribute("aria-expanded","false");
            document.querySelector(`.form-horizontal .nav.nav-justified li.active`).classList.remove("active");
            document.querySelector(`.form-horizontal .tab-content .tab-pane.active`).setAttribute("class","form-group tab-pane fade");
            document.querySelector(`.form-horizontal .has-error`).closest('.tab-pane').setAttribute("class","form-group tab-pane fade active in");
            document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).setAttribute("aria-expanded","true");
            document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).parentElement.classList.add("active");
            document.querySelectorAll(`.form-horizontal .has-error input`)[0].focus();
            
            return false;
        }
    });
</script>