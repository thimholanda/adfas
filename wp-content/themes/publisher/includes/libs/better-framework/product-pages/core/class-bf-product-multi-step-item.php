<?php


abstract class BF_Product_Multi_Step_Item extends BF_Product_Item {

	/**
	 *
	 * @param strint|int $key
	 *
	 * @return string
	 */

	protected function get_steps_data_option_name( $key ) {

		return sprintf( 'bs_%s_data_%s', $this->id, $key );
	}

	/**
	 * save item process temporary data
	 *
	 * @param string $item_id
	 * @param mixed  $data
	 *
	 * @return bool
	 */
	protected function set_steps_data( $item_id, $data ) {


		return update_option( $this->get_steps_data_option_name( $item_id ), $data, 'no' );
	}


	/**
	 * delete item process temporary data
	 *
	 * @param string $item_id
	 *
	 * @return bool true if successful, false otherwise
	 */
	protected function delete_steps_data( $item_id ) {
		return delete_option( $this->get_steps_data_option_name( $item_id ) );
	}


	/**
	 * get item process temporary data
	 *
	 * @param string $item_id
	 *
	 * @return bool true if successful, false otherwise
	 */
	protected function get_steps_data( $item_id ) {
		return get_option( $this->get_steps_data_option_name( $item_id ) );
	}


	/**
	 * determinate is final step of import/rollback process
	 *
	 * @param string     $item_id
	 * @param string     $type
	 * @param string|int $step
	 *
	 * @return bool
	 */
	protected function is_final_step( $item_id, $type, $step ) {

		if ( $data = $this->get_steps_data( $item_id ) ) {

			if ( isset( $data['steps'] ) && is_array( $data['steps'] ) ) {

				end( $data['steps'] );

				$final_step_type  = key( $data['steps'] );
				$final_step_count = $data['steps'] [ $final_step_type ];

				return $type === $final_step_type && $step == $final_step_count;
			}
		}

		return FALSE;
	}

}