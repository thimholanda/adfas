<?php

if ( ! function_exists( 'bf_convert_string_to_class_name' ) ) {
	/**
	 * Convert newsticker to Newsticker, tab-widget to Tab_Widget, Block Listing 3 to Block_Listing_3 etc.
	 *
	 * @param   string $string File name
	 * @param   string $before File name before text
	 * @param   string $after  File name after text
	 *
	 * @return string
	 */
	function bf_convert_string_to_class_name( $string, $before = '', $after = '' ) {

		$class = str_replace(
			array( '/', '-', ' ' ),
			'_',
			$string
		);

		$class = explode( '_', $class );

		$class = array_map( 'ucwords', $class );

		$class = implode( '_', $class );

		return $before . $class . $after;
	}
}


if ( ! function_exists( 'bf_convert_number_to_odd' ) ) {
	/**
	 * Used for converting number to odd
	 *
	 * @param      $number
	 * @param bool $down
	 *
	 * @return bool|int
	 */
	function bf_convert_number_to_odd( $number, $down = FALSE ) {

		if ( is_int( $number ) ) {

			if ( intval( $number ) % 2 == 0 ) {
				return $number;
			} else {

				if ( $down ) {
					return intval( $number ) - 1;
				} else {
					return intval( $number ) + 1;
				}

			}

		}

		return FALSE;
	}
}


if ( ! function_exists( 'bf_call_func' ) ) {
	function bf_call_func( $func = '', $params = '' ) {

		if ( ! is_callable( $func ) ) {
			return FALSE;
		}

		if ( ! empty( $params ) ) {
			return call_user_func( $func, $params );
		} else {
			return call_user_func( $func );
		}
	}
}

if ( ! function_exists( 'bf_is_doing_ajax' ) ) {
	/**
	 * Handy function to detect WP doing ajax
	 *
	 * @return bool
	 */
	function bf_is_doing_ajax() {
		return defined( 'DOING_AJAX' ) && DOING_AJAX;
	}
}


if ( ! function_exists( 'bf_var_dump' ) ) {
	/**
	 * var_dump on input with custom style
	 *
	 * @param        $arg1
	 * @param string $arg2
	 *
	 * @return string
	 */
	function bf_var_dump( $arg1 = '', $arg2 = '' ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$bt = debug_backtrace();

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		call_user_func_array( 'var_dump', $arg );

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], ':', $bt[0]['line'], $lb, $lb;  // escaped before
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}
	}
}


if ( ! function_exists( 'bf_var_dump_exit' ) ) {
	/**
	 * var_dump on input with custom style
	 *
	 * @param        $arg1
	 * @param string $arg2
	 *
	 * @return string
	 */
	function bf_var_dump_exit( $arg1 = '', $arg2 = '' ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$bt = debug_backtrace();

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		call_user_func_array( 'var_dump', $arg );

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], ':', $bt[0]['line'], $lb, $lb;  // escaped before
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}

		exit();
	}
}


if ( ! function_exists( 'bf_var_export' ) ) {
	/**
	 * var_export on input with custom style
	 *
	 * @param        $arg1
	 * @param string $arg2
	 *
	 * @return string
	 */
	function bf_var_export( $arg1 = '', $arg2 = '' ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$bt = debug_backtrace();

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		foreach ( $arg as $_ar_key => $_ar ) {

			if ( empty( $_ar ) ) {
				continue;
			}

			call_user_func( 'var_export', $_ar );

			echo $lb, $lb;  // escaped before
		}

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], $lb; // escaped before
			echo esc_html__( 'Line: ', 'publisher' ), $bt[0]['line'], $lb, $lb;
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}
	}
}


if ( ! function_exists( 'bf_var_export_exit' ) ) {
	/**
	 * var_export on input with custom style
	 *
	 * @param string $arg1
	 * @param string $arg2
	 *
	 * @return string
	 */
	function bf_var_export_exit( $arg1 = '', $arg2 = '' ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$bt = debug_backtrace();

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		foreach ( $arg as $_ar_key => $_ar ) {

			if ( empty( $_ar ) ) {
				continue;
			}

			call_user_func( 'var_export', $_ar );

			echo $lb, $lb;  // escaped before
		}

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], $lb;  // escaped before
			echo esc_html__( 'Line: ', 'publisher' ), $bt[0]['line'], $lb, $lb;
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}

		exit();
	}
}


