<?php
/**
 * bs-popular-categories.php
 *---------------------------
 * The template to show popular categories shortcode/widget
 *
 * [bs-popular-categories] shortcode
 */

$atts = publisher_get_prop( 'shortcode-bs-popular-categories-atts' );

if ( empty( $atts['css-class'] ) ) {
	$atts['css-class'] = '';
}

?>
<div class="bs-shortcode bs-popular-categories <?php echo esc_attr( $atts['css-class'] ); ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	$args = array(
		'orderby'    => 'count',
		'show_count' => TRUE,
		'hide_empty' => FALSE,
		'order'      => 'DESC',
		'number'     => intval( $atts['count'] ) > 0 ? intval( $atts['count'] ) : 6,
		'exclude'    => 1, // Exclude unauthorized
	);

	$categories = get_categories( $args );

	if ( ! empty( $categories ) ) {

		?>
		<ul class="bs-popular-terms-list">
			<?php

			foreach ( $categories as $term ) {
				echo '<li class="bs-popular-term-item term-item-' . esc_attr( $term->term_id ) . '">
					<a href="' . esc_url( get_category_link( $term->term_id ) ) . '">' . $term->name . '<span class="term-count">' . $term->count . '</span></a>
				  </li>'; // escaped before
			}

			?>
		</ul>
		<?php
	}

	?>
</div><!-- .bs-popular-categories -->
