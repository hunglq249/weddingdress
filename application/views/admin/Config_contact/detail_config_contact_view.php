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
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
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
                                    <label style="width: 100px">Status: </label>
                                    <?php if ($detail['is_activated'] == 1): ?>
                                        <a class="btn btn-success btn-xs" title="Cấu hình đang bật">Đang  sử dụng </a>
                                    <?php else: ?>
                                        <a class="btn btn-warning btn-xs" title="Cấu hình không sử dụng">Không sử dụng</a>
                                    <?php endif ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <hr style="border: 1px solid gray">
                                    <label style="margin-bottom: 20px;">View Form</label>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active" ><a href="#view_form" class="btn btn-primary" aria-controls="view_form" role="tab" data-toggle="tab">View Form</a></li>
                                        <li role="presentation" ><a href="#config_send_mail" class="btn btn-primary" aria-controls="config_send_mail" role="tab" data-toggle="tab">Cấu hình Send Mail</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="view_form">
                                            <div class="box box-default">
                                                <div class="box-body">
                                                    <ul class="nav nav-pills nav-justified" role="tablist" style="margin-bottom: 10px;">
                                                        <?php $h = 0; ?>
                                                        <?php $count = 0; ?>
                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                            <li role="presentation" class="<?php echo ($h == 0)? 'active' : '' ?>">
                                                                <a href="#s<?php echo $k.$count ?>" aria-controls="<?php echo $k.$count ?>" role="tab" data-toggle="tab">
                                                                    <span class="badge"><?php echo $h + 1 ?></span> Form <?php echo $val ?>
                                                                </a>
                                                            </li>
                                                        <?php $h++; ?>
                                                        <?php endforeach ?>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                            <div role="tabpanel" class="tab-pane fade <?php echo ($h == count($page_languages))? 'in active' : '' ?>" id="s<?php echo $k.$count ?>">
                                                                <?php
                                                                    foreach (json_decode($detail['data'],true) as $key => $value) {
                                                                        switch ($value['type']) {
                                                                            case 'textarea':
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'][$k] ? ' (<i>' .  $value['description'][$k] . '</i>)' : '') . '</br><textarea name="' . $key . '" value="" class="col-xs-12" rows="5"></textarea></div>';
                                                                                break;
                                                                            
                                                                            case 'radio':
                                                                                $radio = '';
                                                                                foreach ($value['choice'][$k] as $ks => $val) {
                                                                                   $radio .= '<input type="radio" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                                                }
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'][$k] ? ' (<i>' .  $value['description'][$k] . '</i>)' : '') . '</br>' . $radio .'</div>';
                                                                                break;
                                                                            
                                                                            case 'checkbox':
                                                                                $checkbox = '';
                                                                                foreach ($value['choice'][$k] as $ks => $val) {
                                                                                   $checkbox .= '<input type="checkbox" name="' . $key . '"/><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                                                                }
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'][$k] ? ' (<i>' .  $value['description'][$k] . '</i>)' : '') . '</br>' . $checkbox .'</div>';
                                                                                break;
                                                                            
                                                                            case 'select':
                                                                                $select = '';
                                                                                foreach ($value['choice'][$k] as $ks => $val) {
                                                                                    $select .= '<option value="' . $val . '">' . $val . '</option>';
                                                                                }
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label>' . ($value['description'][$k] ? ' (<i>' .  $value['description'][$k] . '</i>)' : '') . '<select name="" class="form-control" ' . (isset($value['select_multiple']) ? 'multiple' : '') . '>' . $select . '</select></div>';
                                                                                break;
                                                                            
                                                                            case 'date':
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="date" placeholder="' .  $value['description'][$k] . '" id="realDPX-min" type="text"></div></div>';
                                                                                break;
                                                                            
                                                                            default:
                                                                                echo '<div class="form-group col-xs-12" style="padding:0px;"><label for="">' . $value['title'][$k] . '</label><input type="' . $value['type'] .'" class="form-control" placeholder="' .  $value['description'][$k] . '" /></div>';
                                                                                break;
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                            <?php $h--; ?>
                                                        <?php endforeach ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="config_send_mail">
                                            <div class="box box-default">
                                                <div class="box-body">
                                                    <?php $body = json_decode($detail['config_send_mail'],true);?>
                                                    <div class="col-md-6 col-xs-12" style="padding:0px;">
                                                        <strong>To Email: </strong><span><?php echo $body['to_email']; ?></span>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12" style="padding:0px;">
                                                        <strong>CC Email: </strong><span><?php echo $body['cc_email']; ?></span>
                                                    </div>
                                                    <hr style="border: 1px solid gray">
                                                    <div class="col-xs-12" style="padding:0px;">
                                                        <ul class="nav nav-pills nav-justified" role="tablist" style="margin-bottom: 10px;">
                                                            <?php $h = 0; ?>
                                                            <?php $count = 0; ?>
                                                            <?php foreach ($page_languages as $k => $val): ?>
                                                                <li role="presentation" class="<?php echo ($h == 0)? 'active' : '' ?>">
                                                                    <a href="#<?php echo $k.$count ?>" aria-controls="<?php echo $k.$count ?>" role="tab" data-toggle="tab">
                                                                        <span class="badge"><?php echo $h + 1 ?></span> Body and Description (<?php echo $val ?>)
                                                                    </a>
                                                                </li>
                                                            <?php $h++; ?>
                                                            <?php endforeach ?>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <?php foreach ($page_languages as $k => $val): ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php echo ($h == count($page_languages))? 'in active' : '' ?>" id="<?php echo $k.$count ?>">
                                                                    <strong>Description Email: </strong><span><?php echo $body['description_email'][$k]; ?></span>
                                                                    <p><strong>Body mail: </strong></p>
                                                                    <p><?php echo $body['body'][$k]; ?></p>
                                                                </div>
                                                            <?php $h--; ?>
                                                            <?php endforeach ?>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
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
</script>