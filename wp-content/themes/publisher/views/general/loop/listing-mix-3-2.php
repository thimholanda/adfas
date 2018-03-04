<?php
/**
 * listing-mix-3-2.php
 *---------------------------
 * Mix listing 3-2 template
 */

$_posts_count = publisher_get_prop( 'posts-count' );

?>
<div class="listing listing-mix-3-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="row-1">
		<?php

		publisher_set_prop( 'show-excerpt', TRUE );

		if ( publisher_have_posts() ) {
			publisher_set_prop( 'listing-class', 'columns-1' );
			publisher_set_prop( 'posts-count', 1 );

			?>
			<div class="listing listing-grid-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
				<?php

				while( publisher_have_posts() ) {
					publisher_the_post();
					publisher_get_view( 'loop', 'listing-grid-1-item' );
				}

				?>
			</div>
			<?php
		}

		?>
	</div>
	<?php

	if ( ! empty( $_posts_count ) && ( intval( $_posts_count ) - 2 ) > 0 ) {
		publisher_set_prop( 'posts-count', $_posts_count );
	} else {
		publisher_unset_prop( 'posts-count' );
	}

	if ( publisher_have_posts() ) {
		?>
		<div class="row-2">
			<?php

			publisher_set_prop( 'listing-class', 'columns-2' );
			publisher_get_view( 'loop', 'listing-thumbnail-2' );

			?>
		</div>
		<?php
	}

	?>
</div>
