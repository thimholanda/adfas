<?php
/**
 * _brand.php
 *---------------------------
 * Prints branding information's of site
 *
 */

$site_name = publisher_get_option( 'logo_text' );
if ( empty( $site_name ) ) {
	$site_name = get_bloginfo( 'name' );
}                   // Site name
$site_name = do_shortcode( $site_name );

$logo   = publisher_get_option( 'logo_image' );        // Site logo
$logo2x = publisher_get_option( 'logo_image_retina' ); // Site 2X logo

// Custom logo for categories
if ( is_category() && bf_get_term_meta( 'logo_image' ) != '' ) {
	$logo   = bf_get_term_meta( 'logo_image' );
	$logo2x = bf_get_term_meta( 'logo_image_retina' );
} // Custom logo for categories
elseif ( is_singular( 'page' ) && bf_get_post_meta( 'logo_image' ) != '' ) {
	$logo   = bf_get_post_meta( 'logo_image' );
	$logo2x = bf_get_post_meta( 'logo_image_retina' );
}


// Make it retina friendly
if ( $logo2x != '' ) {
	$logo2x = ' data-at2x="' . $logo2x . '" ';
}

?>
<div <?php publisher_attr( 'site' ) ?>>
	<h1 <?php publisher_attr( 'site-title', 'logo ' . ( empty( $logo ) ? 'text-logo' : 'img-logo' ) ); ?>>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php publisher_attr( 'site-url' ); ?>>
			<?php

			// Site logo
			if ( ! empty( $logo ) ) { ?>
				<img id="site-logo" src="<?php echo esc_url( $logo ); ?>"
				     alt="<?php echo esc_attr( $site_name ); ?>" <?php publisher_attr( 'site-logo' );
				echo esc_url( $logo2x ); ?> />
			<?php } // Site title as text logo
			else {
				echo $site_name; // escaped before in WP
			}

			?>
		</a>
	</h1>
</div><!-- .site-branding -->