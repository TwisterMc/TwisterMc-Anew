<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

// Use a child theme instead of placing custom functions here
// http://codex.wordpress.org/Child_Themes

//Remove JQuery migrate
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


/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */

load_template( get_template_directory() . '/option-tree/ot-loader.php' );

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
		load_template( get_template_directory() . '/functions/widgets/alx-tabs.php' );


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


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebars' ) ) {

	function alx_sidebars() {
		register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	}

}
add_action( 'widgets_init', 'alx_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */
if ( ! function_exists( 'alx_scripts' ) ) {

	function alx_scripts() {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.4', true );
	}

}
add_action( 'wp_enqueue_scripts', 'alx_scripts' );


/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'alx_styles' ) ) {

	function alx_styles() {
		wp_enqueue_style( 'style-2', get_template_directory_uri() . '/style.css', array(), '1.0.4', false );
		wp_enqueue_style( 'dashicons' );
	}

}
add_action( 'wp_enqueue_scripts', 'alx_styles' );


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_custom_sidebars' ) ) {

	function alx_custom_sidebars() {

		$sidebars = get_option( 'sidebar-areas' );

			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
						register_sidebar(array('name' => ''.$sidebar['title'].'','id' => ''.strtolower($sidebar['id']).'','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
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
		// Default layout
		$layout = 'col-2cl';
		$default = 'col-2cl';

		// Return layout class
		return ot_get_option('layout-global', '' . $default . '');
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

		$logo = '<img src="'.ot_get_option('custom-logo').'" alt="'.get_bloginfo('name').'" height="60" width="50">';

		$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

		$sitename = '<p class="site-title">'.$link.'</p>'."\n";

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

/*  Script for no-js / js class
/* ------------------------------------ */
if ( ! function_exists( 'alx_html_js_class' ) ) {

	function alx_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}

}
add_action( 'wp_head', 'alx_html_js_class', 1 );


/*  WP-PageNavi support - @devinsays (via GitHub)
/* ------------------------------------ */
function alx_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'alx_deregister_styles', 100 );


/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

// add custom code to the header
function twistermc_head_additions() {
	echo '<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">';
	echo '<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">';
	echo '<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">';
	echo '<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">';
	echo '<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">';
	echo '<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">';
	echo '<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">';
	echo '<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">';
	echo '<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">';
	echo '<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">';
	echo '<link rel="icon" type="image/png" href="/favicons/favicon-194x194.png" sizes="194x194">';
	echo '<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">';
	echo '<link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">';
	echo '<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">';
	echo '<link rel="manifest" href="/favicons/manifest.json">';
	echo '<link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#3F8EBC">';
	echo '<meta name="msapplication-TileColor" content="#da532c">';
	echo '<meta name="msapplication-TileImage" content="/mstile-144x144.png">';
	echo '<meta name="theme-color" content="#ffffff">';
	echo '<meta name="twitter:site" content="@TwisterMc"/>';
	echo '<meta name="twitter:domain" content="Blog on a Stick"/>';
	echo '<meta name="twitter:creator" content="@twistermc"/>';
	echo '<meta property="fb:admins" content="500138493"/>';
	$format = get_post_format();
	if ( $format === 'image' ) {
		echo( '<meta name="twitter:card" content="photo">' );
	} else {
		echo( '<meta name="twitter:card" content="summary"/>' );
	}

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
