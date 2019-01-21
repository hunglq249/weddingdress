<!-- OVERVIEW STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/sass/') ?>admin/overview.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Messages
            <small>Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Messages</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <?php for ( $i = 0; $i < 3; $i++){ ?>
                <div class="box box-widget collapsed-box">
                    <div class="box-header with-border">
                        <div class="user-block">
                            <!--<img class="img-circle" src="<?php echo site_url('assets/public/lib/') ?>dist/img/user1-128x128.jpg" alt="User Image">-->
                            <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                            <span class="description">Description of the Message - Title</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                                <i class="fa fa-circle-o"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- post text -->
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

                        <!-- Attachment -->
                        <div class="attachment-block clearfix">
                            <img class="attachment-img" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo1.png" alt="Attachment Image">

                            <div class="attachment-pushed">
                                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">Lorem ipsum text generator</a></h4>

                                <div class="attachment-text">
                                    Description about the attachment can be placed here.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a href="#">more</a>
                                </div>
                                <!-- /.attachment-text -->
                            </div>
                            <!-- /.attachment-pushed -->
                        </div>
                        <!-- /.attachment-block -->

                        <!-- Social sharing buttons -->
                        <!--
                        <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                        <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                        -->
                        <span class="pull-right text-muted">Sent from Website - 24 hours ago</span>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
                <?php } ?>
            </div>
            <!-- /.col -->
            <div class="col-md-4">

                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Products on Stock</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            70%/100% Stock
                        </span>
                    </div>
                </div>

                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cube"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kind of Products</span>
                        <span class="info-box-number">2</span>

                        <span class="progress-description">
                            Number of Product's Kind
                        </span>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>


