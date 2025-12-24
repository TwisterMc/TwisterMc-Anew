<?php get_header(); ?>

<section class="content">
	<h1 id="mainContent" class="screen-reader-text">Main Content</h1>


	<div class="pad group">
		
		<?php get_template_part('inc/page-title'); ?>
		
		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ): the_post(); ?>
				<?php get_template_part('content'); ?>		
			<?php endwhile; ?>
			
			<?php get_template_part('inc/pagination'); ?>
			
		<?php endif; ?>
		
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>