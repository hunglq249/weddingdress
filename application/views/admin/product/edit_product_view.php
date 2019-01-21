<link rel="stylesheet" href="<?php echo site_url('assets/sass/admin/') ?>detailpostnandproduct.css">
<style type="text/css">
    .color_product >span:before {
        font-family: "Glyphicons Halflings";
        content: "\e114";
        float: left;
        margin-top: -1px;
        font-size: 1.3em;transition: .3s;
    }
    /* Icon when the collapsible content is hidden */
    .color_product >span.collapsed:before {
    content: "\e080";
    font-size: 1.3em;
    margin-top: -1px;transition: .3s;
    }
</style>
<input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
<input type="text" name="page_languages" value='<?php echo json_encode($page_languages); ?>' placeholder="" class="form-control hidden" id="page_languages">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cập nhật
            <small>
                Sản phẩm
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
                            $common = json_decode($detail['common'],true);
                        ?>
                        <?php
                            $a_language = '';
                            $detail['data'] = json_decode($detail['data'],true);
                            foreach ($page_languages as $k => $vals){
                                $detail['data_lang_'.$k] = json_decode($detail['data_lang_'.$k],true);
                                $multiple_language[$k] = '';
                            }
                            foreach ($templates as $key => $value) {
                                $required = '';
                                $required_span = '';
                                // $required_focus = '';
                                if(isset($value['required'])){
                                    $required = 'required';
                                    $required_span = '<span class="help-block hidden">' .$value['required']. '</span>';
                                    // $required_focus = 'required_focus';
                                }
                                if($value['check_language'] == 'true'){
                                    switch ($value['type']) {
                                        case 'textarea':
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5" id="' .$key. '">' .$detail['data'][$key]. '</textarea>' .$required_span. '</div>';
                                            break;
                                        
                                        case 'radio':
                                            $radio = '';
                                            foreach ($value['choice']['vi'] as $k => $val) {
                                               $radio .= '<input type="radio" name="' . $key . '" value="' . $k . '" ' .(($detail['data'][$key] != "" && $detail['data'][$key] == $k) ? 'checked' : ''). ' /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                            }
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $radio.$required_span .'</div>';
                                            break;
                                        
                                        case 'checkbox':
                                            $checkbox = '';
                                            foreach ($value['choice']['vi'] as $k => $val) {
                                               $checkbox .= '<input type="checkbox" name="' . $key . '[]" value="' . $k . '" ' .(in_array($k,$detail['data'][$key]) ? 'checked' : ''). ' /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                            }
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $checkbox.$required_span .'</div>';
                                            break;
                                        
                                        case 'select':
                                            $select = '<option value="">Click để chọn</option>';
                                            if(isset($value['check_multiple'])){
                                                foreach ($value['choice']['vi'] as $k => $val) {
                                                    $select .= '<option value="' . $k . '" ' .(in_array($k,$detail['data'][$key]) ? 'selected' : ''). '>' . $val . '</option>';
                                                }
                                            }else{
                                                foreach ($value['choice']['vi'] as $k => $val) {
                                                    $select .= '<option value="' . $k . '" ' .(($detail['data'][$key] == $k) ? 'selected' : ''). '>' . $val . '</option>';
                                                }
                                            }
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<select name="' .$key.(isset($value['check_multiple']) ? '[]" multiple' : '"'). ' class="form-control" >' . $select . '</select>' .$required_span. '</div>';
                                            break;
                                        case 'date':
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="' . $key . '" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text" value="' .$detail['data'][$key]. '"></div>' .$required_span. '</div>';
                                            break;
                                        case 'file':
                                            $a_language .='<div class="form-group col-xs-12"><label for="image_shared">' . $value['title']['vi'] . '( hình ảnh đang dùng)</label><br>';
                                            if(isset($value['check_multiple'])){
                                                if(!empty($detail['data'][$key])){
                                                    foreach ($detail['data'][$key] as $k => $val) {
                                                        $a_language .= '<div class="row_'.$k.'" style="width:250px;padding-right:5px;float:left;position:relative;"><img src="' .base_url('assets/upload/'. $controller .'/'.$detail['slug'].'/'. $val). '" width=100% ><i class="fa-2x fa fa-times" style="cursor: pointer; position: absolute;color:red; top:0px;right: 10px;" onclick=\'remove_image("' .$controller.'","' .$detail['id']. '","' .$val. '","' .$k. '","' .$key. '")\'></i></div>';
                                                    }
                                                }else{
                                                    $a_language .='<span class="no_image" style="color:red">Hiện không có hình ảnh nào</span>';
                                                    
                                                }
                                            }else{
                                                if(!empty($detail['data'][$key])){
                                                    $a_language .= '<img src="' .base_url('assets/upload/'. $controller .'/'.$detail['slug'].'/'. $detail['data'][$key]). '" width=250px style="padding-right:5px;">';
                                                }else{
                                                    $a_language .='<span class="no_image" style="color:red">Hiện không có hình ảnh nào</span>';
                                                }
                                                
                                            }
                                            $a_language .= '<br></div><div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<input type="' . $value['type'] .'" name="' . $key.(isset($value['check_multiple']) ? '[]' : ''). '" class="form-control" placeholder="' .  $value['description'] . '"  ' . (isset($value['check_multiple']) ? 'multiple' : '') . '/>' .$required_span. '</div>';
                                            break;
                                        default:
                                            $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label><input type="' . $value['type'] .'" name="' . $key . '" class="form-control" value="' .$detail['data'][$key]. '" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/>' .$required_span. '</div>';
                                            break;
                                    }
                                }else{
                                    foreach ($page_languages as $k => $vals){
                                        switch ($value['type']) {
                                            case 'textarea':
                                                $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key.'_'.$k . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5">' .$detail['data_lang_'.$k][$key]. '</textarea>' .$required_span. '</div>';
                                                break;
                                            case 'date':
                                                $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="' . $key.'_'.$k . '" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text" value="' .$detail['data_lang_'.$k][$key]. '" ></div>' .$required_span. '</div>';
                                                break;
                                            case 'text':
                                                $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label><input type="' . $value['type'] .'" name="' . $key.'_'.$k . '" value="' .$detail['data_lang_'.$k][$key]. '" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/>' .$required_span. '</div>';
                                                break;
                                            case 'password':
                                                $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label><input type="' . $value['type'] .'" name="' . $key.'_'.$k . '" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/>' .$required_span. '</div>';
                                                break;
                                        }
                                    }
                                }
                            }
                        ?>
                        <div class="col-xs-12">
                            <h4 class="box-title">Basic Information</h4>
                        </div>
                        <div class="row">
                            <span><?php echo $this->session->flashdata('message'); ?></span>
                        </div>
                        <ul class="nav nav-tabs" role="tablist"></ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="image_shared">Hình ảnh đang dùng</label>
                                            <br>
                                            <img src="<?php echo base_url('assets/upload/'. $controller .'/'. $detail['slug'].'/'. $detail['image']); ?>" width=250px height=200px>
                                            <br>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <?php
                                            echo form_label('Hình ảnh', 'file');
                                            echo form_error('image_shared');
                                            echo form_upload('image_shared', set_value('image_shared'), 'class="form-control"');
                                            ?>
                                        </div>
                                        <div class="form-group col-xs-12 required">
                                            <?php
                                            echo form_label('Slug', 'text');
                                            echo form_input('slug_shared', $detail['slug'], 'class="form-control" id="slug_shared" readonly');
                                            ?>
                                            <span class="help-block hidden"><?php echo $templates_all['slug_shared']['required']; ?></span>
                                        </div>
                                        <div class="form-group col-xs-12" >
                                            <label class="control-label">Kiểu danh mục sản phẩm</label>
                                            <select name="type" id="select_templates" class="form-control" required="required" onchange="check_type_product(this)">
                                                <option value="0"<?php echo ($detail['type'] == 0)?' selected': ''; ?>>Váy</option>
                                                <option value="1"<?php echo ($detail['type'] == 1)?' selected': ''; ?>>Phụ kiện</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 required">
                                            <?php
                                            echo form_label('Danh mục', 'select');
                                            ?>
                                            <select name="parent_id_shared" class="form-control">
                                                <option value="">Click để chọn</option>
                                                <?php echo ($detail['type'] == 0)? $type_dress : $type_accessories; ?>
                                            </select>
                                            <span class="help-block hidden"><?php echo $templates_all['parent_id_shared']['required']; ?></span>
                                        </div>
                                        <?php echo $a_language; ?>

                                        <div class="form-group col-xs-12 " id="hot">
                                            <div class="checkbox">
                                                <label class="col-xs-12">
                                                  <input type="checkbox" name="hot" <?php echo ($detail['hot'] == '1')? 'checked': '' ?>> Được khách hàng lựa chọn
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="form-group col-xs-12">
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
                                            </div>
                                            <hr>
                                            <div class="tab-content">
                                                <?php $i = 0; ?>
                                                <?php foreach ($page_languages as $key => $value): ?>
                                                    <div role="tabpanel" class="tab-pane <?php echo ($i == 0)? 'active' : '' ?>" id="<?php echo $key ?>">
                                                            <div class="form-group col-xs-12 required">
                                                                <?php
                                                                    echo form_label($templates_all['title']['title'][$key], 'text');
                                                                    echo form_input('title_'. $key, trim($detail['title_'. $key]), 'class="form-control" id="title_'.$key.'" onchange="title_change(this)"');
                                                                ?>
                                                                <span class="help-block hidden"><?php echo $templates_all['title']['required']; ?></span>
                                                            </div>
                                                            <div class="form-group col-xs-12 <?php echo isset($templates_all['description']['required']) ? 'required' : '' ;?>">
                                                                <?php
                                                                    echo form_label($templates_all['description']['title'][$key], 'textarea');
                                                                    echo form_textarea('description_'. $key, trim($detail['description_'. $key]), 'class="form-control" rows="5"');
                                                                ?>
                                                                <?php echo isset($templates_all['description']['required']) ? '<span class="help-block hidden">' .$templates_all['description']['required']. '</span>' : '' ;?>
                                                            </div>
                                                            <div class="form-group col-xs-12 <?php echo isset($templates_all['content']['required']) ? 'required' : '' ;?>">
                                                                <?php
                                                                    echo form_label($templates_all['content']['title'][$key], 'textarea');
                                                                    echo form_textarea('content_'. $key, trim($detail['content_'. $key]), 'class="tinymce-area form-control" rows="5"');
                                                                ?>
                                                                <?php echo isset($templates_all['content']['required']) ? '<span class="help-block hidden">' .$templates_all['content']['required']. '</span>' : '' ;?>
                                                            </div>
                                                            <?php echo $multiple_language[$key];?>
                                                    </div>
                                                <?php $i++; ?>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="add-product">        
                                <div class="box box-default">
                                    <div class="box-body">
                                        <h4 class="box-title">Chi tiết sản phẩm</h4>
                                        <div class="row">
                                            <span><?php echo $this->session->flashdata('message'); ?></span>
                                        </div>
                                        <div class="col-md-12 showdate" style="margin-bottom: 10px;">
                                            <label class="control-label">Bộ sưu tập</label>
                                            <select name="collection_id" id="collection_id" class="form-control" required="required" >
                                                <option value="0">Không</option>
                                                <?php foreach ($collection as $key => $value): ?>
                                                    <option value="<?php echo $value['id'];?>" <?php echo ($detail['collection_id'] == $value['id'])? 'selected' : ''; ?>><?php echo $value['title'];?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <label class="control-label">Bộ sưu tập hiện có</label>
                                            <div class="col-xs-12" style="padding: 0px;">
                                                <?php foreach (json_decode($detail['collection']) as $k => $val): ?>
                                                    <div class="col-xs-4 collection row_<?php echo $k;?>" style="position: relative;padding:5px;margin-bottom: 10px;">
                                                        <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $val ) ?>" alt="Image Detail" width="100%" height=200px>
                                                        <i class="fa-2x fa fa-times" style="cursor: pointer; position: absolute;color:red; top:0px;right: 5px;" onclick="remove_image('<?php echo $controller;?>','<?php echo $detail['id']; ?>','<?php echo $val; ?>','<?php echo $k ?>','<?php echo $key ?>', 'collection')"></i>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php
                                                echo form_label('Bộ sư tập ảnh cho sản phẩm', 'collection_shared');
                                                echo form_error('collection_shared');
                                                echo form_upload('collection_shared[]', '', 'class="form-control" multiple');
                                            ?>
                                        </div>
                                        <?php $common = json_decode($detail['common'],true);?>
                                        <div class="col-md-12" style="padding: 0px;margin-bottom: 10px;">
                                            <div class="col-md-12" style="margin-top:5px;">
                                                <label class="control-label" for="">Giá sản phẩm</label>
                                                <?php  
                                                    echo form_input("price", $detail['price'], 'class="form-control" onkeypress=" return isNumberKey(event)" id="price"');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label class="col-xs-6">
                                                  <input type="checkbox" name="sale" onclick="check_sale(this)" <?php echo ($common['sale'] == 'true')? 'checked': '' ?>> Khuyến mãi
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="sale" style="display: <?php echo ($common['sale'] == 'true')? 'block': 'none' ?>;">
                                            <div class="col-xs-12" style="border:1px solid #d2d6de;">
                                                <?php
                                                    echo form_label('Giá sản phẩm sau khi giảm giá', 'pricepromotion','style="margin-top:5px;"');
                                                    echo form_error('pricepromotion');
                                                    echo form_input('pricepromotion', $detail['pricepromotion'], 'class="form-control" id="pricepromotion" placeholder ="Đơn vị tiền: VNĐ" onkeypress=" return isNumberKey(event)"');
                                                ?>
                                                <div class="checkbox">
                                                    <label style="padding-right: 10px;padding-bottom: 10px;">
                                                        <input type="checkbox" id="showpromotion" name="showpromotion" <?php echo ($common['showpromotion'] == 'true')? 'checked': '' ?>> Hiển thị khuyến mãi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label class="col-xs-6" style="margin-top: 10px;">
                                                  <input type="checkbox" name="rent" onclick="check_rent(this)" <?php echo ($common['rent'] == 'true')? 'checked': '' ?>> Cho thuê
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="rent" style="display: <?php echo ($common['rent'] == 'true')? 'block': 'none' ?>;">
                                            <div class="col-xs-12" style="border:1px solid #d2d6de;">
                                                <div class="col-md-12" style="padding: 0px;margin-bottom: 10px;">
                                                    <div class="col-md-12" style="padding: 0px;margin-top:5px;">
                                                        <label class="control-label" for="">Giá cho thuê</label>
                                                        <?php  
                                                            echo form_input("price_rent", $detail['price_rent'], 'class="form-control" onkeypress=" return isNumberKey(event)" id="price_rent"');
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-12 showdate" style="padding: 0px;">
                                                        <label style="margin-top:5px;">Chọn các ngày cho thuê nếu có</label>
                                                        <div class="input-group date">
                                                          <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                          <input type="text" name="date" value="<?php echo $detail['date'] ?>" class="form-control pull-right" id="datepicker" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="padding: 0px;">
                                                    <div class="checkbox">
                                                        <label class="col-xs-6" style="margin-bottom: 5px;">
                                                          <input type="checkbox" name="rent_sale" onclick="check_rent_sale(this)" <?php echo ($common['rent_sale'] == 'true')? 'checked': '' ?>> Khuyến mãi
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="rent_sale" style="margin-bottom: 10px;padding: 0px;display: <?php echo ($common['rent_sale'] == 'true')? 'block': 'none' ?>;">
                                                    <div class="col-xs-12" style="border:1px solid #d2d6de;margin-bottom: 10px;">
                                                        <?php
                                                            echo form_label('Giá thuê sau khi giảm giá', 'pricepromotion_rent','style="margin-top:5px;"');
                                                            echo form_error('pricepromotion_rent');
                                                            echo form_input('pricepromotion_rent', $detail['pricepromotion_rent'], 'class="form-control" id="pricepromotion_rent" placeholder ="Đơn vị tiền: VNĐ" onkeypress=" return isNumberKey(event)"');
                                                        ?>
                                                        <div class="checkbox">
                                                            <label style="padding-right: 10px;padding-bottom: 10px;">
                                                                <input type="checkbox" id="showpromotion_rent" name="showpromotion_rent" <?php echo ($common['showpromotion_rent'] == 'true')? 'checked': '' ?>> Hiển thị khuyến mãi
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default">
                            <div class="box-body">
                                <div class="form-group col-xs-12 nav-product" style="">
                                    <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                        <li><button class="btn btn-primary" id="go-back" onclick="history.back(-1);" >Go back</button></li>
                                        <li role="presentation" id="content-home" class="active" style="float: right;"><button href="#add-product" class="btn btn-primary" aria-controls="add-product" role="tab" data-toggle="tab" onclick="check_validate_default(this)">Chi tiết sản phẩm</button></li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 nav-product" style="display: none">
                                    <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                        <li role="presentation" id="config_contacts"><button href="#home" class="btn btn-primary" aria-controls="home" role="tab" data-toggle="tab" onclick="check_validate_default(this)">Thông tin cơ bản</button></li>
                                        <span type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="submit_shared(this)" style="float: right;">Xác nhận</span>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="encypted_ppbtn_all"></div>
                        <!-- <div id="myModal" class="modal">
                            <img class="modal-content" id="img01">
                        </div> -->
                        <?php echo form_close(); ?>
                        <!-- <span onclick="submit_shared(this)" id="submid" class="btn btn-default" id="submit_shared" data-dismiss="modal" >Xác nhận</span> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<input type="hidden" id="type_dress" value='<option value="">Click để chọn</option><?php echo $type_dress; ?>'>
<input type="hidden" id="type_accessories" value='<option value="">Click để chọn</option><?php echo $type_accessories; ?>'>
<input type="hidden" id="product_category_id_selected" value='<?php echo $detail['product_category_id']; ?>'>

<script src="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.js"></script>
<!-- <script src="<?php echo site_url('assets/js/admin/') ?>showmodalimg.js"></script> -->
<script src="<?php echo site_url('assets/js/admin/') ?>product.js"></script>
<input type="hidden" name="language1" value="<?php echo $lang; ?>">
<input type="hidden" name="language1" value="<?php echo $lang; ?>">
<script type="text/javascript">
    for (var i = 0; i < document.querySelectorAll('[id^="demo"]').length; i++) {
        value = document.querySelectorAll('[id^="demo"]')[i].querySelector('[name="color[]"]').value;
        document.querySelectorAll(`[data-target^="#demo"] b`)[i].innerHTML = '. '+document.querySelectorAll('[id^="demo"]')[i].querySelector(`[value="${value}"]`).innerHTML;
    }
    function remove_image(controller, id, image, k, key, column){
        if(confirm('Chắc chắn xóa ảnh này?')){
            let data = new FormData(document.querySelector('form.form-horizontal'));
            data.append('id', id);
            data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
            data.append('image', image);
            data.append('key', key);
            // data.append('k', k);
            data.append('column', column);
            var url = HOSTNAMEADMIN + '/' + controller + '/remove_image_multiple';
            fetch(url,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    if(html.status == "200"){
                        alert(html.message);
                        $(`.${column}.row_${k}`).fadeOut();
                        document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                        
                    }else{
                        alert(html.message);
                        location.reload();
                    }
                }

            );
        }
    }
    $(function () {
        if(document.querySelector('[name="language1"]').value == 'vi'){
            $.fn.datepicker.dates['en'] = {
                days: ["Chủ nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"],
                daysShort: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                months: ["Tháng Một", "Tháng Hai", "Tháng Ba", "Tháng Tư", "Tháng Năm", "Tháng Sáu", "Tháng Bảy", "Tháng Tám", "Tháng Chín", "Tháng Mười", "Tháng Mười Một", "Tháng Mười Hai" ],
                monthsShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12" ],
                today: "Hôm nay",
                clear: "Xóa",
                format: "mm/dd/yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };
        }
        //Date picker
        $('#datepicker').datepicker({
          format: 'dd/mm/yyyy',
          multidate:true,
        })
    })
</script>
<?php 
    function build_new_category($categorie, $parent_id = 0, $detail_id, $char = ''){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            ?>
            <option value="<?php echo $value['id'] ?>" <?php echo($value['id'] == $detail_id)? 'selected' : ''?> ><?php echo $char.$value['title'] ?></option>
            <?php build_new_category($categorie, $value['id'], $detail_id, $char.'---|') ?>
            <?php
            }
        }
    }
?>