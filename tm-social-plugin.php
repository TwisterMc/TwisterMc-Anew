<?php
/*
Template Name: Social Bookmark Plugin
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

<p><strong>Install &amp; Configure</strong><br />
  <strong>1)</strong> <a href="//www.twistermc.com/downloads/wpress/Social-Bookmarks-Plugin.zip">Download the plugin.</a><br />
  <br />
  <strong>2)</strong> Upload the social-bookmark.php file into your Wordpress plugins directory.<br />

  <br />
  <strong>3)</strong> Activate it via the Plugins area in the admin area.</p>
<p>4) Put this code where you want the social bookmark links to show up:<br>
  <span class="htmlcode">&lt;? if (function_exists('social_bookmark')) { social_bookmark(); } ?&gt; </span><br>
  <strong style="color:#FF0000">!!!</strong> It must be in the post loop.  Above the comments is a great spot.  This will not work in the sidebar.</p>

<p><strong>5)</strong> On the Options page in the admin, there is a 'Social Bookmark Creator' submenu.  Select that and setup any options.<br />
      <br />
  List Example:<br>
  >>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="//www.twistermc.com/shake/interface/social-list.gif"><br>
  Drop Down Menu Example: <br>
  >>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="//www.twistermc.com/shake/interface/social-dropdown.gif"></p>

<p><strong>6) </strong>Enjoy!</p>

<div class="clear"></div>
				</div><!--/.entry-->

			</article>

			<?php if ( ot_get_option('page-comments') != '' ) { comments_template('/comments.php',true); } ?>

		<?php endwhile; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
