<ul class="listing listing-widget listing-widget-simple listing-widget-simple-readable-meta">
	<?php while( publisher_have_posts() ): publisher_the_post(); ?>
		<li class="listing-item clearfix">
			<article <?php publisher_attr( 'post' ); ?>>
				<h4 class="title">
					<a <?php publisher_attr( 'post-url' ); ?>><span <?php publisher_attr( 'post-title' ); ?>><?php the_title(); ?></span></a>
				</h4>
				<?php publisher_get_view( 'loop', '_meta-readable' ); ?>
				<?php publisher_meta_tag( 'full' ); ?>
			</article>
		</li>
	<?php endwhile; ?>
</ul>
