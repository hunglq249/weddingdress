<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/lib/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            About
            <small>Testinomials</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> About</a></li>
            <li class="active">Testinomials</li>
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
                            echo form_label('Full Name', 'testinomial_name');
                            echo form_error('testinomial_name');
                            echo form_input('testinomial_name', set_value('testinomial_name'), 'class="form-control" id="testinomial_name"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Position', 'testinomial_position');
                            echo form_error('testinomial_position');
                            echo form_input('testinomial_position', set_value('testinomial_position'), 'class="form-control" id="testinomial_position"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Content', 'testinomial_content');
                            echo form_error('testinomial_content');
                            echo form_textarea('testinomial_content', set_value('testinomial_content'), 'class="form-control box_content" id="testinomial_content"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'testinomial_image');
                            echo form_error('testinomial_image');
                            echo form_upload('testinomial_image', set_value('testinomial_image'), 'id="testinomial_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
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

