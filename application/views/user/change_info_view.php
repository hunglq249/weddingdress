<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="form-group">
                    <?php if ($this->session->flashdata('auth_message')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-success"></i> Alert!</h4>
                            <?php echo $this->session->flashdata('auth_message'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <h1 style="text-align: center;">Cập nhật tài khoản</h1>
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <?php echo form_label('Họ:','first_name').'<br />'; ?>
                        <?php echo form_error('first_name'); ?>
                        <?php echo form_input('first_name',$this->ion_auth->user()->row()->first_name, 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Tên:','last_name').'<br />'; ?>
                        <?php echo form_error('last_name'); ?>
                        <?php echo form_input('last_name',$this->ion_auth->user()->row()->last_name, 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('submit','Thay đổi', 'class="btn btn-primary btn-lg btn-block"').'<br /><br />'; ?>
                    </div>
                    
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>