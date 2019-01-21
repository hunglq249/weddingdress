<!-- /.content-wrapper -->
<footer>
	<div class="container-fluid top">
		<div class="container">
			<div class="row">
				<div class="item col-xs-12 col-md-6 col-lg-3">
					<h6>Customer Service</h6>

					<ul>
						<li>
							<a href="<?php echo base_url('') ?>">
								Contact Us
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Help and FAQs
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Size Infomation
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Help?
							</a>
							<a href="tel:092 315 42 89">
								<u>092 315 42 89</u>
							</a>
						</li>
					</ul>
				</div>

				<div class="item col-xs-12 col-md-6 col-lg-3">
					<h6>Resources</h6>

					<ul>
						<li>
							<a href="<?php echo base_url('') ?>">
								Special Offer
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Wedding Solutions
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Inspiration & Guidance
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Look Books & Guides
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Videos
							</a>
						</li>
					</ul>
				</div>

				<div class="item col-xs-12 col-md-6 col-lg-3">
					<h6>About Us</h6>

					<ul>
						<li>
							<a href="<?php echo base_url('') ?>">
								Quality & Craftmanship
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Company Info
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Careers
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Investor Relations
							</a>
						</li>
					</ul>
				</div>

				<div class="item col-xs-12 col-md-6 col-lg-3">
					<h6>Our Store</h6>

					<ul>
						<li>
							<a href="<?php echo base_url('') ?>">
								Find our Store
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Schedule an Appointment
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('') ?>">
								Information and Services
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid bottom">
		<div class="container">
			<nav>
				<div class="nav-brand">
					<a href="<?php echo base_url('') ?>">
						<!--<img src="<?php echo site_url('assets/img/') ?>logo.png" alt="logo Sound ON">-->
						Ciel de Gia
					</a>
				</div>
				<div class="nav-main">
					<ul>
						<li>
							<a href="<?php echo base_url('about') ?>">
								<?php echo $this->lang->line('about')?>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url('bo-suu-tap') ?>">
								<?php echo $this->lang->line('collection')?>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url('nhom/phu-dau-dip-le-hoi') ?>">
								<?php echo $this->lang->line('bridesmaids')?>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url('nhom/phu-kien') ?>">
								<?php echo $this->lang->line('accessories')?>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url('danh-muc/blogs-tin-tuc') ?>">
								<?php echo $this->lang->line('blogs')?>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url('danh-muc/khuyen-mai') ?>">
								<?php echo $this->lang->line('promotion')?>
							</a>
						</li>
					</ul>

					<ul>

						<li>
							<a href="<?php echo base_url('booking/') ?>">
								Contact Us
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="container">
			<p class="paragraph">
				@cieldegia | 125B Lò Đúc, Hà Nội
			</p>

			<p class="paragraph">
				092 315 42 89
			</p>
		</div>
	</div>

</footer>


