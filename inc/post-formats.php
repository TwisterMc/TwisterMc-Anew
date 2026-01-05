<?php if ( !has_post_format( ) && !is_single() || has_post_format( 'image' ) && !is_single() || has_post_format( 'video' ) && !is_single() ): // Standard & Image ?> ?>

	<div class="post-format">
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="image-container">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php the_post_thumbnail('thumb-large'); ?>
				</a>
				<?php 
				$thumbnail_post = get_post(get_post_thumbnail_id());
				$caption = $thumbnail_post ? $thumbnail_post->post_excerpt : '';
				if ( isset($caption) && $caption ) : ?>
					<figcaption class="image-caption"><?php echo esc_html( $caption ); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>
	</div>
	
<?php endif; ?>
