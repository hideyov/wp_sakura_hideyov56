<?php get_header(); ?>
<div class="container">

	<?php if(get_header_image()): ?>
	<div class="hero">
		<div class="hero-img" style="background-image: url(<?php header_image(); ?>)"></div>
		<div class="hero-text animated bounceInRight bounceInRight-delay"><?php bloginfo('description'); ?></div>
	</div>
	<?php endif; ?>

	<div class="contents">
		<?php
			$location_name = 'pagenav';
			$locations = get_nav_menu_locations();
			$myposts = wp_get_nav_menu_items($locations[$location_name]);
			if($myposts): ?>
		<aside class="mymenu mymenu-top">

			<ul>
				<?php foreach($myposts as $post):
				if($post->object == 'page'):
					$post = get_post($post->object_id);
					setup_postdata($post); ?>
				<li><a href="<?php the_permalink(); ?>">
						<div class="thumb" style="background-image: url(<?php echo mythumb('medium'); ?>)"></div>
						<div class="text">
							<h2>
								<?php the_title(); ?>
							</h2>
							<?php the_excerpt(); ?>
						</div>
					</a></li>
				<?php endif; endforeach; ?>
			</ul>
		</aside>
		<?php wp_reset_postdata(); endif; ?>
	</div>

	<div class="sub">
		<?php $myposts = get_posts(array(
			'post_type' => 'post',
			'posts_per_page' => '7'
		));
	if($myposts): ?>
		<aside class="mymenu mymenu-news">
			<h2>最近の投稿</h2>
			<ul>
				<?php foreach($myposts as $post): setup_postdata($post); ?>
				<li><a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a></li>
				<?php endforeach; ?>
			</ul>

		</aside>
		<?php wp_reset_postdata(); endif; ?>
	</div>

</div>

<?php get_footer(); ?>
