
<div class="content-wrapper" id="create-product-view">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cập nhật
            <small>
                màu
            </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->flashdata('message_error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?php echo $this->session->flashdata('message_error'); ?>
                    </div>
                <?php endif ?>
                <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal','id' => 'register-form'));
                ?>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <div class="box box-default">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <h4 class="box-title">Thông tin cơ bản</h4>
                                </div>
                                <div class="row">
                                    <span><?php echo $this->session->flashdata('message'); ?></span>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 5px;">
                                    <?php
                                        echo form_label("Tên địa chỉ", 'title');
                                        echo form_error('title');
                                        echo form_input('title', $detail['title'], 'class="form-control" ');
                                    ?>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 5px;">
                                    <?php
                                        echo form_label("Địa chỉ", 'address');
                                        echo form_error('address');
                                        echo form_input('address', $detail['address'], 'class="form-control" ');
                                    ?>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 5px;">
                                    <?php
                                        echo form_label("Số điện thoại", 'tel');
                                        echo form_error('tel');
                                        echo form_input('tel', $detail['tel'], 'class="form-control" ');
                                    ?>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 5px;">
                                    <?php
                                        echo form_label("Email", 'email');
                                        echo form_error('email');
                                        echo form_input('email', $detail['email'], 'class="form-control" ');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="col-xs-12">
                            <ul class="nav nav-tabs" role="tablist" id="nav-product">
                                <a class="btn btn-primary" id="go-back" onclick="history.back(-1);" >Go back</a>
                                <input type="submit" name="submit_shared" id="submit-shared" value="OK" class="btn btn-primary" style="float: right;">
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>