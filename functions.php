<?php
// Ensure Dashicons are loaded for all users (front-end and back-end)
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('dashicons');
});
// Preload critical font for performance
if ( ! function_exists( 'alx_preload_assets' ) ) {
	function alx_preload_assets() {
		echo '<link rel="preload" href="' . esc_url( get_template_directory_uri() . '/fonts/titilliumweb-regular-webfont.woff2' ) . '" as="font" type="font/woff2" crossorigin>';
	}
}
add_action( 'wp_head', 'alx_preload_assets', 2 );
/**
 * Theme Functions
 * 
 * @package AnewTwo
 */

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

// Use a child theme instead of placing custom functions here
// http://codex.wordpress.org/Child_Themes

//Remove jQuery migrate
function remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) { // Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array(
				'jquery-migrate'
			));
		}
	}
}

add_action('wp_default_scripts', 'remove_jquery_migrate');


/*  Theme Configuration (hardcoded settings)
/* ------------------------------------ */
define( 'ANEW_LOGO_URL', 'https://www.twistermc.com/blog-u/wp-content/uploads/2013/11/twistermc-logo-white.png' );
define( 'ANEW_LOGO_MAX_HEIGHT', 60 );
define( 'ANEW_LAYOUT_GLOBAL', 'col-2cl' );
define( 'ANEW_CONTAINER_WIDTH', 1380 );
define( 'ANEW_COLOR_ACCENT', '#3b8dbd' );
define( 'ANEW_COLOR_TOPBAR', '#26272b' );
define( 'ANEW_COLOR_HEADER', '#3b8dbd' );
define( 'ANEW_COLOR_FOOTER', '#33363b' );
define( 'ANEW_EXCERPT_LENGTH', 55 );
define( 'ANEW_FOOTER_WIDGETS', 4 );

/* ------------------------------------------------------------------------- *
 *  Localization & Translation Support
/* ------------------------------------------------------------------------- */

if ( ! function_exists( 'anew_load_textdomain' ) ) {
	function anew_load_textdomain() {
		load_theme_textdomain( 'anew', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'anew_load_textdomain' );

/** JetPack Add Image To Tweet **/
add_filter(
	'jetpack_publicize_options', function( $option ) {
		$option['attach_media'] = true;
		return $option;
	}
);

/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */

if ( ! function_exists( 'alx_load' ) ) {

	function alx_load() {
		// Load custom widgets
		require_once get_template_directory() . '/functions/widgets/alx-tabs.php';


	}

}
add_action( 'after_setup_theme', 'alx_load' );


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */

/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'alx_setup' ) ) {

	function alx_setup() {
		// Set content width (max width for images/embeds)
		$GLOBALS['content_width'] = 600;
		
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );

		// Enable post format support
		add_theme_support( 'post-formats', array( 'image', 'video' ) );

		// Enable title-tag support
		add_theme_support( 'title-tag' );
		
		// Enable HTML5 markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script'
		) );
		
		// Enable custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => ANEW_LOGO_MAX_HEIGHT,
			'width'       => 150,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		
		// Enable responsive embeds
		add_theme_support( 'responsive-embeds' );
		
		// Enable block-based widgets
		add_theme_support( 'widgets-block-editor' );

		// Thumbnail sizes
		add_image_size( 'thumb-small', 160, 160, true );
		add_image_size( 'thumb-medium', 520, 245, true );
		add_image_size( 'thumb-large', 700, 329, true );

		// Custom menu areas
		register_nav_menus( array(
			'topbar' => 'Topbar',
			'footer' => 'Footer',
		) );
	}

}
add_action( 'after_setup_theme', 'alx_setup' );


/*  Add lazy loading to post thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'alx_lazy_load_thumbnails' ) ) {

	function alx_lazy_load_thumbnails( $attr, $attachment, $size ) {
		// Don't lazy load the first image on single posts/pages
		if ( is_singular() && ! did_action( 'the_post_thumbnail' ) ) {
			$attr['fetchpriority'] = 'high';
		} else {
			$attr['loading'] = 'lazy';
		}
		return $attr;
	}

}
add_filter( 'wp_get_attachment_image_attributes', 'alx_lazy_load_thumbnails', 10, 3 );


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebars' ) ) {

	function alx_sidebars() {
		$sidebars = array(
			'primary' => array(
				'name' => __('Primary', 'anew'),
				'description' => __('Normal full width sidebar', 'anew'),
			),
			'footer-1' => array(
				'name' => __('Footer 1', 'anew'),
				'description' => __('Widgetized footer', 'anew'),
			),
			'footer-2' => array(
				'name' => __('Footer 2', 'anew'),
				'description' => __('Widgetized footer', 'anew'),
			),
			'footer-3' => array(
				'name' => __('Footer 3', 'anew'),
				'description' => __('Widgetized footer', 'anew'),
			),
			'footer-4' => array(
				'name' => __('Footer 4', 'anew'),
				'description' => __('Widgetized footer', 'anew'),
			),
		);
		
		foreach ( $sidebars as $id => $sidebar ) {
			register_sidebar( array(
				'name' => $sidebar['name'],
				'id' => $id,
				'description' => $sidebar['description'],
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			) );
		}
	}

}
add_action( 'widgets_init', 'alx_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */
if ( ! function_exists( 'alx_scripts' ) ) {

	function alx_scripts() {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'wp-i18n' ), '1.0.5', true );
		// Defer only theme scripts explicitly
		wp_script_add_data( 'scripts', 'defer', true );
	}

}
add_action( 'wp_enqueue_scripts', 'alx_scripts' );


