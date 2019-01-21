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
            <small>Slider</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Homepage</a></li>
            <li class="active">Slider</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url('admin/homepage/creatSlider') ?>" class="btn btn-primary" role="button">Add Item</a>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="mask_lg">
                                            <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                                        </div>
                                    </td>
                                    <td> Slide no.1 Title</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/homepage/editSlider') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="mask_lg">
                                            <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
                                        </div>
                                    </td>
                                    <td> Slide no.2 Title</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/homepage/editSlider') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="mask_lg">
                                            <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
                                        </div>
                                    </td>
                                    <td> Slide no.3 Title</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/homepage/editSlider') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
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