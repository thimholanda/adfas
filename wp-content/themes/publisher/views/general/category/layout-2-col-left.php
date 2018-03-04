<?php
/**
 * layout-2-col-right.php
 *---------------------------
 * 2 column layout with right sidebar.
 *
 */

// Default slider config
$slider_config = array( 'show' => FALSE );

// Show slider only in category archives
if ( is_category() ) {
	$slider_config = publisher_cat_main_slider_config();
}

// Temp flag for making decision to show not found posts or not
$posts_printed = FALSE;

// Show slider -> Not in columns
if ( $slider_config['show'] && ! $slider_config['in-column'] ){

$posts_printed = TRUE; // flag

?>
</div><!-- .content-wrap --><?php

publisher_get_view( 'category', 'slider' );

?>
<div class="content-wrap"><?php

	}

	?>
	<div class="container layout-2-col layout-left-sidebar">
		<div class="row main-section">

			<div class="col-sm-8 col-sm-push-4 content-column">
				<?php

				// Show slider -> In columns
				if ( $slider_config['show'] && $slider_config['in-column'] ) {

					$posts_printed = TRUE; // flag

					publisher_get_view( 'category', 'slider' );

				}

				// Prints the title of archive pages
				// Location: "views/general/archive/title.php"
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


				} elseif ( ! $posts_printed ) {

					// Prints no result message
					// Location: "views/general/loop/_none-result.php"
					publisher_get_view( 'loop', '_none-result' );

				}

				?>
			</div><!-- .content-column -->

			<div class="col-sm-4 col-sm-pull-8 sidebar-column">
				<?php get_sidebar(); ?>
			</div><!-- .sidebar-column -->

		</div><!-- .main-section -->
	</div><!-- .layout-2-col-left -->