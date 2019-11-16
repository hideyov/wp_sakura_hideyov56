<?php get_header(); ?>

<div class="sub-header">
	<div class="bread">
		<ol>
			<li>
				<a href="<?php echo home_url(); ?>">
					<i class="fa fa-home"></i><span>TOP</span></a>
			</li>
			<li>
				<a>検索結果</a>
			</li>
		</ol>
	</div>
</div>

<div class="container">
	<div class="contents">
		
		<article class="tag-article">
			
		<h1><?php the_time('Y年m月'); ?>の記事</h1>
		
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		
		<?php get_template_part('overview', 'medium'); ?>	
		
		<?php endwhile; endif; ?>
		</article>
		
		<div class="pagination pagination-index">
			<?php echo paginate_links(array(
				'type' => 'list',
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;'
			)); ?>
		</div>
	</div><!-- .contents -->

	<div class="sub">
		<?php get_sidebar(); ?>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>
