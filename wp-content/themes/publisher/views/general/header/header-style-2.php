<?php
/**
 * header-style-2.php
 *---------------------------
 * Header style 2 template
 */

$ad = publisher_get_ad_location_data( 'header_aside_logo' );

?>
	<header <?php publisher_attr( 'header', 'site-header header-style-2 ' . publisher_get_header_layout() ); ?>>

		<?php

		// Show Topbar if is active
		if ( publisher_get_option( 'topbar_style' ) != 'hidden' ) {

			// Prints topbar code base the style was selected in panel.
			// Location: "views/general/header/topbar-*.php"
			publisher_get_view( 'header', 'topbar-' . publisher_get_option( 'topbar_style' ) );

		}

		?>
		<div class="header-inner">
			<div class="content-wrap">
				<div class="container">
					<div class="row">
						<div class="row-height">
							<div class="logo-col <?php echo $ad['active_location'] ? 'col-xs-4' : 'col-xs-12'; ?>">
								<div class="col-inside">
									<?php publisher_get_view( 'header', '_brand', 'default' ); ?>
								</div>
							</div>
							<?php

							if ( $ad['active_location'] ) {
								?>
								<div class="sidebar-col col-xs-8">
									<nav class="top-menu-container" style="float:right">

		<ul id="top-navigation" class="top-menu menu clearfix bsm-initialized">
							
				<li id="menu-item-295" class="menu-item menu-item-type-custom menu-item-object-custom better-anim-fade menu-have-icon menu-icon-type-fontawesome menu-item-295"><a href="http://adfas.org.br/login/"><i class="bf-icon  fa fa-unlock-alt"></i>LOGIN</a></li>
<li id="menu-item-1285" class="menu-item menu-item-type-custom menu-item-object-custom better-anim-fade menu-have-icon menu-icon-type-fontawesome menu-item-1285"><a href="http://adfas.org.br/registro/"><i class="bf-icon  fa fa-user"></i>REGISTRO</a></li>
<li id="menu-item-296" class="menu-item menu-item-type-custom menu-item-object-custom better-anim-fade menu-have-icon menu-icon-type-fontawesome menu-item-296"><a href="http://adfas.org.br/associe-se/"><i class="bf-icon  fa fa-check"></i>ASSOCIE-SE</a></li>
</ul>

	</nav>
								</div>
								<?php
							}

							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php publisher_get_view( 'menu', 'main', 'default' ); ?>

	</header><!-- .header -->
<?php

publisher_get_view( 'header', '_mobile-header', 'default' );
