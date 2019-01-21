<!-- OVERVIEW STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/sass/') ?>admin/overview.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Works
            <small>Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Works</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Works</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>No.</th>
                                    <th>Work</th>
                                    <th>Client</th>
                                    <th>Description</th>
                                    <th>Field</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Full Name</td>
                                    <td>CEO - Apple Inc,</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    <td>Design</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Full name</td>
                                    <td>Director - Google</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    <td>Branding</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/works/works') ?>" role="button">See Detail</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">

                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>10</h3>

                        <p>All Works Upload</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#worksUpload" id="worksUploadCall">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>20</h3>

                        <p>Works Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>5</h3>

                        <p>Fields of Works</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-filter"></i>
                    </div>
                    <a href="<?php echo base_url('admin/works/field') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>