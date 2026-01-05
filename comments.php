<?php if ( post_password_required() ) { return; } ?>

<section id="comments" class="themeform pad group">
	
	<?php if ( have_comments() ) : ?>
	
		<h3 class="heading"><?php comments_number( __( 'No Responses', 'anew' ), __( '1 Response', 'anew' ), __( '% Responses', 'anew' ) ); ?></h3>
	
	<ul class="comment-tabs group" role="tablist">
		<li class="active" role="presentation"><a href="#commentlist-container" role="tab" aria-selected="true" aria-controls="commentlist-container"><i class="fa fa-comments-o" aria-hidden="true"></i><?php _e( 'Comments', 'anew' ); ?><span><?php echo get_comments_number(); ?></span></a></li>
			<li><a href="#pinglist-container"><i class="fa fa-share"></i><?php _e( 'Pingbacks', 'anew' ); ?><span><?php echo count($wp_query->comments_by_type['pings']); ?></span></a></li>
		</ul>

		<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
		<div id="commentlist-container" class="comment-tab">
			
			<ol class="commentlist">
				<?php wp_list_comments( 'avatar_size=96&type=comment' ); ?>	
			</ol><!--/.commentlist-->
			
			<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
			<nav class="comments-nav group">
				<div class="nav-previous"><?php previous_comments_link(); ?></div>
				<div class="nav-next"><?php next_comments_link(); ?></div>
			</nav><!--/.comments-nav-->
			<?php endif; ?>
			
		</div>	
		<?php } ?>
		
		<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
		<div id="pinglist-container" class="comment-tab">
			
			<ol class="pinglist">
				<?php // not calling wp_list_comments twice, as it breaks pagination
				$pings = $comments_by_type['pings'];
				foreach ($pings as $ping) { ?>
					<li class="ping">
						<div class="ping-link"><?php comment_author_link($ping); ?></div>
						<div class="ping-meta"><?php comment_date( get_option( 'date_format' ), $ping ); ?></div>
						<div class="ping-content"><?php comment_text($ping); ?></div>
					</li>
				<?php } ?>
			</ol><!--/.pinglist-->
			
		</div>
		<?php } ?>

	<?php else: // if there are no comments yet ?>

		<?php if (comments_open()) : ?>
			<!-- comments open, no comments -->
		<?php else : ?>
			<!-- comments closed, no comments -->
		<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if ( comments_open() ) { comment_form(); } ?>

</section><!--/#comments-->