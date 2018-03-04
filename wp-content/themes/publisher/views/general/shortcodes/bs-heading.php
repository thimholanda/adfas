<?php
/**
 * bs-heading.php
 *---------------------------
 * The template to show heading shortcode/widget
 *
 * [bs-heading] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-heading-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-heading-shortcode <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts );

	?>
</div>
