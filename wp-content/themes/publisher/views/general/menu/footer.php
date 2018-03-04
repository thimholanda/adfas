<?php
/**
 * footer.php
 *---------------------------
 * Footer menu template
 *
 */

if ( ! has_nav_menu( 'footer-menu' ) ) {
	return;
}

$menu_args = array(
	'theme_location' => 'footer-menu',
	'container'      => FALSE,
	'items_wrap'     => '%3$s',
	'fallback_cb'    => 'BF_Menu_Walker',
);

$menu_wrapper_class[]   = 'footer-menu-wrapper';
$menu_container_class[] = 'footer-menu-container';
$menu_class[]           = 'footer-menu menu clearfix';


?>
<div class="row">
	<div class="col-lg-12">
		<div <?php publisher_attr( 'menu', implode( ' ', $menu_wrapper_class ), 'footer' ); ?>>
			<nav class="<?php echo esc_attr( implode( ' ', $menu_container_class ) ); ?>">
				<ul id="footer-navigation" class="<?php echo esc_attr( implode( ' ', $menu_class ) ); ?>">
					<?php

					if ( has_nav_menu( 'footer-menu' ) ) {

						wp_nav_menu( $menu_args );

					}
					?>
				</ul><!-- #footer-navigation -->
			</nav><!-- .footer-menu-container -->
		</div><!-- .footer-menu-wrapper -->
	</div>
</div>