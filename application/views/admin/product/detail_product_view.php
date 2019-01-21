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
    .datepicker table tr td.day, .datepicker table tr td.day:hover{
        text-shadow: 0 -1px 0 rgba(0,0,0,.25);
        background: none;
        cursor: default;
    }
    .datepicker table tr td.day.active, .datepicker table tr td.day.active:hover{
        background: none;
        color: #333;
        cursor: default;
    }
    .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover{
        background-color: #04c;
        background-image: linear-gradient(to bottom,#08c,#04c);
        background-repeat: repeat-x;
        border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0,0,0,.25);
        cursor: default;
    }
    .datepicker table tr td.active.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover.active, .datepicker table tr td.active.disabled:hover.disabled, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active.disabled:hover[disabled], .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active:active, .datepicker table tr td.active:hover, .datepicker table tr td.active:hover.active, .datepicker table tr td.active:hover.disabled, .datepicker table tr td.active:hover:active, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active:hover[disabled], .datepicker table tr td.active[disabled]{
        background-color: rgba(0,0,0,0);
        background-image: none;
        color: #333;
    }
    .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th{
        cursor: default;
    }
    .datepicker table tr td span.focused, .datepicker table tr td span:hover{
        background: #04c;
        color:white;
    }
</style>
<input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="height: 50px;">
        <div class="col-xs-6"> 
            
            <h3>
                Chi tiết
                <small>
                    Sản phẩm
                </small>
            </h3>
        </div>
        <div class="col-xs-6" style="padding-right: 0px;">
            <div style="margin-top: 10px;float: right;">
                <a style="" href="<?php echo base_url('admin/'.$controller.'/edit/'.$detail['id']) ?>" class="btn btn-warning" role="button">Chỉnh sửa</a>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <ul class="nav nav-tabs" role="tablist" id="nav-product">
                            <li role="presentation" class="active"><a href="#default-product" class="btn btn-primary" aria-controls="default-product" role="tab" data-toggle="tab" aria-expanded="true">Chi tiết mặc định</a></li>
                            <li role="presentation"><a href="#detail-product" class="btn btn-primary" aria-controls="detail-product" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                            <li role="presentation"><a href="#collection-product" class="btn btn-primary" aria-controls="collection-product" role="tab" data-toggle="tab">Bộ sưu tập</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="default-product">
                            <div class="box-body" style="margin-left: 20px;">
                                <div class="row">
                                    <?php 
                                        $data = json_decode($detail['data'],true);
                                        foreach ($page_languages as $k => $vals){
                                            $detail['data_lang_'.$k] = json_decode($detail['data_lang_'.$k],true); 
                                        }
                                    ?>
                                    <div class="row" style="margin-right: 0px;">
                                        <div class="detail-info col-md-12">
                                            <div class="table-responsive">
                                                <h4><label>Thông tin</label></h4>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>Trạng thái</th>
                                                        <td>
                                                            <?php if ($detail['is_activated'] == 0): ?>
                                                                <span class="label label-success" onclick="deactive('product', <?php echo $detail['id'] ?>, 'Chăc chắn tắt sản phẩm')" class="dataActionDelete" title="Tắt danh mục" style="cursor: pointer;">Đang sử dụng</span>
                                                            <?php else: ?>
                                                                <span class="label label-warning" onclick="active('product', <?php echo $detail['id'] ?>, 'Chăc chắn bật sản phẩm')" class="dataActionDelete" title="Bật danh mục" style="cursor: pointer;">Không sử dụng</span>
                                                            <?php endif ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Slug</th>
                                                        <td><?php echo $detail['slug'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Danh Mục</th>
                                                        <td><?php echo $detail['parent_title'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Loại sản phẩm</th>
                                                        <td><?php echo ($detail['type'] == 0)? 'Váy' : 'Phụ kiện';?></td>
                                                    </tr>
                                                    <?php if ($detail['type'] == 0): ?>
                                                        <tr>
                                                            <th>Bộ sưu tập</th>
                                                            <td>
                                                                <?php if (!empty($collection['collection_title'])): ?>
                                                                    <a href="<?php echo base_url('admin/collection/detail/'.$collection['id']) ?>"><?php echo $collection['collection_title'] ?></a>
                                                                <?php else:?>
                                                                    Sản phẩm không có bộ sưu tập
                                                                <?php endif ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                    <?php if (!empty($data)): ?>
                                                        <?php foreach ($data as $key => $value): ?>
                                                            <?php if ($templates[$key]['type'] != 'radio' && $templates[$key]['type'] != 'checkbox' && $templates[$key]['type'] != 'select' && $templates[$key]['type'] != 'file'): ?>
                                                                <?php if($detail['type'] == 1 && $key =='kich_thuoc_cho_san_pham') : ?>
                                                                    <?php unset($data[$key]); ?>
                                                                    <?php continue; ?>
                                                                <?php else: ?>
                                                                    <tr>
                                                                        <th><?php echo $templates[$key]['title']['vi']?></th>
                                                                        <td><?php echo $value?></td>
                                                                    </tr>
                                                                <?php endif ?>
                                                                <?php unset($data[$key]); ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                    <?php if ($detail['type'] == 0): ?>
                                                        <tr>
                                                            <th>Lựa chọn khách hàng: </th>
                                                            <td><i class="fa fa-<?php echo ($detail['hot'] == '0') ? 'remove" style="color:red;font-size:1.2em;"' : 'check" style="color:green;font-size:1.2em;"';?>></i></td>
                                                        </tr>
                                                    <?php endif ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px;margin-top: 10px;">

                                        <!-- Nav tabs -->
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

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <?php $i = 0; ?>
                                            <?php foreach ($page_languages as $key => $value): ?>
                                                <div role="tabpanel" class="tab-pane <?php echo ($i == 0)? 'active' : '' ?>" id="<?php echo $key ?>">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th style="width: 120px"><?php echo $templates_all['title']['title'][$key];?>: </th>
                                                                    <td><?php echo $detail['title_'. $key] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width: 120px"><?php echo $templates_all['description']['title'][$key];?>: </th>
                                                                    <td><?php echo $detail['description_'. $key] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width: 120px"><?php echo $templates_all['content']['title'][$key];?>: </th>
                                                                    <td><?php echo $detail['content_'. $key] ?></td>
                                                                </tr>
                                                                <?php if (!empty($data)): ?>
                                                                    <?php foreach ($data as $k => $val): ?>
                                                                        <?php if ($templates[$k]['type'] != 'file' && !isset($templates[$k]['check_multiple']) && $templates[$k]['type'] != 'checkbox'): ?>
                                                                            <tr>
                                                                                <th style="width: 120px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                                <td><?php echo ($val != "") ? $templates[$k]['choice'][$key][$val] : '' ?></td>
                                                                            </tr>
                                                                        <?php endif ?>
                                                                        <?php if (($templates[$k]['type'] != 'file' && isset($templates[$k]['check_multiple'])) || $templates[$k]['type'] == 'checkbox'): ?>
                                                                            <tr>
                                                                                <th style="width: 120px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                                <td>
                                                                                    <?php 
                                                                                        echo implode(', ',array_intersect_key($templates[$k]['choice'][$key], array_flip($val)));
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                                <?php if (!empty($detail['data_lang_'.$key])): ?>
                                                                    <?php foreach ($detail['data_lang_'.$key] as $k => $val): ?>
                                                                        <tr>
                                                                            <th style="width: 120px"><?php echo $templates[$k]['title'][$key]?>: </th>
                                                                            <td><?php echo $val; ?></td>
                                                                        </tr>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php $i++; ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="detail-product">
                            <div class="box-body">
                                <?php $common = json_decode($detail['common'],true); ?>
                                <div class="col-xs-6" style="display: <?php echo ($common['rent'] == 'true')? 'block': 'none'; ?>;">
                                    <div class="col-xs-12 text-center" style="font-weight: 600;">Thuê sản phẩm</div>
                                    <table class="table table-striped"  style="margin-bottom: 0px;">
                                        <tbody class=" col-xs-12" style="padding-left: 0px;">
                                            <tr>
                                                <th>Giá thuê sản phẩm: </th>
                                                <td><?php echo empty($detail['price_rent']) ? 'Liên hệ' : $detail['price_rent']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Giá khuyến mãi thuê sản phẩm: </th>
                                                <td><?php echo ($common['rent_sale'] == 'true') ? empty($detail['pricepromotion_rent']) ? 'Liên hệ' : $detail['pricepromotion_rent'] : 'Không có khuyến mãi cho thuê sản phẩm'; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Hiện thị khuyến mãi: </th>
                                                <td><i class="fa fa-<?php echo ($common['showpromotion_rent'] == 'false') ? 'remove" style="color:red;font-size:1.2em;"' : 'check" style="color:green;font-size:1.2em;"';?>></i></td>
                                            </tr>
                                            <tr style=" <?php echo ($detail['type'] == 0) ? '' : 'display:none'; ?>;">
                                                <th>Lịch Thuê sản phẩm: </th>
                                                <td><span class="btn btn-xs btn-primary" id="datepicker">Click để xem lịch</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-12 text-center" style="font-weight: 600;">Bán sản phẩm</div>
                                    <table class="table table-striped"  style="margin-bottom: 0px;">
                                        <tbody class=" col-xs-12" style="padding-left: 0px;">
                                            <tr>
                                                <th>Giá sản phẩm: </th>
                                                <td><?php echo empty($detail['price']) ? 'Liên hệ' : $detail['price']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Giá khuyến mãi sản phẩm: </th>
                                                <td><?php echo ($common['sale'] == 'true') ? empty($detail['pricepromotion']) ? 'Liên hệ' : $detail['pricepromotion'] : 'Sản phẩm không có khuyến mãi'; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Hiện thị khuyến mãi: </th>
                                                <td><i class="fa fa-<?php echo ($common['showpromotion'] == 'false') ? 'remove" style="color:red;font-size:1.2em;"' : 'check" style="color:green;font-size:1.2em;"';?>></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="collection-product">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <?php foreach (json_decode($detail['collection']) as $k => $val): ?>
                                        <div class="col-xs-4 collection row_<?php echo $k;?>" style="position: relative;padding:5px;margin-bottom: 10px;">
                                            <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $val ) ?>" alt="Image Detail" width="100%" height=200px>
                                            <i class="fa-2x fa fa-times" style="cursor: pointer; position: absolute;color:red; top:0px;right: 5px;" onclick="remove_image('<?php echo $controller;?>','<?php echo $detail['id']; ?>','<?php echo $val; ?>','<?php echo $k ?>','<?php echo $key ?>', 'collection')"></i>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hình ảnh đại điện của sản phẩm</h3>
                    </div>
                    <div class="box-body" style="">
                        <label>Hình ảnh</label>
                        <div class="row">
                            <div class="item col-md-12">
                                <div class="">
                                    <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $detail['image'] ) ?>" alt="Image Detail" width=100% height=200px>
                                </div>
                            </div>
                        </div>
                        <div class="detail-image col-xs-12">
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $key => $value): ?>
                                    <?php  if ($templates[$key]['type'] == 'file'): ?>
                                        <div class="row">
                                            <label><?php echo $templates[$key]['title']['vi']?></label>
                                            <div class="item">     
                                                <?php if (isset($templates[$key]['check_multiple'])): ?>
                                                    <?php foreach ($value as $k => $val): ?>
                                                        <div class="col-xs-12 data row_<?php echo $k;?>" style="position: relative;padding:0px;margin-bottom: 10px;">
                                                            <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $val ) ?>" alt="Image Detail" width="100%" height=200px>
                                                            <i class="fa-2x fa fa-times" style="cursor: pointer; position: absolute;color:red; top:0px;right: 5px;" onclick="remove_image('<?php echo $controller;?>','<?php echo $detail['id']; ?>','<?php echo $val; ?>','<?php echo $k ?>','<?php echo $key ?>', 'data')"></i>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <div class="col-xs-12" style="padding: 0px;margin-bottom: 10px;">
                                                        <img src="<?php echo base_url('assets/upload/'.$controller.'/'.$detail['slug'].'/'. $value ) ?>" alt="Image Detail" width="100%" >
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="encypted_ppbtn_all"></div>
            <div id="myModal" class="modal" style="overflow-y: auto;">
                <img class="modal-content" id="img01">
            </div>
        </div>
        <input type="hidden" name="" id="dates" value='<?php echo json_encode(explode(",", $detail["date"])) ?>'>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
