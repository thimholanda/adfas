<?php

if ( ! isset( $options['value']['family'] ) ) {

	$options['value']['family']  = 'Lato';
	$options['value']['variant'] = '';

}

// prepare std id
if ( isset( $panel_id ) ) {
	$std_id = Better_Framework::options()->get_std_field_id( $panel_id );
} else {
	$std_id = 'css';
}

$enabled = FALSE;

if ( isset( $options[ $std_id ] ) ) {
	if ( isset( $options[ $std_id ]['enable'] ) ) {
		$enabled = TRUE;
	}
} elseif ( isset( $options['std'] ) ) {
	if ( isset( $options['std']['enable'] ) ) {
		$enabled = TRUE;
	}
}

if ( $enabled && ! isset( $options['value']['enable'] ) ) {
	$options['value']['enable'] = $options['std']['enable'];
}

// Get current font
$font = Better_Framework()->fonts_manager()->get_font( $options['value']['family'] );

if ( $enabled ) { ?>
	<div class="typo-fields-container bf-clearfix">
		<div class="typo-field-container">
			<div class="typo-enable-container"><?php

				$hidden = Better_Framework::html()->add( 'input' )->type( 'hidden' )->name( $options['input_name'] . '[enable]' )->val( '0' );

				$checkbox = Better_Framework::html()->add( 'input' )->type( 'checkbox' )->name( $options['input_name'] . '[enable]' )->val( '1' )->class( 'checkbox' );
				if ( $options['value']['enable'] ) {
					$checkbox->attr( 'checked', 'checked' );
				}

				?>
				<div class="bf-switch bf-clearfix">
					<label
						class="cb-enable <?php echo esc_attr( $options['value']['enable'] ) ? 'selected' : ''; ?>"><span><?php esc_html_e( 'Enable', 'publisher' ); ?></span></label>
					<label
						class="cb-disable <?php echo ! $options['value']['enable'] ? 'selected' : ''; ?>"><span><?php esc_html_e( 'Disable', 'publisher' ); ?></span></label>
					<?php

					echo $hidden->display();  // escaped before
					echo $checkbox->display(); // escaped before

					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}

