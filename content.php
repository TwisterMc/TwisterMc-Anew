<?php
/**
 * Content Template
 * 
 * @package Anew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$format = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?> itemscope itemtype="https://schema.org/BlogPosting">

	<h2 class="post-title pad" itemprop="headline">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>" itemprop="url"><?php the_title(); ?></a>
	</h2><!--/.post-title-->

	<ul class="post-meta pad group">
		<li><i class="fa fa-clock-o"></i><time datetime="<?php echo esc_attr( get_the_date('c') ); ?>" itemprop="datePublished"><?php the_time('j M, Y'); ?></time></li>
		<span itemprop="author" itemscope itemtype="https://schema.org/Person" class="screen-reader-text">
			<span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
		</span>
	</ul><!--/.post-meta-->

	<div class="post-inner">

		<?php get_template_part('inc/post-formats'); ?>

		<div class="post-deco">
			<div class="hex hex-small">
				<div class="hex-inner"><i class="fa"></i></div>
				<?php if ( $format != false ) :?><a href="<?php echo get_post_format_link($format); ?>"><?php echo $format; ?> Post Format Archive</a><?php endif; ?>
				<div class="corner-1"></div>
				<div class="corner-2"></div>
			</div>
		</div><!--/.post-deco-->

		<div class="post-content pad">

			<div class="entry" itemprop="description">
				<?php
				if ( is_archive() || is_home() ) {
					the_excerpt();
				} else {
					the_content();
				}
				?>
			</div><!--/.entry-->


		</div><!--/.post-content-->

	</div><!--/.post-inner-->

</article><!--/.post-->
