<?php
/**
 * 2-col-left.php
 *---------------------------
 * 2 column layout with left sidebar.
 *
 */

?>
<div class="container layout-2-col layout-left-sidebar">
	<div class="row main-section">

		<div class="col-sm-8 col-sm-push-4 content-column">
			<?php

			publisher_get_view( 'woocommerce', 'loop', 'default' );

			?>
		</div><!-- content-column -->

		<div class="col-sm-4 col-sm-pull-8 sidebar-column">
			<?php

			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );

			?>
		</div><!-- .sidebar-column -->

	</div><!-- main-section -->
</div><!-- .layout-2-col -->
