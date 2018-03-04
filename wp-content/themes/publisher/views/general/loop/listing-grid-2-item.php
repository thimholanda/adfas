<?php
/**
 * listing-grid-2-item.php
 *---------------------------
 * Grid listing 2 item template
 *
 */

// Creates main term ID that used for custom category color style
$main_term = publisher_get_post_primary_cat();
if ( ! is_wp_error( $main_term ) && is_object( $main_term ) ) {
	$main_term_class = 'main-term-' . $main_term->term_id;
} else {
	$main_term_class = 'main-term-none';
}

?>
<article <?php publisher_attr( 'post', publisher_get_prop_class() . ' listing-item listing-item-grid listing-item-grid-2 ' . $main_term_class ); ?>>

	<h2 class="title">
		<a <?php publisher_attr( 'post-url' ); ?>><span <?php publisher_attr( 'post-title' ); ?>><?php publisher_echo_html_limit_words( get_the_title(), 82 ); ?></span></a>
	</h2>

	<?php

	if ( publisher_get_prop( 'show-meta', TRUE ) ) {
		publisher_get_view( 'loop', '_meta' );
	}

	?>
	<?php if ( publisher_has_post_thumbnail() ) { ?>
		<div class="featured clearfix">
			<?php publisher_cats_badge_code( 1, '', FALSE, TRUE, 'floated' ); ?>
			<?php $img = publisher_get_thumbnail( publisher_get_prop_thumbnail_size( 'publisher-md' ) ); ?>
			<a class="img-holder" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>"
			   style="background-image: url(<?php echo esc_url( $img['src'] ); ?>);"></a>
			<?php publisher_format_icon(); ?>
			<?php edit_post_link( publisher_translation_get( 'edit_post' ) ); ?>
		</div>
	<?php } ?>

	<?php if ( publisher_get_prop( 'show-excerpt', TRUE ) ) { ?>
		<div <?php publisher_attr( 'post-lead' ); ?>>
			<?php publisher_the_excerpt( 115, NULL, TRUE, FALSE ); ?>
		</div>
	<?php } ?>

	<?php publisher_meta_tag( 'full' ); ?>

</article>