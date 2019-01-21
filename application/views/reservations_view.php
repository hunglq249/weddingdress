<section id="reservations">
    <div class="container">
        <div class="row head">
            <div class="col-xs-12 col-sm-6 offset-sm-6 right">
                <h3 class="subtitle-md">Reservations</h3>

                <h2 class="title-md">Book your table now to get the Best Experience</h2>

                <p class="paragraph">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget tristique augue. Donec laoreet nec quam et semper. Integer ut felis euismod, tempus dolor vel, gravida ante. Nulla facilisi.
                </p>

                <p class="paragraph">
                    If you have a trouble booking a table, please contact us directly!
                </p>

                <div class="row">
                    <div class="item col-xs-12 col-sm-6">
                        <p class="paragraph">Location</p>
                        <p class="paragraph">
                            917 Rosenbaum Lodge Apt. 831
                        </p>
                    </div>

                    <div class="item col-xs-12 col-sm-6">
                        <p class="paragraph">Location</p>
                        <p class="paragraph">
                            917 Rosenbaum Lodge Apt. 831
                        </p>
                    </div>
                </div>
                <div class="row body">
                    <?php
                    echo form_open_multipart('homepage/get_data_to_send_mail', array('class' => 'form-horizontal'));
                    ?>

                    <div class="form-group col-xs-12 col-sm-12">
                        <?php
                        echo form_error('contact_name');
                        echo form_input('contact_name', set_value('contact_name'), 'class="form-control" id="contact_name" placeholder="Họ và tên (*)"');
                        ?>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12">
                        <?php
                        echo form_error('contact_mail');
                        echo form_input('contact_mail', set_value('contact_mail'), 'class="form-control" id="contact_mail" placeholder="Nhập Email của bạn (*)"');
                        ?>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12">
                        <?php
                        echo form_error('contact_phone');
                        echo form_input('contact_phone', set_value('contact_phone'), 'class="form-control" id="contact_phone" placeholder="Nhập số điện thoại của bạn (*)"');
                        ?>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12">
                        <?php
                        echo form_error('contact_address');
                        echo form_input('contact_address', set_value('contact_address'), 'class="form-control" id="contact_address" placeholder="Địa chỉ (*)"');
                        ?>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12">
                        <?php
                        echo form_error('contact_message');
                        echo form_textarea('contact_message', set_value('contact_message'), 'class="form-control" id="contact_message" placeholder="Để lại lời nhắn đến với chúng tôi ..."');
                        ?>
                    </div>

                    <div class="col-xs-12 col-sm-12">
                        <?php echo form_submit('submit', 'Gửi đăng ký', 'class="btn btn-primary"'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>

    <div class="cover d-none d-sm-block">
        <div class="mask">
            <img src="https://images.unsplash.com/photo-1520218576172-c1a2df3fa5fc?ixlib=rb-0.3.5&s=0a0cd3b2d02209eb9efb15325386d4c8&auto=format&fit=crop&w=675&q=80" alt="contact cover image">
        </div>
    </div>

    <div id="side-title">
        <h1 class="title-xlg">Reservations</h1>
    </div>
</section>