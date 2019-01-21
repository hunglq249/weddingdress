<section id="detail-blog">
    <div class="container">
		<div class="back" style="z-index: 9999;">
			<a onclick="goBack()">
				<i class="fas fa-arrow-left"></i> <?php echo $this->lang->line('back')?>
			</a>
		</div>
		<div class="cover">
			<div class="mask">
				<img src="<?php echo base_url('assets/upload/post/'.$detail['slug'].'/'.$detail['image']); ?>" alt="blog cover image">
			</div>
		</div>

		<article>
			<div class="heading">
				<h3>
					<?php echo $detail['post_title'] ?>
				</h3>
				<span class="category">
					<?php echo $this->lang->line('post_in')?> <a href="<?php echo base_url('danh-muc/'.$category['slug']) ?>"><?php echo $category['post_category_title'] ?></a>
				</span>
			</div>
			<div class="content">
				<p class="paragraph"><?php echo $detail['post_content'] ?></p>
			</div>
		</article>

		<div class="recommended">
			<div class="heading">
				<h4>
					<?php echo $this->lang->line('related_post')?>
				</h4>
			</div>
			<div class="row">
				<?php foreach ($post_related as $key => $value): ?>
					<div class="item col-xs-12 col-md-4 wow fadeInUp" data-wow-delay="0.<?php echo $key ?>s">
						<div class="image">
							<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
								<img src="<?php echo base_url('assets/upload/post/'.$value['slug'].'/'.$value['image']); ?>" alt="blog cover image">
							</a>
						</div>

						<div class="content">
							<h4>
								<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>">
									<?php echo $value['title']; ?>
								</a>
							</h4>
							<p class="paragraph">
								<?php echo $value['description']; ?>
								<a href="<?php echo base_url('bai-viet/'.$value['slug']) ?>"><?php echo $this->lang->line('read_more')?>...</a>
							</p>
							<span class="date" style="display: none">20 Oct 2018</span>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>

<script>
    function goBack() {
        window.history.back();
    }
</script>