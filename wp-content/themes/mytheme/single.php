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
		<article class="single-article" <?php post_class('kiji'); ?>>

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

			<div class="share">
				<ul>
					<li><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title().' - '.get_bloginfo('name')); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;via=hideyovic_ge" onclick="window.open(this.href, 'SNS', 'width=500, height=300, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-tw">
							<i class="fab fa-twitter"></i>
							Twitter<span> でシェア</span>
						</a></li>
					<li><a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>" onclick="window.open(this.href, 'SNS', 'width=500, height=300, menubar=no, toolbar=no, scrollbar=yes'); return false;" class="share-fb">
							<i class="fab fa-facebook"></i>
							Facebook<span> でシェア</span>
						</a></li>
				</ul>
			</div>
			
			<div class="pagination-single">
				<p>
				<span class="oldpage"><?php previous_post_link(); ?></span>
				<span class="newpage"><?php next_post_link(); ?></span>
				</p>
			</div>
			
			<?php if(has_category()) {
				$cats = get_the_category();
				$catkwds = array();
				foreach($cats as $cat) {
					$catkwds[] = $cat->term_id;
				}
			} ?>
			 
		</article>
		
			<?php
			$myposts = get_posts( array(
				'post_type' => 'post',
				'posts_per_page' => '4',
				'post__not_in' => array($post->ID),
				'category__in' => $catkwds,
				'orderby' => 'rand'
			));
			if($myposts): ?>
			<aside class="mymenu mymenu-thumb mymenu-related">
				<h2>関連記事</h2>
				<ul>
					<?php foreach($myposts as $post):
					setup_postdata($post); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<div class="thumb" style="background-image:
							url(<?php echo mythumb('thumbnail'); ?>)">
							</div>
							<div class="text">
								<?php the_title(); ?>
							</div>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</aside>
			<?php wp_reset_postdata(); endif; ?>
			
		<?php endwhile; endif; ?>
		
	</div><!-- .contents -->

	<div class="sub">
		<?php get_sidebar(); ?>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>

<?php // アクセス数の記録
$count_key = 'postviews';
$count = get_post_meta($post->ID, $count_key, true);
$count++;
update_post_meta($post->ID, $count_key, $count);
?>
