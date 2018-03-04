<?php
/**
 * main.php
 *---------------------------
 * Main menu inline mode template
 */

$menu_args = array(
	'theme_location' => 'main-menu',
	'container'      => FALSE,
	'items_wrap'     => '%3$s',
	'fallback_cb'    => 'BF_Menu_Walker',
);

// Custom menu for category
if ( is_category() ) {
	if ( bf_get_term_meta( 'main_nav_menu' ) != 'default' ) {
		$menu_args['menu'] = bf_get_term_meta( 'main_nav_menu' );
	}
} // Custom menu for page
elseif ( is_singular( 'page' ) ) {
	if ( bf_get_post_meta( 'main_nav_menu' ) != 'default' ) {
		$menu_args['menu'] = bf_get_post_meta( 'main_nav_menu' );
	}
} // Custom menu for search page
elseif ( is_search() ) {
	if ( publisher_get_option( 'search_menu' ) != 'default' ) {
		$menu_args['menu'] = publisher_get_option( 'search_menu' );
	}
} // custom menu for 404 page
elseif ( is_404() ) {
	if ( publisher_get_option( 'archive_404_menu' ) != 'default' ) {
		$menu_args['menu'] = publisher_get_option( 'archive_404_menu' );
	}
}

$menu_container_class = 'main-menu-container ';

$show_search = publisher_get_option( 'menu_show_search_box' ) == 'show';
if ( $show_search ) {
	$menu_container_class .= ' show-search-item';
}

$show_cart = publisher_get_option( 'menu_show_shop_cart' ) == 'show' && function_exists( 'is_woocommerce' ) && ! is_cart();
if ( $show_cart ) {
	$menu_container_class .= ' show-cart-item';
}

?>
<nav class="<?php echo esc_attr( $menu_container_class ); // escaped before; ?>">
	<?php

	if ( $show_search ) {
		?>
		<div class="search-container close">
			<span class="search-handler"><i class="fa fa-search"></i></span>

			<div class="search-box clearfix">
				<?php publisher_get_view( 'wp', 'searchform', 'default' ); ?>
			</div>
		</div>
		<?php
	}

	if ( $show_cart ) {
		publisher_get_view( 'woocommerce', 'menu-cart', 'default' );
	}

	?>
	<ul id="main-navigation" class="main-menu menu bsm-pure clearfix">
		<?php

		if ( has_nav_menu( 'main-menu' ) ) {

			wp_nav_menu( $menu_args );

		} elseif ( is_user_logged_in() ) {

			?>
			<li><?php publisher_translation_echo( 'select_main_nav' ); ?></li>
			<?php

		}

		?>
	</ul><!-- #main-navigation -->
</nav><!-- .main-menu-container -->
