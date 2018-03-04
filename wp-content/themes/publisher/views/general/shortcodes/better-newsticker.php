<?php
/**
 * better-newsticker.php
 *---------------------------
 * The template to show BetterNewsticker shortcode/widget
 *
 * [better-newsticker] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-better-newsticker' );

bf_shortcode_show_title( $atts ); // show title

// Term class
$class = '';
if ( ! empty( $atts['cat'] ) ) {
	$class = 'term-' . $atts['cat'];
}

if ( ! empty( $atts['class'] ) ) {
	$class .= ' ' . $atts['class'];
}

if ( ! empty( $atts['css-class'] ) ) {
	$class .= ' ' . $atts['css-class'];
}

if ( intval( $atts['count'] ) <= 0 || empty( $atts['count'] ) ) {
	$atts['count'] = 10;
}

$id = 'newsticker-' . rand( 1, 9999999 );

?>
<div id="<?php echo esc_attr( $id ); ?>" class="better-newsticker <?php echo esc_attr( $class ); ?>"
     data-speed="<?php echo esc_attr( intval( $atts['speed'] ) * 1000 ); ?>">
	<p class="heading "><?php echo esc_html( $atts['ticker_text'] ); ?></p>
	<ul class="news-list">
		<?php

		$args = array(
			'posts_per_page' => $atts['count'],
			'post_type'      => 'post'
		);

		if ( ! empty( $atts['cat'] ) ) {
			$args['cat'] = $atts['cat'];
		}

		$query = new WP_Query( apply_filters( 'better-news-ticker/query/args', $args ) );

		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post(); ?>
				<li><a class="limit-line" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
			}
		} else { ?>
			<li class="limit-line"> ...</li>
		<?php } ?>
	</ul>
</div>
