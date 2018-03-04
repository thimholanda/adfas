<?php
/**
 * 404.php
 *---------------------------
 * The template for displaying 404 pages (not found)
 *
 */

get_header(); ?>

	<div class="container layout-1-col layout-no-sidebar">
		<div class="row main-section">

			<div class="content-column content-404">

				<div class="row first-row">

					<div class="col-lg-12 text-404-section">
						<p class="text-404 heading-typo">404</p>
					</div>

					<div class="col-lg-12 desc-section">
						<h1 class="title-404"><?php publisher_translation_echo( '404_not_found' ); ?></h1>
						<p><?php publisher_translation_echo( '404_not_found_message' ); ?></p>
						<div class="row action-links">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<a href="javascript: history.go(-1);"><i
										class="fa fa-angle-double-right"></i> <?php publisher_translation_echo( '404_go_previous_page' ); ?>
								</a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i
										class="fa fa-angle-double-right"></i> <?php publisher_translation_echo( '404_go_homepage' ); ?>
								</a>
							</div>
						</div>
					</div>

				</div><!-- .first-row -->

				<div class="row second-row">
					<div class="col-lg-12">
						<div class="top-line">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div><!-- .second-row -->

			</div><!-- .content-column -->

		</div><!-- .main-section -->
	</div> <!-- .layout-1-col -->

<?php get_footer(); ?>