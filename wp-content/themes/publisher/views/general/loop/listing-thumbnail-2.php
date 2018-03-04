<?php
/**
 * listing-thumbnail-2.php
 *---------------------------
 * Thumbnail listing template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-thumbnail listing-tb-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-thumbnail-2-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
