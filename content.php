<?php $format = get_post_format(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>

	<h2 class="post-title pad">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h2><!--/.post-title-->

	<ul class="post-meta pad group">
		<li><?php the_category(' / '); ?></li>
		<li><i class="fa fa-clock-o"></i><?php the_time('j M, Y'); ?></li>
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

			<div class="entry">
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
