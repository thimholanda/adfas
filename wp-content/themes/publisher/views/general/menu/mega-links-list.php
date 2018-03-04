<?php
/**
 * mega-links-list.php
 *---------------------------
 * Horizontal mega menu template
 *
 */

$args = publisher_get_prop( 'mega-menu-args', array() );

?>
	<div class="mega-menu mega-type-link-list">
		<ul class="mega-links">
			<?php echo $args['sub-menu']; // escaped before ?>
		</ul>
	</div>
<?php

publisher_clear_props();
