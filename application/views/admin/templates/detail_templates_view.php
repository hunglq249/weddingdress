<link rel="stylesheet" href="<?php echo site_url('assets/sass/admin/') ?>detail.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết
            <small>
                Cấu hình
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Chi tiết</a></li>
            <li class="active">
                Cấu hình
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf" />
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Chi tiết</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 5px;">
                                <div class="col-md-6">
                                    <label style="width: 100px">Tên cấu hình: </label>
                                    <span><?php echo $detail['title'] ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label style="width: 100px">Sử dụng cho: </label>
                                    <span><?php echo ($detail['type'] == 1)? 'Post' : 'Product';?></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <hr style="border: 1px solid gray">
                                    <label style="margin-bottom: 20px;">View Form</label>
                                    <div class="tab-content">

                                        <?php
                                            $a_language = '';
                                            $multiple_language = array('vi' => '', 'en' => '');
                                            foreach (json_decode($detail['data'],true) as $key => $value) {
                                                if($value['check_language'] == 'true'){
                                                    switch ($value['type']) {
                                                        case 'textarea':
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5"></textarea></div>';
                                                            break;
                                                        
                                                        case 'radio':
                                                            $radio = '';
                                                            foreach ($value['choice']['vi'] as $k => $val) {
                                                               $radio .= '<input type="radio" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                            }
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $radio .'</div>';
                                                            break;
                                                        
                                                        case 'checkbox':
                                                            $checkbox = '';
                                                            foreach ($value['choice']['vi'] as $k => $val) {
                                                               $checkbox .= '<input type="checkbox" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                            }
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $checkbox .'</div>';
                                                            break;
                                                        
                                                        case 'select':
                                                            $select = '';
                                                            foreach ($value['choice']['vi'] as $k => $val) {
                                                                $select .= '<option value="' . $val . '">' . $val . '</option>';
                                                            }
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<select name="" class="form-control" ' . (isset($value['check_multiple']) ? 'multiple' : '') . '>' . $select . '</select></div>';
                                                            break;
                                                        
                                                        case 'date':
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="date" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text"></div></div>';
                                                            break;
                                                        case 'file':
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<input type="' . $value['type'] .'" class="form-control" placeholder="' .  $value['description'] . '"  ' . (isset($value['check_multiple']) ? 'multiple' : '') . '/></div>';
                                                            break;
                                                        default:
                                                            $a_language .= '<div class="form-group col-xs-12"><label for="">' . $value['title']['vi'] . '</label><input type="' . $value['type'] .'" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/></div>';
                                                            break;
                                                    }
                                                }else{
                                                    foreach ($page_languages as $k => $val){
                                                        switch ($value['type']) {
                                                            case 'textarea':
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5"></textarea></div>';
                                                                break;
                                                            
                                                            case 'radio':
                                                                $radio = '';
                                                                foreach ($value['choice'] as $k => $val) {
                                                                   $radio .= '<input type="radio" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                                }
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $radio .'</div>';
                                                                break;
                                                            
                                                            case 'checkbox':
                                                                $checkbox = '';
                                                                foreach ($value['choice'] as $k => $val) {
                                                                   $checkbox .= '<input type="checkbox" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                                }
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $checkbox .'</div>';
                                                                break;
                                                            
                                                            case 'select':
                                                                $select = '';
                                                                foreach ($value['choice'] as $k => $val) {
                                                                    $select .= '<option value="' . $val . '">' . $val . '</option>';
                                                                }
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<select name="" class="form-control" ' . (isset($value['check_multiple']) ? 'multiple' : '') . '>' . $select . '</select></div>';
                                                                break;
                                                            
                                                            case 'date':
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="date" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text"></div></div>';
                                                                break;
                                                            case 'file':
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<input type="' . $value['type'] .'" class="form-control" placeholder="' .  $value['description'] . '"  ' . (isset($value['check_multiple']) ? 'multiple' : '') . '/></div>';
                                                                break;
                                                            default:
                                                                $multiple_language[$k] .= '<div class="form-group col-xs-12"><label for="">' . $value['title'][$k] . '</label><input type="' . $value['type'] .'" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/></div>';
                                                                break;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        <?php echo $a_language; ?>
                                        <div class="col-xs-12">
                                            <ul class="nav nav-pills nav-justified" role="tablist">
                                                <?php $i = 0; ?>
                                                <?php foreach ($page_languages as $k => $val): ?>
                                                    <?php $activated = ($i == 0) ? 'active' : ''; ?>
                                                    <li role="presentation" class="<?php echo $activated ?>">
                                                        <a href="#<?php echo $k ?>" aria-controls="<?php echo $k ?>" role="tab" data-toggle="tab">
                                                            <span class="badge"><?php echo ($i + 1); ?></span><?php echo $val;?>
                                                        </a>
                                                    </li>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <?php foreach ($page_languages as $k => $val): ?>
                                                <div role="tabpanel" class="tab-pane <?php echo ($i == count($page_languages))? 'active' : '' ?>" id="<?php echo $k ?>">
                                                    <?php echo $multiple_language[$k];?>
                                                </div>
                                                <?php $i--; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Chỉnh sửa 
                            Cấu hình
                         này?</h3>
                    </div>
                    <div class="box-body">
                        <a href="<?php echo base_url('admin/'.$controller.'/edit/'.$detail['id']) ?>" class="btn btn-warning" role="button">Chỉnh sửa</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>
<script src="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.js"></script>
<script type="text/javascript">
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAME = 'http://diamondtour.vn/';
            break;
        default:
            var HOSTNAME = 'http://localhost/soundon/';
    }
    if(document.querySelectorAll('[id="realDPX-min"]').length > 0){
        for (var m = 0; m < document.querySelectorAll('[id="realDPX-min"]').length; m++) {
            var $min = document.querySelectorAll('[id="realDPX-min"]')[m];
            $min.DatePickerX.init({
                mondayFirst: true,
                format: 'dd/mm/yyyy',
                minDate    : new Date(1900, 8, 13),
                maxDate    : new Date(9999, 8, 13),
            });
        }
    }
    {
        "use strict";
        tinymce.init({
            selector: ".tinymce-area",
            theme: "modern",
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
            height: 300,
            relative_urls: false,
            remove_script_host: false,
            // forced_root_block : false,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
            ],
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
            external_filemanager_path: HOSTNAME + "filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": HOSTNAME + "filemanager/plugin.min.js"}
        });
    }
</script>