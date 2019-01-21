<!-- OVERVIEW STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/sass/') ?>admin/overview.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            About Us
            <small>Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">About Us</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Description</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mask">
                                    <img class="img-responsive pad" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo2.png" alt="Photo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Aenean risus arcu, hendrerit ut sem a, porta suscipit elit. Donec vitae nulla eget arcu imperdiet sollicitudin. Sed dictum ut neque id sodales.</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas malesuada ipsum et enim pulvinar, vel tempor nisl iaculis. Ut vitae justo ut justo eleifend lacinia. Nunc sit amet dui iaculis, varius urna ut, congue risus. Morbi accumsan, dui a tincidunt efficitur, eros lorem cursus ligula, vel semper diam felis at ligula. Donec consectetur lorem tempus dui aliquet vulputate.</p>
                                <ol>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                </ol>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/about/description') ?>" role="button">Edit</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">

                <!-- SERVICES BOX -->
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Services</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordionService">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionService" href="#serviceOne">
                                            Service #1
                                        </a>
                                    </h4>
                                </div>
                                <div id="serviceOne" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="mask">
                                            <img class="img-responsive pad" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo2.png" alt="Photo">
                                        </div>

                                        <h3>Service #1</h3>
                                        <h4>Subtitle Service #1</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionService" href="#serviceTwo">
                                            Service #2
                                        </a>
                                    </h4>
                                </div>
                                <div id="serviceTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <i class="fa fa-3x fa-truck" aria-hidden="true"></i>

                                        <h3>Service #2</h3>
                                        <h4>Subtitle Service #2</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionService" href="#serviceThree">
                                            Service #3
                                        </a>
                                    </h4>
                                </div>
                                <div id="serviceThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <h3>Service #3</h3>
                                        <h4>Subtitle Service #3</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/about/services') ?>" role="button">Edit</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->

                <!-- TEAM BOX -->
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Team</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordionTeam">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionTeam" href="#teamOne">
                                            Founder
                                        </a>
                                    </h4>
                                </div>
                                <div id="teamOne" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="mask">
                                            <img class="img-responsive pad" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo2.png" alt="Photo">
                                        </div>

                                        <h3>Name of Founder</h3>
                                        <h4>Founder</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionTeam" href="#teamTwo">
                                            Director
                                        </a>
                                    </h4>
                                </div>
                                <div id="teamTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="mask">
                                            <img class="img-responsive pad" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo2.png" alt="Photo">
                                        </div>

                                        <h3>Name of Director</h3>
                                        <h4>Director</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordionTeam" href="#teamThree">
                                            CFO
                                        </a>
                                    </h4>
                                </div>
                                <div id="teamThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="mask">
                                            <img class="img-responsive pad" src="<?php echo site_url('assets/public/lib/') ?>dist/img/photo2.png" alt="Photo">
                                        </div>

                                        <h3>Name of CFO</h3>
                                        <h4>CFO</h4>

                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/about/team') ?>" role="button">Edit</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->

                <!-- TESTINOMIAL -->
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Testinomial</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Comment</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Name Name</td>
                                    <td>Great!</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Name Name</td>
                                    <td>Great!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/about/testinomials') ?>" role="button">Edit</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
</section>
</div>