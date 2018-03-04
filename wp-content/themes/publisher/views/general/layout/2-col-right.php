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

			if ( is_singular() ) {

				// Prints post and other post type templates
				// Location: "views/general/{posttype}/content.php"
				publisher_get_content_template();

			} // Other pages template
			else {

				// Prints the title of archive pages
				// Location: "views/general/archive/page.php"
				publisher_get_view( 'archive', 'title' );

				if ( publisher_have_posts() ) {

					// You can use this for adding codes before the main loop
					do_action( 'publisher/archive/before-loop' );

					// Prints posts base of listing that was selected in panels.
					// Location: "views/general/loop/listing-*.php"
					publisher_get_view( 'loop', publisher_get_page_listing() );

					// You can use this to add some code after the main query.
					// the pagination will be printed from this action.
					do_action( 'publisher/archive/after-loop' );


				} else {

					// Prints no result message
					// Location: "views/general/loop/_none-result.php"
					publisher_get_view( 'loop', '_none-result' );

				}

			}

			?>
		</div><!-- .content-column -->

		<div class="col-sm-4 sidebar-column">
			<?php get_sidebar(); ?>
		</div><!-- .sidebar-column -->

	</div><!-- .main-section -->
</div><!-- .layout-2-col -->
