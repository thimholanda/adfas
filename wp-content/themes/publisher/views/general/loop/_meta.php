<?php


$show_comments = TRUE;
$show_reviews  = FALSE;
$show_author   = TRUE;
$show_date     = TRUE;


/**
 *
 * Single Logic Conditions
 *
 */

if ( publisher_get_prop( 'hide-meta-date', FALSE ) ) {
	$show_date = FALSE;
}

if ( publisher_get_prop( 'hide-meta-comments', FALSE ) || ! comments_open() ) {
	$show_comments = FALSE;
}

if ( publisher_get_prop( 'hide-meta-author', FALSE ) ) {
	$show_author = FALSE;
}

if ( function_exists( 'Better_Reviews' ) && Better_Reviews()->generator()->is_review_enabled() ) {
	$show_reviews = TRUE;
}


/**
 *
 * Multiple Logic Conditions
 *
 */

// Hide comments to make space for review
if ( $show_comments && publisher_get_prop( 'hide-meta-comments-if-review', FALSE ) && $show_reviews ) {
	$show_comments = FALSE;
}

// Hide author to make space for review
if ( $show_author && publisher_get_prop( 'hide-meta-author-if-review', 0 ) && $show_reviews ) {
	$show_author = FALSE;
}

?>
<div <?php publisher_attr( 'post-meta' ); ?>>

	<?php if ( $show_author ) { ?>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemscope="itemscope"
		   itemprop="url" title="<?php echo publisher_translation_esc_attr( 'browse_auth_articles' ); ?>"
		   class="post-author-a">
			<i <?php publisher_attr( 'post-meta-author', 'author' ); ?>>
				<?php the_author(); ?>
			</i>
		</a>
	<?php }


	if ( $show_date ) {
		?>
		<span class="time"><time <?php publisher_attr( 'post-meta-published' ); ?>><?php the_time( publisher_translation_get( 'comment_time' ) ); ?></time></span>
		<?php
	}


	if ( $show_reviews ) {
		$atts = Better_Reviews()->generator()->prepare_rate_atts();
		echo Better_Reviews()->generator()->get_rating( Better_Reviews()->generator()->calculate_overall_rate( $atts ), $atts['type'] ); // escaped before
	}


	if ( $show_comments ) {

		$title  = apply_filters( 'better-studio/theme/meta/comments/title', get_the_title() );
		$link   = apply_filters( 'better-studio/theme/meta/comments/link', get_comments_link() );
		$number = apply_filters( 'better-studio/theme/meta/comments/number', get_comments_number() );

		$text = '<i class="fa fa-comments-o"></i> ' . apply_filters( 'better-studio/themes/meta/comments/text', $number );

		echo sprintf( '<a href="%1$s" title="%2$s" ' . publisher_get_attr( 'post-meta-comments' ) . '>%3$s</a>',
			esc_url( $link ),
			esc_attr( sprintf( publisher_translation_get( 'leave_comment_on' ), $title ) ),
			$text
		);

	}

	?>
</div>
