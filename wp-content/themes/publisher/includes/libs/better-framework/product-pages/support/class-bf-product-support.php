<?php

class BF_Product_Support extends BF_Product_Item {

	public $id = 'support';


	protected function before_render() {
		?>

		<style>
			.bs-pages-primary-btn {
				padding: 3px 13px;
			}

			.bs-pages-secondary-btn {
				background: none;
				border: none;
				color: #a9a9a9;
			}
		</style>
		<?php
	}


	public function render_content( $options ) {

		//todo: hide support links when product was not resisted
		if ( $support_list = apply_filters( 'better-framework/product-pages/support/config', array() ) ) :

			?>
			<div class="bs-product-pages-box-container bf-clearfix">

				<?php
				foreach ( $support_list as $support_data ) {

					$support_data['classes'] = array( 'fix-height-1' );
					bf_product_box( $support_data );
				}
				?>
			</div>

			<?php
		else:

			$this->error( 'no support registered' );
		endif;
	}
}
