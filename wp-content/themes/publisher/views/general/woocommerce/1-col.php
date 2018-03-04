<?php
/**
 * 1-col.php
 *---------------------------
 * Single column layout template file.
 *
 */

?>
<div class="container layout-1-col layout-no-sidebar">
	<div class="main-section">
		<div class="content-column">
			<?php

			publisher_get_view( 'woocommerce', 'loop', 'default' );

			?>
		</div><!-- .content-column -->
	</div><!-- .main-section -->
</div><!-- .layout-1-col -->
