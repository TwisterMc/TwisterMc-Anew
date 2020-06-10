		</div><!--/.main-->
	</div><!--/.container-inner-->

	<footer id="footer" role="contentinfo">
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

				<a id="back-to-top" href="#"><span class="isVisuallyHidden">Back to Top</span><i class="fa fa-angle-up"></i></a>

				<div class="pad group">
					<div class="grid one-half">

						<div id="copyright">
							<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e('All Rights Reserved.','anew'); ?></p>
						</div><!--/#copyright-->

					</div>
					<div class="grid one-half last">
						<ul class="social-links">
							<li><a rel="nofollow" class="social-tooltip" title="Twitter" href="http://twitter.com/twistermc" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a rel="nofollow" class="social-tooltip" title="RSS Feed" href="https://www.twistermc.com/feed/" target="_blank"><i class="fa fa-rss"></i></a></li>
						</ul>
					</div>
				</div><!--/.pad-->

			</div><!--/.container-->
		</section><!--/#footer-bottom-->

	</footer><!--/#footer-->

</div><!--/#wrapper-->

<?php wp_footer(); ?>

</body>
</html>
