<?php
/**
 * category.php
 *---------------------------
 * Used to display category archive page.
 *
 * Content is output based on which layout has been selected in theme option panel.
 * To view and/or edit the markup of layouts, go to "views/general/category" there is
 * some files tht handles multiple layouts.
 *
 * Layout files:
 *  - layout-1-col.php         : 1 column layout handler
 *  - layout-2-col-left.php    : 2 column, Sidebar right handler
 *  - layout-2-col-right.php   : 2 column, Sidebar right handler
 *
 */

get_header();

publisher_get_view( 'category', 'layout-' . publisher_get_page_layout() );

get_footer();
