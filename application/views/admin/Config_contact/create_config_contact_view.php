<style type="text/css">
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
            Thêm mới
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
                    <div class="box-body" style="padding:0px;">
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
                                                    echo form_input('name_configuration', set_value('name_configuration'), ' class="form-control" id="name_configuration" ');
                                                ?>
                                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                                            </div>

                                            <div class="input-group col-sm-5 col-xs-12" style="float: right;">
                                                <?php 
                                                    echo form_label('Số field', 'number_field');
                                                    echo form_error('number_field');
                                                    echo form_input('number_field[]', set_value('number_field'), 'class="form-control" id="number_field" ');
                                                ?>
                                                <span class="input-group-btn">
                                                    <a class="btn btn-primary" onclick="addField(document.getElementById('number_field').value)" style="cursor:pointer; margin-top: 25px;">Xác nhận</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="append_field">

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
                                        <div class="col-xs-12">
                                            <div class="col-xs-12 required" id="parent_to_mail" style="padding: 0px;">
                                                <?php 
                                                    echo form_label('To Email (Chỉ được nhập 1 mail)', 'to_email'); 
                                                    echo form_error('to_email');
                                                    echo form_input('to_email', set_value('to_email'), ' class="form-control" id="to_email" placeholder="VD: admin@gmail.com" ');
                                                ?>
                                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="col-xs-12" style="padding: 0px; padding-top: 5px;">
                                                <?php 
                                                    echo form_label('CC Email (Các mail cách nhau bởi dấu ,)', 'cc_email'); 
                                                    echo form_error('cc_email');
                                                    echo form_input('cc_email', set_value('cc_email'), ' class="form-control" id="cc_email" placeholder="VD: admin@gmail.com, username@gmail.com" ');
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
                                                                echo form_input('description_email_'.$key, set_value('description_email'), ' class="form-control" id="description_email_'.$key.'" placeholder="Nhập mô tả email" ');
                                                            ?>
                                                            <span class="help-block hidden">Bạn cần nhập trường này</span>
                                                        </div>
                                                        <div class="col-xs-12 add-content-body" style="padding: 0px;">
                                                            
                                                        </div>
                                                        <div class="col-xs-12" style="padding: 0px;">
                                                            <textarea name="" class="tinymce-area" id="content_body_<?php echo $key; ?>" name="content_body_<?php echo $key; ?>" ></textarea>
                                                        </div>
                                                    </div>
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