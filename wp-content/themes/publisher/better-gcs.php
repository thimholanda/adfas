<?php
/**
 * better-gcs.php
 *---------------------------
 * "Better Google Custom Search" plugin template.
 *
 */

get_header();

?>
	<div class="container layout-2-col layout-right-sidebar">
		<div class="row main-section">

			<div class="col-sm-8 content-column">
				<?php

				Better_GCS_Search_Box();

				?>
			</div><!-- .content-column -->

			<div class="col-sm-4 sidebar-column">
				<?php get_sidebar(); ?>
			</div><!-- .sidebar-column -->

		</div><!-- .main-section -->
	</div><!-- .layout-2-col -->
<?php

get_footer();