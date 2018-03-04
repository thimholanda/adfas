<?php
/**
 * bs-social-share.php
 *---------------------------
 * The template to show social share shortcode/widget
 *
 * [bs-social-share] shortcode
 */

$atts = publisher_get_prop( 'shortcode-bs-social-share-atts' );

if ( ! isset( $atts['class'] ) ) {
	$atts['class'] = '';
}

$style = $atts['style'];

$show_title = TRUE;

if ( $style == 'button-no-text' ) {
	$style      = 'button';
	$show_title = FALSE;
} elseif ( $style == 'outline-button-no-text' ) {
	$style      = 'outline-button';
	$show_title = FALSE;
	$atts['class'] .= 'no-title-style';
}

$atts['class'] .= ' style-' . $style;

if ( $atts['colored'] ) {
	$atts['class'] .= ' colored';
}

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-social-share <?php echo esc_attr( $atts['class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	?>
	<ul class="social-list clearfix"><?php

		if ( ! is_array( $atts['sites'] ) ) {
			$atts['sites'] = explode( ',', $atts['sites'] );
			foreach ( $atts['sites'] as $site ) {
				echo publisher_shortcode_social_share_get_li( $site, $show_title ); // escaped before
			}
		} else {
			foreach ( $atts['sites'] as $site_key => $site ) {
				if ( $site ) {
					echo publisher_shortcode_social_share_get_li( $site_key, $show_title ); // escaped before
				}
			}
		}

		?>
	</ul><!-- .social-list -->
</div><!-- .bs-social-share -->
