<?php
/**
 * listing-blog-1.php
 *---------------------------
 * Blog listing template
 */


if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	<div class="listing listing-blog listing-blog-1 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php
}


while( publisher_have_posts() ) {
	publisher_the_post();
	publisher_get_view( 'loop', 'listing-blog-1-item' );
}


if ( publisher_get_prop( 'show-listing-wrapper', TRUE ) ) {
	?>
	</div>
	<?php
}
