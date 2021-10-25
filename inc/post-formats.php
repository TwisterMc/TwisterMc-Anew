<?php $meta = get_post_custom($post->ID); ?>

<?php if ( !has_post_format( ) && !is_single() || has_post_format( 'image' ) && !is_single() || has_post_format( 'video' ) && !is_single() ): // Standard & Image ?>

	<div class="post-format">
		<div class="image-container">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php if ( has_post_thumbnail() ) {	
					the_post_thumbnail('thumb-large'); 
					$caption = get_post(get_post_thumbnail_id())->post_excerpt;
					if ( isset($caption) && $caption ) echo '<div class="image-caption">'.$caption.'</div>';
				} ?>
			</a>
		</div>
	</div>
	
<?php endif; ?>