<?php if(empty($username->id)): ?>
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="loginLabel">Login</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		    <div class="login-box-body">
		        <p class="login-box-msg">Đăng nhập để truy cập</p>
		        <?php if ($this->session->flashdata('auth_message')): ?>
		            <?php echo $this->session->flashdata('auth_message'); ?>
		        <?php endif ?>
		        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
		        <div class="form-group">
		            <?php echo form_label('Email', 'identity'); ?>
		            <?php echo form_error('identity'); ?>
		            <?php echo form_input('identity', '', 'class="form-control"'); ?>
		        </div>
		        <div class="form-group">
		            <?php echo form_label('Mật Khẩu', 'password'); ?>
		            <?php echo form_error('password'); ?>
		            <?php echo form_password('password', '', 'class="form-control"'); ?>
		        </div>
		        <div class="form-group">
		            <label>
		                <?php echo form_checkbox('remember', '1', FALSE); ?> Remember me
		            </label>
		        </div>
		        <div class="form-group">
		            <?php echo form_submit('submit', 'Log in', 'class="btn btn-primary btn-lg btn-block"'); ?>
		        </div>
		        <?php echo form_close(); ?>
		        <label>
				<a style="color: blue;font-size: 1.2rem;font-weight: normal;" href="<?php echo base_url('')?>" data-toggle="modal" data-target="#forgot_password" data-whatever="@getbootstrap"  class="close" data-dismiss="modal" aria-label="Close">
					Quên mật khẩu
				</a></label><br>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="forgot_passwordLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="forgot_passwordLabel">Forgot password</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		    <div class="login-box-body">
		        <p class="login-box-msg">Quên mật khẩu</p>

		        <?php echo $this->session->flashdata('message'); ?>
		        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
		        <div class="form-group">
		            <?php echo form_label('Email', 'email'); ?>
		            <?php echo form_error('email'); ?>
		            <?php echo form_input('email', '', 'class="form-control"'); ?>
		        </div>
		        <div class="form-group">
		            <?php echo form_submit('submit', 'Xác Nhận', 'class="btn btn-primary btn-lg btn-block"'); ?>
		        </div>

		        <?php echo form_close(); ?>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="signupLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="signupLabel">Sign up</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div>
	            <?php if ($this->session->flashdata('auth_message')): ?>
	                <div class="alert alert-success alert-dismissible">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
	                    <?php echo $this->session->flashdata('auth_message'); ?>
	                </div>
	            <?php endif ?>
	            <h1 style="text-align: center;">Đăng ký tài khoản</h1>
	            <?php echo form_open('', array('class' => 'form-horizontal')); ?>
	                <div class="form-group">
	                    <?php echo form_label('Họ:','first_name').'<br />'; ?>
	                    <?php echo form_error('first_name'); ?>
	                    <?php echo form_input('first_name',set_value('first_name'), 'class="form-control"'); ?>
	                </div>
	                <div class="form-group">
	                    <?php echo form_label('Tên:','last_name').'<br />'; ?>
	                    <?php echo form_error('last_name'); ?>
	                    <?php echo form_input('last_name',set_value('last_name'), 'class="form-control"'); ?>
	                </div>
	                <div class="form-group">
	                    <?php echo form_label('Tên Tài Khoản:','username').'<br />'; ?>
	                    <?php echo form_error('username'); ?>
	                    <?php echo form_input('username',set_value('username'), 'class="form-control"'); ?>
	                </div>
	                <div class="form-group">
	                    <?php echo form_label('Email:','email').'<br />'; ?>
	                    <?php echo form_error('email'); ?>
	                    <?php echo form_input('email',set_value('email'), 'class="form-control"'); ?>
	                </div>
	                <div class="form-group">
	                    <?php echo form_label('Mật Khẩu:', 'password').'<br />'; ?>
	                    <?php echo form_error('password'); ?>
	                    <?php echo form_password('password', '','class="form-control"'); ?>
	                </div>
	                <div class="form-group">
	                    <?php echo form_label('Xác Nhận Mật Khẩu:', 'confirm_password').'<br />'; ?>
	                    <?php echo form_error('confirm_password'); ?>
	                    <?php echo form_password('confirm_password', '','class="form-control"').'<br />'; ?>
	                </div>
	                <?php echo form_submit('submit','Đăng Ký', 'class="btn btn-primary btn-lg btn-block"').'<br /><br />'; ?>
	            <?php echo form_close(); ?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
