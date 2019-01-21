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
<input type="text" name="detail_templates" value='{}' placeholder="" class="form-control hidden" id="detail_templates"/>
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
    <input type="text" name="" value='<?php echo $number_field; ?>' placeholder="" class="form-control hidden" id="number_field_type">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body" style="padding:0px;">
                        <?php
                        echo form_open_multipart('', array('class' => 'form-horizontal','onsubmit' => 'return false'));
                        ?>
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
                                                    echo form_input('number_field',$number_field, 'class="form-control" id="number_field" ');
                                                ?>
                                                <span class="input-group-btn">
                                                    <a class="btn btn-primary" onclick="addField(Number(document.getElementById('number_field').value))" style="cursor:pointer; margin-top: 25px;">Xác nhận</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="append_field">
                                            <h4 style="margin-top: 5px;font-weight: bold;color:red">Nội dung bắt buộc</h4>
                                            <?php 
                                                $title = array(
                                                    'vi' => array('Hình ảnh', 'Slug', 'Danh mục', 'Tiêu đề', 'Mô tả', 'Nội dung','Thương hiệu','Tính năng','Giá chung cho sản phẩm (đơn vị VND)'),
                                                    'en' => array('Image', 'Slug', 'Category', 'Title', 'Description', 'Content','Trademark', 'Features','Common price'),
                                                );
                                            ?>
                                            <?php for ($i = 1; $i <= $number_field;$i++): ?>
                                                <div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_<?php echo $i;?>"  draggable="false" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                                                    <div class="col-xs-12 drop-drag" draggable="false" ondragstart="drag(event)">
                                                        <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align: left;">
                                                            <span data-toggle="collapse" data-target="#demo<?php echo $i;?>" class="col-xs-12 check-collapse collapsed" style="height:35px;padding-top:2px;" aria-expanded="false">
                                                                <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;"><?php echo $i;?></span><b style="font-size: 1.18em;font-weight: 500">. <?php echo $title['vi'][$i-1] ?></b>
                                                            </span>
                                                            <i style="float: right;padding-right:5px;display: none;" class="fa-2x fa fa-close remove" onclick="remove_field(<?php echo $i;?>)"></i>
                                                        </div>
                                                        <div id="demo<?php echo $i;?>" class="collapse form-group" aria-expanded="false" style="height: 0px;">
                                                            <div class="col-xs-12" style="padding: 0px;">
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <label class="control-label" for="inputError">Mô tả</label>
                                                                    <input type="text" name="description[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12" id="list<?php echo $i;?>">
                                                                    <label for="" style="margin-bottom: 0px; margin-top: 7px;">Kiểu Nhập</label>
                                                                    <select name="type[]"  class="form-control select_type" onchange="select(this,'<?php echo $i;?>')" disabled>
                                                                        <option value="text" <?php echo ($i == 2 || $i == 4 || $i == 9)? 'selected' : '' ?>>Text</option>
                                                                        <option value="textarea" <?php echo ($i == 5 || $i == 6)? 'selected' : '' ?>>Textarea</option>
                                                                        <option value="radio">Radio</option>
                                                                        <option value="checkbox">Checkbox</option>
                                                                        <option value="password">Password</option>
                                                                        <option value="select"<?php echo ($i == 3 || $i == 7 || $i == 8)? 'selected' : '' ?>>Select</option>
                                                                        <option value="date">Date</option>
                                                                        <option value="file" <?php echo ($i==1)? 'selected' : '' ?>>Image</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12" style="padding: 0px;">
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="" value="" class="check_language" <?php echo ($i < 4 || $i > 6) ? 'checked' : ''; ?> onclick="check_multiple(this)" disabled>Chỉ cho phép nhập hoặc chọn một ngôn ngữ
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12 checkbox_field">
                                                                    <?php if ($i == 1): ?>
                                                                        <div class="check_multiple" style="padding:0px;">
                                                                            <label class="checkbox-inline" ><input type="checkbox" name="multiple_image" disabled >Chọn nhiều ảnh</label>
                                                                        </div>
                                                                    <?php elseif ($i == 3 || $i == 7 || $i == 8): ?>
                                                                        <div class="checkbox check_multiple" style="padding:0px;">
                                                                            <label class="checkbox-inline"><input type="checkbox" name="" value="" class="select_multiple" onclick="check_multiple(this)" disabled <?php echo ($i == 8)? 'checked' : '' ?>>Được phép chọn nhiều</label>
                                                                        </div>
                                                                    <?php elseif ($i == 5): ?>
                                                                        <div class="check_multiple" style="padding:0px;">
                                                                                <label class="checkbox-inline"><input type="checkbox" name="tinymce_textarea" disabled>Nhúng trình soạn thảo tinymce</label>
                                                                        </div>
                                                                    <?php elseif ($i == 6): ?>
                                                                        <div class="check_multiple" style="padding:0px;">
                                                                                <label class="checkbox-inline"><input type="checkbox" checked="checked" name="tinymce_textarea" disabled>Nhúng trình soạn thảo tinymce</label>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="" class="required_check" onclick="check_required(this)"/ <?php echo (in_array($i,array(2,3,4,7)))? 'checked disabled' : ''; ?> <?php echo ($i == 9)? 'disabled' : ''; ?>><span>Bắt buộc chọn hoặc nhập thông tin</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <?php if (in_array($i,array(2,3,4,7))): ?>
                                                                <div class="col-xs-12 content-required" style="margin-top: 5px;"> 
                                                                    <label for="">Nội dung hiện lên khi Không chọn hoặc nhập thông tin</label>
                                                                    <input type="text" name="required_content[]" value="" placeholder="" onblur="listener(this)" class="form-control required">
                                                               </div>
                                                            <?php endif ?>
                                                            <div class="col-xs-12" id="data<?php echo $i;?>">
                                                                <div class="col-ms-12" style="margin-top:10px;padding-top:5px;border-top:2px solid green;">
                                                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                                                        <?php $h = 0; ?>
                                                                        <?php foreach ($page_languages as $key => $value): ?>
                                                                            <li role="presentation" class="<?php echo ($h == 0)? 'active' : '' ?>">
                                                                                <a href="#<?php echo $key.$i ?>" aria-controls="<?php echo $key.$i ?>" role="tab" data-toggle="tab">
                                                                                    <span class="badge"><?php echo $h + 1 ?></span> <?php echo $value ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php $h++; ?>
                                                                        <?php endforeach ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php foreach ($page_languages as $key => $value): ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php echo ($h == count($page_languages))? 'in active' : '' ?>" id="<?php echo $key.$i ?>">
                                                                                <div class="box box-default" style="border-top:none;">
                                                                                    <div class="box-body" style="padding:0px;">
                                                                                        <div class="col-xs-12 required" style="padding: 0px;">
                                                                                            <label class="control-label" for="">Tiêu đề</label>
                                                                                            <input type="text" name="title_<?php echo $key;?>[]" value="<?php echo $title[$key][$i-1];?>" placeholder="" readonly onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title" >
                                                                                            <span class="help-block hidden">Bạn cần nhập trường này</span>
                                                                                        </div>
                                                                                        <div class="col-xs-12 show_textarea" style="padding:0px;">
                                                                                            <?php if ($i == 3 || $i == 7 || $i == 8): ?>
                                                                                                <div class="importValue">
                                                                                                    <label for="">Nhập danh sách lựa chọn cho kiểu select các lựa chọn cách nhau bởi ba dấu ;;; </label>
                                                                                                    <div class="col-xs-12" style="padding:0px;">
                                                                                                        <textarea type="text" name="number_list_<?php echo $key; ?>[]" class="col-xs-12"  onfocus="onfocus_text(this)" onblur="listener(this)" placeholder="" readonly id="number_list_<?php echo $key.$i; ?>" rows="5"></textarea>
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
                                            <?php endfor ?>
                                            <h4 style="margin-top: 15px;font-weight: bold;color:green">Nội dung tự thêm</h4>
                                        </div>
                                        <div class="col-xs-12">
                                            <i class="fa-2x fa fa-plus-square" id="addpend-one-field" onclick="addOneField()" style="float: right;cursor: pointer;"></i>
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
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"  onclick="check_validate(this)" style="float: right;">Xem Form</span>
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
<script src="<?php echo site_url('assets/js/admin/') ?>templates.js"></script>