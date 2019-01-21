<!-- OWL CAROUSEL CSS -->
<link rel="stylesheet" href="<?php echo site_url('assets/lib/owl-carousel/css/') ?>owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo site_url('assets/lib/owl-carousel/css/') ?>owl.theme.default.min.css">

<section id="homepage">
	<div class="container-fluid slider">
		<div id="slider" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php foreach ($banner as $key => $value): ?>
					<div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
						<div class="mask">
							<img src="<?php echo base_url('assets/upload/banner/'.$value['image']); ?>" alt="First slide">
						</div>

						<div class="content">
							<!-- <h6 class="subtitle">
								New Collection
							</h6> -->
							<h1>
								<?php if($value['type'] == 1):?>
									<?php echo $value['category']['collection_title']; ?>
								<?php else : ?>
									<?php echo $value['category']['product_category_title']; ?>
								<?php endif;?>
								<div class="line"></div>
							</h1>

							<div class="row">
								<div class="item col">
									<p class="paragraph">
										<?php if($value['type'] == 1):?>
											<?php echo $value['category']['collection_description']; ?>
										<?php else : ?>
											<?php echo $value['category']['product_category_description']; ?>
										<?php endif;?>
									</p>
								</div>
							</div>
							<?php if($value['type'] == 1):?>
								<a href="<?php echo base_url('bo-suu-tap/'.$value['category']['slug']);?>" class="btn btn-outline" role="button">
							<?php else : ?>
								<a href="<?php echo base_url('nhom/'.$value['category']['slug']);?>" class="btn btn-outline" role="button">
							<?php endif;?>
								<?php echo $this->lang->line('view_detail')?>
							</a>
						</div>
					</div>
				<?php endforeach ?>
				
			</div>
			<a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
				<i class="fas fa-arrow-left"></i>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#slider" role="button" data-slide="next">
				<i class="fas fa-arrow-right"></i>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="container-fluid ads-short">
		<h5><?php echo $this->lang->line('search_dress')?> 800.000 VND</h5>
		<form method="post" action="<?php echo base_url('nhom'); ?>">
			<input type="hidden" name="number_search" value="800000">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
			<button href="<?php ?>" class="btn btn-light" role="button">
				<?php echo $this->lang->line('view_detail')?>
			</button>
		</form>
	</div>

	<div class="container-fluid new-arrivals">
		<div class="row">
			<div class="left col-xs-12 col-md-7">
				<div class="mask">
					<img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bfef355c0cf4898112f3c63cd8bb4bf9&auto=format&fit=crop&w=1950&q=80" alt="new arrivals image">

					<div class="content">
						<h1><?php echo $this->lang->line('new_arrivals')?></h1>
						<h2><span>Fall</span> 2018</h2>
					</div>
				</div>
			</div>

			<div class="right col-xs-12 col-md-5">
				<div id="arrivals" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php foreach ($product as $key => $value): ?>
							<div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
								<div class="mask">
									<img src="<?php echo base_url('assets/upload/product/'.$value['slug'].'/'.$value['image']); ?>" alt="First slide">
								</div>
								<div class="overlay">
									<div class="content">
										<h6 class="subtitle"><?php echo $value['category'] ?></h6>
										<h3><?php echo $value['product_title']; ?></h3>

										<p class="paragraph"><?php echo $value['product_description']; ?></p>

										<a href="<?php echo base_url('san-pham/'.$value['slug']) ?>" class="btn btn-outline" role="button">
											<?php echo $this->lang->line('view_detail')?>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
					<a class="carousel-control-prev" href="#arrivals" role="button" data-slide="prev">
						<i class="fas fa-arrow-left"></i>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#arrivals" role="button" data-slide="next">
						<i class="fas fa-arrow-right"></i>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid ads-md" style="background-image: url('https://images.unsplash.com/photo-1487163731010-29462200612c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=817b0c5460d4ea65f3baaabc78b0ddd4&auto=format&fit=crop&w=1953&q=80');">
		<div class="overlay">
			<div class="content">

				<h3><?php echo $this->lang->line('search_dress')?> 800.000 VND</h3>
				<form method="post" action="<?php echo base_url('nhom'); ?>">
					<input type="hidden" name="number_search" value="800000">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
					<button href="<?php ?>" class="btn btn-outline" role="button">
						<?php echo $this->lang->line('view_detail')?>
					</button>
				</form>
			</div>
		</div>
	</div>

	<div class="container-fluid special">
		<div class="heading">
			<h1><?php echo $this->lang->line('customer_Choice')?></h1>
		</div>
		<div class="body">
			<div class="owl-carousel">
				<?php foreach ($product_hot as $key => $value): ?>
					<?php $data = json_decode($value['data'],true); ?>
					<div class="item">
						<a href="<?php echo base_url('san-pham/'.$value['slug']) ?>">
							<div class="mask">
								<img src="<?php echo base_url('assets/upload/product/'.$value['slug'].'/'.$value['image']); ?>" alt="First slide">
							</div>
							<div class="content">
								<h5><?php echo $value['product_title']; ?></h5>
								<h6>Serial <?php echo $data['ma_san_pham'] ?></h6>
							</div>
						</a>
					</div>
				<?php endforeach ?>
				
			</div>
		</div>
	</div>

	<div class="container-fluid story">
		<div class="heading">
			<h1><?php echo $this->lang->line('our_story')?></h1>
		</div>
		<div class="body">
			<div class="row">
				<?php foreach ($about as $key => $value): ?>
					<div class="item col-xs-12 col-md-6">
						<div class="top">
							<div class="mask">
								<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
									<img src="<?php echo base_url('assets/upload/post/'.$value['slug'].'/'.$value['image']); ?>" alt="First slide">
								</a>
							</div>
							<div class="content">
								<h6 class="subtitle"><?php  echo ($lang=='vi') ? 'Về chúng tôi' : 'About';?></h6>
								<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
									<h3 class="text-wrapper"><?php echo $value['post_title'] ?></h3>
								</a>
							</div>
						</div>
						<div class="bottom">
							<div class="line"></div>
							<p class="paragraph">
								<?php echo $value['post_description'] ?>
							</p>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="foot">
			<a href="<?php echo base_url('about') ?>" class="btn btn-primary" role="button">
				<?php echo $this->lang->line('see_all')?>
				
			</a>
		</div>
	</div>

	<div class="container-fluid connection">
		<h1><?php echo $this->lang->line('get_connected')?></h1>
		<div class="line"></div>
		<ul>
			<li>
				<a href="javascript:void(0);" target="_blank">
					<i class="fab fa-facebook-square"></i>
				</a>
			</li>

			<li>
				<a href="javascript:void(0);" target="_blank">
					<i class="fab fa-instagram"></i>
				</a>
			</li>

			<li>
				<a href="javascript:void(0);" target="_blank">
					<i class="fab fa-pinterest-square"></i>
				</a>
			</li>

			<li>
				<a href="javascript:void(0);" target="_blank">
					<i class="fab fa-youtube-square"></i>
				</a>
			</li>
		</ul>
	</div>

</section>

<!-- OWL CAROUSEL JS -->
<script src="<?php echo site_url('assets/lib/owl-carousel/js/') ?>owl.carousel.min.js"></script>
<script>
	$('header').addClass('light');

    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
			loop: true,
			center: true,
			margin: 30,
			responsiveClass: true,
			responsive: {
			    0:{
			        items: 1
				},

				768:{
			        items: 3
				},

				1024:{
			        items: 5
				}
			}
		});

        $(window).scroll(function () {
            //if you hard code, then use console
            //.log to determine when you want the
            //nav bar to stick.
            'use strict';
            if ($(window).scrollTop() > 0) {
                $('header').removeClass('light');
            }
            if ($(window).scrollTop() === 0) {
                $('header').addClass('light');
            }
        });
    });
</script>