<?php else: ?>
	<div class="modal fade" id="Personal" tabindex="-1" role="dialog" aria-labelledby="PersonalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="PersonalLabel">Personal information</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div>
	            <h4 style="text-align: center;">Thông tin cá nhân</h4>
	            <table class="table table-inverse">
	            	<tbody>
	            		<tr>
	            			<th>Họ và tên</th>
	            			<td><?php echo $username->first_name.' '.$username->last_name;?></td>
	            			<td>
	            				<a href="<?php echo base_url('')?>" class="edit_name" data-toggle="modal" data-target="#edit_name" data-whatever="@getbootstrap" class="close" data-dismiss="modal" aria-label="Close">
									Edit
								</a>
							</td>
	            		</tr>
	            		<tr>
	            			<th>Email</th>
	            			<td><?php echo $username->email;?></td>
	            			<td></td>
	            		</tr>
	            		<tr>
	            			<th>Update</th>
	            			<td>
	            				<a href="<?php echo base_url('')?>" class="edit_password" data-toggle="modal" data-target="#edit_password" data-whatever="@getbootstrap" class="close" data-dismiss="modal" aria-label="Close">
									Đổi mật khẩu
								</a>
	            			</td>
	            			<td></td>
	            		</tr>
	            	</tbody>
	            </table>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="edit_name" tabindex="-1" role="dialog" aria-labelledby="edit_nameLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="edit_nameLabel">Update information</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div>
	            <h4 style="text-align: center;">Thay đổi thông tin cá nhân</h4>
	            <table class="table table-inverse">
	            	<tbody>
	            		<tr>
	            			<th>Họ</th>
	            			<td><input type="text" class="form-control" value="<?php echo $username->first_name;?>"></td>
	            		</tr>
	            		<tr>
	            			<th>Tên</th>
	            			<td><input type="text" class="form-control" value="<?php echo $username->last_name;?>"></td>
	            		</tr>
	            	</tbody>
	            </table>
	            <div class="col-xs-12" style="float: right;padding-right: 10px;">
	            	<span class="btn btn-primary" style="margin-left:5px " class="close" data-dismiss="modal" aria-label="Close">Hủy</span>
	            	<span class="btn btn-primary">Xác nhận</span>
	            </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-labelledby="edit_passwordLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="edit_passwordLabel">Update Password</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div>
	            <h4 style="text-align: center;">Thay đổi mật khẩu</h4>
	            <table class="table table-inverse">
	            	<tbody>
	            		<tr>
	            			<th>Mật khẩu cũ</th>
	            			<td><input type="text" class="form-control" placeholder="Nhập mật khẩu cũ"></td>
	            		</tr>
	            		<tr>
	            			<th>Mật khẩu mới</th>
	            			<td><input type="text" class="form-control" placeholder="Nhập mật khẩu mới"></td>
	            		</tr>
	            		<tr>
	            			<th>Xác nhận mật khẩu mới</th>
	            			<td><input type="text" class="form-control" placeholder="Xác nhận mật khẩu mới"></td>
	            		</tr>
	            	</tbody>
	            </table>
	            <div class="col-xs-12" style="float: right;padding-right: 10px;">
	            	<span class="btn btn-primary" style="margin-left:5px " class="close" data-dismiss="modal" aria-label="Close">Hủy</span>
	            	<span class="btn btn-primary">Xác nhận</span>
	            </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="commentLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="commentLabel">Comment</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div>
	            <h4 style="text-align: center;">Bình luận</h4>
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <span class="label label-default">Rating:</span>
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star-half-alt"></i></li>
                </div>
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <input type="" name="" class="form-control">
                </div>
	            <div class="col-xs-12" style="float: right;">
	            	<span class="btn btn-primary" style="margin-left:5px " class="close" data-dismiss="modal" aria-label="Close">Hủy</span>
	            	<span class="btn btn-primary">Xác nhận</span>
	            </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
<?php endif; ?>


<!-- popper js -->
<script src="<?php echo site_url('node_modules/popper.js/') ?>dist/umd/popper.min.js"></script>

<!-- Bootstrap js -->
<script src="<?php echo site_url('node_modules/bootstrap/') ?>dist/js/bootstrap.min.js"></script>

<!-- Script -->
<script src="<?php echo site_url('assets/js/') ?>script.min.js"></script>

<!-- Cart -->

<script src="<?php echo site_url('assets/js/') ?>cart.js"></script>
<script>
    var url = window.location.protocol + '//' + window.location.hostname;
    var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
    $(document).ready(function(){
        $.ajax({
            method: "get",
            url: url + '/soundon/checkout',
            data: {
                cart: JSON.stringify(cart)
            },
            success: function(response){
            	console.log(response);
            },
            error: function(jqXHR, exception){
            }
        });
    })
    function login(){
    	return false;
    }
</script>
<script>
    $(".change-language").click(function(){
        $.ajax({
            method: "GET",
            url: "http://localhost/weddingdress/homepage/change_language",
            data: {
                lang: $(this).data('language')
            },
            async:false,
            success: function(res){
                if(res.message == 'changed'){
                    window.location.reload();
                }
            },
            error: function(){

            }
        });
    });
</script>
</body>
</html>