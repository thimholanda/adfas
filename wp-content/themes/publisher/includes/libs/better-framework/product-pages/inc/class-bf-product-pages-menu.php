<?php


die( 'Marked to remove' );

abstract class BF_Product_Pages_Menu extends BF_Product_Pages_Base {

	public $data;

	public $instaces = array();

	abstract public function fields();

	public function get_field_types() {

		return apply_filters( 'better-framework/product-pages/fields', array(
				'import_demo' => 'BS_Theme_Pages_Demo_Import_Manager'
			)
		);
	}

	public function render() {

		try {
			$fields = $this->fields();
			if ( ! $fields ) {
				throw new Exception( 'Fields is empty!' );
			}

			if ( ! is_array( $fields ) ) {
				throw new Exception( 'Fields is invalid!' );
			}

			$fields_required_keys = array(
				'type'    => '',
				'options' => ''
			);

			$available_types = $this->get_field_types();
			//handle fields

			foreach ( $fields as $field ) {

				if ( array_diff_key( $fields_required_keys, $field ) ) {
					continue;
				}
				$type    = &$field['type'];
				$options = &$field['options'];

				if ( ! isset( $available_types[ $type ] ) ) {
					throw new Exception( sprintf( 'invalid field type: %s', $type ) );
				}

				$instance = $this->get_instance( $available_types[ $type ] );

				$instance->setup();

				call_user_func( array( $instance, 'display_field' ), $field['options'] );

				$instance->tearDown();

			}

		} catch( Exception $e ) {

			$this->error( $e->getMessage() );
		}
	}

	protected function get_instance( &$class_name ) {
		if ( ! isset( $this->instaces[ $class_name ] ) ) {
			$this->instaces[ $class_name ] = new $class_name();
			$this->instaces[ $class_name ]->init();
		}

		return $this->instaces[ $class_name ];
	}
}