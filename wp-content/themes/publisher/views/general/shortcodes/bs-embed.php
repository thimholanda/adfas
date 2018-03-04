<?php
/**
 * bs-embed.php
 *---------------------------
 * The template to show embed shortcode/widget
 *
 * [bs-embed] shortcode
 */

$atts = publisher_get_prop( 'shortcode-bs-embed-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}


?>
<div class="bs-shortcode bs-embed clearfix <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	$embeds_list = explode( "\n", $atts['url'] );

	foreach ( $embeds_list as $embed ) {

		$embed = trim( $embed );

		if ( empty( $embed ) ) {
			continue;
		}

		?>
		<div class="bs-embed-item">
			<?php echo do_shortcode( apply_filters( 'better-framework/content/auto-embed', trim( $embed ) ) ); // escaped before ?>
		</div>
		<?php

	}

	?>
</div><!-- .bs-embed -->
