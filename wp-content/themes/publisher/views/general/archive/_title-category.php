<?php
/**
 * _title-category.php
 *---------------------------
 * categories title template
 *
 */

global $wp_query;

$term_id = $wp_query->get_queried_object_id();

// If Term Title is Active
if ( bf_get_term_meta( 'hide_term_title' ) ) {
	return;
}

$container_class = array(); // temp

// category raw title
$term_name = single_term_title( '', FALSE );

// Pre title
if ( bf_get_term_meta( 'term_custom_pre_title' ) != '' ) {
	$pre_title = sprintf( bf_get_term_meta( 'term_custom_pre_title' ), $term_name );
} else {
	$pre_title = sprintf( publisher_translation_get( 'archive_cat_title' ), $term_name );
}

// Custom title
if ( bf_get_term_meta( 'term_custom_title' ) != '' ) {
	$title = sprintf( bf_get_term_meta( 'term_custom_title' ), $term_name );
} else {
	$title = $term_name;
}

// RSS Link
$rss_link          = get_category_feed_link( $term_id );
$container_class[] = 'with-actions';

// Term Description
$term_desc = '';
if ( ! bf_get_term_meta( 'hide_term_description' ) && term_description() ) {

	$term_desc = '<div class="desc">' . do_shortcode( term_description() ) . '</div>';

	$container_class[] = 'with-desc';
}

$show_subcategories = TRUE;
if ( $show_subcategories ) {
	$sub_categories = bf_get_child_categories( $wp_query->get_queried_object_id(), 7, TRUE );
}

if ( $show_subcategories && count( $sub_categories ) > 0 ) {
	$container_class[] = 'with-terms';
} else {
	$container_class[] = 'without-terms';
}

?>
<section class="archive-title category-title <?php echo esc_attr( implode( ' ', $container_class ) ); ?>">
	<div class="pre-title"><span><?php echo $pre_title; // escaped before ?></span></div>

	<div class="actions-container">
		<a class="rss-link" href="<?php echo esc_url( $rss_link ); ?>"><i class="fa fa-rss"></i></a>
	</div>

	<h1 class="page-heading"><span class="h-title"><?php echo $title; // escaped before ?></span></h1>
	<?php echo $term_desc; // escaped before inside WP ?>

	<?php

	if ( $show_subcategories && count( $sub_categories ) > 0 ) { ?>
		<div class="term-badges">
			<?php
			foreach ( $sub_categories as $term ) {
				?>
				<span class="term-badge term-<?php echo esc_attr( $term->term_id ); ?>">
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
				</span>
				<?php
			}

			?>
		</div>

		<?php
	}

	?>
</section>
