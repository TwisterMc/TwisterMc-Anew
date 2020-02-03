<?php
/*
Template Name: Chicklet Creator Plugin
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

<p>Instructions below for version 0.5.x.</p>
<p>Included in the plugin are the button images and the plugin file.</p>
<p><strong>Install &amp; Configure</strong><br />
<strong>1)</strong> <a href="//www.twistermc.com/downloads/wpress/Chicklet-Creator.zip">Download the plugin.</a><br /><br />
<strong>2)</strong> Upload the <em>entire</em> Chicklet-Creator folder into your Wordpress plugins directory.<br />
-- The final path should look like this <span class="htmlcode">/wp-content/plugins/Chicklet-Creator/</span> <br>
<br />
<strong>3)</strong> Activate the plugin via the Plugins area in the Wordpress admin.<br /><br>
<strong>4)</strong> Put the following code in the theme's template where you want the feed buttons to show up:<br> <span class="htmlcode">
&lt;?
if (function_exists('chicklet_creator')) {
	chicklet_creator();
} ?&gt;
</span><br />
-- My suggestion would be to go into your Wordpress theme directory and open sidebar.php.  Then insert it above the archives code which will look like this <span class="htmlcode">&lt;li&gt;&lt;h2&gt;Archives&lt;/h2&gt;</span><br>
<br />
<strong>5)</strong> In the admin area, go to 'Options' -> 'Chicklet Creator' and configure what buttons you want to see.  You can also add a Feedburner feed here.<br><br />
<strong>6)</strong> Enjoy!  This code should work anywhere in your blog template.<br /><br /></p>
<p><strong>Error?!</strong> - If you get this error <span class="htmlcode">Cannot load Chicklet-Creator/chicklet-creator.php</span> it means that the files were uploaded but the file struction is incorrect.  Ensure that your file structure looks like this<br>
<span class="htmlcode">/wp-content/plugins/Chicklet-Creator/chicklet-creator.php</span><br>
<span class="htmlcode">/wp-content/plugins/Chicklet-Creator/RSS-images/</span>
</p>

<div class="clear"></div>
				</div><!--/.entry-->

			</article>

			<?php if ( ot_get_option('page-comments') != '' ) { comments_template('/comments.php',true); } ?>

		<?php endwhile; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
