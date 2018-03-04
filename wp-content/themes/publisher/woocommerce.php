<?php
/**
 * woocommerce.php
 *---------------------------
 * The template for displaying WooCommerce pages
 *
 */

get_header();

// Prints content with layout that is selected in panels.
// Location: "views/general/woocommerce/{1-col, 2-col-left, 2col-right}.php"
publisher_get_view( 'woocommerce', publisher_get_page_layout() );

get_footer();
