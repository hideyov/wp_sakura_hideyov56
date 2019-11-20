<?php dynamic_sidebar('submenu'); ?>

<?php
$location_name = 'pickupnav';
$locations = get_nav_menu_locations();
$myposts = wp_get_nav_menu_items($locations[$location_name]);

if($myposts): ?>
<aside class="mymenu mymenu-thumb">
	<h2>こだわり記事</h2>
	<ul>
		<?php foreach($myposts as $post):
		if($post->object == 'post'):
		$post = get_post($post->object_id);
		setup_postdata($post); ?>
		<li><a href="<?php the_permalink(); ?>">
				<div class="thumb" style="background-image:
			url(<?php echo mythumb('thumbnail'); ?>)"></div>
				<div class="text">
					<?php the_title(); ?>
					<?php if(has_category()): ?>
					<?php $postcat=get_the_category(); ?>
					<span>
						<?php echo $postcat[0]->name; ?></span>
					<?php endif; ?>
				</div>
			</a></li>
		<?php endif; endforeach; ?>
	</ul>
</aside>

<aside class="mymenu mymenu-page">
	<h2>hideyov7</h2>
	<?php wp_nav_menu(array(
				'theme_location' => 'pagenav'
			)); ?>
</aside>

<?php wp_reset_postdata();
endif; ?>
