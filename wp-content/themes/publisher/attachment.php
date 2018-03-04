<?php
/**
 * attachment.php
 *---------------------------
 * The template for displaying attachments content
 *
 */

get_header();

// Prints content with layout that is selected in panels.
// Location: "views/general/layout/*.php"
// The attachment content file is located in: "views/general/attachment/content.php"
publisher_get_view( 'layout', publisher_get_page_layout() );

get_footer();
