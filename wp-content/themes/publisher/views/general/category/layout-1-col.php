<?php
/**
 * layout-1-col.php
 *---------------------------
 * Single column layout template file.
 *
 */

// Prepares the main slider config
$slider_config = publisher_cat_main_slider_config();

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
	<div class="container layout-1-col layout-no-sidebar">
		<div class="main-section">
			<div class="content-column">
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

		</div><!-- .main-section -->
	</div><!-- .layout-1-col -->