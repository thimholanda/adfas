<?php
/**
 * bs-flickr.php
 *---------------------------
 * The template to show flickr shortcode/widget
 *
 * [bs-flickr] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-flickr-atts' );

$style = '';
switch ( $atts['style'] ) {

	case 2:
	case 3:
		$style = 'columns-' . $atts['style'];
		break;

	case 'list':
		$style = 'list-photos';
		break;

	case 'slider':
		$style = 'slider';
		break;

}

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-flickr clearfix <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	if ( ! empty( $atts['user_id'] ) ) {

		$images_list = publisher_shortcode_flickr_get_data( $atts );

		if ( is_wp_error( $images_list ) ) {
			if ( is_user_logged_in() ) {
				echo $images_list->get_error_message(); // escaped before
			}

		} elseif ( $images_list != FALSE ) {

			$images_list = array_slice( $images_list, 0, $atts['photo_count'] );

			switch ( $style ) {

				// Simple Grid
				case 'columns-3':
				case 'columns-2':
			case 'list-photos':

				?>
				<ul class="bs-flickr-photo-list <?php echo esc_attr( $style ); ?> clearfix"><?php

				foreach ( (array) $images_list as $index => $item ) {

					?>
					<li class="bs-flickr-photo">
						<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank">
							<img src="<?php echo esc_url( $item['media']['s'] ); ?>"
							     alt="<?php echo esc_attr( $item['title'] ); ?>"/>
						</a>
					</li>
					<?php
				}

				?></ul><?php

			break;

			// Slider
			case 'slider':

			// Slider ID
			$slider_id = 'inst-slider-' . rand( 1, 9999999 );

			?>
				<div class="better-slider" id="<?php echo esc_attr( $slider_id ); ?>">
					<ul class="slides">
						<?php

						foreach ( $images_list as $item ) {

							?>
							<li class="bs-flickr-photo">
								<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank">
									<img src="<?php echo esc_url( $item['media']['s'] ); ?>"
									     alt="<?php echo esc_attr( $item['title'] ); ?>"/>
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
							animation: "slide",
							slideshowSpeed: "6000",
							animationSpeed: "500",
							animationLoop: true,
							directionNav: true,
							controlNav: false,
							pauseOnHover: true,
							smoothHeight: true,
							itemWidth: '100',
							itemMargin: 0,
							minItems: 3,
							maxItems: 3
						}).find('.better-control-nav').addClass('square');
					});
				</script>
				<?php
				break;
			} // switch
		}
	}

	?>
</div><!-- .bs-flickr -->
