<?php
/**
 * bs-dribbble.php
 *---------------------------
 * The template to show dribbble shortcode/widget
 *
 * [bs-dribbble] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-dribbble-atts' );

switch ( $atts['style'] ) {

	case 2:
	case 3:
		$style = 'columns-' . $atts['style'];
		break;

	case 'slider':
		$style = 'slider';
		break;

	default:
		$style = '';
		break;

}

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-dribbble clearfix <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	if ( ! empty( $atts['user_id'] ) && ! empty( $atts['access_token'] ) ) {

		$shots_list = publisher_shortcode_dribbble_get_data( $atts );

		if ( $shots_list != FALSE && count( $shots_list ) > 0 ) { ?>
			<?php

			$shots_list = array_slice( (array) $shots_list, 0, $atts['photo_count'] );

			switch ( $style ) {

				// Simple Grid
				case 'columns-3':
			case 'columns-2':

				?>
			<ul class="bs-dribbble-shot-list <?php echo esc_attr( $style ); ?> clearfix">
				<?php
				foreach ( $shots_list as $index => $item ) {
					?>
					<li class="dribbble-shot">
						<a href="<?php echo esc_url( $item->html_url ); ?>" target="_blank">
							<img src="<?php echo esc_url( $item->images->teaser ); ?>"
							     alt="<?php echo esc_attr( $item->title ); ?>"/>
						</a>
					</li>
					<?php
				}

				?>
			</ul><?php
			break;

			// Slider
			case 'slider':

			// Slider ID
			$slider_id = 'dribbble-slider-' . rand( 1, 9999999 );

			?>
				<div class="better-slider" id="<?php echo esc_attr( $slider_id ); ?>">
					<ul class="slides">
						<?php

						foreach ( $shots_list as $index => $item ) {
							?>
							<li class="dribbble-shot slide">
								<a href="<?php echo esc_url( $item->html_url ); ?>" target="_blank">
									<img src="<?php echo esc_url( $item->images->normal ); ?>"
									     alt="<?php echo esc_attr( $item->title ); ?>"/>
								</a>
							</li>
							<?php
						}

						?>
					</ul>
				</div><!-- /better-slider -->
				<script>
					jQuery(window).ready(function () {
						jQuery('#<?php echo esc_attr( $slider_id ); ?>').flexslider({
							namespace: "better-",
							animation: "fade",
							slideshowSpeed: "3500",
							animationSpeed: "400",
							animationLoop: true,
							directionNav: true,
							pauseOnHover: true
						}).find('.better-control-nav').addClass('square');
					});
				</script>
				<?php
				break;
			}
		}
	} else {
		if ( is_user_logged_in() && is_admin() ) {
			esc_html_e( 'Please fill all fields.', 'publisher' );
		}
	}

	?>
</div><!-- .bs-dribbble -->