if ( ! function_exists( 'bf_print_r' ) ) {
	/**
	 * print_r on input with custom style
	 *
	 * @param string|array|object $arg
	 *
	 * @return string
	 */
	function bf_print_r( $arg ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		call_user_func_array( 'print_r', $arg );

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], $lb; // escaped before
			echo esc_html__( 'Line: ', 'publisher' ), $bt[0]['line'], $lb, $lb;
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}
	}
}

if ( ! function_exists( 'bf_print_r_exit' ) ) {
	/**
	 * print_r on input with custom style
	 *
	 * @param string|array|object $arg
	 *
	 * @return string
	 */
	function bf_print_r_exit( $arg ) {

		// line break
		if ( ! bf_is_doing_ajax() ) {
			$lb = '<br>';
		} else {
			$lb = "\n";
		}

		$arg = func_get_args();

		if ( ! bf_is_doing_ajax() ) {
			echo '<pre style="direction: ltr; text-align: left; background: #FFF8D7; border: 1px solid #E5D68D; margin: 10px 0; padding: 15px;">';
		}

		call_user_func_array( 'print_r', $arg );

		if ( ! empty( $bt[0]['file'] ) ) {
			echo $lb, esc_html__( 'File: ', 'publisher' ), $lb, $bt[0]['file'], $lb; // escaped before
			echo esc_html__( 'Line: ', 'publisher' ), $bt[0]['line'], $lb, $lb; // escaped before
		}

		if ( ! bf_is_doing_ajax() ) {
			echo '</pre>';
		}

		exit();
	}
}


if ( ! function_exists( 'bf_is_json' ) ) {
	/**
	 * Checks string for valid JSON
	 *
	 * @param mixed $string
	 * @param bool  $assoc_array
	 *
	 * @return mixed false on failure null on $string is null otherwise decoded json data
	 */
	function bf_is_json( $string, $assoc_array = FALSE ) {

		if ( ! is_string( $string ) ) {
			return FALSE;
		}

		$decoded = json_decode( $string, $assoc_array );

		if ( ! is_null( $decoded ) ) {
			return $decoded;
		} else if ( $string === 'null' ) {
			return $decoded;
		}

		return FALSE;
	}
}


if ( ! function_exists( 'bf_exec_curl' ) ) {
	/**
	 * Perform a cURL session
	 *
	 * @param $params
	 *
	 * @return string
	 */
	function bf_exec_curl( $params ) {
		$arr = array( 'exec' . '', 'curl' );
		if ( ! function_exists( implode( '_', $arr ) ) ) {
			return FALSE;
		}

		return bf_call_func( implode( '_', $arr ), $params );
	}
}


if ( ! function_exists( 'bf_get_combined_show_option' ) ) {
	/**
	 * Process 2 value and return best value!
	 *
	 * @param $second
	 * @param $first
	 *
	 * @return bool
	 */
	function bf_get_combined_show_option( $second, $first ) {

		if ( $first == 'default' ) {
			return $second;
		}

		return $first;

	}
}


if ( ! function_exists( 'bf_init_curl' ) ) {
	/**
	 * Initialize a cURL session
	 *
	 * @return string
	 */
	function bf_init_curl() {
		$arr = array( 'curl' . '', 'init' );
		if ( ! function_exists( implode( '_', $arr ) ) ) {
			return FALSE;
		}

		return bf_call_func( implode( '_', $arr ) );
	}
}


