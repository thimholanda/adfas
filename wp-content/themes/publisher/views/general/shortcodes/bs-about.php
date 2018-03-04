<?php
/**
 * bs-about.php
 *---------------------------
 * The template to show about shortcode/widget
 *
 * [bs-about] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-about-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-about <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	?>
	<h4 class="about-title">
		<?php

		if ( $atts['about_link_url'] != '' ){
		?><a href="<?php echo esc_url( $atts['about_link_url'] ); ?>"><?php
			}

			if ( $atts['logo_img'] ) { ?>
				<img class="logo-image" src="<?php echo esc_url( $atts['logo_img'] ); ?>"
				     alt="<?php echo esc_attr( $atts['logo_text'] ); ?>">
			<?php } else {
				echo esc_html( $atts['logo_text'] );
			}

			if ( $atts['about_link_url'] != '' ){
			?></a><?php
	}

	?>
	</h4>
	<div class="about-text">
		<?php echo wpautop( do_shortcode( $atts['content'] ) ); // escaped before ?>
	</div>
	<?php if ( $atts['about_link_url'] != '' ) { ?>
		<div class="about-link heading-typo">
			<a href="<?php echo esc_url( $atts['about_link_url'] ); ?>"><?php echo esc_html( $atts['about_link_text'] ); ?></a>
		</div>
	<?php }

	echo publisher_shortcode_about_get_icons( $atts );  // escaped before 

	?>
</div>
