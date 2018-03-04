<?php
/**
 * listing-modern-grid-2.php
 *---------------------------
 * Modern grid listing template
 */

// Image Sizes
$item_big_img   = 'publisher-lg';
$item_small_img = 'publisher-mg2';

?>
<div
	class="listing listing-modern-grid listing-modern-grid-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="mg-col mg-col-1">
		<?php

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_set_prop( 'title-limit', 160 );
			publisher_set_prop_class( 'listing-item-1', TRUE );
			publisher_set_prop_thumbnail_size( $item_big_img );
			publisher_get_view( 'loop', 'listing-modern-grid-2-item' );
		}

		?>
	</div>
	<div class="mg-col mg-col-2">
		<div class="mg-row mg-row-1 clearfix">
			<div class="item-2-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-2', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item_small_img );
					publisher_get_view( 'loop', 'listing-modern-grid-2-item' );
				}

				?>
			</div>
			<div class="item-3-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-3', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item_small_img );
					publisher_get_view( 'loop', 'listing-modern-grid-2-item' );
				}

				?>
			</div>
		</div>
		<div class="mg-row mg-row-2 clearfix">
			<div class="item-4-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-4', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item_small_img );
					publisher_get_view( 'loop', 'listing-modern-grid-2-item' );
				}

				?>
			</div>
			<div class="item-5-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-5', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item_small_img );
					publisher_get_view( 'loop', 'listing-modern-grid-2-item' );
				}

				?>
			</div>
		</div>
	</div>
</div>
