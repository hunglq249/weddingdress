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
                                <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" >Thêm mới</span>
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
                                            <a href="<?php echo base_url('admin/'.$controller.'/detail/'.$value['id']) ?>"
                                            <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">See Detail</button>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/'.$controller.'/edit/'. $value['id']) ?>" class="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                            &nbsp&nbsp&nbsp
                                            <a href="javascript:void(0);" onclick="remove('<?php echo $controller; ?>', <?php echo $value['id'] ?>)" class="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tên cấu hình</th>
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Chọn cấu hình</h4>
                    </div>
                    <div class="modal-body" id="modal-form">
                        <select name="" id="select_templates" class="form-control" required="required" onclick="submit_shared(this.value)">
                            <option value="1">Post</option>
                            <option value="2">Product</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" id="submit_shared">Xác nhận</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
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
            var HOSTNAME = 'http://localhost/weddingdress/';
    }
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
            break;
        default:
            var HOSTNAMEADMIN = 'http://localhost/weddingdress/admin';
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
    document.querySelector('.modal-footer a').setAttribute('href',HOSTNAMEADMIN+'/templates/create/'+document.getElementById('select_templates').value);
    function submit_shared(val){
        document.querySelector('.modal-footer a').setAttribute('href',HOSTNAMEADMIN+'/templates/create/'+val);
    }
</script>
