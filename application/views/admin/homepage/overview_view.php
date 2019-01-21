<!-- OVERVIEW STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/sass/') ?>admin/overview.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Homepage
            <small>Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Homepage</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Carousel</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="mask">
                                        <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        First Slide
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="mask">
                                        <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
                                    </div>
                                    <div class="carousel-caption">
                                        Second Slide
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="mask">
                                        <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
                                    </div>
                                    <div class="carousel-caption">
                                        Third Slide
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/homepage/slider') ?>" role="button">Edit</a>
                    </div>
                </div>
                <!-- /.box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Featured</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua">
                                    <i class="fa fa-envelope-o"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Featured 1</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua">
                                    <div class="mask">
                                        <img src="https://s3.amazonaws.com/influencive.com/wp-content/uploads/2016/11/08185308/Depositphotos_22928632_m-2015.jpg">
                                    </div>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Featured 2</span>
                                    <p>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</p>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/homepage/featured') ?>" role="button">Edit</a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>