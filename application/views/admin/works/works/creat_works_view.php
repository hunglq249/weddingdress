<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Works
            <small>List of Works</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Works</a></li>
            <li class="active">Works</li>
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

                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Name', 'works_name');
                            echo form_error('works_name');
                            echo form_input('works_name', set_value('works_name'), 'class="form-control" id="works_name"');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Client', 'works_client');
                            echo form_error('works_client');
                            echo form_input('works_client', set_value('works_client'), 'class="form-control" id="works_client"');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Time', 'works_time');
                            echo form_error('works_time');
                            echo form_input('works_time', set_value('works_time'), 'class="form-control" id="works_time"');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Field', 'works_field');
                            echo form_error('works_field');
                            echo form_dropdown('works_field', $option = array('1' => 'Design', '2' => 'Branding', '3' => 'Photography'), 0, 'class="form-control" id="works_field"');
                            ?>
                        </div>
                        <div class="form-group col-md-12">
                            <?php
                            echo form_label('Image Input', 'works_image');
                            echo form_error('works_image');
                            echo form_upload('works_image', set_value('works_image'), 'id="works_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group col-md-12">
                            <?php
                            echo form_label('Description', 'works_description');
                            echo form_error('works_description');
                            echo form_textarea('works_description', set_value('works_description'), 'class="form-control box_content" id="works_description"');
                            ?>
                        </div>
                        <div class="form-group col-md-12">
                            <?php
                            echo form_label('Content', 'works_content');
                            echo form_error('works_content');
                            echo form_textarea('works_content', set_value('works_content'), 'class="form-control box_content" id="works_content"');
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="check_available">
                                <?php
                                echo form_error('works_active');
                                echo form_checkbox('works_active', 1, false , 'id="works_active"');
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

