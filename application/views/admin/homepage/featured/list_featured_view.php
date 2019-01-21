<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/lib/') ?>dataTable/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/datatable.css">

<!-- SCRIPT -->
<script src="<?php echo site_url('assets/public/lib/') ?>dataTable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets/public/lib/') ?>dataTable/js/dataTables.bootstrap.min.js"></script>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Homepage
            <small>Featured</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Homepage</a></li>
            <li class="active">Featured</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Featured</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url('admin/homepage/creatFeatured') ?>" class="btn btn-primary" role="button">Add Item</a>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image/Icon</th>
                                    <th>Heading</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="mask_lg">
                                            <img src="https://s3.amazonaws.com/influencive.com/wp-content/uploads/2016/11/08185308/Depositphotos_22928632_m-2015.jpg">
                                        </div>
                                    </td>
                                    <td>Feature 1</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/homepage/editFeatured') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>
                                    </td>
                                    <td>Feature 2</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/homepage/editFeatured') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Image/Icon</th>
                                    <th>Heading</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>

<!-- DataTables -->
<script>
    $(function () {
        $('#table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>