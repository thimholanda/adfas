<?php
/**
 * main.php
 *---------------------------
 * Main menu template
 */

$menu_wrapper_class = 'main-menu-wrapper';

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

$show_search = publisher_get_option( 'menu_show_search_box' ) == 'show';
if ( $show_search ) {
	$menu_wrapper_class .= ' show-search-item';
}

$show_cart = publisher_get_option( 'menu_show_shop_cart' ) == 'show' && function_exists( 'is_woocommerce' ) && ! is_cart();
if ( $show_cart ) {
	$menu_wrapper_class .= ' show-cart-item';
}

?>
<div <?php publisher_attr( 'menu', $menu_wrapper_class, 'main' ); ?>>
	<div class="main-menu-inner">
		<div class="content-wrap">
			<div class="container">

				<nav class="main-menu-container">
					<ul id="main-navigation" class="main-menu menu bsm-pure clearfix">
						<?php

						if ( has_nav_menu( 'main-menu' ) ) {

							wp_nav_menu( $menu_args );

						} elseif ( is_user_logged_in() ) {

							if ( current_user_can( 'edit_theme_options' ) ) {
								?>
								<li>
									<a href="<?php echo admin_url( '/nav-menus.php?action=locations' ); ?>"><?php publisher_translation_echo( 'select_main_nav' ); ?></a>
								</li>
								<?php
							} else {
								?>
								<li><?php publisher_translation_echo( 'select_main_nav' ); ?></li>
								<?php
							}

						}

						?>
					</ul><!-- #main-navigation -->
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
				</nav><!-- .main-menu-container -->

			</div>
		</div>
	</div>
</div><!-- .menu -->