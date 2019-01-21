<section id="list-collections">
    <div class="container-fluid">
        <div class="row">
            <div class="left col-xs-12 col-md-8">
                <div class="list-items">
                    <div class="row">
                    	<?php foreach ($collection1 as $key => $value): ?>
	                        <div class="special col-xs-12 col-md-7">
								<div class="mask">
									<img src="<?php echo base_url('assets/upload/collection/'.$value['slug'].'/'.$value['image_left']);?>" alt="image latest collection">
									<div class="wrapper"></div>
									<div class="content">
										<h6 class="subtitle">
											<?php echo $this->lang->line('new_collection')?>
										</h6>
										<h1>
											<a href="<?php echo base_url('bo-suu-tap/'.$value['slug']) ?>">
												<?php echo $value['title'] ?>
											</a>
											<div class="line"></div>
										</h1>
									</div>
								</div>
	                        </div>
                    	<?php endforeach ?>
                        <div class="others col-md-5">
                        	<?php foreach ($collection2 as $key => $value): ?>
								<div class="item">
									<div class="mask">
										<img src="<?php echo base_url('assets/upload/collection/'.$value['slug'].'/'.$value['image_left']);?>" alt="image latest collection">

										<div class="wrapper"></div>

										<div class="content">
											<h4>
												<a href="<?php echo base_url('bo-suu-tap/'.$value['slug']) ?>">
													<?php echo $value['title'] ?>
												</a>
											</h4>
										</div>
									</div>
								</div>
							<?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right col-xs-12 col-md-4">
            	<?php foreach ($collection3 as $key => $value): ?>
					<div class="item">
						<div class="mask">
							<img src="<?php echo base_url('assets/upload/collection/'.$value['slug'].'/'.$value['image_left']);?>" alt="image latest collection">
							<div class="wrapper"></div>

							<div class="content">
								<h1>
									<a href="<?php echo base_url('products/') ?>">
										<?php echo $value['title'] ?>
									</a>

									<div class="line"></div>
								</h1>
							</div>
						</div>
					</div>
				<?php endforeach ?>
            </div>
        </div>
    </div>
</section>