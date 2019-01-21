<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo site_url('node_modules/animate.css/') ?>animate.min.css">

<section id="products">
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

	<div class="container content">
		<div class="row">
			<div class="left col-xs-12 col-md-12 col-lg-3">
				<div class="accordion" id="sideBar">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<?php echo $this->lang->line('explore')?>
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#sideBar">
							<div class="card-body">
								<?php if (!empty($product_category['content'])): ?>
									<?php echo $product_category['content']; ?>
								<?php else:?>
									<?php echo $message_category ?>
								<?php endif ?>
								
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									<?php echo $this->lang->line('filter')?>
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#sideBar">
							<div class="card-body">
								<form method="post">
									<input type="hidden" name="uri" value="<?php echo $this->uri->segment(2);?>">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_sitecom_token" />
									<div class="item">
										<div class="item-head">
											<?php echo $this->lang->line('filter_rent')?>
										</div>
										<div class="item-body">
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="rent1" value="rent_0-199999">
												<label class="form-check-label" for="rent1">
													0 - 199.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="rent2" value="rent_200000-399999">
												<label class="form-check-label" for="rent2">
													200.000 - 399.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="rent3" value="rent_400000-899999">
												<label class="form-check-label" for="rent3">
													400.000 - 899.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="rent4" value="rent_900000-4999999">
												<label class="form-check-label" for="rent4">
													900.000 - 4.999.999 VND
												</label>
											</div>
										</div>
									</div>

									<div class="item">
										<div class="item-head">
											<?php echo $this->lang->line('price')?>
										</div>
										<div class="item-body">
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="sale1" value="sale_0-999999">
												<label class="form-check-label" for="sale1">
													0 - 999.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="sale2" value="sale_1000000-3999999">
												<label class="form-check-label" for="sale2">
													1.000.000 - 3.999.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="sale3" value="sale_4000000-7999999">
												<label class="form-check-label" for="sale3">
													4.000.000 - 7.999.999 VND
												</label>
											</div>
											<div class="form-check" onclick="check_radio(this)">
												<input class="form-check-input" type="radio" name="salerent" id="sale4" value="sale_8000000-19999999">
												<label class="form-check-label" for="sale4">
													8.000.000 - 19.999.999 VND
												</label>
											</div>
										</div>
									</div>
									<div class="item">
										<button class="btn btn-sm text right" style="color:  #444444;">Filter</button>
									</div>
								</form>
							<!-- 	<div class="item">
									<div class="item-head">
										Silhouette
									</div>
									<div class="item-body">
                                        <?php for ($i = 0; $i < 4; $i++) { ?>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="Radios3" id="Radios3-<?php echo $i ?>" value="option3-<?php echo $i ?>" <?php echo ($i == 0)? 'checked' : '' ?>>
												<label class="form-check-label" for="Radios<?php echo $i ?>">
													Ballgown (30)
												</label>
											</div>
                                        <?php } ?>
									</div>
								</div>

								<div class="item">
									<div class="item-head">
										Availability
									</div>
									<div class="item-body">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="Radios4" id="Radios4-1" value="option4-1" checked>
											<label class="form-check-label" for="Radios4">
												In stock
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="Radios4" id="Radios4-2" value="option4-2">
											<label class="form-check-label" for="Radios4">
												Out of Stock
											</label>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="right col-xs-12 col-md-12 col-lg-9">
				<div class="grid">
					<div class="grid-sizer"></div>
					<?php if (count($product) == 0): ?>
            			<?php echo $message;?>
					<?php endif ?>
                    <?php foreach ($product as $key => $value): ?>
                    	<?php $data = json_decode($value['data'],true); ?>
                    	<?php $common = json_decode($value['common'],true); ?>
                    	
						<div class="grid-item <?php echo ($key % 2 == 0)? 'grid-item-mt' : '' ?> wow fadeInUp" data-wow-delay="0.<?php echo $key ?>s">
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
										<?php echo $value['title'] ?>
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
		</div>
	</div>

</section>

<!-- Isotope JS -->
<script src="<?php echo site_url('node_modules/isotope-layout/') ?>dist/isotope.pkgd.min.js"></script>
<!-- imageLoaded JS -->
<script src="<?php echo site_url('node_modules/imagesloaded/') ?>imagesloaded.pkgd.min.js"></script>
<!-- wow JS -->
<script src="<?php echo site_url('node_modules/wow.js/') ?>dist/wow.min.js"></script>
<script type="text/javascript">
	function check_radio(ev){
// 		for (var i = 0; i < document.querySelectorAll('.form-check').length; i++){
//             if (document.querySelectorAll('.form-check')[i].querySelector('input').checked === true){
// 				document.querySelectorAll('.form-check')[i].querySelector('input').checked = false;
//             }
//         }
// 		ev.querySelector('input').setAttribute('checked','checked')
	}
</script>
<script>
    $(document).ready(function(){
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.grid-sizer'
            }
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.isotope('layout');
        });

        new WOW().init();

		{
		    // Sticky sideBar on Scroll

			$(document).scroll(function(){
			    if ($(window).scrollTop() > 200){
			        $('#sideBar').addClass('active');
				}

                if ($(window).scrollTop() < 200){
                    $('#sideBar').removeClass('active');
                }
			})
		}
    })
</script>