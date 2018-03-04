<?php
/**
 * header-style-6.php
 *---------------------------
 * Header style 6 template
 */

?>
	<header <?php publisher_attr( 'header', 'site-header header-style-6 ' . publisher_get_header_layout() ); ?>>
		<?php

		// Show Topbar if is active
		if ( publisher_get_option( 'topbar_style' ) != 'hidden' ) {

			// Prints topbar code base the style was selected in panel.
			// Location: "views/general/header/topbar-*.php"
			publisher_get_view( 'header', 'topbar-' . publisher_get_option( 'topbar_style' ) );

		}

		?>
		<div class="content-wrap">
			<div class="container">
				<div class="header-inner clearfix">
					<?php

					publisher_get_view( 'header', '_brand', 'default' );

					publisher_get_view( 'menu', 'main-inline', 'default' );

					?>
				</div>
			</div>
		</div>
	</header><!-- .site-header -->
<?php

publisher_get_view( 'header', '_mobile-header', 'default' );
