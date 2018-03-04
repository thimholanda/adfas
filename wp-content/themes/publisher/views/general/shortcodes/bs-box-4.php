<?php
/**
 * bs-box-4.php
 *---------------------------
 * The template to show box 4 shortcode/widget
 *
 * [bs-box-4] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-box-4-atts' );

?>
<div
	class="bs-shortcode bs-box bs-box-4  box-text-<?php echo esc_attr( $atts['text_align'] ); ?> <?php echo $atts['image'] ? '' : 'box-no-bg'; // escaped before 
	echo ' ' . $atts['css-class']; // escaped before ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	?>
	<div class="bs-box-inner">
		<?php

		$img_src = publisher_get_media_src( $atts['image'], 'publisher-tall-big' );

		?>
		<div class="box-content">
			<a class="box-image" itemprop="url" rel="bookmark" href="<?php echo esc_url( $atts['link'] ); ?>"
			   style="background-image: url('<?php echo esc_url( $img_src ); ?>')">
			</a>
			<div class="box-text">
				<?php if ( ! empty( $atts['box_icon'] ) ) {
					echo bf_get_icon_tag( $atts['box_icon'] ); // escaped before
				} ?>
				<h3 class="box-title"><?php echo esc_html( $atts['heading'] ); ?></h3>
				<p class="box-sub-title"><?php echo esc_html( $atts['text'] ); ?></p>
			</div>
		</div>
	</div>
</div>
