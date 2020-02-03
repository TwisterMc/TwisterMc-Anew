<?php get_header(); ?>
<?php $format = get_post_format(); ?>

<section class="content" role="main">

	<div class="pad group">

	<?php while ( have_posts() ): the_post(); ?>
	<a id="mainContent" href="" role="heading" tabindex="-1" class="isVisuallyHidden" aria-level="2">Main Content</a>


		<article <?php post_class(); ?>>

			<h1 class="post-title pad"><?php the_title(); ?></a></h1>

			<ul class="post-meta pad group">
				<li><?php the_category(' / '); ?></li>
				<li><i class="fa fa-clock-o"></i><?php the_time('j M, Y'); ?></li>
				<?php if ( comments_open() ): ?><li><a href="<?php comments_link(); ?>"><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
			</ul>

			<div class="post-inner">

				<?php if( get_post_format() ) { get_template_part('inc/post-formats'); } ?>

				<div class="post-deco">
					<div class="hex hex-small">
						<div class="hex-inner"><i class="fa"></i></div>
						<?php if ( $format != false ) :?><a href="<?php echo get_post_format_link($format); ?>"></a><?php endif; ?>
						<div class="corner-1"></div>
						<div class="corner-2"></div>
					</div>
				</div><!--/.post-deco-->

				<div class="post-content pad">

					<div class="entry">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','anew'),'after'=>'</div>')); ?>
					</div><!--/.entry-->

					<?php the_tags('<p class="post-tags"><span>'.__('Tags:','anew').'</span> ','','</p>'); ?>

				</div><!--/.post-content-->

			</div><!--/.post-inner-->

		</article><!--/.post-->
	<?php endwhile; ?>

		<?php if ( is_single() ): ?>
			<ul class="post-nav group">
				<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i><strong>'.__('Next', 'anew').'</strong> <span>%title</span>'); ?></li>
				<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i><strong>'.__('Previous', 'anew').'</strong> <span>%title</span>'); ?></li>
			</ul>
		<?php endif; ?>

	<?php comments_template('/comments.php',true); ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
