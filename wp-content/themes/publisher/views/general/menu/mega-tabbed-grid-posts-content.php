<?php
/**
 * mega-tabbed-grid-posts-content.php
 *---------------------------
 * the content part of mega-tabbed-grid-posts.php
 */

publisher_set_prop( 'show-excerpt', FALSE );
publisher_set_prop( 'show-meta', FALSE );
publisher_set_prop( 'listing-class', 'columns-3' );
publisher_set_prop_class( 'simple-grid' );
publisher_get_view( 'loop', 'listing-grid-1' );
