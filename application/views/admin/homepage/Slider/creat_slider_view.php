<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

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
                        <h3 class="box-title">Add item</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <?php
                        echo form_open_multipart('', array('class' => 'form-horizontal'));
                        ?>
                        <div class="form-group">
                            <?php
                            echo form_label('Title', 'slider_title');
                            echo form_error('slider_title');
                            echo form_input('slider_title', set_value('slider_title'), 'class="form-control" id="slider_title"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'slider_image');
                            echo form_error('slider_image');
                            echo form_upload('slider_image', set_value('slider_image'), 'id="slider_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group">
                            <div class="check_available">
                                <?php
                                echo form_error('slider_active');
                                echo form_checkbox('slider_active', 1, false , 'id="slider_active"');
                                ?>
                                <span>Active?</span>
                                <p>Check the box if you want to show above information immediately. Uncheck to set it to pending mode.</p>
                            </div>
                        </div>
                        <?php form_close() ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Upload!</button>
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

