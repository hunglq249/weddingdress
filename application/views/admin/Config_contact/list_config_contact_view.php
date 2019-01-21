<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách
            <small>
                Cấu hình
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
            <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Cấu hình
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
                                        <input type="text" class="form-control" placeholder="Tìm kiếm ..." name="search" value="">
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
                                    <th>Tên cấu hình</th>
                                    <th>Trạng thái</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($result) && $result): ?>
                                <?php $i = 1; ?>
                                <?php foreach ($result as $key => $value): ?>
                                    <tr class="remove_<?php echo $value['id'] ?>">
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $value['title'] ?></td>
                                        <td>
                                            <?php echo ($value['is_activated'] == 1)? '<span class="label label-success">Đang sử dụng</span>' : '<span class="label label-warning">Không sử dụng</span>' ?>   
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/'.$controller.'/detail/'.$value['id']) ?>"
                                            <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">See Detail</button>
                                        </td>
                                        <td>
                                            <?php if ($value['is_activated'] == 0): ?>
                                                <a href="javascript:void(0);" onclick="active('<?php echo $controller; ?>', <?php echo $value['id'] ?>, 'Chăc chắn Bật cấu hình')" class="dataActionDelete" title="Bật cấu hình"><i class="fa fa-low-vision" aria-hidden="true"></i> </a>
                                            <?php else: ?>
                                                <a href="javascript:void(0);" onclick="deactive('<?php echo $controller; ?>', <?php echo $value['id'] ?>, 'Chăc chắn tắt cấu hình')" class="dataActionDelete" title="Tắt cấu hình"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            <?php endif ?>

                                            <a href="<?php echo base_url('admin/'.$controller.'/edit/'. $value['id']) ?>" class="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                            &nbsp&nbsp&nbsp
                                            <a href="javascript:void(0);" onclick="remove('<?php echo $controller; ?>', <?php echo $value['id'] ?>)" class="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                            <!-- <a href="<?php echo base_url('admin/'.$controller.'/remove/'.$value['id']); ?>" class="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a> -->
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tên cấu hình</th>
                                        <th>Trạng thái</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        Chưa có Cấu hình liên hệ
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
<script type="text/javascript">
    
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAME = 'http://diamondtour.vn/';
            break;
        default:
            var HOSTNAME = 'http://localhost/soundon/';
    }
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
            break;
        default:
            var HOSTNAMEADMIN = 'http://localhost/soundon/admin';
    }
    function active(controller, id, question) {
        let [url, data] = [HOSTNAMEADMIN + '/' + controller + '/active' ,new FormData()];
        data.append('id', id);
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        if(confirm(question)){
            fetch(url,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    alert(html.message);
                    location.reload();
                }

            );
        }
    }

    function deactive(controller, id, question) {
        let [url, data] = [HOSTNAMEADMIN + '/' + controller + '/deactive' ,new FormData()];
        data.append('id', id);
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        if(confirm(question)){
            fetch(url,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    alert(html.message);
                    location.reload();
                }

            );
        }
    }
    function remove(controller, id){
        let [url, data] = [HOSTNAMEADMIN + '/' + controller + '/remove' ,new FormData()];
        data.append('id', id);
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        if(confirm('Chắc chắn xóa')){
            fetch(url,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    alert(html.message);
                    if(html.status == '200'){
                        $('.remove_' + id).fadeOut();
                        document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                    }else{
                        location.reload();
                    }
                    
                }

            );
        }
    }
</script>
