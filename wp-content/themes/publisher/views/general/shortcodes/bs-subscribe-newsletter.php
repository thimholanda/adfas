<?php
/**
 * bs-subscribe-newsletter.php
 *---------------------------
 * The template to show newsletter shortcode/widget
 *
 * [bs-subscribe-newsletter] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-subscribe-newsletter-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-subscribe-newsletter <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	if ( ! empty( $atts['image'] ) ) { ?>
		<div class="subscribe-image">
			<img src="<?php echo esc_url( $atts['image'] ); ?>">
		</div>
	<?php } ?>

	<div class="subscribe-message">
		<?php echo wp_kses( wpautop( $atts['msg'] ), bf_trans_allowed_html() ); ?>
	</div>

	<form method="post" action="http://feedburner.google.com/fb/a/mailverify" class="bs-subscribe-feedburner clearfix"
	      target="_blank">
		<input type="hidden" value="<?php echo esc_attr( $atts['feedburner-id'] ); ?>" name="uri"/>
		<input type="hidden" name="loc" value="<?php echo get_locale(); ?>"/>
		<input type="text" id="feedburner-email" name="email" class="feedburner-email"
		       placeholder="<?php publisher_translation()->_echo_esc_attr( 'widget_enter_email' ); ?>"/>
		<input class="feedburner-subscribe" type="submit" name="submit"
		       value="<?php publisher_translation()->_echo_esc_attr( 'widget_subscribe' ); ?>"/>
	</form><!-- .bs-subscribe-feedburner -->
</div><!-- .bs-subscribe-newsletter -->
