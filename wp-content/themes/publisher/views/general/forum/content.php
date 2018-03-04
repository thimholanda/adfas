<?php
/**
 * content.php
 *---------------------------
 * The template for displaying forum archive page template
 *
 */

the_post();

?>
<div class="single-container">
	<article <?php publisher_attr( 'post', 'single-forum-content' ); ?>>
		<?php

		if ( ! is_post_type_archive( 'forum' ) ) {
			?>
			<h1 class="section-heading forum-section-heading">
				<span <?php publisher_attr( 'post-title', 'h-text' ); ?>><?php the_title(); ?></span></h1>
			<?php
		}

		?>
		<div <?php publisher_attr( 'post-content', 'clearfix' ); ?>>
			<?php publisher_the_content(); ?>
		</div>

	</article><!-- .single-forum-content -->
</div>