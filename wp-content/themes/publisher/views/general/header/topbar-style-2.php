<?php
/**
 * topbar-style-2.php
 *---------------------------
 * Topbar style 2 template
 */

// better social counter is active
$bs_social_counter = class_exists( 'Better_Social_Counter_Shortcode' );

?>
<section class="topbar topbar-style-2 hidden-xs hidden-xs">
	<div class="content-wrap">
		<div class="container">
			<div class="topbar-inner">
				<div class="row">
					<div class="<?php echo $bs_social_counter ? 'col-md-8' : 'col-sm-12'; ?> section-menu">
						<?php echo do_shortcode( '[better-newsticker ]' ); // todo add config for this ?>
					</div><!-- .section-menu -->

					<?php if ( $bs_social_counter ) { ?>
						<div class="col-md-4 section-links">
							<?php
							if ( publisher_get_option( 'topbar_show_social_icons' ) == 'show' ) {
								publisher_get_view( 'header', '_social-icons', 'default' );
							}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
