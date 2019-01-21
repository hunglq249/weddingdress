<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    /*.numberlist{*/
    /*width:450px;*/
    /*}*/
    .numberlist ol{
        counter-reset: li;
        list-style: none;
        *list-style: decimal;
        font: 15px 'trebuchet MS', 'lucida sans';
        padding: 0;
        margin-bottom: 4em;
    }
    .numberlist ol ol{
        margin: 0 0 0 2em;
    }

    .numberlist a{
        width: 80%;
        position: relative;
        display: inline-block;
        padding: .4em .4em .4em 2em;
        *padding: .4em;
        margin: .5em 0;
        background: #FFF;
        color: #444;
        text-decoration: none;
        -moz-border-radius: .3em;
        -webkit-border-radius: .3em;
        border-radius: .3em;
        text-decoration: none;
    }

    .numberlist a:hover{
        background: #cbe7f8;
        text-decoration:none;
    }
    .numberlist a:before{
        content: counter(li);
        counter-increment: li;
        position: absolute;
        left: -1.3em;
        top: 57%;
        margin-top: -1.3em;
        background: #87ceeb;
        height: 2.4em;
        width: 2.4em;
        line-height: 2em;
        border: .3em solid #fff;
        text-align: center;
        font-weight: bold;
        -moz-border-radius: 2em;
        -webkit-border-radius: 2em;
        border-radius: 2em;
        color:#FFF;
    }

     .error{
         color: red;
     }

</style>

<!-- <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token"> -->
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
            <h2>Chỉnh sửa menu <span><?php echo $detail['title_vi']; ?></span></h2>
            <div class="modified-mode">
                <div class="col-lg-10 col-lg-offset-0">
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
                                            echo form_error($k .'_'. $key);
                                            echo form_input($k .'_'. $key, trim($detail['title_'. $key]), 'class="form-control title" id="title_'.$key.'"');
                                            echo '<span class="help-block hidden">Bạn phải nhập tiêu đề cho menu.</span></div>';
                                        }
                                        ?>
                                <?php endforeach ?>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </div>
                    <?php if($count_sub == 0): ?>
                    <hr class="form-group" style="border: solid 0.5px lightgrey">
                    <h3 class="form-group">Dựng đường dẫn cho menu</h3>
                    <input type="hidden" name="slug_post" value="<?php echo $detail['slug_post'] ?>" id="slug_post">
                    <div class="form-group sub-cat">
                        <?php
                        echo form_label('Chọn menu chính (hoặc Bài viết riêng nếu là bài viết lẻ)', 'select_main');
                        echo form_error('select_main');
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
                        ?>
                        <select name="selectArticle_shared" class="form-control" id="select_article" onchange="list_post(this.selectedIndex, this.id)">
                            <option value="">Click để chọn</option>
                            <?php foreach ($result as $key => $value): ?>
                                <?php 
                                    $selected = (strrpos($detail['url'],"bai-viet/" . $value['slug']) || strrpos($detail['url'],"san-pham/" . $value['slug'])) ? 'selected' : '';
                                    $param_url = (explode('/',$detail['slug'])[0] == 'nhom' || explode('/',$detail['slug'])[0] == 'san-pham') ? 'san-pham' : 'bai-viet'; 
                                ?>
                                <option value="<?php echo $param_url;?>/<?php echo $value['slug'];?>" <?php echo $selected;?>>
                                    <?php 
                                        echo ($value['is_activated'] == 1) ? $value['title'].MESSAGE_ERROR_TURN_ON_POST_PERSENT : $value['title'];
                                    ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Đường dẫn hoàn chỉnh của menu', 'url_shared');
                        echo form_error('url_shared');
                        echo form_input('url_shared', $detail['url'], 'class="form-control" id="url" readonly="readonly"');
                        ?>
                    </div>
                    <hr class="form-group" style="border: solid 0.5px lightgrey">
                    <?php endif; ?>
                    <div class="form-group picture sub-cat">
                        <?php
                        echo form_label('Bật / Tắt menu', 'isActived_shared');
                        echo form_error('isActived_shared');
                        echo form_dropdown('isActived_shared', array('0' => 'Bật', '1' => 'Tắt'), set_value('isActived_shared', $detail['is_activated']), 'class="form-control" id="is_actived"');
                        ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <?php
                        echo form_submit('submit', 'OK', 'class="btn btn-primary" id="checksubmit" style="float:right"');
                        echo form_close();
                        ?>
                        <a class="btn btn-primary cancel" href="javascript:window.history.go(-1);">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content row">
        <div class="container col-md-12 numberlist">
                <h2>Danh sách menu con trong menu 
                    <span><?php echo $detail['title_vi']; ?></span>
                    &nbsp&nbsp&nbsp&nbsp
                    <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('admin/menu/create/' . $detail['id']); ?>'">
                        <span class="glyphicon glyphicon-plus"></span>
                     menu con</button>
                </h2>
                <h5 style="color:darkorange">Nếu có menu con đang được bật, menu chính bên trên không thể gán đường dẫn trực tiếp</h5>
            <div class="col-lg-10 col-lg-offset-0">
                <ol id="sub-sortable">
                    <?php
                    if (!empty($subs)):
                        foreach ($subs as $key => $item):
                            ?>
                            <li class="treeview remove_<?php echo $item['id'] ?>" id="<?php echo ($key + 1) . '-' . $item['id'] ?>">
                                <strong class="col-md-9"><a " href="<?php echo base_url('admin/menu/edit/' . $item['id']) ?>"><?php echo $item['title'] ?></a></strong>
                                <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('admin/menu/edit/' . $item['id']); ?>'"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('admin/menu/create/' . $item['id']); ?>'">
                                    <span class="glyphicon glyphicon-plus"> </span>
                                </button>
                                <button data-url="<?php echo base_url('admin/menu/remove'); ?>" data-id="<?php echo $item['id']; ?>" type="button" class="btn btn-danger btn-remove-menu" onclick="remove_menu(this)">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                                <button data-url="<?php echo base_url('admin/menu/active'); ?>" data-parent-id="<?php echo $detail['id']; ?>" data-id="<?php echo $item['id']; ?>" data-active="<?php echo $item['is_activated']; ?>" type="button" class="btn <?php echo ($item['is_activated'] == 0) ? 'btn-success' : 'btn-danger'; ?> btn-active-menu" onclick="activated_menu(this)">
                                    <i class="fa <?php echo ($item['is_activated'] == 0) ? 'fa-check' : 'fa-remove'; ?>" aria-hidden="true"></i>
                                </button>
                            </li>
                            <?php
                        endforeach;
                    else:
                    ?>
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset-0" style="margin-top: 10px;">
                            <table>
                                Không có menu con!
                            </table>

                        </div>

                    </div>
                    <?php endif; ?>
                </ol>
            </div>
        </div>
    </section>
