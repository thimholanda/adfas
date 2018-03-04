<?php
/**
 * header.php
 *---------------------------
 * The template for displaying the header.
 *
 */

// Prints all codes before <body> tag.
// Location: "views/general/header/_common.php"
publisher_get_view( 'header', '_common', 'general' );

?>
<div class="main-wrap">
	<?php

	// Prints header code base the style was selected in panel.
	// Location: "views/general/header/header-*.php"
	publisher_get_view( 'header', 'header-' . publisher_get_header_style() );

	?>
	<div class="content-wrap">
		<main <?php publisher_attr( 'content', '' ); ?>>