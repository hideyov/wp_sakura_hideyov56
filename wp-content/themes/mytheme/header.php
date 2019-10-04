<!DOCTYPE html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns#">
	<meta charset="UTF-8">
	<title>
		<?php wp_title('|', true, 'right'); ?>
		<?php bloginfo( 'name' ); ?>
	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/4e5eb2ce7f.js" crossorigin="anonymous"></script>
	<!--	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	-->
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Mansalva|Special+Elite&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>?ver=<?php echo date('U'); ?>">

	<?php if(is_single()): // 記事の個別ページ用のメタデータ ?>
	<meta name="description" content="<?php echo wp_trim_words($post->post_content, 100, '...'); ?>">	
	
	<?php if(has_tag()): ?>
	<?php $tags = get_the_tags();
		$kwds = array();
		foreach($tags as $tag) {
			$kwds[] = $tag->name;
		} ?>
	<meta name="keywords" content="<?php echo implode(',', $kwds); ?>">
	<?php endif; ?>
	
	<meta property="og:type" content="article">
	<meta property="og:title" content="<?php the_title(); ?>">
	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:description" content="<?php echo wp_trim_words($post->post_content, 100, '...'); ?>">

	<?php if(has_post_thumbnail()): ?>
		<?php $postthumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
		<meta property="og:image" content="<?php echo $postthumb[0]; ?>">
	<?php elseif(preg_match('/wp-image-(\d+)/s', $post->post_content, $thumbid)): ?>
	<?php $postthumb = wp_get_attachment_image_src($thumbid[1], 'large'); ?>
		<meta property="og:image" content="<?php echo $postthumb[0]; ?>">
	<?php else: ?>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/logo_skia_trans-4x.png">
	<?php endif; ?>
	<?php endif; ?>
	
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
	<meta property="og:locale" content="ja_JP">
<!--
	[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>	
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>	
	<![endif]
-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header>
		<div class="header-inner">
			<div class="site">
				<h1>
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/logo_skia_trans-4x.png" alt="<?php bloginfo('name'); ?>" width="133" height="30">
					</a>
				</h1>
			</div>
		</div><!-- .header-inner -->
	</header>
