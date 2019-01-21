<link rel="stylesheet" href="<?php echo site_url('assets/sass/admin/') ?>detailpostnandproduct.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="height: 50px;">
        <div class="col-xs-6"> 
            
            <h3>
                Chi tiết
                <small>
                    Danh Mục
                </small>
            </h3>
        </div>
        <div class="col-xs-6" style="padding-right: 0px;">
            <div style="margin-top: 10px;float: right;">
                <a style="" href="<?php echo base_url('admin/'.$controller.'/edit/'.$detail['id']) ?>" class="btn btn-warning" role="button">Chỉnh sửa</a>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('message_success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('message_success'); ?>
            </div>
        <?php endif ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Chi tiết</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="detail-info col-xs-12">
                                <div class="table-responsive">
                                    <label>Thông tin</label>
                                    <table class="table table-striped">
                                        <tr>
                                            <th colspan="2">Thông tin cơ bản</th>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td><?php echo $detail['slug'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Kiểu danh mục
                                            </th>
                                            <td>
                                                <?php echo $detail['type'] == 0 ? 'Váy' : 'Phụ kiện' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Trạng Thái</th>
                                            <td>
                                                <?php if ($detail['is_activated'] == 0): ?>
                                                    <span class="label label-success" onclick="deactive('product_category', <?php echo $detail['id'] ?>, 'Chăc chắn tắt danh mục(Lưu ý: Khi tắt danh mục thì tất cả danh mục con và sản phẩm của danh mục cũng tắt theo)')" class="dataActionDelete" title="Tắt danh mục" style="cursor: pointer;">Đang sử dụng</span>
                                                <?php else: ?>
                                                    <span class="label label-warning" onclick="active('product_category', <?php echo $detail['id'] ?>, 'Chăc chắn bật danh mục')" class="dataActionDelete" title="Bật danh mục" style="cursor: pointer;">Không sử dụng</span>
                                                <?php endif ?>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">

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
                                    <?php foreach ($template as $key => $value): ?>
                                        <div role="tabpanel" class="tab-pane fade<?php echo ($i == 0)? ' in active' : '' ?>" id="<?php echo $key ?>">
                                            <?php foreach ($value as $k => $val): ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <?php if ($k == 'title' && in_array($k, $request_language_template)): ?>
                                                                <tr>
                                                                    <th style="width: 140px">Tiêu đề: </th>
                                                                    <td><?php echo $detail['title_'. $key] ?></td>
                                                                </tr>
                                                            <?php elseif($k == 'metakeywords' && in_array($k, $request_language_template)): ?>
                                                                <tr>
                                                                    <th style="width: 140px">Từ khóa meta: </th>
                                                                    <td><?php echo $detail['metakeywords_'. $key] ?></td>
                                                                </tr>
                                                            <?php elseif($k == 'metadescription' && in_array($k, $request_language_template)): ?>
                                                                <tr>
                                                                    <th style="width: 140px">Mô tả meta: </th>
                                                                    <td><?php echo $detail['metadescription_'. $key] ?></td>
                                                                </tr>
                                                            <?php elseif($k == 'description' && in_array($k, $request_language_template)): ?>
                                                                <tr>
                                                                    <th style="width: 140px">Giới thiệu: </th>
                                                                    <td><?php echo $detail['description_'. $key] ?></td>
                                                                </tr>
                                                            <?php elseif($k == 'content' && in_array($k, $request_language_template)): ?>
                                                                <tr>
                                                                    <th style="width: 140px">Nội dung: </th>
                                                                    <td><?php echo $detail['content_'. $key] ?></td>
                                                                </tr>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                                    <div role="tabpanel" class="tab-pane" id="en">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 100px">Title: </th>
                                                        <td><?php echo $detail['title_en'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 100px">Description: </th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 100px">Content: </th>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Hình ảnh</h3>
                        <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/' .$detail['image']) ?>" alt="anh-cua-<?php echo $detail['slug'] ?>" width="100%" > 
                    </div>
                </div>
            </div>
        </div>
        <div id="encypted_ppbtn_all"></div>
        <div id="myModal" class="modal" style="overflow-y: auto;">
            <img class="modal-content" id="img01">
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>
<script src="<?php echo site_url('assets/js/admin/') ?>showmodalimg.js"></script>