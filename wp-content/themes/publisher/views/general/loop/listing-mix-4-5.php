<?php
/**
 * listing-mix-4-5.php
 *---------------------------
 * Mix listing 4-5 template
 */

$_posts_count = publisher_get_prop( 'posts-count' );

?>
<div class="listing listing-mix-4-5 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php

	publisher_set_prop( 'show-excerpt', TRUE );

	if ( publisher_have_posts() ) {
		publisher_set_prop( 'listing-class', 'columns-1' );
		publisher_set_prop( 'posts-count', 1 );

		publisher_get_view( 'loop', 'listing-classic-2' );
	}

	if ( ! empty( $_posts_count ) && ( intval( $_posts_count ) - 2 ) > 0 ) {
		publisher_set_prop( 'posts-count', $_posts_count );
	} else {
		publisher_unset_prop( 'posts-count' );
	}

	publisher_set_prop( 'title-length', 60 ); // limit titles length

	if ( publisher_have_posts() ) {
		publisher_set_prop( 'listing-class', 'columns-2' );
		publisher_get_view( 'loop', 'listing-classic-2' );
	}

	?>
</div>