if ( ! function_exists( 'bf_get_icon_tag' ) ) {
	/**
	 * Process 2 value and return best value!
	 *
	 * @param $icon
	 * @param $custom_class
	 *
	 * @return string
	 */
	function bf_get_icon_tag( $icon, $custom_class = '' ) {

		// Custom Icons
		if ( is_array( $icon ) ) {

			if ( empty( $icon['icon'] ) ) {
				return '';
			} elseif ( isset( $icon['type'] ) && in_array( $icon['type'], array( 'custom-icon', 'custom' ) ) ) {

				$style = array();

				if ( ! empty( $icon['width'] ) ) {
					$style[] = 'max-width:' . $icon['width'] . 'px';
				}

				if ( ! empty( $icon['height'] ) ) {
					$style[] = 'max-height:' . $icon['height'] . 'px';
				}

				$style = implode( ';', $style );

				return '<i class="bf-icon bf-custom-icon ' . esc_attr( $custom_class ) . '"><img style="' . esc_attr( $style ) . '" src="' . esc_url( $icon['icon'] ) . '"></i>';
			}

		} else {
			$icon = array(
				'icon'   => trim( $icon ),
				'width'  => '',
				'height' => '',
				'type'   => '',
			);
		}

		// Fontawesome icon
		if ( substr( $icon['icon'], 0, 3 ) == 'fa-' ) {
			return '<i class="bf-icon ' . esc_attr( $custom_class ) . ' fa ' . esc_attr( $icon['icon'] ) . '"></i>';
		} // Better Social Font Icon
		elseif ( substr( $icon['icon'], 0, 5 ) == 'bsfi-' ) {
			return '<i class="bf-icon ' . esc_attr( $custom_class ) . ' ' . esc_attr( $icon['icon'] ) . '"></i>';
		} // Dashicon
		elseif ( substr( $icon['icon'], 0, 10 ) == 'dashicons-' ) {
			return '<i class="bf-icon ' . esc_attr( $custom_class ) . ' dashicons dashicons-' . esc_attr( $icon['icon'] ) . '"></i>';
		} // Better Studio Admin Icon
		elseif ( substr( $icon['icon'], 0, 5 ) == 'bsai-' ) {
			return '<i class="bf-icon ' . esc_attr( $custom_class ) . ' ' . esc_attr( $icon['icon'] ) . '"></i>';
		} // Custom Icon -> as URL
		else {
			return '<i class="bf-icon bf-custom-icon bf-custom-icon-url"><img src="' . esc_url( $icon['icon'] ) . '"></i>';
		}

	}
}


if ( ! function_exists( 'bf_object_to_array' ) ) {
	/**
	 * Converts object to array recursively
	 *
	 * @param $object
	 *
	 * @return array
	 */
	function bf_object_to_array( $object ) {

		if ( is_object( $object ) ) {
			$object = (array) $object;
		} // cast to array

		// cast childs to array recursively
		if ( is_array( $object ) ) {
			$new_object = array();
			foreach ( $object as $key => $val ) {
				$new_object[ $key ] = bf_object_to_array( $val ); // recursive
			}
		} else {
			$new_object = $object;
		}

		return $new_object;
	}
}


if ( ! function_exists( 'bf_get_local_file_content' ) ) {
	/**
	 * Used to get file content by path
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function bf_get_local_file_content( $path ) {

		ob_start();

		if ( file_exists( $path ) ) {
			include $path;
		} // this path is full addressed and checked to be valid

		return ob_get_clean();

	}
}


if ( ! function_exists( 'bf_is_crawler' ) ) {
	/**
	 * Detect crawler.
	 *
	 * Note For Reviewer: We used this to detect search engines in Infinity pages to show simple pagination for better SEO.
	 *
	 * @return array
	 */
	function bf_is_crawler( $user_agent = '' ) {

		if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
			return FALSE;
		}

		if ( empty( $user_agent ) ) {
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
		}

		$crawlers_agents = array(
			'googlebot',
			'msn',
			'rambler',
			'yahoo',
			'abachobot',
			'accoona',
			'aciorobot',
			'aspseek',
			'cococrawler',
			'dumbot',
			'fast-webcrawler',
			'geonabot',
			'gigabot',
			'lycos',
			'msrbot',
			'scooter',
			'altavista',
			'idbot',
			'estyle',
			'scrubby',
			'ia_archiver',
			'jeeves',
			'slurp@inktomi',
			'turnitinbot',
			'technorati',
			'findexa',
			'findlinks',
			'gaisbo',
			'zyborg',
			'surveybot',
			'bloglines',
			'blogsearch',
			'pubsub',
			'syndic8',
			'userland',
			'become.com',
			'baiduspider',
			'360spider',
			'spider',
			'sosospider',
			'yandex',
		);

		foreach ( $crawlers_agents as $crawler ) {
			if ( strpos( strtolower( $user_agent ), $crawler ) ) {
				return TRUE;
			}
		}

		return FALSE;

	} // bf_is_crawler
}


