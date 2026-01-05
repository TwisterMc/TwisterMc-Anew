<?php if ( has_post_thumbnail() ): ?>
<div class="page-image">
	<div class="image-container">
		<?php the_post_thumbnail('thumb-large'); ?>
		<?php 
			$thumbnail_post = get_post(get_post_thumbnail_id());
			$caption = $thumbnail_post->post_excerpt;
			$description = $thumbnail_post->post_content;
			echo '<div class="page-image-text">';
			if ( isset($caption) && $caption ) echo '<div class="caption">'.esc_html($caption).'</div>';
			if ( isset($description) && $description ) echo '<div class="description"><i>'.esc_html($description).'</i></div>';
			echo '</div>';
		?>
	</div>
</div><!--/.page-image-->
<?php endif; ?>	