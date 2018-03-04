<?php
/**
 * listing-modern-grid-4.php
 *---------------------------
 * Modern grid listing template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-modern-grid listing-modern-grid-4 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}
$counter = 0;

publisher_set_prop( 'title-limit', 50 );
publisher_set_prop( 'hide-meta-author-if-review', TRUE ); // hide author to make space for reviews

while( publisher_have_posts() ) {
	publisher_the_post();

	$counter ++;
	publisher_set_prop_class( 'listing-item-' . $counter, TRUE );

	publisher_get_view( 'loop', 'listing-modern-grid-4-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
