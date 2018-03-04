<?php
/**
 * listing-thumbnail-3.php
 *---------------------------
 * Thumbnail listing template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-thumbnail listing-tb-3 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}

publisher_set_prop( 'hide-meta-author', TRUE );
publisher_set_prop( 'hide-meta-comments', TRUE );

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-thumbnail-3-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
