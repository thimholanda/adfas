<?php
/**
 * listing-modern-grid-1.php
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
	class="listing listing-modern-grid listing-modern-grid-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="mg-col mg-col-1">
		<?php

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_set_prop( 'title-limit', 160 );
			publisher_set_prop_class( 'listing-item-1', TRUE );
			publisher_set_prop_thumbnail_size( $item1_img );
			publisher_get_view( 'loop', 'listing-modern-grid-1-item' );
		}

		?>
	</div>
	<div class="mg-col mg-col-2">
		<div class="mg-row mg-row-1">
			<?php

			if ( publisher_have_posts() ) {
				publisher_the_post();
				publisher_set_prop( 'title-limit', 90 );
				publisher_set_prop_class( 'listing-item-2', TRUE );
				publisher_set_prop_thumbnail_size( $item2_img );
				publisher_get_view( 'loop', 'listing-modern-grid-1-item' );
			}

			?>
		</div>
		<div class="mg-row mg-row-2">
			<div class="item-3-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-3', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'show-term-badge', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item3_img );
					publisher_get_view( 'loop', 'listing-modern-grid-1-item' );
				}

				?>
			</div>
			<div class="item-4-cont">
				<?php

				if ( publisher_have_posts() ) {
					publisher_the_post();
					publisher_set_prop_class( 'listing-item-4', TRUE );
					publisher_set_prop( 'show-meta', FALSE );
					publisher_set_prop( 'show-term-badge', FALSE );
					publisher_set_prop( 'title-limit', 70 );
					publisher_set_prop_thumbnail_size( $item4_img );
					publisher_get_view( 'loop', 'listing-modern-grid-1-item' );
				}

				?>
			</div>
		</div>
	</div>
</div>
