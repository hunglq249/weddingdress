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
            About
            <small>Team</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> About</a></li>
            <li class="active">Team</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Team</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url('admin/about/creatTeam') ?>" class="btn btn-primary" role="button">Add Item</a>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Description</th>
                                        <th>Link Account</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="mask_sm">
                                                <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                                            </div>
                                        </td>
                                        <td>Full Name</td>
                                        <td>Founder</td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="http://facebook.com" target="_blank">
                                                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://instagram.com" target="_blank">
                                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/about/editTeam') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                            <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="mask_sm">
                                                <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                                            </div>
                                        </td>
                                        <td>Full name</td>
                                        <td>Director</td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="http://facebook.com" target="_blank">
                                                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://instagram.com" target="_blank">
                                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/about/editTeam') ?>" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                            <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Description</th>
                                        <th>Link Account</th>
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