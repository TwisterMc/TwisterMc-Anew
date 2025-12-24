<form method="get" class="searchform themeform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="screen-reader-text"><?php _e( 'Search for:', 'anew' ); ?></label>
	<input type="search" class="search" name="s" id="s" placeholder="<?php esc_attr_e( 'To search type and hit enter', 'anew' ); ?>" />
	<button type="submit" class="screen-reader-text"><?php _e( 'Search', 'anew' ); ?></button>
</form>