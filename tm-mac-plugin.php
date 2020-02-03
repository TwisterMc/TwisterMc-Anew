<?php
/*
Template Name: Mac Plugin
*/
?>

<?php get_header(); ?>

<section class="content">

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>

				<?php get_template_part('inc/page-image'); ?>

				<h1 class="page-title-single"><?php the_title(); ?></h1>

				<div class="entry themeform">
					<?php the_content(); ?>

<p><strong><img src="/shake/interface/download-icon.png"> Install &amp; Configure</strong> - <a href="//www.twistermc.com/blog/category/made-on-a-mac">Plugin Discussion</a><br />
<strong>1)</strong> <a href="//www.twistermc.com/downloads/Made_on_a_Mac.zip">Download the plugin.</a><br /><br />
<strong>2)</strong> Upload the <em>entire</em> Made_on_a_Mac folder into your Wordpress plugins directory.<br />
-- The final path should look like this<br />
<span class="htmlcode">/wp-admin/plugins/Made_on_a_Mac/mac_made.php</span> <br />
<span class="htmlcode">/wp-admin/plugins/Made_on_a_Mac/mac_made.png</span> <br />
<br />
<strong>3)</strong> Activate the plugin via the Plugins area in the Wordpress admin.<br /><br />
That's it!  If your Wordpress theme template is including the wp_meta function, you'll see the 'Made on a Mac' button show up there.  If it doesn't show after activation, then your theme probably don't have that function call.  Don't worry, we can do it the advanced way.
<br /><br />
<strong>Advanced</strong> Put the following code in the theme's template where you want the button to show up:<br> <span class="htmlcode">
&lt;?
if (function_exists('Made_on_a_Mac')) {
	Made_on_a_Mac();
} ?&gt;
</span><br />
<br />
That's it for now.  Enjoy!
<br /><br />
<em>Note: The graphic is a transparent PNG which works in all browsers except IE6 and older.</em>
</p>

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
