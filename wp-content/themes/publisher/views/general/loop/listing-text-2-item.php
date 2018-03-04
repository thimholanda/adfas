<?php
/**
 * listing-text-2-item.php
 *---------------------------
 * Text listing item template
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
<article <?php publisher_attr( 'post', publisher_get_prop_class() . ' listing-item listing-item-text listing-item-text-2 ' . $main_term_class ); ?>>
	<div class="item-inner">
		<h2 class="title">
			<a <?php publisher_attr( 'post-url' ); ?>><span <?php publisher_attr( 'post-title' ); ?>><?php publisher_echo_html_limit_words( get_the_title(), 70 ); ?></span></a>
		</h2>
		<?php publisher_get_view( 'loop', '_meta' ); ?>
		<?php publisher_meta_tag( 'full' ); ?>
	</div>
</article>
