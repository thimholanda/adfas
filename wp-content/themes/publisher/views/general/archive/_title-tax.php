<?php
/**
 * _title-tax.php
 *---------------------------
 * Other taxonomies title template
 *
 */

$container_class = array(); // temp

// tax term raw name
$term_name = single_term_title( '', FALSE );

// Pre title
$pre_title = sprintf( publisher_translation_get( 'archive_tax_title' ), $term_name );

// Term Description
$term_desc = '';
if ( term_description() ) {

	$term_desc = '<div class="desc">' . do_shortcode( term_description() ) . '</div>';

	$container_class[] = 'with-desc';
}

?>
<section class="archive-title tax-title <?php echo esc_attr( implode( ' ', $container_class ) ); ?>">
	<div class="pre-title"><span><?php echo $pre_title; // escaped before ?></span></div>
	<h1 class="page-heading"><span class="h-title"><?php echo $term_name; // escaped before ?></span></h1>
	<?php echo $term_desc; // escaped before ?>
</section>