?>
	<div class="typo-fields-container bf-clearfix">
		<span class="enable-disable"></span>
		<div class="typo-field-container font-family-container">
			<label><?php esc_html_e( 'Font Family:', 'publisher' ); ?></label>
			<select name="<?php echo esc_attr( $options['input_name'] ); ?>[family]"
			        id="<?php echo esc_attr( $options['input_name'] ); ?>-family"
			        class="font-family <?php if ( is_rtl() ) {
				        echo 'chosen-rtl';
			        } ?>">
				<?php

				if ( $font['type'] == 'theme-font' ) {
					echo Better_Framework()->fonts_manager()->theme_fonts()->get_fonts_family_option_elements( $options['value']['family'] ); // escaped before
				} else {
					echo Better_Framework()->fonts_manager()->theme_fonts()->get_fonts_family_option_elements(); // escaped before
				}

				if ( $font['type'] == 'custom-font' ) {
					echo Better_Framework()->fonts_manager()->custom_fonts()->get_fonts_family_option_elements( $options['value']['family'] ); // escaped before
				} else {
					echo Better_Framework()->fonts_manager()->custom_fonts()->get_fonts_family_option_elements(); // escaped before
				}

				// all font stacks
				if ( $font['type'] == 'font-stack' ) {
					echo Better_Framework()->fonts_manager()->font_stacks()->get_fonts_family_option_elements( $options['value']['family'] ); // escaped before
				} else {
					echo Better_Framework()->fonts_manager()->font_stacks()->get_fonts_family_option_elements(); // escaped before
				}

				// all google fonts
				if ( $font['type'] == 'google-font' ) {
					echo Better_Framework()->fonts_manager()->google_fonts()->get_fonts_family_option_elements( $options['value']['family'] ); // escaped before
				} else {
					echo Better_Framework()->fonts_manager()->google_fonts()->get_fonts_family_option_elements(); // escaped before
				}

				?>
			</select>
		</div>

		<div class="bf-select-option-container typo-field-container">
			<label
				for="<?php echo esc_attr( $options['input_name'] ); ?>[variant]"><?php esc_html_e( 'Font Weight:', 'publisher' ); ?></label>
			<select name="<?php echo esc_attr( $options['input_name'] ); ?>[variant]"
			        id="<?php echo esc_attr( $options['input_name'] ); ?>-variants" class="font-variants">
				<?php

				Better_Framework()->fonts_manager()->get_font_variants_option_elements( $font, $options['value']['variant'] );

				?>
			</select>
		</div>

		<div class="bf-select-option-container typo-field-container">
			<label
				for="<?php echo esc_attr( $options['input_name'] ); ?>[subset]"><?php esc_html_e( 'Font Character Set:', 'publisher' ); ?></label>
			<select name="<?php echo esc_attr( $options['input_name'] ); ?>[subset]"
			        id="<?php echo esc_attr( $options['input_name'] ); ?>-subset" class="font-subsets">
				<?php

				Better_Framework()->fonts_manager()->get_font_subset_option_elements( $font, $options['value']['subset'] );

				?>
			</select>
		</div>

		<?php

		$align = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['align'] ) ) {
				$align = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['align'] ) ) {
				$align = TRUE;
			}
		}

		if ( $align && ! isset( $options['value']['align'] ) ) {
			$options['value']['align'] = $options['std']['align'];
		}

		if ( $align ) { ?>
			<div class="bf-select-option-container  typo-field-container text-align-container">
				<label
					for="<?php echo esc_attr( $options['input_name'] ); ?>[align]"><?php esc_html_e( 'Text Align:', 'publisher' ); ?></label>
				<?php
				$aligns = array(
					'inherit' => 'Inherit',
					'left'    => 'Left',
					'center'  => 'Center',
					'right'   => 'Right',
					'justify' => 'Justify',
					'initial' => 'Initial',
				);
				?>
				<select name="<?php echo esc_attr( $options['input_name'] ); ?>[align]"
				        id="<?php echo esc_attr( $options['input_name'] ); ?>-align">
					<?php foreach ( $aligns as $key => $align ) {
						echo '<option value="' . esc_attr( $key ) . '" ' . ( $key == $options['value']['align'] ? 'selected' : '' ) . '>' . esc_html( $align ) . '</option>';
					} ?>
				</select>
			</div>
		<?php } ?>

		<?php

		$transform = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['transform'] ) ) {
				$transform = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['transform'] ) ) {
				$transform = TRUE;
			}
		}

		if ( $transform && ! isset( $options['value']['transform'] ) ) {
			$options['value']['transform'] = $options['std']['transform'];
		}

		if ( $transform ) { ?>
			<div class="bf-select-option-container typo-field-container text-transform-container">
				<label
					for="<?php echo esc_attr( $options['input_name'] ); ?>[transform]"><?php esc_html_e( 'Text Transform:', 'publisher' ); ?></label>
				<?php
				$transforms = array(
					'none'       => 'None',
					'capitalize' => 'Capitalize',
					'lowercase'  => 'Lowercase',
					'uppercase'  => 'Uppercase',
					'initial'    => 'Initial',
					'inherit'    => 'Inherit',
				);
				?>
				<select name="<?php echo esc_attr( $options['input_name'] ); ?>[transform]"
				        id="<?php echo esc_attr( $options['input_name'] ); ?>-transform" class="text-transform">
					<?php foreach ( $transforms as $key => $transform ) {
						echo '<option value="' . esc_attr( $key ) . '" ' . ( $key == $options['value']['transform'] ? 'selected' : '' ) . '>' . esc_html( $transform ) . '</option>';
					} ?>
				</select>
			</div>
		<?php } ?>


		<?php

		$size = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['size'] ) ) {
				$size = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['size'] ) ) {
				$size = TRUE;
			}
		}

		if ( $size && ! isset( $options['value']['size'] ) ) {
			$options['value']['size'] = $options['std']['size'];
		}

		if ( $size ) { ?>
			<div class="typo-field-container text-size-container">
				<label
					for="<?php echo esc_attr( $options['input_name'] ); ?>[size]"><?php esc_html_e( 'Font Size:', 'publisher' ); ?></label>
				<div class="bf-field-with-suffix">
					<input type="text" name="<?php echo esc_attr( $options['input_name'] ); ?>[size]"
					       value="<?php echo esc_attr( $options['value']['size'] ); ?>" class="font-size"/><span
						class='bf-prefix-suffix bf-suffix'><?php esc_html_e( 'Pixel', 'publisher' ); ?></span>
				</div>
			</div>
		<?php }

		//
		// Line Height
		//
		$line_height = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['line-height'] ) ) {
				$line_height_id = 'line-height';
				$line_height    = TRUE;
			} elseif ( isset( $options[ $std_id ]['line_height'] ) ) {
				$line_height_id = 'line_height';
				$line_height    = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['line-height'] ) ) {
				$line_height_id = 'line-height';
				$line_height    = TRUE;
			} elseif ( isset( $options['std']['line_height'] ) ) {
				$line_height_id = 'line_height';
				$line_height    = TRUE;
			}
		}

		if ( $line_height && ! isset( $options['value'][ $line_height_id ] ) ) {
			$options['value'][ $line_height_id ] = $options['std'][ $line_height_id ];
		}

		if ( $line_height ) { ?>
			<div class="typo-field-container text-height-container">
				<label><?php esc_html_e( 'Line Height:', 'publisher' ); ?></label>
				<div class="bf-field-with-suffix ">
					<input type="text"
					       name="<?php echo esc_attr( $options['input_name'] ); ?>[<?php echo esc_attr( $line_height_id ); ?>]"
					       value="<?php echo esc_attr( $options['value'][ $line_height_id ] ); ?>" class="line-height"/><span
						class='bf-prefix-suffix bf-suffix'><?php esc_html_e( 'Pixel', 'publisher' ); ?></span>
				</div>
			</div>
		<?php }


		//
		// Letter Spacing
		//
		$letter_spacing = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['letter-spacing'] ) ) {
				$letter_spacing = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['letter-spacing'] ) ) {
				$letter_spacing = TRUE;
			}
		}

		if ( $letter_spacing && ! isset( $options['value']['letter-spacing'] ) ) {
			$options['value']['letter-spacing'] = $options['std']['letter-spacing'];
		}

		if ( $letter_spacing ) { ?>
			<div class="typo-field-container text-height-container">
				<label><?php esc_html_e( 'Letter Spacing:', 'publisher' ); ?></label>
				<div class="bf-field-with-suffix ">
					<input type="text" name="<?php echo esc_attr( $options['input_name'] ); ?>[letter-spacing]"
					       value="<?php echo esc_attr( $options['value']['letter-spacing'] ); ?>"
					       class="letter-spacing"/><span
						class='bf-prefix-suffix bf-suffix'><i class="fa fa-arrows-h"></i></span>
				</div>
			</div>
			<?php
		}


		//
		// Color field
		//
		$color = FALSE;

		if ( isset( $options[ $std_id ] ) ) {
			if ( isset( $options[ $std_id ]['color'] ) ) {
				$color = TRUE;
			}
		} elseif ( isset( $options['std'] ) ) {
			if ( isset( $options['std']['color'] ) ) {
				$color = TRUE;
			}
		}

		if ( $color && ! isset( $options['value']['color'] ) ) {
			$options['value']['color'] = $options['std']['color'];
		}

		if ( $color ) {
			?>
			<div class="typo-field-container text-color-container">
				<label><?php esc_html_e( 'Color:', 'publisher' ); ?></label>
				<div class="bs-color-picker-wrapper">
					<div class="bs-color-picker-stripe">
						<a class="wp-color-result" title="Select Color" data-current="Current Color"
						   style="background-color: <?php echo esc_attr( $options['value']['color'] ); ?>"></a>
					</div>

					<input type="text" name="<?php echo esc_attr( $options['input_name'] ) ?>[color]" value="<?php
					echo esc_attr( $options['value']['color'] )
					?>" class="bs-color-picker-value">
				</div>
			</div>

			<?php
		}
		?>

	</div>
<?php
