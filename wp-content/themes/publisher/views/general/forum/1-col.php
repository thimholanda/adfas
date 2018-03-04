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

			// Prints post and other post type templates
			// Location: "views/general/{posttype}/content.php"
			publisher_get_content_template();

			?>
		</div><!-- .content-column -->
	</div><!-- .main-section -->
</div><!-- .layout-1-col -->