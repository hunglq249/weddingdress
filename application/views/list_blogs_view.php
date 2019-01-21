<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo site_url('node_modules/animate.css/') ?>animate.min.css">

<section id="blogs">
	<div class="container-fluid" id="grid-controls" style="display: none;">
		<div class="container">
			<ul class="nav nav-pills nav-fill">
				<li class="nav-item">
					<button class="nav-link" data-filter="*">All Posts</button>
				</li>
				<li class="nav-item">
					<button class="nav-link" data-filter=".plan">Wedding Planning</button>
				</li>
				<li class="nav-item">
					<button class="nav-link" data-filter=".tip">Tips & Trends</button>
				</li>
				<li class="nav-item">
					<button class="nav-link" data-filter=".career">Career</button>
				</li>
				<li class="nav-item">
					<button class="nav-link" data-filter=".sale">Sale</button>
				</li>
			</ul>
		</div>
	</div>
	<div class="container" id="grid-content">
		<div class="grid">
			<div class="grid-sizer"></div>
            <?php foreach ($blog as $key => $value): ?>
				<div class="grid-item <?php echo ($key % 2 == 0)? 'plan' : '' ?> wow fadeInUp" data-wow-delay="0.<?php echo $key ?>s">
					<div class="image">
						<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
							<img src="<?php echo base_url('assets/upload/post/'.$value['slug'].'/'.$value['image']) ?>">
						</a>
					</div>

					<div class="content">
						<h4>
							<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
								<?php echo $value['title'] ?>
							</a>
						</h4>
						<p class="paragraph">
							<?php echo $value['description'] ?>
							<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>"><?php echo $this->lang->line('read_more')?>...</a>
						</p>
						<span class="date" style="display: none;">20 Oct 2018</span>
					</div>
				</div>
            <?php endforeach ?>
		</div>
	</div>
</section>

<!-- Isotope JS -->
<script src="<?php echo site_url('node_modules/isotope-layout/') ?>dist/isotope.pkgd.min.js"></script>
<!-- imageLoaded JS -->
<script src="<?php echo site_url('node_modules/imagesloaded/') ?>imagesloaded.pkgd.min.js"></script>
<!-- wow JS -->
<script src="<?php echo site_url('node_modules/wow.js/') ?>dist/wow.min.js"></script>

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

        $('#grid-controls .nav').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
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