<link rel="stylesheet" href="<?php echo site_url('assets/sass/admin/') ?>detailpostnandproduct.css">
<input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="height: 50px;">
        <div class="col-xs-6"> 
            
            <h3>
                Chi tiết
                <small>
                    bài viết
                </small>
            </h3>
        </div>
        <div class="col-xs-6" style="padding-right: 0px;">
            <div style="margin-top: 10px;float: right;">
                <a style="" href="<?php echo base_url('admin/'.$controller.'/edit/'.$detail['id']) ?>" class="btn btn-warning" role="button">Chỉnh sửa</a>
            </div>
        </div>
    </section>

<?php

// echo '<pre>';
// print_r($templates);
// echo '</pre>';
// echo '<pre>';
// print_r($detail);
// echo '</pre>';
?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Chi tiết</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="margin-left: 20px;">
                        <div class="row">
                            <?php 
                                $data = json_decode($detail['data'],true);
                                foreach ($page_languages as $k => $vals){
                                    $detail['data_lang_'.$k] = json_decode($detail['data_lang_'.$k],true); 
                                }
                            ?>
                            <div class="row" style="margin-right: 0px;">
                                <div class="detail-info col-md-12">
                                    <div class="table-responsive">
                                        <h4><label>Thông tin</label></h4>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Trạng thái</th>
                                                <td>
                                                    <?php if ($detail['is_activated'] == 0): ?>
                                                        <span class="label label-success" onclick="deactive('post', <?php echo $detail['id'] ?>, 'Chăc chắn tắt bài viết')" class="dataActionDelete" title="Tắt danh mục" style="cursor: pointer;">Đang sử dụng</span>
                                                    <?php else: ?>
                                                        <span class="label label-warning" onclick="active('post', <?php echo $detail['id'] ?>, 'Chăc chắn bật bài viết')" class="dataActionDelete" title="Bật danh mục" style="cursor: pointer;">Không sử dụng</span>
                                                    <?php endif ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Slug</th>
                                                <td><?php echo $detail['slug'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Danh Mục</th>
                                                <td><?php echo $detail['parent_title'] ?></td>
                                            </tr>
                                            <?php if (!empty($data)): ?>
                                                <?php foreach ($data as $key => $value): ?>
                                                    <?php if ($templates[$key]['type'] != 'radio' && $templates[$key]['type'] != 'checkbox' && $templates[$key]['type'] != 'select' && $templates[$key]['type'] != 'file'): ?>
                                                        <tr>
                                                            <th><?php echo $templates[$key]['title']['vi']?></th>
                                                            <td><?php echo $value?></td>
                                                        </tr>
                                                        <?php unset($data[$key]); ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left: 0px;margin-top: 10px;">

                                <!-- Nav tabs -->
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

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php $i = 0; ?>
                                    <?php foreach ($page_languages as $key => $value): ?>
                                        <div role="tabpanel" class="tab-pane <?php echo ($i == 0)? 'active' : '' ?>" id="<?php echo $key ?>">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width: 100px"><?php echo $templates_all['title']['title'][$key];?>: </th>
                                                            <td><?php echo $detail['title_'. $key] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 100px"><?php echo $templates_all['description']['title'][$key];?>: </th>
                                                            <td><?php echo $detail['description_'. $key] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 100px"><?php echo $templates_all['content']['title'][$key];?>: </th>
                                                            <td><?php echo $detail['content_'. $key] ?></td>
                                                        </tr>
                                                        <?php if (!empty($data)): ?>
                                                            <?php foreach ($data as $k => $val): ?>
                                                                <?php if ($templates[$k]['type'] != 'file' && !isset($templates[$k]['check_multiple']) && $templates[$k]['type'] != 'checkbox'): ?>
                                                                    <tr>
                                                                        <th style="width: 100px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                        <td><?php echo $templates[$k]['choice'][$key][$val] ?></td>
                                                                    </tr>
                                                                <?php endif ?>
                                                                <?php if (($templates[$k]['type'] != 'file' && isset($templates[$k]['check_multiple'])) || $templates[$k]['type'] == 'checkbox'): ?>
                                                                    <tr>
                                                                        <th style="width: 100px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                        <td>
                                                                            <?php 
                                                                                echo implode(', ',array_intersect_key($templates[$k]['choice'][$key], array_flip($val)));
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                        <?php if (!empty($detail['data_lang_'.$key])): ?>
                                                            <?php foreach ($detail['data_lang_'.$key] as $k => $val): ?>
                                                                <tr>
                                                                    <th style="width: 100px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                    <td><?php echo $val; ?></td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tất cả hình ảnh</h3>
                    </div>
                    <div class="box-body" style="">
                        <label>Hình ảnh</label>
                        <div class="row">
                            <div class="item col-md-12">
                                    <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $detail['image'] ) ?>" alt="Image Detail" width=100%>
                            </div>
                        </div>
                        <div class="detail-image col-xs-12">
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $key => $value): ?>
                                    <?php  if ($templates[$key]['type'] == 'file'): ?>
                                        <div class="row">
                                            <label><?php echo $templates[$key]['title']['vi']?></label>
                                            <div class="item">     
                                                <?php if (isset($templates[$key]['check_multiple'])): ?>
                                                    <?php foreach ($value as $k => $val): ?>
                                                        <div class="col-xs-12 row_<?php echo $k;?>" style="position: relative;padding:0px;margin-bottom: 10px;">
                                                            <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $val ) ?>" alt="Image Detail" width="100%" height="150px">
                                                            <i class="fa-2x fa fa-times" style="cursor: pointer; position: absolute;color:red; top:0px;right: 5px;" onclick="remove_image('<?php echo $controller;?>','<?php echo $detail['id']; ?>','<?php echo $val; ?>','<?php echo $k ?>','<?php echo $key ?>')"></i>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <div class="col-xs-12" style="padding: 0px;margin-bottom: 10px;">
                                                        <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $value ) ?>" alt="Image Detail" width="100%" height="150px">
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal">
                <img class="modal-content" id="img01">
            </div>
        </div>

        <div>
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Chỉnh sửa Bài Viết này?</h3>
                </div>
                <div class="box-body">
                    <a href="<?php echo base_url('admin/'.$controller.'/edit/'.$detail['id']) ?>" class="btn btn-warning" role="button">Chỉnh sửa</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>
<script src="<?php echo site_url('assets/js/admin/') ?>showmodalimg.js"></script>
<script type="text/javascript">
switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
        break;
    default:
        var HOSTNAMEADMIN = 'http://localhost/weddingdress/admin';
}
function remove_image(controller, id, image, k, key){
    if(confirm('Chắc chắn xóa ảnh này?')){
        let data = new FormData(document.querySelector('form.form-horizontal'));
        data.append('id', id);
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        data.append('image', image);
        data.append('key', key);
        var url = HOSTNAMEADMIN + '/' + controller + '/remove_image_multiple';
        fetch(url,{method: "POST",body: data}
        ).then(
            response => response.json()
        ).then(
            html => {
                if(html.status == "200"){
                    alert(html.message);
                    $('.row_' + k).fadeOut();
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                    
                }else{
                    alert(html.message);
                    location.reload();
                }
            }

        );
    }
}
</script>