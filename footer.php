<?php
/**
 * Footer Template
 * 
 * @package Anew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		</div><!--/.main-->
	</div><!--/.container-inner-->

	<footer id="footer">
		<section id="footer-widgets" class="container">
			<div class="pad group">
					<?php
					if ( is_active_sidebar( 'footer-1' ) ) :
						echo '<div class="grid one-fourth">';
						dynamic_sidebar( 'footer-1' );
						echo '</div>';
					endif;
					if ( is_active_sidebar( 'footer-2' ) ) :
						echo '<div class="grid one-fourth">';
						dynamic_sidebar( 'footer-2' );
						echo '</div>';
					endif;
					if ( is_active_sidebar( 'footer-3' ) ) :
						echo '<div class="grid one-fourth">';
						dynamic_sidebar( 'footer-3' );
						echo '</div>';
					endif;
					if ( is_active_sidebar( 'footer-4' ) ) :
						echo '<div class="grid one-fourth">';
						dynamic_sidebar( 'footer-4' );
						echo '</div>';
					endif;
				?>
			</div><!--/.pad-->
		</section><!--/#footer-widgets-->

		<section id="footer-bottom">
			<div class="container">

				<a id="back-to-top" href="#" aria-label="<?php esc_attr_e( 'Back to Top', 'anew' ); ?>"><span class="screen-reader-text"><?php _e( 'Back to Top', 'anew' ); ?></span><i class="fa fa-angle-up" aria-hidden="true"></i></a>

				<div class="pad group">
					<div class="grid one-half">

						<address id="copyright" itemscope itemtype="https://schema.org/Organization">
							<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo('name') ); ?>">
							<meta itemprop="url" content="<?php echo esc_url( home_url('/') ); ?>">
							<p><?php echo esc_html( get_bloginfo('name') ); ?> &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>. <?php _e('All Rights Reserved.','anew'); ?></p>
						</address><!--/#copyright-->

					</div>
				</div><!--/.pad-->

			</div><!--/.container-->
		</section><!--/#footer-bottom-->

	</footer><!--/#footer-->

		</div><!--/#wrapper-->

<?php wp_footer(); ?>

</body>
</html>
