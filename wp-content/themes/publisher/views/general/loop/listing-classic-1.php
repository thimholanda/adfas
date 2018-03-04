<?php
/**
 * listing-classic-1.php
 *---------------------------
 * Classic listing template
 *
 */

$columns = publisher_get_prop( 'listing-columns', 1 );

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-classic listing-classic-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?> columns-<?php echo esc_attr( $columns ); ?>">
	<?php
}

while( publisher_have_posts() ) {

	publisher_the_post();

	publisher_get_view( 'loop', 'listing-classic-1-item' );

}

if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
