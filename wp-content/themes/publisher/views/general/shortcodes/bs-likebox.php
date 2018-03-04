<?php
/**
 * bs-likebox.php
 *---------------------------
 * The template to show likebox shortcode/widget
 *
 * [bs-likebox] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-likebox-atts' );

$height = 65;
if ( $atts['show_faces'] == TRUE ) {
	$height += 175;
}
if ( $atts['show_posts'] == TRUE ) {
	$height += 350;
}

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-likebox <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	?>
	<div class="fb-page"
	     data-href="<?php echo esc_attr( $atts['url'] ) ?>"
	     data-small-header="false"
	     data-adapt-container-width="true"
	     data-show-facepile="<?php echo esc_attr( $atts['show_faces'] ); ?>"
	     data-show-posts="<?php echo esc_attr( $atts['show_posts'] ); ?>">
		<div class="fb-xfbml-parse-ignore">
			<blockquote cite="<?php echo esc_attr( $atts['url'] ) ?>"><a
					href="<?php echo esc_url( $atts['url'] ) ?>"></a></blockquote>
		</div>
	</div><!-- .fb-page -->
</div><!-- .bs-likebox -->
