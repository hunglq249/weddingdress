<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

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
                        <h3 class="box-title">Add item</h3>
                    </div>
                    <!-- /.box-header -->
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>
                    <div class="box-body">
                        <!-- form start -->

                        <div class="form-group">
                            <?php
                            echo form_label('Heading', 'featured_title');
                            echo form_error('featured_title');
                            echo form_input('featured_title', set_value('featured_title'), 'class="form-control" id="featured_title"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Content', 'featured_content');
                            echo form_error('featured_content');
                            echo form_textarea('featured_content', set_value('featured_content'), 'class="form-control" id="featured_content"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'featured_image');
                            echo form_error('featured_image');
                            echo form_upload('featured_image', set_value('featured_image'), 'id="featured_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Icon Size', 'featured_icon_size');
                            echo form_error('featured_icon_size');
                            //echo form_input('featured_icon_size', set_value('featured_icon_size'), 'class="form-control" id="featured_icon_size"');
                            echo form_dropdown('featured_icon_size', $option = array('1x' => 'normal', 'lg' => 'fa-lg (33% larger)', '2x' => 'fa-2x', '3x' => 'fa-3x', '4x' => 'fa-4x', '5x' => 'fa-5x'), 1 ,'class="form-control"')
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Icon', 'featured_icon');
                            echo form_error('featured_icon');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon">fa-</span>';
                            echo form_input('featured_icon', set_value('featured_icon'), 'class="form-control" id="featured_icon"');
                            echo '</div>';
                            ?>
                            <p class="help-block">Write name of icon class you want to use. List of icon <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">here</a></p>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="check_available">
                                <?php
                                echo form_error('featured_active');
                                echo form_checkbox('featured_active', 1, false , 'id="featured_active"');
                                ?>
                                <span>Available?</span>
                                <p>Check the box if you want to show above information immediately. Uncheck to set it to pending mode.</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?php form_close() ?>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>


