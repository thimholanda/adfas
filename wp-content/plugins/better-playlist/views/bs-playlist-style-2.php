<?php
/**
 * bs-playlist-style-2.php
 *---------------------------
 * [bs-playlist-style-2] shortcode
 */

$atts = bsp_get_prop( 'shortcode-bs-playlist-atts' );

$playlist = BS_PlayList::get_playlist( $atts );

$frame_url_js = BS_PlayList::change_video_frame_url( $atts );
$frame_url    = BS_PlayList::default_frame_url( $atts );

if ( $playlist && ! empty( $playlist['videos'] ) ) :

	$first_video_ID = key( $playlist['videos'] );

	// detect by
	$by = '';
	if ( $atts['type'] == 'playlist' ) {
		if ( isset( $playlist['info']->channelTitle ) ) {
			$by = $playlist['info']->channelTitle;
		} elseif ( isset( $playlist['info']->username ) ) {
			$by = $playlist['info']->username;
		}
	} else {
		$by = $atts['by'];
	}

	?>
<div class="bsp-wrapper <?php echo isset( $atts['class'] ) ? esc_attr( $atts['class'] ) : '' ?>">
	<?php

	bf_shortcode_show_title( $atts ); // show title

	if ( $atts['show_playlist_title'] ) { ?>
		<div class="bsp-playlist-info">
			<div class="bsp-video-name">
				<?php

				if ( ! empty( $atts['playlist_title'] ) ) {
					echo $atts['playlist_title'];
				} else if ( isset( $playlist['info']->title ) ) {
					echo $playlist['info']->title;
				}

				?>
			</div>
			<?php if ( ! empty( $by ) ) { ?>
				<div class="bsp-video-by bsp-small">
					<?php

					echo Better_Playlist::_get( 'bsp_by' ), ' ', $by;

					?>
				</div>
			<?php } ?>
			<div class="bsp-video-position bsp-small">
				<span class="bsp-current-index">1</span>/
				<?php

				echo number_format_i18n( count( $playlist['videos'] ) );

				?>
			</div>
		</div>
		<?php
	}
	?>

	<div class="bsp-player-wrapper">
		<div class="bsp-player" data-frame-url="<?php echo esc_attr( $frame_url_js ) ?>">
			<iframe type="text/html" width="100%" height="100%"
			        src="<?php echo esc_attr( str_replace( '{video-id}', $first_video_ID, $frame_url ) ) ?>?"
			        frameborder="0"></iframe>
		</div>
	</div>

	<div class="bsp-videos">
		<div class="bsp-videos-items">
			<ol>
				<?php
				$_video_index = 0;
				foreach ( $playlist['videos'] as $video_ID => $video_info ) : ?>
					<li class="bsp-videos-item <?php if ( ! $_video_index )
						echo 'bsp-current-item' ?>">
						<span class="bsp-video-index"><?php echo ++ $_video_index ?></span>
						<a href="#" class="bsp-clearfix bsp-item" data-video-id="<?php echo $video_ID ?>">
								<span class="bsp-video-icon-wrapper">
								<span class="bsp-video-icon"></span>
							</span>
							<span class="bsp-video-thumbnail">
								<?php if ( $thumbnail = bsp_get_video_thumbnail( $video_info['thumbnails'] ) ): ?>
									<img src="<?php echo esc_attr( $thumbnail ) ?>"
									     alt="<?php echo esc_attr( $video_info['title'] ) ?>">
								<?php endif ?>
							</span>
							<span class="bsp-video-info">
								<span class="bsp-video-name"><?php echo $video_info['title'] ?></span>
								<span
									class="bsp-small bsp-video-duration"><?php echo bsp_get_video_duration( $video_info['duration'] ) ?></span>
							</span>
						</a>
					</li>
				<?php endforeach ?>
			</ol>
		</div>
	</div>
	</div><?php

elseif ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) :

	_e( 'Playlist Error: cannot fetch data', 'better-studio' );

endif ?>