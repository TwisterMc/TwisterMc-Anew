<?php
/*
Template Name: Daily Photo
*/
get_header(); ?>

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
					// Directory containing daily photos
					$dir = '/var/www/html/tw/twistermc.com/daily-lily/';
					$img_url = '/daily-lily/';
					$tn_url = '/daily-lily/tn/';
					
					// Cache directory listing for 1 hour
					$transient_key = 'daily_photo_list_' . md5($dir);
					$dir_array = get_transient($transient_key);
					
					if (false === $dir_array && is_dir($dir)) {
						$dir_array = array();
						$handle = opendir($dir);
						if ($handle) {
							while (false !== ($file = readdir($handle))) {
								if ($file !== "." && $file !== ".." && $file !== "error_log" && $file !== "index.php" && $file !== "tn") {
									$dir_array[] = $file;
								}
							}
							closedir($handle);
						}
						sort($dir_array);
						set_transient($transient_key, $dir_array, HOUR_IN_SECONDS);
					}
					if (!empty($dir_array)) {
						sort($dir_array);
						echo '<p>';
						foreach ($dir_array as $val) {
							$escaped_val = esc_attr($val);
							echo '<a href="' . $img_url . $escaped_val . '" rel="lightbox" title="' . $escaped_val . '"><img src="' . $tn_url . $escaped_val . '" title="' . $escaped_val . '"></a>';
						}
						echo '</p>';
					} else {
						echo '<p>No daily photos found.</p>';
					}
					?>
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
