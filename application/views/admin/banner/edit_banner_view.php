<link rel="stylesheet" href="<?php echo site_url('assets/sass/admin/') ?>detail.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cập nhật
            <small>
                Banner
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                        <?php
                        echo form_open_multipart('', array('class' => 'form-horizontal'));
                        ?>
                        <div class="col-xs-12">
                            <h4 class="box-title">Basic Information</h4>
                        </div>
                        <div class="form-group col-xs-12 type">
                            <label class="control-label">Chọn kiểu hiển thị banner</label>
                            <select class="form-control" name="type" onchange="check_change_type(this)">
                                <option value="0"<?php echo $detail['type'] == '0' ? 'selected' : ''; ?>>Danh mục sản phẩm</option>
                                <option value="1"<?php echo $detail['type'] == '1' ? 'selected' : ''; ?>>Bộ sưu tập sản phẩm</option>
                            </select>
                        </div>
                        <div class="product_category">
                            <?php if ($detail['type'] == '0'): ?>
                                <div class="form-group col-xs-12">
                                    <label class="control-label">Chọn danh mục sản phẩm</label>
                                    <select class="form-control" name="category_id">
                                        <?php echo $product_category; ?>
                                    </select>
                                    <span class="help-block hidden">Vui lòng chọn danh mục sản phẩm</span>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="collection">
                            <?php if ($detail['type'] == '1'): ?>
                                <div class="form-group col-xs-12">
                                    <label class="control-label">Chọn bộ sưu tập sản phẩm</label>
                                    <select class="form-control" name="category_id">
                                        <option value="" selected>Click để chọn</option>
                                        <?php foreach ($collection as $key => $value): ?>
                                            <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $detail['category_id'])? 'selected' : '';?>><?php echo $value['title'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="help-block hidden">Vui lòng chọn bộ sưu tập sản phẩm</span>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row">
                            <span><?php echo $this->session->flashdata('message'); ?></span>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="image_shared">Hình ảnh đang dùng</label></br>
                            <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['image']); ?>" alt="anh-mo-ta" width=150>
                        </div>
                        <div class="form-group col-xs-12">
                            <?php
                            echo form_label('Ảnh đại diện', 'image_shared');
                            echo form_error('image_shared');
                            echo form_upload('image_shared', set_value('image_shared'), 'class="form-control"');
                            ?>
                            <br>
                        </div>
                        <div class="hidden">
                            <ul class="nav nav-pills nav-justified" role="tablist">
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
                            <hr>
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                <?php foreach ($template as $key => $value): ?>
                                    <div role="tabpanel" class="tab-pane <?php echo ($i == 0)? 'active' : '' ?>" id="<?php echo $key ?>">
                                        <?php foreach ($value as $k => $val): ?>
                                            <div class="form-group col-xs-12">
                                                <?php
                                                    if($k == 'title' && in_array($k, $request_language_template)){
                                                        echo form_label($val, $k .'_'. $key);
                                                        echo form_error($k .'_'. $key);
                                                        echo form_input($k .'_'. $key, trim($detail['title_'. $key]), 'class="form-control" id="title_'.$key.'"');
                                                    }
                                                    // elseif($k == 'description' && in_array($k, $request_language_template)){
                                                    //     echo form_label($val, $k .'_'. $key);
                                                    //     echo form_error($k .'_'. $key);
                                                    //     echo form_textarea($k .'_'. $key,  trim($detail['description_'. $key]), 'class="form-control" rows="5"');
                                                    // }elseif($k == 'content' && in_array($k, $request_language_template)){
                                                    //     echo form_label($val, $k .'_'. $key);
                                                    //     echo form_error($k .'_'. $key);
                                                    //     echo form_textarea($k .'_'. $key,  trim($detail['content_'. $key]), 'class="tinymce-area form-control" rows="5"');
                                                    // }
                                                ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php $i++; ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php echo form_submit('submit_shared', 'OK', 'class="btn btn-primary"'); ?>
                        <?php echo form_close(); ?>
                        <div class="hidden_product_category" style="display: none">
                            <div class="form-group col-xs-12">
                                <label class="control-label">Chọn danh mục sản phẩm</label>
                                <select class="form-control">
                                    <?php echo $product_category; ?>
                                </select>
                                <span class="help-block hidden">Vui lòng chọn danh mục sản phẩm</span>
                            </div>
                        </div>
                        <div class="hidden_collection" style="display: none">
                            <div class="form-group col-xs-12">
                                <label class="control-label">Chọn bộ sưu tập sản phẩm</label>
                                <select class="form-control">
                                    <option value="" selected>Click để chọn</option>
                                    <?php foreach ($collection as $key => $value): ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block hidden">Vui lòng chọn bộ sưu tập sản phẩm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" id="category_product_hidden" value="<?php echo $detail['category_id'] ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/admin/script.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/admin/common.js') ?>"></script>
<script type="text/javascript">
    var product_category = document.querySelector('.hidden_product_category').innerHTML;
    var collection = document.querySelector('.hidden_collection').innerHTML;
    if(document.querySelector('.type select').value == 0){
        document.querySelector(`.product_category option[value="${document.querySelector('#category_product_hidden').value}"]`).setAttribute('selected','');
    }
    function check_change_type(ev){
        document.querySelector('.product_category').innerHTML = '';
        document.querySelector('.collection').innerHTML = '';
        if(ev.value == 0){
            document.querySelector('.product_category').innerHTML = product_category;
            document.querySelector('.product_category select').setAttribute('name','category_id');
        }else{
            document.querySelector('.collection').innerHTML = collection;
            document.querySelector('.collection select').setAttribute('name','category_id');
        }
    }
    $(".form-horizontal").submit(function(e){
        if(document.querySelector('[name="category_id"]').value == ''){
            document.querySelector('[name="category_id"]').parentElement.classList.add('has-error');
            document.querySelector('[name="category_id"]').parentElement.querySelector('span').classList.remove('hidden');
            document.querySelector('[name="category_id"]').setAttribute('onchange',`check_validate(this)`);
            e.preventDefault();
        }
        
    });
    function check_validate(){
        if(document.querySelector('[name="category_id"]').value == ''){
            document.querySelector('[name="category_id"]').parentElement.classList.add("has-error");
            document.querySelector('[name="category_id"]').parentElement.querySelector('span').classList.remove('hidden');
        }else{
            document.querySelector('[name="category_id"]').parentElement.classList.remove("has-error");
            document.querySelector('[name="category_id"]').parentElement.querySelector('span').classList.add('hidden');
        }
    }
</script>

