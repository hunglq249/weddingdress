<style type="text/css" media="screen">
    @media only screen and (max-width: 768px) {
        .check_multiple{
            margin-top: 0px;
        }
    }
    @media only screen and (min-width: 768px) {
        .check_multiple{
            margin-top: 25px;
        }
    }
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
            </small>
        </h1>
    </section>
    <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
    <input type="text" name="page_languages" value='<?php echo json_encode($page_languages); ?>' placeholder="" class="form-control hidden" id="page_languages">
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
                                                    echo form_input('number_field[]', count(json_decode($detail['data'],true)), 'class="form-control" id="number_field" readonly');
                                                ?>
                                                <span class="input-group-btn hidden">
                                                    <a class="btn btn-primary" onclick="addField(document.getElementById('number_field').value)" style="cursor:pointer; margin-top: 25px;">Xác nhận</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="append_field">
                                            <?php 
                                                $count = 1; 
                                                $type = array('radio', 'select', 'checkbox');
                                            ?>
                                            <?php foreach (json_decode($detail['data'],true) as $key => $value): ?>
                                                <div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_<?php echo $count; ?>"  draggable="true" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                                                    <div class="col-xs-12 drop-drag" draggable="true" ondragstart="drag(event)">
                                                        <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align:left">
                                                            <span data-toggle="collapse" data-target="#demo<?php echo $count; ?>" class="col-xs-10 check-collapse" style="height:35px;padding-top:2px">
                                                                <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;"><?php echo $count; ?></span>
                                                                <b style="font-size: 1.18em;font-weight: 500;">. <?php echo $value['title']['vi']; ?></b>
                                                            </span>
                                                            <i style="float: right;padding-right:5px;marrgin-top:-10px;" class="fa-2x fa fa-close remove" onclick="remove_field(<?php echo $count; ?>)"></i>
                                                        </div>
                                                        <div id="demo<?php echo $count; ?>" class="collapse in form-group">
                                                            <div class="col-xs-12" style="padding:0px;">
                                                                <div class="col-xs-6" id="list<?php echo $count; ?>">
                                                                    <label for="">Kiểu Nhập</label>
                                                                    <select name="type[]"  class="form-control" onchange="select(this,'<?php echo $count; ?>')" id="type">
                                                                        <option value="text" <?php echo ($value['type'] == 'text') ? 'selected="selected"' : '';?>>Text</option>
                                                                        <option value="textarea" <?php echo ($value['type'] == 'textarea') ? 'selected="selected"' : '';?>>Textarea</option>
                                                                        <option value="radio" <?php echo ($value['type'] == 'radio') ? 'selected="selected"' : '';?>>Radio</option>
                                                                        <option value="checkbox" <?php echo ($value['type'] == 'checkbox') ? 'selected="selected"' : '';?>>Checkbox</option>
                                                                        <option value="password" <?php echo ($value['type'] == 'password') ? 'selected="selected"' : '';?>>Password</option>
                                                                        <option value="select" <?php echo ($value['type'] == 'select') ? 'selected="selected"' : '';?>>Select</option>
                                                                        <option value="date" <?php echo ($value['type'] == 'date') ? 'selected="selected"' : '';?>>Date</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12 checkbox_field">
                                                                    <?php if($value['type'] == 'select'): ?>
                                                                        <div class="col-ms-12 check_multiple">
                                                                            <div class="col-ms-12">
                                                                                <label class="checkbox-inline"><input type="checkbox" <?php echo isset($value['check_multiple'])? 'checked' : ''; ?> onclick="check_multiple(this)">Được phép chọn nhiều</label>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="col-xs-12">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="" <?php echo isset($value['required']) ? 'checked' : '';?> class="required_check" onclick="check_required(this)"/><span>Bắt buộc chọn hoặc nhập thông tin</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12" id="data<?php echo $count; ?>">
                                                                <div class="col-ms-12" style="margin-top:10px;padding-top:5px;border-top:2px solid green;">
                                                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                                                        <?php $h = 0; ?>
                                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                                            <li role="presentation" class="<?php echo ($h == 0)? 'active' : '' ?>">
                                                                                <a href="#<?php echo $k.$count ?>" aria-controls="<?php echo $k.$count ?>" role="tab" data-toggle="tab">
                                                                                    <span class="badge"><?php echo $h + 1 ?></span> <?php echo $val ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php $h++; ?>
                                                                        <?php endforeach ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php foreach ($page_languages as $k => $val): ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php echo ($h == count($page_languages))? 'in active' : '' ?>" id="<?php echo $k.$count ?>">
                                                                                <div class="form-group col-xs-12 required" style="margin-bottom:0px;">
                                                                                    <label class="control-label" for="">Tiêu đề</label>
                                                                                    <input type="text" name="title_<?php echo $k;?>[]" value="<?php echo $value['title'][$k];?>" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title">
                                                                                    <span class="help-block hidden">Bạn cần nhập trường này</span>
                                                                                </div> 
                                                                                <div class="form-group col-xs-12" style="margin-bottom:0px;">
                                                                                    <label class="control-label" for="inputError">Mô tả</label>
                                                                                    <input type="text" name="description_<?php echo $k;?>[]" value="<?php echo $value['description'][$k];?>" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                                                                                </div>
                                                                                <div class="col-xs-12 required_field" style="padding: 0px;">
                                                                                    <?php if (isset($value['required'])): ?>
                                                                                        <div class="col-xs-12 content-required" style="padding-left:0px;padding-right:30px;"> 
                                                                                            <label for="">Nội dung hiện lên khi không chọn hoặc nhập thông tin</label>
                                                                                            <input type="text" name="required_content_<?php echo $k;?>[]" value="<?php echo $value['required'][$k];?>" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control required">
                                                                                       </div>
                                                                                    <?php endif ?>
                                                                                </div>
                                                                                <div class="col-xs-12 show_textarea" style="padding:0px;">
                                                                                    <?php if(in_array($value['type'],$type)): ?>
                                                                                        <div class="importValue">
                                                                                            <label for="">Nhập danh sách lựa chọn cho kiểu <?php echo $value['type'];?> các lựa chọn cách nhau bởi ba dấu ;;; </label>
                                                                                            <div class="col-xs-12" style="padding:0px;">
                                                                                                <textarea type="text" name="number_list_<?php echo $k;?>[]" class="col-xs-12"  onfocus="onfocus_text(this)" onblur="listener(this)" placeholder="" id="number_list_<?php echo $k.$count; ?>" rows="5"><?php echo implode(';;;',$value['choice'][$k]);?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                            <?php $h--; ?>
                                                                        <?php endforeach ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $count++; ?>
                                            <?php endforeach ?>

                                        </div>
                                        <div class="col-xs-12">
                                            <i class="fa-2x fa fa-plus-square" id="addpend-one-field" onclick="addOneField()" style="float: right;cursor: pointer;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="config_send_mail">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <?php $body = json_decode($detail['config_send_mail'],true); ?>
                                        <div class="col-xs-12">
                                            <div class="col-xs-12 required" id="parent_to_mail" style="padding: 0px;">
                                                <?php 
                                                    echo form_label('To Email (Chỉ được nhập 1 mail)', 'to_email'); 
                                                    echo form_error('to_email');
                                                    echo form_input('to_email', $body['to_email'], ' class="form-control" id="to_email" placeholder="VD: admin@gmail.com" ');
                                                ?>
                                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="col-xs-12" style="padding: 0px; padding-top: 5px;">
                                                <?php 
                                                    echo form_label('CC Email (Các mail cách nhau bởi dấu ,)', 'cc_email'); 
                                                    echo form_error('cc_email');
                                                    echo form_input('cc_email', $body['cc_email'], ' class="form-control" id="cc_email" placeholder="VD: admin@gmail.com, username@gmail.com" ');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <ul class="nav nav-pills nav-justified" role="tablist" style="padding-top: 10px;">
                                                <?php $i = 0; ?>
                                                <?php foreach ($page_languages as $key => $value): ?>
                                                    <li role="presentation" class="<?php echo ($i == 0)? 'active' : '' ?>">
                                                        <a href="#<?php echo $key ?>" aria-controls="<?php echo $key ?>" role="tab" data-toggle="tab">
                                                            <span class="badge"><?php echo $i + 1 ?></span> <?php echo $value ?>
                                                        </a>
                                                    </li>
                                                <?php $i++; ?>
                                                <?php endforeach ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php $i = 0; ?>
                                                <?php foreach ($page_languages as $key => $value): ?>
                                                    <div role="tabpanel" class="tab-pane fade <?php echo ($i == 0)? 'active in' : '' ?>" id="<?php echo $key ?>">
                                                        <div class="col-xs-12 required" id="parent_to_mail" style="margin-bottom: 10px;padding: 0px;">
                                                            <?php 
                                                                echo form_label('Mô tả Email', 'description_email_'.$key); 
                                                                echo form_error('description_email_'.$key);
                                                                echo form_input('description_email_'.$key, $body['description_email'][$key], ' class="form-control" id="description_email_'.$key.'" placeholder="Nhập mô tả email" ');
                                                            ?>
                                                            <span class="help-block hidden">Bạn cần nhập trường này</span>
                                                        </div>
                                                        <div class="col-xs-12 add-content-body" style="padding: 0px;">
                                                            
                                                        </div>
                                                        <div class="col-xs-12" style="padding: 0px;">
                                                            <textarea name="" class="tinymce-area" id="content_body_<?php echo $key; ?>" name="content_body"><?php echo $body['body'][$key]; ?></textarea>
                                                        </div>
                                                    </div>
                                                <?php $i++; ?>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default">
                            <div class="box-body">
                                <div class="col-xs-12 nav-product" style="">
                                    <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                        <li><button class="btn btn-primary" id="go-back" onclick="history.back(-1);" >Go back</button></li>
                                        <li role="presentation" id="content-home" class="active" style="float: right;"><button href="#config_send_mail" class="btn btn-primary" aria-controls="config_send_mail" role="tab" data-toggle="tab" onclick="check_validate(this)">Cấu hình send mail</button></li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 nav-product" style="display: none">
                                    <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                        <li role="presentation" id="config_contacts"><button href="#config_contact" class="btn btn-primary" aria-controls="config_contact" role="tab" data-toggle="tab" onclick="check_validate(this)">Cấu hình Form</button></li>
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="view_form(this)" style="float: right;">Xem Form</span>
                                    </ul>
                                </div>
                            </div>
                        </div>

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
<script src="<?php echo site_url('assets/js/admin/') ?>configContact.js"></script>

<!-- DatePickerX Plugin -->

