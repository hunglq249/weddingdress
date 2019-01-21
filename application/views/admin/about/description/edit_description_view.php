<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/lib/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            About
            <small>Description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> About</a></li>
            <li class="active">Description</li>
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
                            echo form_label('Heading', 'description_title');
                            echo form_error('description_title');
                            echo form_input('description_title', set_value('description_title'), 'class="form-control" id="description_title"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Description', 'description_content');
                            echo form_error('description_content');
                            echo form_textarea('description_content', set_value('description_content'), 'class="form-control box_content" id="description_content"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'description_image');
                            echo form_error('description_image');
                            echo form_upload('description_image', set_value('description_image'), 'id="description_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group">
                            <div class="check_available">
                                <?php
                                echo form_error('description_active');
                                echo form_checkbox('description_active', 1, false , 'id="description_active"');
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

