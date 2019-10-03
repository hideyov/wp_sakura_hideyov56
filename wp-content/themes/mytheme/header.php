<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>
		<?php wp_title('|', true, 'right'); ?>
		<?php bloginfo( 'name' ); ?>
	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/4e5eb2ce7f.js" crossorigin="anonymous"></script>
<!--	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Mansalva|Special+Elite&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>?ver=<?php echo date('U'); ?>">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>	
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>	
	<![endif]-->
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
