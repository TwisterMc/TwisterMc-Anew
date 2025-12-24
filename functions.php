<?php
/**
 * Theme Functions
 * 
 * @package Anew
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

// Content width
if ( !isset( $content_width ) ) { $content_width = 600; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'alx_setup' ) ) {

	function alx_setup() {
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );

		// Enable post format support
		add_theme_support( 'post-formats', array( 'image', 'video' ) );

		// Enabled new title-tag support
		add_theme_support( 'title-tag' );

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
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.5', true );
		// Add defer attribute to non-critical scripts
		wp_script_add_data( 'scripts', 'defer', true );
	}

}
add_action( 'wp_enqueue_scripts', 'alx_scripts' );


/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'alx_styles' ) ) {

	function alx_styles() {
		wp_enqueue_style( 'style-2', get_template_directory_uri() . '/style.css', array(), '1.0.8', false );
		// Load Dashicons only if user is logged in
		if ( is_user_logged_in() ) {
			wp_enqueue_style( 'dashicons' );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'alx_styles' );


/*  Add defer to scripts
/* ------------------------------------ */
if ( ! function_exists( 'alx_defer_scripts' ) ) {

	function alx_defer_scripts( $tag, $handle, $src ) {
		// Don't defer jQuery as other scripts depend on it
		if ( 'jquery-core' === $handle || 'jquery' === $handle ) {
			return $tag;
		}
		// Defer other scripts
		if ( strpos( $tag, 'defer' ) === false ) {
			$tag = str_replace( ' src=', ' defer="defer" src=', $tag );
		}
		return $tag;
	}

}
add_filter( 'script_loader_tag', 'alx_defer_scripts', 10, 3 );


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
		$logo_url = ANEW_LOGO_URL;
		$site_name = get_bloginfo('name');
		
		if ( ! empty( $logo_url ) ) {
			$logo = sprintf(
				'<img src="%s" alt="%s" width="50" height="60" fetchpriority="high">',
				esc_url( $logo_url ),
				esc_attr( $site_name )
			);
		} else {
			$logo = esc_html( $site_name );
		}

		$link = sprintf(
			'<a href="%s" rel="home">%s</a>',
			esc_url( home_url('/') ),
			$logo
		);

		$sitename = '<p class="site-title">' . $link . '</p>' . "\n";

		return $sitename;
	}

}


/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_images' ) ) {

	function alx_post_images( $args=array() ) {
		global $post;

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
		wp_enqueue_script( 'post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array( 'jquery' ) );
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




// auto set featured image
function tmc_autoset_featured() {
	global $post;
	$already_has_thumb = has_post_thumbnail( $post->ID );
	if ( ! $already_has_thumb ) {
		$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
		if ( $attached_image ) {
			foreach ( $attached_image as $attachment_id => $attachment ) {
				set_post_thumbnail( $post->ID, $attachment_id );
			}
		}
	}
}

add_action( 'the_post', 'tmc_autoset_featured' );
add_action( 'save_post', 'tmc_autoset_featured' );
add_action( 'draft_to_publish', 'tmc_autoset_featured' );
add_action( 'new_to_publish', 'tmc_autoset_featured' );
add_action( 'pending_to_publish', 'tmc_autoset_featured' );
add_action( 'future_to_publish', 'tmc_autoset_featured' );

/**
 * Disable Ads appearing below the post content.
 */

function wordads_disable_inpost_pages() {
	$tmc_pfx_date = get_the_date( 'Y' );

	if ( is_front_page() || is_page() || $tmc_pfx_date > 2017 ) {
		add_filter( 'wordads_inpost_disable', '__return_true' );
	}
	add_filter( 'wordads_header_disable', '__return_true' );
}

add_action( 'wp_head', 'wordads_disable_inpost_pages', 10 );

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

// Add block editor (Gutenberg) compatibility: theme.json support, block styles, wide/full align, editor styles, and color palette.
add_action( 'after_setup_theme', function() {
	// Add support for block styles
	add_theme_support( 'wp-block-styles' );
	// Add support for full and wide align images/blocks
	add_theme_support( 'align-wide' );
	// Add support for editor styles
	add_theme_support( 'editor-styles' );
	// Load editor stylesheet (create this file if you want custom editor CSS)
	add_editor_style( 'editor-style.css' );
	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );
	// Add support for custom color palette (optional, matches your theme)
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Accent', 'anew' ), 'slug' => 'accent', 'color' => ANEW_COLOR_ACCENT ],
		[ 'name' => __( 'Topbar', 'anew' ), 'slug' => 'topbar', 'color' => ANEW_COLOR_TOPBAR ],
		[ 'name' => __( 'Header', 'anew' ), 'slug' => 'header', 'color' => ANEW_COLOR_HEADER ],
		[ 'name' => __( 'Footer', 'anew' ), 'slug' => 'footer', 'color' => ANEW_COLOR_FOOTER ],
		[ 'name' => __( 'White', 'anew' ), 'slug' => 'white', 'color' => '#fff' ],
		[ 'name' => __( 'Black', 'anew' ), 'slug' => 'black', 'color' => '#000' ],
	] );
} );
