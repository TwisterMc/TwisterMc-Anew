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
				</div>
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

<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push(249092);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/249092ns.gif" /></p></noscript>

</body>
</html>
