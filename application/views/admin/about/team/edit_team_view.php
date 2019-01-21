<!-- STYLE -->
<link rel="stylesheet" href="<?php echo site_url('assets/public/lib/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/public/') ?>sass/admin/forms.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            About
            <small>Team</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> About</a></li>
            <li class="active">Team</li>
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
                            echo form_label('Full Name', 'team_name');
                            echo form_error('team_name');
                            echo form_input('team_name', set_value('team_name'), 'class="form-control" id="team_name"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Position', 'team_position');
                            echo form_error('team_position');
                            echo form_input('team_position', set_value('team_position'), 'class="form-control" id="team_position"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Content', 'team_content');
                            echo form_error('team_content');
                            echo form_textarea('team_content', set_value('team_content'), 'class="form-control box_content" id="team_content"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Image Input', 'team_image');
                            echo form_error('team_image');
                            echo form_upload('team_image', set_value('team_image'), 'id="team_image"');
                            ?>
                            <p class="help-block">Click to upload.</p>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Link Facebook', 'team_acc_fb');
                            echo form_error('team_acc_fb');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook </span>';
                            echo form_input('team_acc_fb', set_value('team_acc_fb'), 'class="form-control" id="team_acc_fb"');
                            echo '</div>';
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Link Instagram', 'team_acc_ig');
                            echo form_error('team_acc_ig');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram </span>';
                            echo form_input('team_acc_ig', set_value('team_acc_ig'), 'class="form-control" id="team_acc_ig"');
                            echo '</div>';
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Link Twitter', 'team_acc_tw');
                            echo form_error('team_acc_tw');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter </span>';
                            echo form_input('team_acc_tw', set_value('team_acc_tw'), 'class="form-control" id="team_acc_tw"');
                            echo '</div>';
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Link LinkedIn', 'team_acc_li');
                            echo form_error('team_acc_li');
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon"><i class="fa fa-linkedin-square" aria-hidden="true"></i> LinkedIn </span>';
                            echo form_input('team_acc_li', set_value('team_acc_li'), 'class="form-control" id="team_acc_li"');
                            echo '</div>';
                            ?>
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

