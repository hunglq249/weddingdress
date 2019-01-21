<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Works
            <small>Field of Works</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Works</a></li>
            <li class="active">Field of Works</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit item</h3>
                    </div>
                    <!-- /.box-header -->
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>
                    <div class="box-body">
                        <!-- form start -->

                        <div class="form-group">
                            <?php
                            echo form_label('Field', 'field_name');
                            echo form_error('field_name');
                            echo form_input('field_name', set_value('field_name'), 'class="form-control" id="field_name"');
                            ?>
                        </div>
                        <div class="form-group">
                            <div class="check_available">
                                <?php
                                echo form_error('field_active');
                                echo form_checkbox('field_active', 1, false , 'id="field_active"');
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

