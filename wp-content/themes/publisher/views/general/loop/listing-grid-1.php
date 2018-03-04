<?php
/**
 * listing-grid-1.php
 *---------------------------
 * Grid listing 1 template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-grid listing-grid-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-grid-1-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
