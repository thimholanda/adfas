<?php

// border param must be set
if ( ! isset( $options['border'] ) ) {
	return '';
}

// All Borders
if ( isset( $options['border']['all'] ) ) {

	$border         = $options['border']['all'];
	$border['type'] = 'all';

	include BF_PATH . 'core/field-generator/fields/partial-border.php';

} // Specified borders
else {

	// Top Border
	if ( isset( $options['border']['top'] ) ) {

		$border          = $options['border']['top'];
		$border['type']  = 'top';
		$border['label'] = __( 'Top Border:', 'publisher' );

		include BF_PATH . 'core/field-generator/fields/partial-border.php';

	}

	// Right Border
	if ( isset( $options['border']['right'] ) ) {

		$border          = $options['border']['right'];
		$border['type']  = 'right';
		$border['label'] = __( 'Right Border:', 'publisher' );

		include BF_PATH . 'core/field-generator/fields/partial-border.php';

	}

	// Bottom Border
	if ( isset( $options['border']['bottom'] ) ) {

		$border          = $options['border']['bottom'];
		$border['type']  = 'bottom';
		$border['label'] = __( 'Bottom Border:', 'publisher' );

		include BF_PATH . 'core/field-generator/fields/partial-border.php';

	}

	// Left Border
	if ( isset( $options['border']['left'] ) ) {

		$border          = $options['border']['left'];
		$border['type']  = 'left';
		$border['label'] = __( 'Left Border:', 'publisher' );

		include BF_PATH . 'core/field-generator/fields/partial-border.php';

	}

}
