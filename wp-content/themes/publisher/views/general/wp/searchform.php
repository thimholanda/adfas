<form role="search" method="get" class="search-form clearfix" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="search-field"
	       placeholder="<?php publisher_translation()->_echo_esc_attr( 'search_dot' ); ?>"
	       value="<?php echo isset( $s ) ? esc_attr( $s ) : ''; ?>" name="s"
	       title="<?php publisher_translation()->_echo_esc_attr( 'search_for' ); ?>">
	<input type="submit" class="search-submit" value="<?php publisher_translation_echo( 'search' ); ?>">
</form><!-- .search-form -->
