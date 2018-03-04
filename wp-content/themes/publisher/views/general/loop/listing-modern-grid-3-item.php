<?php
/**
 * grid-item.php
 *---------------------------
 * Grid listing item template
 *
 */

if ( publisher_has_post_thumbnail() ) {
	$img     = publisher_get_thumbnail( publisher_get_prop_thumbnail_size( 'publisher-lg' ) );
	$img_src = $img['src'];
} else {
	$img_src = '';
}

// Creates main term ID that used for custom category color style
$main_term = publisher_get_post_primary_cat();
if ( ! is_wp_error( $main_term ) && is_object( $main_term ) ) {
	$main_term_class = 'main-term-' . $main_term->term_id;
} else {
	$main_term_class = 'main-term-none';
}

?>
<article <?php publisher_attr( 'post', publisher_get_prop_class() . ' listing-item listing-mg-item listing-mg-3-item ' . $main_term_class ) ?>>
	<div class="item-content">
		<a class="img-cont" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>"
		   style="background-image: url('<?php echo esc_url( $img_src ); ?>')"></a>
		<?php publisher_format_icon(); ?>
		<div class="content-container">
			<?php publisher_cats_badge_code( 1, '', FALSE, TRUE, 'floated' ); ?>
			<h2 class="title">
				<a class="post-url" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>">
					<span <?php publisher_attr( 'post-title' ); ?>><?php publisher_echo_html_limit_words( get_the_title(), publisher_get_prop( 'title-limit', - 1 ) ); ?></span>
				</a>
			</h2>
			<?php publisher_get_view( 'loop', '_meta' ); ?>
		</div>
	</div>
	<?php publisher_meta_tag( 'full' ); ?>
</article>
