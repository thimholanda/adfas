<?php
/**
 * listing-modern-grid-6.php
 *---------------------------
 * Grid listing template
 */

// Image sizes
$item1_img = 'publisher-lg';
$item2_img = 'publisher-lg';
$item3_img = 'publisher-mg2';
$item4_img = 'publisher-mg2';

?>
<div
	class="listing listing-modern-grid listing-modern-grid-6 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php

	$col_1 = '';
	$col_2 = '';

	while( publisher_have_posts() ) {

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_set_prop_class( 'listing-item-1', TRUE );
			publisher_set_prop_thumbnail_size( $item1_img );
			$col_1 .= publisher_get_view( 'loop', 'listing-modern-grid-6-item', '', FALSE );
		}

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_set_prop_class( 'listing-item-2', TRUE );
			publisher_set_prop_thumbnail_size( $item1_img );
			$col_2 .= publisher_get_view( 'loop', 'listing-modern-grid-6-item', '', FALSE );
		}

	}

	?>
	<div class="mg-col mg-col-1">
		<?php

		echo $col_1; // escaped before
		unset( $col_1 );

		?>
	</div>
	<div class="mg-col mg-col-2">
		<?php

		echo $col_2; // escaped before
		unset( $col_2 );

		?>
	</div>
</div>
