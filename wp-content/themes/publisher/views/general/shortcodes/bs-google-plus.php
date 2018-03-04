<?php
/**
 * bs-google-plus.php
 *---------------------------
 * The template to show google+ shortcode/widget
 *
 * [bs-google-plus] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-google-plus-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-google-plus clearfix <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	if ( ! empty( $atts['url'] ) ) {

		switch ( $atts['type'] ) {

			case 'page':
				$type = 'g-page';
				break;

			case 'community':
				$type = 'g-community';
				break;

			default:
				$type = 'g-person';
				break;

		}

		?>
		<div class="<?php echo esc_attr( $type ); ?>" data-width="<?php echo esc_attr( $atts['width'] ); ?>"
		     data-href="<?php echo esc_url( $atts['url'] ); ?>" data-layout="<?php echo esc_attr( $atts['layout'] ); ?>"
		     data-theme="<?php echo esc_attr( $atts['scheme'] ); ?>" data-rel="publisher"
		     data-showtagline="<?php echo $atts['tagline'] == 'show' ? 'true' : 'false'; ?>"
		     data-showcoverphoto="<?php echo $atts['cover'] == 'show' ? 'true' : 'false'; ?>"></div>
		<script type="text/javascript">
			var lang = '<?php echo esc_attr( $atts['lang'] ); ?>';
			if (lang !== '') {
				window.___gcfg = {lang: lang};
			}
			(function () {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>
		<?php

	}
	?>
</div><!-- .bs-google-plus -->
