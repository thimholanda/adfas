<?php

if ( ! class_exists( 'BF_API_Exception' ) ) {

	/**
	 * Custom Exception except error code as string
	 *
	 * Class BF_API_Exception
	 */
	Class BF_API_Exception extends Exception {

		public function __construct( $message = '', $code = '', $previous = NULL ) {

			parent::__construct( $message, 0, $previous );
			$this->code = $code;
		}
	}
}