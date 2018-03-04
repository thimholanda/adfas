<?php

class BF_Product_Welcome extends BF_Product_Item {

	public $id = 'welcome';


	public function render_content( $item_data ) {

		if ( ! empty( $item_data['include_file'] ) && file_exists( $item_data['include_file'] ) ) {
			include $item_data['include_file'];
		}
	}

	public function ajax_request( $params ) {


		if ( empty( $params['bs_pages_action'] ) ) {
			return;
		}

		try {
			switch ( $params['bs_pages_action'] ) {

				case 'register':

					if ( isset( $params['bs-purchase-code'] ) && isset( $params['bs-register-token'] ) ) {

						//verify register product token

						if ( wp_create_nonce( 'bs-register-product' ) !== $params['bs-register-token'] ) {

							throw new Exception( 'invalid request.' );
						}

						$purchase_code = &$params['bs-purchase-code'];
						if ( $response = $this->api_request( 'register-product', array(), compact( 'purchase_code' ) ) ) {
							if ( isset( $response->status ) ) {
								$status = $response->status;
								bf_register_product_set_info( compact( 'purchase_code', 'status' ) );
							}

							if ( isset( $response->{'error-code'} ) && $response->{'error-code'} === 'add-to-account' ) {
								$auth      = apply_filters( 'better-framework/product-pages/register-product/auth', array() );
								$uri       = site_url();
								$item_id   = $auth['item_id'];
								$bs_action = 'register-product';

								$link = add_query_arg( compact( 'purchase_code', 'uri', 'item_id', 'bs_action' ), 'http://community.betterstudio.com/apply-purchase-code' );

								$response->{'error-message'} = wp_kses( sprintf( __( 'This looks like <b>a new purchase code that hasn’t been added to BetterStudio account yet</b>. Login to existing account or register new one to continue. <br><br> <a href="%s" class="bs-pages-primary-btn" target="_blank" id="bs-login-register-btn">Login or Register</a>', 'better-studio' ), $link ), bf_trans_allowed_html() );

							}

							wp_send_json( $response );
						} else {
							throw new Exception( __( 'unknown error occurred!', 'better-studio' ) );
						}
					}


					break;
			}
		} catch( Exception $e ) {

			wp_send_json( array( 'status' => 'error', 'error-message' => $e->getMessage() ) );

		}

	}
}