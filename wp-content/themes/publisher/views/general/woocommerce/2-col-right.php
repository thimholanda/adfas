<?php
/**
 * 2-col-right.php
 *---------------------------
 * 2 column layout with right sidebar.
 *
 */

?>
<div class="container layout-2-col layout-right-sidebar">
	<div class="row main-section">

		<div class="col-sm-8 content-column">
			<?php

			publisher_get_view( 'woocommerce', 'loop', 'default' );

			?>
		</div><!-- .content-column -->

		<div class="col-sm-4 sidebar-column">
			<?php

			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );

			?>
		</div><!-- .sidebar-column -->

	</div><!-- .main-section -->
</div><!-- .layout-2-col -->
