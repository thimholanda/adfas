<?php
/**
 * top.php
 *---------------------------
 * Top menu template
 *
 */

$menu_args = array(
	'theme_location' => 'top-menu',
	'container'      => FALSE,
	'items_wrap'     => '%3$s',
	'fallback_cb'    => 'BF_Menu_Walker',
);

$menu_wrapper_class[]   = 'top-menu-wrapper';
$menu_container_class[] = 'top-menu-container';
$menu_class[]           = 'top-menu menu clearfix bsm-pure';

?>
<div <?php publisher_attr( 'menu', implode( ' ', $menu_wrapper_class ), 'top' ); ?>>
	<nav class="<?php echo esc_attr( implode( ' ', $menu_container_class ) ); ?>">

		<ul id="top-navigation" class="<?php echo esc_attr( implode( ' ', $menu_class ) ); ?>">
			<?php

			if ( publisher_get_option( 'topbar_show_date' ) == 'show' ) {
				?>
				<li id="topbar-date" class="menu-item menu-item-date">
					<span
						class="topbar-date"><?php echo current_time( publisher_translation_get( 'topbar_date_format' ) ); ?></span>
				</li>
				<?php
			}

			if ( has_nav_menu( 'top-menu' ) ) {

				wp_nav_menu( $menu_args );

			} elseif ( is_user_logged_in() ) {

				if ( is_user_logged_in() ) {
					?>
					<li>
						<a href="<?php echo admin_url( '/nav-menus.php?action=locations' ); ?>"><?php publisher_translation_echo( 'select_top_nav' ); ?></a>
					</li>
					<?php
				} else {
					?>
					<li><?php publisher_translation_echo( 'select_top_nav' ); ?></li>
					<?php
				}

			}

			?>
		</ul>

	</nav>
</div>
