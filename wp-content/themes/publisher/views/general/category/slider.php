<?php
/**
 * sidebar.php
 *---------------------------
 * The man code to print sliders.
 *
 */


// Get slider params
$slider_config = publisher_cat_main_slider_config();

if ( ! $slider_config['show'] ) {
	return;
}

$class = array(
	'slider-container clearfix',
	'slider-type-' . $slider_config['type'],
);

switch ( $slider_config['type'] ) {

	case 'disable':
		return;
		break;

	case 'custom-blocks':
		$class[] = 'slider-' . $slider_config['style'] . '-container';
		$class[] = 'slider-overlay-' . $slider_config['overlay'];
		break;

}

?>
<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
<?php

// In columns wrapper
if ( ! $slider_config['in-column'] ){
	?>
	<div class="content-wrap">
	<div class="container">
	<?php
}


switch ( $slider_config['type'] ) {

	case 'custom-blocks':

		$query = new WP_Query( array(
			'cat'            => get_queried_object()->term_id,
			'posts_per_page' => $slider_config['posts'],
		) );
		
		publisher_set_query( $query );

		if ( ! empty( $slider_config['columns'] ) ) {
			publisher_set_prop( 'listing-class', 'slider-overlay-' . $slider_config['overlay'] . ' columns-' . $slider_config['columns'] );
		} else {
			publisher_set_prop( 'listing-class', 'slider-overlay-' . $slider_config['overlay'] );
		}

		publisher_get_view( $slider_config['directory'], $slider_config['file'] );

		break;

	case 'rev_slider':

		if ( function_exists( 'putRevSlider' ) ) {
			putRevSlider( $slider_config['style'] );
		}

		break;

}


// In columns wrapper
if ( ! $slider_config['in-column'] ){
	?>
	</div>
	</div>
	<?php
}

?>
	</div><?php

publisher_clear_props();
publisher_clear_query();
