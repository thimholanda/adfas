<?php
/**
 * bs-slider-2.php
 *---------------------------
 * The template to show slider 2 shortcode
 *
 * [bs-slider-2] shortcode
 *
 */

$atts = publisher_get_prop( 'bs-slider-2' );

// Slider ID
$slider_id = 'slider-' . rand( 1, 9999999 );

if ( empty( $atts['animation'] ) ) {
	$atts['animation'] = 'slide';
}

if ( empty( $atts['slideshow_speed'] ) ) {
	$atts['slideshow_speed'] = 7000;
}

if ( empty( $atts['animation_speed'] ) ) {
	$atts['animation_speed'] = 600;
}

$class = '';

?>
<div class="bs-shortcode bs-slider bs-slider-2 clearfix">

	<div class="better-slider" id="<?php echo esc_attr( $slider_id ); ?>">
		<ul class="slides">
			<?php

			publisher_set_prop( 'hide-meta-author-if-review', TRUE ); // hide author to make space for reviews

			while( publisher_have_posts() ) {

				publisher_the_post();

				// Creates main term ID that used for custom category color style
				$main_term = publisher_get_post_primary_cat();
				if ( ! is_wp_error( $main_term ) && is_object( $main_term ) ) {
					$main_term_class = 'main-term-' . $main_term->term_id;
				} else {
					$main_term_class = 'main-term-none';
				}

				if ( publisher_has_post_thumbnail() ) {
					$img     = publisher_get_thumbnail( publisher_get_prop_thumbnail_size( 'publisher-full' ) );
					$img_src = $img['src'];
					$class .= ' has-post-thumbnail';
				} else {
					$img_src = '';
					$class .= ' has-not-post-thumbnail';
				}

				?>
				<li class="slide bs-slider-item bs-slider-2-item <?php echo esc_attr( $class ); ?>">
					<div class="item-content">

						<a class="img-cont" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>"
						   style="background-image: url('<?php echo esc_url( $img_src ); ?>')"></a>
						<?php

						publisher_format_icon();

						?>
						<div class="content-container">
							<?php

							if ( publisher_get_prop( 'show-term-badge', TRUE ) ) {
								publisher_cats_badge_code( 1, '', FALSE, TRUE, 'floated' );
							}

							?>
							<h2 class="title">
								<a class="post-url" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>">
									<span <?php publisher_attr( 'post-title' ); ?>><?php publisher_echo_html_limit_words( get_the_title(), publisher_get_prop( 'title-limit', - 1 ) ); ?></span>
								</a>
							</h2>
							<?php

							if ( publisher_get_prop( 'show-meta', TRUE ) ) {
								publisher_get_view( 'loop', '_meta' );
							}

							?>
							<a class="read-more"
							   href="<?php the_permalink(); ?>"><?php publisher_translation_echo( 'continue_reading' ); ?></a>
						</div>
					</div>
					<?php publisher_meta_tag( 'full' ); ?>
				</li>
				<?php

			}
			?>

		</ul>
	</div>

	<script>
		jQuery(window).ready(function () {
			jQuery('#<?php echo esc_attr( $slider_id ); ?>').flexslider({
				namespace: "better-",
				animation: "<?php echo esc_attr( $atts['animation'] ); ?>",
				slideshowSpeed: "<?php echo esc_attr( $atts['slideshow_speed'] ); ?>",
				animationSpeed: "<?php echo esc_attr( $atts['animation_speed'] ); ?>",
				animationLoop: true,
				directionNav: true,
				pauseOnHover: true,
				start: function (slider) {
					jQuery(slider).find(".better-active-slide").addClass("slider-content-shown");
					window.dispatchEvent(new Event('resize')); // Fix for EQ
				},
				before: function (slider) {
					jQuery(slider).find(".slider-content-shown").removeClass("slider-content-shown");
				},
				after: function (slider) {
					jQuery(slider).find(".better-active-slide").addClass("slider-content-shown");
				}
			}).find('.better-control-nav').addClass('circle');
		});
	</script>
</div>
