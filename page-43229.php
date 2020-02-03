<?php get_header(); ?>

<style>
    .page-id-43229 .main {
        padding-right: 0px;
        background-image: none;
    }

    .bbulider {
        text-align: center;
    }

    .bbulider h2,
    .bbulider h3 {
        margin: 100px 0 30px 0;
        padding-bottom: 20px;
        border-bottom: 2px solid #4E92DF;
    }

    .bbulider img {
        background-color: #ffffff;
        padding: 40px;
    }

    .entry p {
        font-size: 20px;
    }
</style>
<?php // I know. I know. This is not the right place to put css. ?>

<section class="content bbulider">

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>

				<h1 class="page-title-single"><?php the_title(); ?></h1>

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

<?php get_footer(); ?>
