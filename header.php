<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="alternate" href="https://www.twistermc.com" hreflang="en-us" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a href="#mainContent" class="linkSkip">Skip To Main Content (Click This)</a>
<div id="wrapper">

	<header id="header" role="banner">

		<?php if (has_nav_menu('topbar')): ?>
			<nav class="nav-container group" id="nav-topbar" role="navigation">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>

				<div class="container">
					<div class="toggle-search"><i class="fa fa-search"></i></div>
					<div class="search-expand">
						<div class="search-expand-inner">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div><!--/.container-->

			</nav><!--/#nav-topbar-->
		<?php endif; ?>

		<div class="container">
			<div class="pad group">
				<?php echo tmc_site_title(); ?>
				<h1 class="site-description"><?php bloginfo( 'description' ); ?></h1>
			</div>
		</div><!--/.container-->

	</header><!--/#header-->

	<div id="page" class="container">
		<div class="main group">
