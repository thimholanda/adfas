<?php
/**
 * text.php
 *---------------------------
 * The template to show text shortcode/widget
 *
 * [bs-text] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-text-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-text <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	?>
	<div class="bs-text-content">
		<?php echo wpautop( do_shortcode( $atts['content'] ) ); // escaped before ?>
	</div>
</div><!-- .bs-text -->