/*  Enqueue css - Modular approach for better performance
/* ------------------------------------ */
if ( ! function_exists( 'alx_styles' ) ) {

	function alx_styles() {
		$theme_version = '3.2.1'; // Update version when CSS changes
		$template_uri = get_template_directory_uri();
		
		// Base styles (required)
		wp_enqueue_style( 'anew-base', $template_uri . '/css/base.css', array(), $theme_version );
		wp_enqueue_style( 'anew-layout', $template_uri . '/css/layout.css', array(), $theme_version );
		wp_enqueue_style( 'anew-utilities', $template_uri . '/css/utilities.css', array(), $theme_version );
		
		// Component styles
		wp_enqueue_style( 'anew-navigation', $template_uri . '/css/components/navigation.css', array(), $theme_version );
		wp_enqueue_style( 'anew-site-frame', $template_uri . '/css/components/site-frame.css', array(), $theme_version ); // Merged header+footer
		wp_enqueue_style( 'anew-posts', $template_uri . '/css/components/posts.css', array(), $theme_version );
		wp_enqueue_style( 'anew-sidebar', $template_uri . '/css/components/sidebar.css', array(), $theme_version );
		wp_enqueue_style( 'anew-widgets', $template_uri . '/css/components/widgets.css', array(), $theme_version );
		
		// Conditional: Comments (only on single posts/pages with comments open)
		if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
			wp_enqueue_style( 'anew-comments', $template_uri . '/css/components/comments.css', array(), $theme_version );
		}
		
		// Theme customizations
		wp_enqueue_style( 'anew-theme', $template_uri . '/css/theme.css', array(), $theme_version );
		
		// Note: style.css is kept as WordPress theme requirement (header only, no actual styles loaded)
		
		// Load Dashicons only if user is logged in
		if ( is_user_logged_in() ) {
			wp_enqueue_style( 'dashicons' );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'alx_styles' );


/*  Add defer to scripts
/* ------------------------------------ */
/* Global script deferral removed to avoid races with core/plugins (e.g. wp-i18n).
   Use wp_script_add_data( 'handle', 'defer', true ); for theme scripts instead. */


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_custom_sidebars' ) ) {

	function alx_custom_sidebars() {

		$sidebars = get_option( 'sidebar-areas' );

		if ( ! empty( $sidebars ) && is_array( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				if ( isset( $sidebar['title'] ) && ! empty( $sidebar['title'] ) && 
				     isset( $sidebar['id'] ) && ! empty( $sidebar['id'] ) && 
				     ( $sidebar['id'] !== 'sidebar-' ) ) {
					
					register_sidebar( array(
						'name' => sanitize_text_field( $sidebar['title'] ),
						'id' => sanitize_key( strtolower( $sidebar['id'] ) ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3>',
						'after_title' => '</h3>',
					) );
				}
			}
		}
	}
}
add_action( 'widgets_init', 'alx_custom_sidebars' );


/* ------------------------------------------------------------------------- *
 *  Template functions
/* ------------------------------------------------------------------------- */

/*  Layout class
/* ------------------------------------ */
if ( ! function_exists( 'alx_layout_class' ) ) {

	function alx_layout_class() {
		// Return layout class
		return ANEW_LAYOUT_GLOBAL;
	}

}


/*  Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebar_primary' ) ) {
	function alx_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Return sidebar
		return $sidebar;
	}

}

/*  Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'tmc_site_title' ) ) {

	function tmc_site_title() {
		$site_name = get_bloginfo('name');
		
		// Check for custom logo first (modern approach)
		if ( has_custom_logo() ) {
			$logo = get_custom_logo();
		} 
		// Fallback to hardcoded logo URL
		elseif ( ! empty( ANEW_LOGO_URL ) ) {
			$logo = sprintf(
				'<a href="%s" rel="home"><img src="%s" alt="%s" width="50" height="60" fetchpriority="high"></a>',
				esc_url( home_url('/') ),
				esc_url( ANEW_LOGO_URL ),
				esc_attr( $site_name )
			);
		} 
		// Final fallback to site name text
		else {
			$logo = sprintf(
				'<a href="%s" rel="home">%s</a>',
				esc_url( home_url('/') ),
				esc_html( $site_name )
			);
		}

		$sitename = '<p class="site-title">' . $logo . '</p>' . "\n";

		return $sitename;
	}

}


/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_images' ) ) {

	function alx_post_images( $args=array() ) {
		$post = get_post();
		if ( ! $post ) {
			return array();
		}

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}

}


/* ------------------------------------------------------------------------- *
 *  Admin panel functions
/* ------------------------------------------------------------------------- */

/*  Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_formats_script' ) ) {

	function alx_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( !in_array( $hook, array('post.php','post-new.php') ) )
			return;
		wp_enqueue_script( 'post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array(), '1.0.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'alx_post_formats_script' );


/* ------------------------------------------------------------------------- *
 *  Filters
/* ------------------------------------------------------------------------- */

/*  Body class
/* ------------------------------------ */
if ( ! function_exists( 'alx_body_class' ) ) {

	function alx_body_class( $classes ) {
		$classes[] = alx_layout_class();
		$classes[] = 'topbar-enabled';
		$classes[] = 'light-header-text';
		return $classes;
	}

}
add_filter( 'body_class', 'alx_body_class' );


/*  Add responsive container to embeds
/* ------------------------------------ */
if ( ! function_exists( 'alx_embed_html' ) ) {

	function alx_embed_html( $html ) {
		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jet pack


/*  Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'alx_thumbnail_upscale' ) ) {

	function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}

}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );


/* ------------------------------------------------------------------------- *
 *  Actions
/* ------------------------------------------------------------------------- */

/*  Preload critical assets
/* ------------------------------------ */



/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

// add custom code to the header
function twistermc_head_additions() {
	// Favicon links
	$favicons = array(
		'apple-touch-icon' => array(
			array('sizes' => '57x57', 'href' => '/favicons/apple-touch-icon-57x57.png'),
			array('sizes' => '60x60', 'href' => '/favicons/apple-touch-icon-60x60.png'),
			array('sizes' => '72x72', 'href' => '/favicons/apple-touch-icon-72x72.png'),
			array('sizes' => '76x76', 'href' => '/favicons/apple-touch-icon-76x76.png'),
			array('sizes' => '114x114', 'href' => '/favicons/apple-touch-icon-114x114.png'),
			array('sizes' => '120x120', 'href' => '/favicons/apple-touch-icon-120x120.png'),
			array('sizes' => '144x144', 'href' => '/favicons/apple-touch-icon-144x144.png'),
			array('sizes' => '152x152', 'href' => '/favicons/apple-touch-icon-152x152.png'),
			array('sizes' => '180x180', 'href' => '/favicons/apple-touch-icon-180x180.png'),
		),
		'icon' => array(
			array('type' => 'image/png', 'sizes' => '32x32', 'href' => '/favicons/favicon-32x32.png'),
			array('type' => 'image/png', 'sizes' => '194x194', 'href' => '/favicons/favicon-194x194.png'),
			array('type' => 'image/png', 'sizes' => '96x96', 'href' => '/favicons/favicon-96x96.png'),
			array('type' => 'image/png', 'sizes' => '192x192', 'href' => '/favicons/android-chrome-192x192.png'),
			array('type' => 'image/png', 'sizes' => '16x16', 'href' => '/favicons/favicon-16x16.png'),
		),
	);
	
	foreach ($favicons['apple-touch-icon'] as $icon) {
		printf('<link rel="apple-touch-icon" sizes="%s" href="%s">', esc_attr($icon['sizes']), esc_url($icon['href']));
	}
	foreach ($favicons['icon'] as $icon) {
		printf('<link rel="icon" type="%s" href="%s" sizes="%s">', esc_attr($icon['type']), esc_url($icon['href']), esc_attr($icon['sizes']));
	}
	?>
	<link rel="manifest" href="/favicons/manifest.json">
	<link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#3F8EBC">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php
	
	// Twitter/Social meta tags
	$twitter_card = 'summary';
	$format = get_post_format();
	if ( $format === 'image' ) {
		$twitter_card = 'summary_large_image';
	}
	?>
	<meta name="twitter:card" content="<?php echo esc_attr($twitter_card); ?>">
	<meta name="twitter:site" content="@TwisterMc">
	<meta name="twitter:creator" content="@TwisterMc">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo('name') ); ?>">
	<meta property="fb:admins" content="500138493">
	<?php

}

add_action( 'wp_head', 'twistermc_head_additions', 100 );

function jetpackme_related_posts_time_restriction( $date_range ) {
	$date_range = array(
		'from' => 1420070400,
		'to'   => time(),
	);

	return $date_range;

}

add_filter( 'jetpack_relatedposts_filter_date_range', 'jetpackme_related_posts_time_restriction' );

/**
 * Remove Jetpack's External Media feature.
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		$disable_external_media = <<<JS
document.addEventListener( 'DOMContentLoaded', function() {
    wp.hooks.removeFilter( 'blocks.registerBlockType', 'external-media/individual-blocks' );
    wp.hooks.removeFilter( 'editor.MediaUpload', 'external-media/replace-media-upload' );
} );
JS;
		wp_add_inline_script( 'jetpack-blocks-editor', $disable_external_media );
	}
);
