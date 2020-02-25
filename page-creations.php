<?php get_header(); ?>

<section class="content">

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>

				<?php get_template_part('inc/page-image'); ?>

				<h1 class="page-title-single"><?php the_title(); ?></h1>

				<div class="entry themeform">
					<?php the_content(); ?>
					<?php // Loop through all the creations
                        if( get_field('creation') ): ?>
                            <?php while( has_sub_field('creation') ): $count++ ?>
                            <div class="creation <?php if($count&1) { echo 'odd'; } else { echo 'even'; } ?> <?php if (get_sub_field('active') == 1) { echo 'active'; } ?>">
                                <div class="creation_title">
                                    <a href="<?php the_sub_field('link'); ?>">
                                        <img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('name'); ?>" height="35" width="32" />
                                        <?php the_sub_field('name'); ?>
                                    </a>
                                </div>
                                <div class="creation_short_description"><?php the_sub_field('short_description'); ?> - <?php if (get_sub_field('active') == 1) { echo 'Active Project'; } else { echo 'Inactive Project'; } ?></div>
                                <div class="creation_description"><?php the_sub_field('description'); ?></div>
                            </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
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
