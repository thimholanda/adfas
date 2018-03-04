<?php
/**
 * page.php
 *---------------------------
 * The template for displaying pages
 *
 */

get_header();

// Prints content with layout that is selected in panels.
// Location: "views/general/layout/*.php"
publisher_get_view( 'layout', publisher_get_page_layout() );

get_footer();
