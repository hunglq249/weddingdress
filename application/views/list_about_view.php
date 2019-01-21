<section id="about">
    <div class="container-fluid" id="desc">
		<div class="container">
			<div class="row">
				<div class="left col-xs-12 col-md-6">
					<img src="<?php echo base_url('assets/upload/post_category/'.$category['image']) ?>" alt="about image">
				</div>

				<div class="right col-xs-12 col-md-6">
					<h1><?php echo $category['post_category_title'] ?></h1>

					<p class="paragraph">
						<?php echo $category['post_category_content'] ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="why-us">
		<div class="heading">
			<h1><?php echo $this->lang->line('choose')?></h1>
		</div>

		<div class="body">
			<div class="row">
				<?php foreach ($about as $key => $value): ?>
					<div class="item col-xs-12 col-md-4">
						<div class="inner">
							<h3>
								<?php echo $value['post_title'] ?>
							</h3>

							<p class="paragraph">
								<?php echo $value['post_description'] ?>
							</p>

							<div class="mask">
								<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
									<img src="<?php echo base_url('assets/upload/post/'.$value['slug'].'/'.$value['image']) ?>" alt="why us image <?php echo $key ?>">
								</a>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>