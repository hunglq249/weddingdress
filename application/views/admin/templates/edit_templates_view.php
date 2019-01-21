<style type="text/css" media="screen">
    .drop-drag div.btn >span:before {
        font-family: "Glyphicons Halflings";
        content: "\e114";
        float: left;
        margin-top: -1px;
        font-size: 1.3em;transition: .3s;
      }
      /* Icon when the collapsible content is hidden */
      .drop-drag div.btn >span.collapsed:before {
        content: "\e080";
        font-size: 1.3em;
        margin-top: -1px;transition: .3s;
      }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa
            <small>
                cấu hình
                <?php echo $number_field; ?>
            </small>
        </h1>
    </section>
    <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
    <input type="text" name="page_languages" value='<?php echo json_encode($page_languages); ?>' placeholder="" class="form-control hidden" id="page_languages">
    <input type="text" name="detail_templates" value='<?php echo json_encode(json_decode($detail['data'],true)); ?>' placeholder="" class="form-control hidden" id="detail_templates">
    <input type="text" name="" value='<?php echo $number_field; ?>' placeholder="" class="form-control hidden" id="number_field_type">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <?php
                        echo form_open_multipart('', array('class' => 'form-horizontal','onsubmit' => 'return false'));
                        ?>

                        <ul class="nav nav-tabs" role="tablist"></ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="config_contact">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <h4 class="box-title">Thông tin cơ bản</h4>
                                        </div>
                                        <div class="row">
                                            <span><?php echo $this->session->flashdata('message'); ?></span>
                                        </div>
                                        <div class="col-xs-12" style="padding-bottom: 10px;">
                                            <div class="col-xs-12 required" id="parent_configuration" style="padding: 0px;">
                                                <?php 
                                                    echo form_label('Chọn loại cấu hình', 'type_configuration'); 
                                                    echo form_error('type_configuration');
                                                ?>
                                                <select name="type_configuration"  class="form-control type_configuration" disabled>
                                                    <option value="1" <?php echo ($detail['type'] == 1) ? 'selected' : ''; ?>>Post</option>
                                                    <option value="2" <?php echo ($detail['type'] == 2) ? 'selected' : ''; ?>>Product</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 required" id="parent_configuration" style="padding: 0px;">
                                                <?php 
                                                    echo form_label('Tên cấu hình', 'name_configuration'); 
                                                    echo form_error('name_configuration');
                                                    echo form_input('name_configuration', $detail['title'], ' class="form-control" id="name_configuration" ');
                                                ?>
                                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                                            </div>

                                            <div class="input-group col-sm-5 col-xs-12" style="float: right;">
                                                <?php 
                                                    echo form_label('Số field', 'number_field');
                                                    echo form_error('number_field');
                                                    echo form_input('number_field', count(json_decode($detail['data'],true)), 'class="form-control" id="number_field" readonly ');
                                                ?>
                                                <span class="input-group-btn">
                                                    <a class="btn btn-primary" onclick="addField(document.getElementById('number_field').value)" style="cursor:pointer; margin-top: 25px;display: none;">Xác nhận</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="append_field">
                                            <?php 
                                                $i = 1; 
                                                $type = array('radio', 'select', 'checkbox');
                                                $checbox_file = array(
                                                    'textarea' => 'Nhúng trình soạn thảo tinymce', 
                                                    'select' => 'Được phép chọn nhiều', 
                                                    'file' => 'Chọn nhiều ảnh'
                                                );
                                            ?>
                                            <?php foreach (json_decode($detail['data'],true) as $key => $value): ?>
                                                <div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_<?php echo $i;?>"  draggable="<?php echo ($i <= 9)? 'false' : 'true'; ?>" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                                                    <div class="col-xs-12 drop-drag" draggable="<?php echo ($i <= 9)? 'false' : 'true'; ?>" ondragstart="drag(event)">
                                                        <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align: left;">
                                                            <span data-toggle="collapse" data-target="#demo<?php echo $i;?>" class="col-xs-10 check-collapse collapsed" style="height:35px;padding-top:2px" aria-expanded="false">
                                                                <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;"><?php echo $i;?></span> <b style="font-size: 1.18em;font-weight: 500;">. <?php echo $value['title']['vi']; ?> </b>
                                                            </span>
                                                            <i style="float: right;padding-right:5px;font-size:1.8em;<?php echo ($i <= 9) ? 'display: none;' : '';?>" class="fa fa-close remove" onclick="remove_field(<?php echo $i;?>)"></i>
                                                        </div>
                                                        <div id="demo<?php echo $i;?>" class="collapse form-group" aria-expanded="false">
                                                            <div class="col-xs-12" style="padding: 0px;">
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <label class="control-label" for="inputError">Mô tả</label>
                                                                    <input type="text" name="description[]" value="" placeholder="" onfocus="onfocus_text(this)" value="<?php echo $value['description'] ?>" onblur="listener(this)" class="form-control description">
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12" id="list<?php echo $i;?>">
                                                                    <label for="" style="margin-bottom: 0px; margin-top: 7px;">Kiểu Nhập</label>
                                                                    <select name="type[]"  class="form-control select_type" disabled onchange="select(this,'<?php echo $i; ?>')" id="type">
                                                                        <option value="text" <?php echo ($value['type'] == 'text') ? 'selected="selected"' : '';?>>Text</option>
                                                                        <option value="textarea" <?php echo ($value['type'] == 'textarea') ? 'selected="selected"' : '';?>>Textarea</option>
                                                                        <option value="radio" <?php echo ($value['type'] == 'radio') ? 'selected="selected"' : '';?>>Radio</option>
                                                                        <option value="checkbox" <?php echo ($value['type'] == 'checkbox') ? 'selected="selected"' : '';?>>Checkbox</option>
                                                                        <option value="password" <?php echo ($value['type'] == 'password') ? 'selected="selected"' : '';?>>Password</option>
                                                                        <option value="select" <?php echo ($value['type'] == 'select') ? 'selected="selected"' : '';?>>Select</option>
                                                                        <option value="date" <?php echo ($value['type'] == 'date') ? 'selected="selected"' : '';?>>Date</option>
                                                                        <option value="file" <?php echo ($value['type'] == 'file')? 'selected' : '' ?>>Image</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12" style="padding: 0px;">
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="" disabled value="" class="check_language" <?php echo ($value['check_language'] == 'true') ? 'checked' : ''; ?> onclick="check_multiple(this)" <?php echo ($i <= 9 || in_array($value['type'],$type) || $value['type'] == 'file')? 'disabled' : ''; ?>>Chỉ cho phép nhập hoặc chọn một ngôn ngữ
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12 checkbox_field">
                                                                    <?php if (array_key_exists($value['type'], $checbox_file)): ?>
                                                                        <div class="check_multiple" style="padding:0px;">
                                                                            <label class="checkbox-inline"><input type="checkbox" name="multiple_image" disabled <?php echo (isset($value['check_multiple'])) ? 'checked' : '' ?> ><?php echo $checbox_file[$value['type']]; ?></label>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="" class="required_check" onclick="check_required(this)"/ <?php echo (isset($value['required']))? 'checked' : ''; ?> <?php echo (in_array($i,array(2,3,4,7,9)))? 'disabled' : ''; ?>><span>Bắt buộc chọn hoặc nhập thông tin</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <?php if (isset($value['required'])): ?>
                                                                <div class="col-xs-12 content-required" style="margin-top: 5px;"> 
                                                                    <label for="">Nội dung hiện lên khi Không chọn hoặc nhập thông tin</label>
                                                                    <input type="text" name="required_content[]" value="<?php echo (isset($value['required']))? $value['required'] : ''; ?>" placeholder="" onblur="listener(this)" class="form-control required">
                                                               </div>
                                                            <?php endif ?>
                                                            <div class="col-xs-12" id="data<?php echo $i;?>">
                                                                <div class="col-ms-12" style="margin-top:10px;padding-top:5px;border-top:2px solid green;">
                                                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                                                        <?php $h = 0; ?>
                                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                                            <li role="presentation" class="<?php echo ($h == 0)? 'active' : '' ?>">
                                                                                <a href="#<?php echo $k.$i ?>" aria-controls="<?php echo $k.$i ?>" role="tab" data-toggle="tab">
                                                                                    <span class="badge"><?php echo $h + 1 ?></span> <?php echo $val ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php $h++; ?>
                                                                        <?php endforeach ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php echo ($h == count($page_languages))? 'in active' : '' ?>" id="<?php echo $k.$i ?>">
                                                                                <div class="box box-default" style="border-top:none;">
                                                                                    <div class="box-body" style="padding:0px;">
                                                                                        <div class="col-xs-12 required" style="padding: 0px;">
                                                                                            <label class="control-label" for="">Tiêu đề</label>
                                                                                            <input type="text" name="title_<?php echo $k;?>[]" placeholder="" value="<?php echo $value['title'][$k]; ?>"  onfocus="onfocus_text(this)" onblur="listener(this)" <?php echo ($i <= 9) ? 'readonly' : '';?> class="form-control title" >
                                                                                            <span class="help-block hidden">Bạn cần nhập trường này</span>
                                                                                        </div>
                                                                                        <div class="col-xs-12 show_textarea" style="padding:0px;">
                                                                                            <?php if (in_array($value['type'],$type)): ?>
                                                                                                <div class="importValue">
                                                                                                    <label for="">Nhập danh sách lựa chọn cho kiểu <?php echo $value['type']?> các lựa chọn cách nhau bởi ba dấu ;;; </label>
                                                                                                    <div class="col-xs-12" style="padding:0px;">
                                                                                                        <textarea type="text" name="number_list_<?php echo $k; ?>[]" class="col-xs-12"  onfocus="onfocus_text(this)" onblur="listener(this)" placeholder="" <?php echo ($key == 'parent_id_shared' || $key == 'trademark' || $key == 'features') ? 'readonly' : '' ;?> id="number_list_<?php echo $k.$i; ?>" rows="5"><?php echo implode(';;;',$value['choice'][$k]);?></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php endif ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php $h--; ?>
                                                                        <?php endforeach;?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i++; ?>
                                            <?php endforeach ?>

                                        </div>
                                        <div class="col-xs-12">
                                            <i class="fa-2x fa fa-plus-square" id="addpend-one-field" onclick="addOneField()" style="float: right;cursor: pointer;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default" >
                            <div class="box-body">
                                <div class="col-xs-12 nav-product" >
                                    <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                        <li><button class="btn btn-primary" id="go-back" onclick="history.back(-1);" >Go back</button></li>
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"  onclick="check_validate(this)" style="float: right;">Xem Form</span>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-xs-12">
                            <span type="button" data-toggle="modal" data-target="#myModals" class="btn btn-primary" onclick="view_form(this)">Xem Form</span>
                        </div> -->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Form</h4>
                  </div>
                  <div class="modal-body" id="modal-form" style="padding: 0px;">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="submit_shared" data-dismiss="modal" onclick="submit_shared()">Xác nhận</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </section>
</div>
<script src="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.js"></script>
<script src="<?php echo site_url('assets/js/admin/') ?>templates.js"></script>

<!-- DatePickerX Plugin -->

