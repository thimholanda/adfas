<?php
/**
 * archive.php
 *---------------------------
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Content is output based on which layout has been selected in theme option panel.
 * To view and/or edit the markup of layouts, go to "views/general/layout" there is
 * some files tht handles multiple layouts.
 *
 * Layout files:
 *  - 1-col.php         : 1 column layout handler
 *  - 2-col-left.php    : 2 column, Sidebar right handler
 *  - 2-col-right.php   : 2 column, Sidebar right handler
 *
 */

get_header();

publisher_get_view( 'layout', publisher_get_page_layout() );

get_footer();
