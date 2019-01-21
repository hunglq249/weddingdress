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
        width: 100%;
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

</style>
<div class="content-wrapper" style="min-height: 916px;">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
    <section class="content row">
        <div class="container col-md-12">
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <h3>Quản lý menu chính</h3>
            <div class="row">
                <a type="button" href="<?php echo site_url('admin/menu/create'); ?>" class="btn btn-primary">THÊM MỚI MENU CHÍNH</a>
            </div>
            <?php if ($menus): ?>
                <div class="row">
                    <div class="col-lg-12 numberlist" style="margin-top: 10px;">
                        <ol id="sortable">
                            <?php
                            if (!empty($menus)):
                            foreach ($menus as $key => $item):
                            ?>
                                <li class="treeview remove_<?php echo $item['id'] ?>" id="<?php echo ($key + 1) . '-' . $item['id'] ?>">
                                    <strong class="col-md-9">
                                        <a style="color:#f02561" href="<?php echo base_url('admin/menu/edit/' . $item['id']); ?>"><?php echo $item['title'] ?></a>
                                    </strong>
                                    <button style="margin:7px" type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('admin/menu/edit/' . $item['id']); ?>'">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <?php if ($item['slug'] != 'trang-chu' && $item['slug'] != 'lien-he' && $item['slug'] != 'thuc-don'): ?>
                                        <button style="margin:7px" type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('admin/menu/create/' . $item['id']); ?>'">
                                            <span class="glyphicon glyphicon-plus"> </span>
                                        </button>
                                        <button style="margin:7px" data-url="<?php echo base_url('admin/menu/remove'); ?>" data-id="<?php echo $item['id']; ?>" type="button" class="btn btn-danger btn-remove-menu" onclick="remove_menu(this)">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    <?php endif ?>
                                    <button style="margin:7px" data-url="<?php echo base_url('admin/menu/active'); ?>" data-id="<?php echo $item['id']; ?>" data-active="<?php echo $item['is_activated']; ?>" type="button" class="btn <?php echo ($item['is_activated'] == 0) ? 'btn-success' : 'btn-danger'; ?> btn-active-menu" onclick="activated_menu(this)">
                                        <i class="fa <?php echo ($item['is_activated'] == 0) ? 'fa-check' : 'fa-remove'; ?>" aria-hidden="true"></i>
                                    </button>
                                </li>
                            <?php
                            endforeach;
                            endif;
                            ?>
                        </ol>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table>
                            Không tồn tại!
                        </table>
                        
                    </div>
                    
                </div>
            <?php endif ?>
        </div>
    </section>
        <?php //$nav->showCategories($menus, 0); ?>
</div>

<script>
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAME = 'http://diamondtour.vn/';
            break;
        default:
            var HOSTNAME = 'http://localhost/weddingdress/';
    }
    $( function() {
        $('#sortable').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                console.log(data);

                $.ajax({
                    data: {
                        sort: data,
                    },
                    method: 'GET',
                    url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/weddingdress/admin/menu/sort",
                });
            }
        });
    } );

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
                    id : id, csrf_sitecom_token : document.getElementById('csrf_sitecom_token').value
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
</script>


