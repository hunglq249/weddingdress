<link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.css">
<style type="text/css">
    label{
        font-weight: bold;
    }
    .has-error{
        color:red;
    }
    .has-error input{
        border:1px solid red;
    }
    .form-row{
        margin-top: 10px;
        margin-bottom: : 10px;
        display: block;
        
    }
    .form-row label{
        margin-bottom: 2px;

    }
    .form-row .form-check{
        float: left;

    }
    #form-contact .container .row .row{
        padding-top: 10px;
    }
    #form-contact .container .row .row.invalid-feedback{
        padding-top: 0px;
        margin-left: 5px;
    }
</style>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control" id="csrf_sitecom_token">
<section id="form-contact">
    <div class="cover">
        <div class="mask">
            <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80" alt="image contact form cover">

            <div class="overlay"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div style="margin-left: -5px;">
                    <h3 class="subtitle-md">Contact Us</h3>

                    <h2 class="title-md">Feeling free to say "Hello" to us</h2>

                    <p class="paragraph">
                        We will not market to you unless you request this service. At Bose, we take privacy preferences seriously. Please visit our Privacy policy for more information.
                    </p>
                </div>
                <?php
                echo form_open_multipart('homepage/get_data_to_send_mail', array('class' => 'form-horizontal'));
                ?>
                <?php echo $form;?>
                    



                <!-- <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_name');
                    echo form_input('contact_name', set_value('contact_name'), 'class="form-control" id="contact_name" placeholder="Your Name"');
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_mail');
                    echo form_input('contact_mail', set_value('contact_mail'), 'class="form-control" id="contact_mail" placeholder="Your E-mail"');
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_phone');
                    echo form_input('contact_phone', set_value('contact_phone'), 'class="form-control" id="contact_phone" placeholder="Your Phone Number"');
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_address');
                    echo form_input('contact_address', set_value('contact_address'), 'class="form-control" id="contact_address" placeholder="Your Address"');
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_job');
                    echo form_input('contact_job', set_value('contact_job'), 'class="form-control" id="contact_job" placeholder="Your Job (optional)"');
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                        $option = array(
                            '0' => 'Select One Reason',
                            '1' => 'Speakers',
                            '2' => 'Headphones',
                            '3' => 'Accessories',
                            '4' => 'Need Helps',
                            '5' => 'Advise Corner'
                        )
                    ?>
                    <?php
                    echo form_error('contact_reason');
                    echo form_dropdown('contact_reason', $option, '0', 'class="form-control" id="contact_job"')
                    ?>
                </div>

                <div class="form-row col-xs-12">
                    <?php
                    echo form_error('contact_message');
                    echo form_textarea('contact_message', set_value('contact_message'), 'class="form-control" id="contact_message" placeholder="Message..."');
                    ?>
                </div> -->

                <div class="form-row row" style="margin-top: 5px;padding-top: 30px">
                    <span type="button" class="btn btn-primary" id="submit_shared" data-dismiss="modal" onclick="submit_shared()">Xác nhận</span>
                    <!-- <?php echo form_submit('submit', 'SUBMIT', 'class="btn btn-primary"'); ?> -->
                </div>
                <?php echo form_close(); ?>

                <p class="paragraph">
                    To acknowledge the receipt of your message, we will send an email confirmation to the address you provided. Please note: All email from Soundon Customer Service will originate from support@soundon.store. Some spam filters may prevent our replies from reaching you. If you do not receive your email confirmation within a few hours, please add support@soundon.store to the safe list for your spam filter.
                </p>
            </div>
        </div>
    </div>
    <div id="encypted_ppbtn_all"></div>
</section>
<script src="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.js"></script>
<script src="<?php echo site_url('assets/js/') ?>contact.js"></script>