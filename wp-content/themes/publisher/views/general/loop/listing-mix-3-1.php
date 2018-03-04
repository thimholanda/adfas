<?php
/**
 * listing-mix-3-1.php
 *---------------------------
 * Mix listing 3-1 template
 */

$_posts_count = publisher_get_prop( 'posts-count' );

?>
<div class="listing listing-mix-3-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<div class="row-1">
		<?php

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

			publisher_set_prop( 'listing-class', 'columns-1' );
			publisher_get_view( 'loop', 'listing-thumbnail-1' );

			?>
		</div>
		<?php
	}

	?>
</div>
