<?php
/**
 * listing-mix-2-2.php
 *---------------------------
 * Mix listing template
 */

$_posts_count = publisher_get_prop( 'posts-count' );

?>
<div class="listing listing-mix-2-2 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">

	<div class="row">
		<div class="col-lg-12">
			<?php

			if ( publisher_have_posts() ) {
				publisher_set_prop( 'listing-class', 'columns-2' );
				publisher_set_prop( 'posts-count', 2 );

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
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php

			if ( ! empty( $_posts_count ) && ( intval( $_posts_count ) - 2 ) > 0 ) {
				publisher_set_prop( 'posts-count', $_posts_count );
			} else {
				publisher_unset_prop( 'posts-count' );
			}

			if ( publisher_have_posts() ) {
				publisher_set_prop( 'listing-class', 'columns-2' );
				publisher_get_view( 'loop', 'listing-text-2' );
			}

			?>
		</div>
	</div>
</div>