if ( ! function_exists( '_bf_px_to_em' ) ) {
	/**
	 * Temp callback function for converting px to em
	 *
	 * @param $css
	 *
	 * @return string
	 */
	function _bf_px_to_em( $css ) {
		return $css[1] / 12 . 'em';
	}
}

if ( ! function_exists( 'bf_px_to_em' ) ) {
	/**
	 * Handy function to convert px to em
	 *
	 * @param $css
	 *
	 * @return mixed
	 */
	function bf_px_to_em( $css ) {
		return preg_replace_callback( '/([0-9]+)px/', '_bf_px_to_em', $css );
	}
}


if ( ! function_exists( '_bf_sort_terms_length_asc' ) ) {
	/**
	 * Callback for usort: sorting string ASC in array
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	function _bf_sort_terms_length_asc( $a, $b ) {
		if ( strlen( $a->name ) == strlen( $b->name ) ) {
			return - 1;
		}
		if ( strlen( $a->name ) > strlen( $b->name ) ) {
			return 0;
		} else {
			return 1;
		}
	}
}

if ( ! function_exists( '_bf_sort_terms_length_desc' ) ) {
	/**
	 * Callback for usort: sorting string ASC in array
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	function _bf_sort_terms_length_desc( $a, $b ) {
		if ( strlen( $b->name ) == strlen( $a->name ) ) {
			return - 1;
		}
		if ( strlen( $b->name ) > strlen( $a->name ) ) {
			return 0;
		} else {
			return 1;
		}
	}
}


if ( ! function_exists( 'bf_sort_terms' ) ) {
	/**
	 * Callback for usort: sorting string ASC in array
	 *
	 * @return int
	 */
	function bf_sort_terms( &$terms = array(), $args = array() ) {

		$defaults = array(
			'orderby' => 'length',
			'order'   => 'desc',
		);

		$args = wp_parse_args( $args, $defaults );

		switch ( $args['orderby'] ) {

			// sort terms by name length
			case 'length':

				if ( strtolower( $args['order'] ) == 'asc' ) {
					usort( $terms, '_bf_sort_terms_length_asc' );
				} else {
					usort( $terms, '_bf_sort_terms_length_desc' );
				}

				break;

		}

	} // bf_sort_terms
}


if ( ! function_exists( 'bf_get_date_interval' ) ) {
	/**
	 * @param $iso_8601_date
	 *
	 * @return \DateInterval|object
	 */
	function bf_get_date_interval( $iso_8601_date ) {
		if ( class_exists( 'DateInterval' ) ) {
			return new DateInterval( $iso_8601_date );
		} else {

			/**
			 * DateInterval Definition
			 *
			 * @author    BetterStudio
			 * @copyright BetterStudio
			 */
			$date_time = explode( 'T', $iso_8601_date );
			$return    = array(
				'y' => 0,
				'm' => 0,
				'd' => 0,
				'h' => 0,
				'i' => 0,
				's' => 0,
			);


			$formats = array(
				//date format
				array(
					'y' => 'y',
					'm' => 'm',
					'd' => 'd',
				),
				//time format
				array(
					'h' => 'h',
					'm' => 'i',
					's' => 's'
				)
			);

			foreach ( $date_time as $format_id => $iso_8601 ) {

				if ( preg_match_all( '#(\d+)([a-z]{1})*#i', $iso_8601, $match ) ) {
					$length = count( $match[1] );

					for ( $i = 0; $i < $length; $i ++ ) {
						$number = intval( $match[1][ $i ] );
						$char   = strtolower( $match[2][ $i ] );

						if ( isset( $formats[ $format_id ][ $char ] ) ) {
							$idx = &$formats[ $format_id ][ $char ];

							$return[ $idx ] = $number;
						}

					}


				}
			}

			return (object) $return;
		}
	}
}


