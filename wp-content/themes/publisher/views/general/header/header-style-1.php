<?php
/**
 * header-style-1.php
 *---------------------------
 * Header style 1 template
 */

?>
	<header <?php publisher_attr( 'header', 'site-header header-style-1 ' . publisher_get_header_layout() ); ?>>
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
					<?php publisher_get_view( 'header', '_brand', 'default' ); ?>
				</div>
			</div>
		</div>
		<?php publisher_get_view( 'menu', 'main', 'default' ); ?>
	</header><!-- .header -->
<?php

publisher_get_view( 'header', '_mobile-header', 'default' );
