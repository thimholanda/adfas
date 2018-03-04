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

			// Prints post and other post type templates
			// Location: "views/general/{posttype}/content.php"
			publisher_get_content_template();

			?>
		</div><!-- .content-column -->

		<div class="col-sm-4 sidebar-column">
			<?php get_sidebar(); ?>
		</div><!-- .sidebar-column -->

	</div><!-- .main-section -->
</div><!-- .layout-2-col -->