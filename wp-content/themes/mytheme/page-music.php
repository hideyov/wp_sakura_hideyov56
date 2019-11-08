<?php
/*
Template Name: page-music.php
*/
?>

<?php get_header(); ?>

<div class="sub-header">
	<div class="bread">
		<ol>
			<li>
				<a href="<?php echo home_url(); ?>">
					<i class="fa fa-home"></i><span>TOP</span></a>
			</li>
			<li>
				<?php if(has_category()): ?>
				<?php $postcat=get_the_category(); ?>
				<?php echo get_category_parents($postcat[0], true, '</li><li>'); ?>
				<?php endif; ?>
				<a>
					<?php the_title(); ?></a>
			</li>
		</ol>
	</div>
</div>

<div class="container">
	<div class="contents">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<article class="page-article" <?php post_class('kiji'); ?>>

			<div class="kiji-tag">
				<?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>
			</div>
			<h1>
				<?php the_title(); ?>
			</h1>

			<div class="kiji-date">
				<i class="fa fa-pencil"></i>
				<time datetime="<?php echo get_the_date('Y-m-d'); ?>">
					投稿：
					<?php echo get_the_date(); ?>
				</time>

				<?php if(get_the_modified_date('Ymd') > get_the_date('Ymd')): ?>
				|
				<time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>">
					更新：
					<?php echo get_the_modified_date(); ?>
				</time>
				<?php endif; ?>
			</div>


			<?php if(has_post_thumbnail() && $page == 1): ?>
			<div class="catch">
				<?php the_post_thumbnail('large'); ?>
			</div>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php wp_link_pages( array(
				'before' => '<div class="pagenation"><ul><li>',
				'separator' => '</li><li>',
				'after' => '</li></ul></div>',
				'pagelink' => '<span>%</span>'
			)); ?>

		</article>
		<?php endwhile; endif; ?>
	</div><!-- .contents -->

	<div class="sub">
		<?php get_sidebar('music'); ?>
		<aside class="mymenu mymenu-page">
			<h2>hideyov56</h2>
			<?php wp_nav_menu(array(
				'theme_location' => 'pagenav'
			)); ?>
		</aside>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>
