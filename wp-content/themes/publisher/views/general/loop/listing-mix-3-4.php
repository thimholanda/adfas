<?php
/**
 * listing-mix-3-4.php
 *---------------------------
 * Mix listing 3-4 template
 */

$_posts_count = publisher_get_prop( 'posts-count' );

?>
<div class="listing listing-mix-3-4 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="row-1">
		<?php

		if ( publisher_have_posts() ) {
			$_listing_class = publisher_get_prop( 'listing-class' );

			publisher_set_prop( 'listing-class', 'columns-1 slider-overlay-simple-gr' );
			publisher_set_prop( 'posts-count', 1 );

			publisher_get_view( 'loop', 'listing-modern-grid-3' );

			publisher_set_prop( 'listing-class', $_listing_class );
		}

		?>
	</div>
	<?php

	if ( ! empty( $_posts_count ) && ( intval( $_posts_count ) - 2 ) > 0 ) {
		publisher_set_prop( 'posts-count', $_posts_count );
	} else {
		publisher_unset_prop( 'posts-count' );
	}

	if ( publisher_have_posts() ) {
		?>
		<div class="row-2">
			<?php

			publisher_set_prop( 'listing-class', 'columns-1' );
			publisher_get_view( 'loop', 'listing-thumbnail-1' );

			?>
		</div>
		<?php
	}

	?>
</div>
