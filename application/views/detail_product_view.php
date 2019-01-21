<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo site_url('node_modules/animate.css/') ?>animate.min.css">

<section id="detail-product">
    <div class="container" id="detail">
		<div class="row">
			<div class="left col-xs-12 col-md-12 col-lg-7">
				<div class="slider-product">
					<ul class="thumbnails">
						<?php foreach ($detail['collection'] as $key => $value): ?>
							<li>
								<a href="#slide<?php echo $key+1; ?>">
									<img src="<?php echo base_url('assets/upload/product/'.$detail['slug'].'/'.$value)?>" />
								</a>
							</li>
						<?php endforeach ?>
					</ul>
					<ul class="slides">
						<?php foreach ($detail['collection'] as $key => $value): ?>
							<li id="slide<?php echo $key+1; ?>">
								<img src="<?php echo base_url('assets/upload/product/'.$detail['slug'].'/'.$value)?>" alt="" />
							</li>
						<?php endforeach ?>
					</ul>

				</div>
			</div>

			<div class="right col-xs-12 col-md-12 col-lg-5">
				<div class="content">
					<div class="overall item">
						<h4>
							<?php echo $this->lang->line('name_product')?>: <?php echo $detail['product_title'];?>
						</h4>
						<h5>
							<?php echo $this->lang->line('category')?>: <?php echo $detail['parent_title']; ?>
						</h5>
						<span class="code"><?php echo $this->lang->line('code')?>: <?php echo $detail['data']['ma_san_pham'];?></span>

						<table class="table table-borderless">
							<?php if ($detail['common']['rent'] == 'true'): ?>
								<tr>
									<td><?php echo $this->lang->line('filter_rent')?></td>
									<td>
	                                    <span class="price-rent">
											<?php if ($detail['common']['showpromotion_rent'] == 'true'): ?>
												<?php echo $detail['pricepromotion_rent'] ?> vnd <small><?php echo $detail['price_rent'] ?> vnd</small>
											<?php else:?>
			                                    <?php echo $detail['price_rent'] ?> vnd 
											<?php endif ?>
	                                    </span>
									</td>
								</tr>
							<?php endif ?>
							<tr>
								<td><?php echo $this->lang->line('price')?></td>
								<td>
									<span class="price-buy">
										<?php if ($detail['common']['sale'] == 'true' && $detail['common']['showpromotion'] == 'true'): ?>
											<?php echo $detail['pricepromotion'] ?> vnd <small><?php echo $detail['price'] ?> vnd</small>
										<?php else:?>
		                                    <?php echo $detail['price'] ?> vnd 
										<?php endif ?>
                                    </span>
								</td>
							</tr>
						</table>
					</div>

					<div class="detail item">
						<h5>
							<?php echo $this->lang->line('detail_infomation')?>
						</h5>

						<table class="table table-borderless">
							<tr>
								<td><?php echo $this->lang->line('color')?></td>
								<td colspan="2">
									<span><?php echo $detail['product_data_lang']['mau_san_pham'];?></span>
								</td>
							</tr>
							<tr>
								<td><?php echo $this->lang->line('size')?></td>
								<td>
									<?php echo $detail['data']['kich_thuoc_cho_san_pham'];?>
								</td>
								<td>
								</td>
								<!-- <td>
									<a href="javascript:void(0)">
										Size & Fit Guide
									</a>
								</td> -->
							</tr>
						</table>
					</div>

					<div class="desc item">
						<h5>
							<?php echo $this->lang->line('detail_infomation')?>
						</h5>

						<p class="paragraph">
							<?php echo $detail['product_content']; ?>
							<a href="javascript:void(0)"><?php echo $this->lang->line('read_more')?>...</a>
						</p>
						<form action="<?php echo base_url('booking');?>" method="get">
							
							<button type="submit" class="btn btn-primary" type="button">
								<i class="fas fa-check-circle"></i> <?php echo $this->lang->line('contact_now')?>
							</button>
						</form>
					</div>

					<div class="share item">
						<h5>
							<?php echo $this->lang->line('share')?>: <a href="javascript:void(0)"><i class="fab fa-facebook-square"></i> </a>
						</h5>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="container" id="related">
		<h1>
			<?php echo $this->lang->line('related_products')?>
		</h1>

		<div class="row">
			<?php foreach ($detail['product_related'] as $key => $value): ?>
				<?php $data = json_decode($value['data'],true); ?>
                <?php $common = json_decode($value['common'],true); ?>
				<div class="item col-xs-12 col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.<?php echo $key ?>s">
					<div class="image">
						<div class="mask">
							<a href="<?php echo base_url('san-pham/'.$value['slug']) ?>">
								<img src="<?php echo base_url('assets/upload/product/'.$value['slug'].'/'.$value['image']); ?>" alt="First slide">
							</a>
						</div>

						<div class="name">
							<h6>Name of Product Jessica</h6>
						</div>
					</div>

					<div class="content">
						<h4>
							<a href="<?php echo base_url('san-pham/'.$value['slug']) ?>">
								<?php echo $value['product_title'] ?>
							</a>
						</h4>
						<h6>Code: <?php echo $data['ma_san_pham'] ?></h6>
						<div class="price">
							<?php if ($common['rent'] == 'true'): ?>
                                <span class="price-rent">
									<?php if ($common['showpromotion_rent'] == 'true'): ?>
										<?php echo $value['pricepromotion_rent'] ?> vnd <small><?php echo $value['price_rent'] ?> vnd</small>
									<?php else:?>
	                                    <?php echo $value['price_rent'] ?> vnd 
									<?php endif ?>
                                </span>
							<?php endif ?>
							<span class="price-buy">
							<?php if ($common['sale'] == 'true' && $common['showpromotion'] == 'true'): ?>
								<?php echo $value['pricepromotion'] ?> vnd <small><?php echo $value['price'] ?> vnd</small>
							<?php else:?>
                                <?php echo $value['price'] ?> vnd 
							<?php endif ?>
                            </span>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<!-- wow JS -->
<script src="<?php echo site_url('node_modules/wow.js/') ?>dist/wow.min.js"></script>

<script>
    $(document).ready(function(){
        new WOW().init();
    })
</script>