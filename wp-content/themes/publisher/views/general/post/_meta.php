<div <?php publisher_attr( 'post-meta', 'single-post-meta' ); ?>>

	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemscope="itemscope"
	   itemprop="url" title="<?php echo publisher_translation_esc_attr( 'browse_auth_articles' ); ?>">
		<i <?php publisher_attr( 'post-meta-author', 'author' ); ?>>
			<?php the_author(); ?>
		</i>
	</a>

	<span class="time"><time <?php publisher_attr( 'post-meta-published' ); ?>><?php the_time( publisher_translation_get( 'comment_time' ) ); ?></time></span>
	<?php

	// Views count
	if ( function_exists( 'The_Better_Views' ) ) {
		The_Better_Views( TRUE, '<span ' . publisher_get_attr( 'post-meta-views' ) . '><i class="fa fa-eye"></i>', '</span>', 'show', '%VIEW_COUNT%' );
	}

	// Comments link
	if ( publisher_get_prop( 'meta-show-comments', TRUE ) && comments_open() ) {

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