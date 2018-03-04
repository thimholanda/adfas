<?php

if ( ! function_exists( 'bf_remove_reject_unsafe_urls' ) ) {
	function bf_remove_reject_unsafe_urls( $args ) {
		$args['reject_unsafe_urls'] = FALSE;

		return $args;
	}
}
