<?php
/**
 * Header Template
 * 
 * @package Anew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Inline Critical CSS for faster initial render -->
	<style><?php include( get_template_directory() . '/css/critical.css' ); ?></style>

	<?php wp_head(); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="alternate" href="https://www.twistermc.com" hreflang="en-us" />

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a href="#mainContent" class="skip-link screen-reader-text"><?php _e( 'Skip to content', 'anew' ); ?></a>
<div id="wrapper">

	<header class="site-header">

		<?php if (has_nav_menu('topbar')): ?>
			<nav class="nav-container group" id="nav-topbar" aria-label="<?php esc_attr_e( 'Main Navigation', 'anew' ); ?>">
				<button class="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation', 'anew' ); ?>"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>

				<div class="container">
					<button class="toggle-search" aria-label="<?php esc_attr_e( 'Toggle search', 'anew' ); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
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
				<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			</div>
		</div><!--/.container-->

	</header><!--/#header-->

	<div id="page" class="container">
		<main class="main group">