</div>

<?php 
    function build_new_category($categorie, $parent_id = 0, $slug, $char = '', $type = ''){
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
            <option value="<?php echo $type.$value['slug'] ?>" <?php echo($value['slug'] == $slug && !empty($slug))? 'selected' : ''?> slug="<?php echo $value['slug']; ?>" type="<?php echo $type; ?>"><?php echo $char.$value['title'] ?><?php echo($value['is_activated'] == 1)? MESSAGE_ERROR_TURN_ON_CATEGORY_FOR_SELECTED_CREATE : ''?></option>
            
            <?php build_new_category($categorie, $value['id'], $slug, $char.'---|', $type) ?>
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

    $( function() {
        $('#sub-sortable').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: {
                        sort: data,
                    },
                    method: 'GET',
                    url: `${HOSTNAME}admin/menu/sort`,
                });
            }
        });
    });

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

    function activated_menu(ev){
        var url = HOSTNAME + 'admin/menu/active';
        var id = $(ev).data('id');
        if($(ev).hasClass('btn-success')){
            var question = 'Chắc chắn tắt Menu này? Nếu tắt tất cả các Menu con cũng sẽ bị tắt';
        }else{
            var question = 'Chắc chắn bật Menu này?';
        }
        if(confirm(question)){
            $.ajax({
                method: "post",
                url: url,
                data: {
                    id : id, csrf_sitecom_token : document.querySelector('[name="csrf_sitecom_token"]').value
                },
                success: function(response){
                    csrf_hash = response.reponse.csrf_hash;
                    if(response.status == 200){
                        if($(ev).hasClass('btn-success')){
                            alert(response.message);
                        }else{
                            alert(response.message);
                        }
                        location.reload();
                    }
                },
                error: function(responses){
                     if(responses.responseJSON.status == 404){
                        alert(responses.responseJSON.message);
                        location.reload();
                     }
                }
            });
        }
    }
    function remove_menu(ev){
        var url = HOSTNAME + 'admin/menu/remove';
        var id = $(ev).data('id');
        if(confirm('Chắc chắn xóa?')){
            $.ajax({
                method: "get",
                url: url,
                data: {
                    id : id
                },
                success: function(response){
                    console.log(response);
                    if(response.status == 200 && response.isExisted == true){
                        $('.remove_' + id).fadeOut();
                    }
                    if(response.status == 200 && response.isExisted == false){
                        alert('Menu này có chứa Menu con. Vui lòng xóa Menu con trước trước sau đó thực hiện lại thao tác');
                    }
                },
                error: function(jqXHR, exception){
                    console.log(errorHandle(jqXHR, exception));
                }
            });
        }
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
