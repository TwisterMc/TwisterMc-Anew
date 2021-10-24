<?php get_header(); ?>

<section class="content" role="main">
<a id="mainContent" role="heading" tabindex="-1" class="isVisuallyHidden" aria-level="2">Main Content</a>

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>

				<?php get_template_part('inc/page-image'); ?>

				<h1 class="page-title-single"><?php echo get_the_title(); ?></h1>

				<div class="entry themeform">
					<?php the_content(); ?>
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
