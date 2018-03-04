<?php
/**
 * listing-tall-1.php
 *---------------------------
 * Tall listing template
 */

$columns = publisher_get_prop( 'listing-columns', 1 );

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-tall listing-tall-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>  columns-<?php echo esc_attr( $columns ); ?>">
	<?php
}

publisher_set_prop( 'hide-meta-author-if-review', TRUE );

while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-tall-1-item' );
}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
