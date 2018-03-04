<?php
/**
 * single.php
 *---------------------------
 * The template for displaying posts
 *
 */

get_header();

$template = publisher_get_single_template();

// Prints content with layout that is selected in panels.
// Location: "views/general/post/style-*.php"
publisher_get_view( 'post', $template );

get_footer();
