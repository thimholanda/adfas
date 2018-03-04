<?php

if ( ! function_exists( 'publisher_meta_tag' ) ) {
	/**
	 * Outputs an HTML meta tag.
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $prop    Meta itemprop value
	 * @param   string $content Default meta content value
	 *
	 * @return void
	 */
	function publisher_meta_tag( $prop, $content = '' ) {
		echo publisher_get_meta_tag( $prop, $content ); // escaped before
	}
}


if ( ! function_exists( 'publisher_get_meta_tag' ) ) {
	/**
	 * Gets an HTML meta tag.
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $prop    Meta itemprop value
	 * @param   string $content Default meta content value
	 *
	 * @return string
	 */
	function publisher_get_meta_tag( $prop, $content = '' ) {

		if ( $prop == 'full' ) {

			$list = array(
				'headline' => 'headline',
				'url'      => 'url',
				'date'     => 'date',
				'image'    => 'image',
				'author'   => 'author',
				'comments' => 'comments',
			);

			switch ( get_post_format() ) {

				case 'video':
					unset( $list['headline'] );
					$list[] = 'name';

					$list[] = 'description';
					$list[] = 'date_upload';
					break;

			}

			foreach ( $list as $item ) {
				publisher_meta_tag( $item, '' );
			}

		} elseif ( in_array( $prop, array(
			'headline',
			'url',
			'date',
			'image',
			'author',
			'comments',
			'description',
			'name',
			'date_upload'
		) ) ) {

			$output = '';

			$attr = apply_filters( "publisher_meta_tag_{$prop}", $content );

			// exception for empty data, ex when there is no featured image
			if ( isset( $attr['empty'] ) ) {
				return '';
			}

			if ( empty( $attr ) ) {
				$attr['itemprop'] = $prop;
				$attr['content']  = $content;
			}

			foreach ( $attr as $name => $value ) {
				$output .= $value != '' ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );
			}

			return '<meta ' . trim( $output ) . ' />';

		} else {

			$output = '';

			$attr['itemprop'] = $prop;
			$attr['content']  = $content;

			foreach ( $attr as $name => $value ) {

				$output .= ! empty( $value ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );

			}

			return '<meta ' . trim( $output ) . ' />';

		}

	} // publisher_get_meta_tag
}
