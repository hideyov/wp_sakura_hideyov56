<?php
$location_name = 'pickupnav_web';
$locations = get_nav_menu_locations();
$myposts = wp_get_nav_menu_items($locations[$location_name]);

if($myposts): ?>
<aside class="mymenu mymenu-thumb">
	<h2>pick up 'web'</h2>
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
<?php wp_reset_postdata();
endif; ?>
