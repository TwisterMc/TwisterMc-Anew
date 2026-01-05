<?php
/**
 * Single Post Template
 * 
 * @package Anew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$format = get_post_format();
?>

<section class="content">
	<h1 id="mainContent" class="screen-reader-text">Main Content</h1>

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>
			<article <?php post_class('group'); ?> itemscope itemtype="https://schema.org/BlogPosting">

				<h1 class="post-title"><?php the_title(); ?></h1>

				<ul class="post-meta group">
					<li><i class="fa fa-clock-o" aria-hidden="true"></i><time datetime="<?php echo esc_attr( get_the_date('c') ); ?>" itemprop="datePublished"><?php the_time('j M, Y'); ?></time></li>
					<meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date('c') ); ?>">
					<span itemprop="author" itemscope itemtype="https://schema.org/Person" class="screen-reader-text">
						<span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
					</span>
					<!-- Publisher schema -->
					<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="screen-reader-text">
						<span itemprop="name"><?php echo esc_html( get_bloginfo('name') ); ?></span>
						<meta itemprop="url" content="<?php echo esc_url( home_url('/') ); ?>">
					</span>
					<?php if ( has_post_thumbnail() ) : ?>
					<meta itemprop="image" content="<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>">
					<?php endif; ?>
				</ul>

				<?php if( get_post_format() ) { get_template_part('inc/post-formats'); } ?>

				<div class="post-deco">
					<div class="hex hex-small">
						<div class="hex-inner"><i class="fa"></i></div>
					</div>
					<?php if ( $format != false ) :?><a href="<?php echo esc_url( get_post_format_link($format) ); ?>"><?php echo esc_html( $format ); ?> Post Format Archive</a><?php endif; ?>
				</div><!--/.post-deco-->

				<div class="entry themeform" itemprop="articleBody">
					<?php the_content(); ?>
					<?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','anew'),'after'=>'</div>')); ?>
					<div class="clear"></div>
				</div><!--/.entry-->

				<hr />
				<div><p class="post-tags">Posted In: <?php the_category(' '); ?></p></div>
				<?php the_tags('<p class="post-tags"><span>'.__('Tagged With:','anew').'</span> ','','</p>'); ?>

				<?php if ( is_single() ): ?>
					<nav class="post-nav" aria-label="<?php esc_attr_e( 'Post Navigation', 'anew' ); ?>">
						<ul class="group">
							<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right" aria-hidden="true"></i><strong>'.__('Next', 'anew').'</strong> <span>%title</span>'); ?></li>
							<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left" aria-hidden="true"></i><strong>'.__('Previous', 'anew').'</strong> <span>%title</span>'); ?></li>
						</ul>
					</nav>
				<?php endif; ?>

			</article>

			<?php comments_template('/comments.php',true); ?>

		<?php endwhile; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