</div>
<script type="text/javascript">
  $(function () {
    datesDisabled = JSON.parse(document.getElementById('dates').value);
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
    //Date picker
    $('#datepicker').datepicker({
      format: 'dd/mm/yyyy',
      multidate:true,
      datesDisabled:datesDisabled
    })
  })
function remove(controller, id){
    var url = HOSTNAMEADMIN + '/' + controller + '/remove';
    if(confirm('Chắc chắn xóa?')){
        $.ajax({
            method: "post",
            url: url,
            data: {
                id : id, csrf_sitecom_token : document.getElementById('csrf_sitecom_token').value
            },
            success: function(response){
                document.getElementById('csrf_sitecom_token').value = response.reponse.csrf_hash;
                if(response.status == 200){
                    console.log(response);
                    console.log(response.message);
                    if(response.message != 'undefined'){
                        alert(response.message);
                    }
                    $('.remove_' + id).fadeOut();
                }
            },
            error: function(jqXHR, exception){
                // location.reload();
            }
        });
    }
}
$('[class^="datepicker-"] td').click(function(){
    console.log(1);
});
</script>
<script src="<?php echo site_url('assets/js/admin/') ?>showmodalimg.js"></script>
<script src="<?php echo site_url('assets/js/admin/') ?>detail-product.js"></script>