<!-- Content Wrapper. Contains page content -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách
            <small>
                Danh Mục
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh Mục
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/'.$controller.'/create') ?>" class="btn btn-primary hidden" role="button">Thêm mới</a>
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
                            <table class="table table_product table-cate">
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                
                                <?php if($result): ?>

                                <?php build_new_category($result, 0, $controller, $check) ?>

                                <?php else: ?>
                                    <tr>
                                        Chưa có danh mục
                                    </tr>
                                <?php endif; ?>
                                <!-- <tfoot>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Cấp danh mục</th>
                                    <th>Danh mục con</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot> -->
                            </table>
                        </div>
                        <div class="col-md-6 col-md-offset-5 page">
                            <?php echo $page_links ?>
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
    $( function() {
        $('.sortable').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: {
                        sort: data,
                    },
                    method: 'GET',
                    url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/teddy/admin/post_category/sort",
                });
            }
        });
    } );

    $('.btn-dropdown-cate').click(function(){
        if($(this).attr('aria-expanded') == false){
            $( ".sortable" ).sortable({
                items: "tbody:not(.ui-state-disabled)"
            });
        }
        if($('.btn-dropdown-cate').attr('aria-expanded') == true){
            $( ".sortable" ).sortable();
        }

    })
</script>
<?php 
    function build_new_category($categorie, $parent_id = 0, $controller, $check, $sort = 1){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        // print_r($cate_child);die;
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            ?>
            <tbody class="treeview ui-sortable-handle" id="<?php echo ($key + 1) . '-' . $value['id'] ?>" <?php echo ($value['parent_id'] == 0)? 'style="cursor: pointer;"' : '' ?> >
                <tr class="remove_<?php echo $value['id'] ?>" >
                    <td>
                        <div class="mask_sm">
                            <img src="<?php echo base_url('assets/upload/'.$controller.'/'. $value['image']) ?>" alt="anh-cua-<?php echo $value['slug'] ?>" width=150px>
                        </div>
                    </td>
                    <td><?php echo $value['title'] ?></td>
                    <td><?php echo $value['parent_title'] ?></td>
                    <td>
                        <?php echo ($value['is_activated'] == 0)? '<span class="label label-success">Đang sử dụng</span>' : '<span class="label label-warning">Không sử dụng</span>' ?>   
                    </td>
                   <td>
                    <a href="<?php echo base_url('admin/'.$controller.'/detail/'.$value['id']) ?>"
                        <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">See Detail</button>
                    </td>
                    <td>
                        <div style="display: none;">
                            <?php if ($value['is_activated'] == 0): ?>
                                <a href="javascript:void(0);" onclick="deactive('post_category', <?php echo $value['id'] ?>, 'Chăc chắn tắt danh mục(Lưu ý: Khi tắt danh mục thì tất cả danh mục con, bài viết của danh mục cũng tắt theo)')" class="dataActionDelete" title="Tắt danh mục"><i class="fa fa-low-vision" aria-hidden="true"></i> </a>
                                <!-- Chăc chắn tắt danh mục(Lưu ý: Khi tắt danh mục thì tất cả danh mục con, bài viết của danh mục và các menu chọn danh mục là menu chính cũng tắt theo) -->
                            <?php else: ?>
                                <a href="javascript:void(0);" onclick="active('post_category', <?php echo $value['id'] ?>, 'Chăc chắn bật danh mục')" class="dataActionDelete" title="Bật danh mục"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                            <?php endif ?>
                        </div>
                        &nbsp&nbsp&nbsp
                        <a href="<?php echo base_url('admin/'.$controller.'/edit/'. $value['id']) ?>" class="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        &nbsp&nbsp&nbsp
                        <div style="display: none;">
                            <a href="javascript:void(0);" onclick="remove('post_category', <?php echo $value['id'] ?>)" class="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="no_border" style="padding: 0">
                        <div class="collapse" id="<?php echo $value['id'] ?>" aria-expanded="true" style="">
                            <div clas="row">
                                <div class="table-responsive col-md-11 col-md-offset-1" style="padding-right: 0">
                                    <table class="table table_product">
                                        <?php if ($check->check_sub_category($value['id'])): ?>
                                            <tr>
                                                <th>Hình ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Danh mục</th>
                                                <th>Trạng thái</th>
                                                <th>Detail</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php build_new_category($categorie, $value['id'], $controller, $check, $sort + 1); ?>
                                        <?php endif ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>  
            <?php
                
            }
        }
    }
?>