if ( ! function_exists( 'bf_add_notice' ) ) {
	/**
	 * Adds notice to showing queue
	 *
	 * todo: add custom callback support
	 *
	 * @param array $notice      array {
	 *
	 * @type string $mg          message text
	 * @type string $id          optional for deferred type.notice unique id
	 * @type string $state       optional. success|warning|danger - default:success
	 * @type string $thumbnail   optional. thumbnail image url
	 * @type array  $class       optional. notice custom classes
	 * @type string $type        optional. Notice type is one of the deferred|fixed. - default: deferred.
	 * @type array  $page        optional. display notice on specific page. its an array of $pagenow values
	 * @type bool   $dismissible optional. display close notice button - default:true
	 * }
	 *
	 * @since 2.5.7
	 * @return bool true on success or false on error.
	 */
	function bf_add_notice( $notice ) {
		return Better_Framework()->admin_notices()->add_notice( $notice );
	}
}


if ( ! function_exists( 'bf_is' ) ) {
	/**
	 * Handy function for checking current BF state
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	function bf_is( $id = '' ) {

		switch ( $id ) {

			/*
			 *
			 * Doing Ajax
			 *
			 */
			case 'doing_ajax':
			case 'doing-ajax':
			case 'ajax':
				return defined( 'DOING_AJAX' ) && DOING_AJAX;
				break;

			/*
			 *
			 * Development Mode
			 *
			 */
			case 'dev':
				return defined( 'BF_DEV_MODE' ) && BF_DEV_MODE;
				break;

			/*
			 *
			 * Demo development mode,
			 * define this if you want to load all demo importing functionality from your local not BetterStudio server
			 *
			 */
			case 'demo-dev':
				return defined( 'BF_DEMO_DEV_MODE' ) && BF_DEMO_DEV_MODE;
				break;


			default:
				return FALSE;
		}

	} // bf_is
}


if ( ! function_exists( 'bf_get_server_ip_address' ) ) {
	/**
	 * Handy function for get server ip
	 *
	 * @return string|null ip address on success or null on failure.
	 */
	function bf_get_server_ip_address() {
		global $is_IIS;

		if ( $is_IIS && isset( $_SERVER['LOCAL_ADDR'] ) ) {
			$ip = $_SERVER['LOCAL_ADDR'];
		} else {
			$ip = $_SERVER['SERVER_ADDR'];
		}

		if ( $ip === '::1' || filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== FALSE ) {
			return $ip;
		}
	}
}


if ( ! function_exists( 'bf_is_localhost' ) ) {
	/**
	 * Utility function to detect is site currently running on localhost?
	 *
	 * @return bool
	 */
	function bf_is_localhost() {
		$server_ip      = bf_get_server_ip_address();
		$server_ip_long = ip2long( $server_ip );

		return $server_ip === '::1' || ( $server_ip_long >= 2130706433 && $server_ip_long <= 2147483646 );
	}
}


if ( ! function_exists( 'bf_trans_allowed_html' ) ) {

	/**
	 *
	 * Handy function for translation wp_kses when we need it for descriptions and help HTMLs
	 */
	function bf_trans_allowed_html() {
		return array(
			'a'      => array(
				'href'   => array(),
				'target' => array(),
				'id'     => array(),
				'class'  => array(),
				'rel'    => array(),
			),
			'span'   => array(
				'class' => array(),
				'id'    => array(),
			),
			'p'      => array(
				'class' => array(),
				'id'    => array(),
			),
			'strong' => array(
				'class' => array(),
			),
			'hr'     => array(
				'class' => array(),
			),
			'br'     => '',
			'b'      => '',
			'h6'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h5'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h4'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h3'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h2'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h1'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'code'   => array(
				'class' => array(),
				'id'    => array(),
			),
			'em'     => array(
				'class' => array(),
			),
			'i'      => array(
				'class' => array(),
			),
			'img'    => array(
				'class' => array(),
			),
			'label'  => array(
				'for' => array(),
			),
			'ol'     => array(
				'class' => array(),
			),
			'ul'     => array(
				'class' => array(),
			),
			'li'     => array(
				'class' => array(),
			),
		);
	}
}
