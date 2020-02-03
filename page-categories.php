<?php get_header(); ?>

<section class="content">

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>

				<?php get_template_part('inc/page-image'); ?>

				<h1 class="page-title-single"><?php the_title(); ?></h1>

				<div class="entry themeform">
					<?php the_content(); ?>
					<h2>Categories</h2>
					<ul>
						<?php wp_list_categories('orderby=name&show_count=1&title_li='); ?>
					</ul>
					<?php if ( function_exists('wp_tag_cloud') ) : ?>
						<h2>Popular Tags</h2>
						<ul>
							<?php wp_tag_cloud('smallest=8&largest=22'); ?>
						</ul>
					<?php endif; ?>

					<h2>Pages</h2>
					<?php wp_list_pages('title_li='); ?>
					<div class="clear"></div>
				</div><!--/.entry-->

			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template('/comments.php', true);
			}
			?>
		<?php endwhile; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
