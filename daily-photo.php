<?php
/*
Template Name: Daily Photo
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

<div>
<?php
 if ($handle = opendir('/var/www/html/tw/twistermc.com/daily-lily/')) {
 $dir_array = array();
   while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != ".." && $file != "error_log" && $file != "index.php" && $file != "tn") {
          	//$thelist .= '<a href="'.$file.'"><img src="/tn/'.$file.'" rel="lightbox" title="'.$file.'"></a>';
          	//$thelist .= $file.'<br>';
          	$dir_array[] = $file;
          }
       }
  closedir($handle);
  }
?>
<? sort($dir_array); ?>
<p>
<?
foreach ($dir_array as $key => $val) {
    echo '<a href="/daily-lily/'.$val.'" rel="lightbox" title="'.$val.'"><img src="/daily-lily/tn/'.$val.'" title="'.$val.'"></a>';
}?>
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
