<?php
/**
 * listing-grid-2.php
 *---------------------------
 * Grid listing 2 template
 */

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-grid listing-grid-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-grid-2-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
