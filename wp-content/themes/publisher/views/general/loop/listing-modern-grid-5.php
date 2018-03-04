<?php
/**
 * listing-modern-grid-5.php
 *---------------------------
 * Modern grid listing template
 */

// Image Sizes
$item_big_img   = 'publisher-lg';
$item_small_img = 'publisher-mg2';

?>
<div
	class="listing listing-modern-grid listing-modern-grid-5 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="mg-col mg-col-1">
		<?php

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_set_prop_class( 'listing-item-1', TRUE );
			publisher_set_prop_thumbnail_size( $item_big_img );
			publisher_get_view( 'loop', 'listing-modern-grid-5-item-big' );
		}

		?>
	</div>
	<?php

	publisher_set_prop( 'title-limit', 50 );
	publisher_set_prop_class( 'listing-item-2', TRUE );
	publisher_set_prop( 'show-meta', FALSE );
	publisher_set_prop_thumbnail_size( $item_small_img );

	$col_1 = '';
	$col_2 = '';

	while( publisher_have_posts() ) {

		if ( publisher_have_posts() ) {
			publisher_the_post();
			$col_1 .= publisher_get_view( 'loop', 'listing-modern-grid-5-item-small', '', FALSE );
		}

		if ( publisher_have_posts() ) {
			publisher_the_post();
			$col_2 .= publisher_get_view( 'loop', 'listing-modern-grid-5-item-small', '', FALSE );
		}

	}

	?>
	<div class="mg-col mg-col-2">
		<?php

		echo $col_1; // escaped before
		unset( $col_1 );

		?>
	</div>
	<div class="mg-col mg-col-3">
		<?php

		echo $col_2; // escaped before
		unset( $col_2 );

		?>
	</div>
</div>
