<?php
/**
 * listing-mix-1-2.php
 *---------------------------
 * Mix listing 1-2 template
 *
 */
?>
<div class="listing listing-mix-1-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="column-1">
		<?php

		if ( publisher_have_posts() ) {
			publisher_the_post();
			publisher_get_view( 'loop', 'listing-grid-1-item' );
		}

		?>
	</div>
	<div class="column-2">
		<?php

		if ( publisher_have_posts() ) {
			publisher_set_prop( 'listing-class', 'columns-2' );
			publisher_get_view( 'loop', 'listing-thumbnail-2' );
		}

		?>
	</div>
</div>
