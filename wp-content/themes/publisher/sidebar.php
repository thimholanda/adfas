<?php
/**
 * sidebar.php
 *---------------------------
 * The template for displaying sidebars.
 *
 */
?>
<aside <?php publisher_attr( 'sidebar', '', 'primary-sidebar' ) ?>>
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside>
