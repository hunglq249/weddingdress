<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách
            <small>
                màu
            </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
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
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf" />
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            màu
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">  
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/'.$controller.'/create') ?>" class="btn btn-primary" role="button">Thêm mới</a>
                            </div>
                            <div class="col-md-6">
                                <form action="<?php echo base_url('admin/'.$controller.'/index') ?>" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="<?php echo $keyword ?>">
                                        <span class="input-group-btn">
                                            <input type="submit" class="btn btn-block btn-primary" value="Tìm kiếm">
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="table" class="table table_product">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tên màu tiếng Việt</th>
                                    <th>Tên màu tiếng Anh</th>
                                    <th>Màu minh họa</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($result) && $result): ?>
                                    <?php foreach ($result as $key => $value): ?>
                                        <tr class="remove_<?php echo $value['id']; ?>">
                                            <td><?php echo $key+1 ?></td>
                                            <td><?php echo $value['vi'] ?></td>
                                            <td><?php echo $value['en'] ?></td>
                                            <td ><p style="height: 30px; width: 80%;border: 1px solid gray;background:<?php echo $value['code_color'] ?>"></p></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/'.$controller.'/edit/'. $value['id']) ?>" class="dataActionEdit" title="Sửa địa điểm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                &nbsp&nbsp&nbsp
                                                <a href="javascript:void(0);" onclick="remove('<?php echo $controller; ?>', <?php echo $value['id'] ?>)" class="dataActionDelete" title="Xóa địa điểm"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <?php if (count($result) > 5): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tên màu tiếng Việt</th>
                                            <th>Tên màu tiếng Anh</th>
                                            <th>Màu minh họa</th>
                                            <th>Action</th>
                                        </tr>
                                    <?php endif ?>

                                <?php else: ?>
                                    <tr>
                                        Chưa có màu nào.
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-md-offset-5 page">
                            <?php echo (isset($page_links))? $page_links : ''; ?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo site_url('assets/js/admin/') ?>common.js"></script>
