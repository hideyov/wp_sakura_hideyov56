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

	<?php if(is_single() || is_page()): // 記事の個別ページ用のメタデータ ?>
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

		<meta property="og:image" content="<?php echo mythumb('large'); ?>">
	<?php endif; ?>
	
	<?php if(is_home()): // トップページ用のメタデータ ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">	
	
		<?php $allcats = get_categories();
			$kwds = array();
			foreach ($allcats as $allcat) {
				$kwds[] = $allcat->name;
			} ?>
		<meta name="keywords" content="<?php echo implode(',', $kwds); ?>">
		<meta proterty="og:type" content="website">
		<meta proterty="og:title" content="<?php bloginfo('name'); ?>">
		<meta proterty="og:url" content="<?php home_url('/'); ?>">
		<meta proterty="og:description" content="<?php bloginfo('description'); ?>">
		<meta proterty="og:image" content="<?php echo get_template_directory_uri(); ?>/logo_skia_trans-4x.png">
	<?php endif; // トップページ用のメタデータ、ここまで ?>

	<?php if(is_category() || is_tag()): // カテゴリー・タグページ用のメタデータ ?>
		<?php if(is_category()) {
			$termid = $cat;
			$taxname = 'category';
		} elseif(is_tag()) {
			$termid = $tag_id;
			$taxname = 'post_tag';
		} ?>
	
		<meta name="description" content="<?php single_term_title(); ?>に関する記事の一覧です。">	
		
		<?php $childcats = get_categories(array('child_of' => $termid));
		$kwds = array();
		$kwds[] = single_term_title('', false);
		foreach($childcats as $childcat) {
			$kwds[] = $childcat->name;
		} ?>
	
		<meta name="keywords" content="<?php echo implode(',', $kwds); ?>">
		<meta proterty="og:type" content="website">
		<meta proterty="og:title" content="<?php single_term_title(); ?>に関する記事 | <?php bloginfo('name'); ?>">
		<meta proterty="og:url" content="<?php echo get_term_link($termid, $taxname); ?>">
		<meta proterty="og:description" content="<?php single_term_title(); ?>に関する記事の一覧です。">
		<meta proterty="og:image" content="<?php echo get_template_directory_uri(); ?>/logo_skia_trans-4x.png">
	<?php endif; // カテゴリー・タグページ用のメタデータ、ここまで ?>

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
			
			<?php wp_nav_menu(array(
				'theme_location' => 'sitenav',
				'container' => 'nav',
				'container_class' => 'mainmenu',
				'container_id' => 'mainmenu'
			)); ?>
			
		</div><!-- .header-inner -->
	</header>
