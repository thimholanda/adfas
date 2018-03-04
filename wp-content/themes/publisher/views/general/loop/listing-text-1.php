<?php
/**
 * listing-text-1.php
 *---------------------------
 * Text listing template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-text listing-text-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}

publisher_set_prop( 'hide-meta-author-if-review', TRUE );

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-text-1-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
