<?php
/**
 * instagram-style-2.php
 *---------------------------
 * footer instagram style-2
 */

$username = publisher_get_option( 'footer_instagram' );

?>
<div class="footer-instagram footer-instagram-2 clearfix">
	<h3 class="footer-instagram-label"><?php publisher_translation_echo( 'footer_instagram_follow' ); ?> <a
			href="http://instagram.com/<?php echo esc_attr( $username ); ?>">@<?php echo esc_html( $username ); ?></a>
	</h3>
	<?php

	$images_list = publisher_shortcode_instagram_get_data( array(
		'user_id'     => $username,
		'photo_count' => 8,
		'show_title'  => 0,
	) );

	if ( $images_list != FALSE ) {

		// Show error message
		if ( is_wp_error( $images_list ) && is_user_logged_in() ) {
			echo $images_list->get_error_message(); // escaped before
		} // Print images
		elseif ( ! is_wp_error( $images_list ) ) {

			foreach ( $images_list as $image_id => $image ) {

				$img_url = $image['images']['small'];

				echo '<div class="bs-instagram-photo bs-instagram-photo-' . $image_id . '">
					<a href="' . esc_url( $image['link'] ) . '" target="_blank">
						<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $image['description'] ) . '" />
					</a>
				</div>';

			}

		}
	}

	?>
</div>
