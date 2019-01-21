<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/lib/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            About
            <small>Services</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> About</a></li>
            <li class="active">Services</li>
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
                            echo form_label('Heading', 'services_title');
                            echo form_error('services_title');
                            echo form_input('services_title', set_value('services_title'), 'class="form-control" id="services_title"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Sub Heading', 'services_subtitle');
                            echo form_error('services_subtitle');
                            echo form_input('services_subtitle', set_value('services_subtitle'), 'class="form-control" id="services_subtitle"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Content', 'services_content');
                            echo form_error('services_content');
                            echo form_textarea('services_content', set_value('services_content'), 'class="form-control box_content" id="services_content"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'services_image');
                            echo form_error('services_image');
                            echo form_upload('services_image', set_value('services_image'), 'id="services_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Icon Size', 'services_icon_size');
                            echo form_error('services_icon_size');
                            //echo form_input('services_icon_size', set_value('services_icon_size'), 'class="form-control" id="services_icon_size"');
                            echo form_dropdown('services_icon_size', $option = array('1x' => 'normal', 'lg' => 'fa-lg (33% larger)', '2x' => 'fa-2x', '3x' => 'fa-3x', '4x' => 'fa-4x', '5x' => 'fa-5x'), 1 ,'class="form-control"')
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Icon', 'services_icon');
                            echo form_error('services_icon');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon">fa-</span>';
                            echo form_input('services_icon', set_value('services_icon'), 'class="form-control" id="services_icon"');
                            echo '</div>';
                            ?>
                            <p class="help-block">Write name of icon class you want to use. List of icon <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">here</a></p>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="check_available">
                                <?php
                                echo form_error('services_active');
                                echo form_checkbox('services_active', 1, false , 'id="services_active"');
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

<!-- TINYMCE JS-->
<script type="text/javascript" src="<?php echo site_url('tinymce/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: ".box_content",
        theme: "modern",
        height: 200,
        relative_urls: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: "Bold text", inline: "b"},
            {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
            {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
            {title: "Example 1", inline: "span", classes: "example1"},
            {title: "Example 2", inline: "span", classes: "example2"},
            {title: "Table styles"},
            {title: "Table row 1", selector: "tr", classes: "tablerow1"}
        ],
        external_filemanager_path: "<?php echo site_url('filemanager/'); ?>",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": "<?php echo site_url('filemanager/plugin.min.js'); ?>"}
    });
</script>

