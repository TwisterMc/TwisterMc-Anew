<?php get_header(); ?>

<a id="mainContent" href="" aria-label="Skip to content" tabindex="-1" class="isVisuallyHidden">Main Content</a>

<section class="content" role="main">
<a id="mainContent" href="" aria-label="Skip to content" tabindex="-1" class="isVisuallyHidden">Main Content</a>


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