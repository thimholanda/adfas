<?php

// set options from deferred callback
if ( isset( $options['deferred-options'] ) ) {
	if ( is_string( $options['deferred-options'] ) && is_callable( $options['deferred-options'] ) ) {
		$options['options'] = call_user_func( $options['deferred-options'] );
	} elseif ( is_array( $options['deferred-options'] ) && ! empty( $options['deferred-options']['callback'] ) && is_callable( $options['deferred-options']['callback'] ) ) {
		if ( isset( $options['deferred-options']['args'] ) ) {
			$options['options'] = call_user_func_array( $options['deferred-options']['callback'], $options['deferred-options']['args'] );
		} else {
			$options['options'] = call_user_func( $options['deferred-options']['callback'] );
		}
	}
}

if ( empty( $options['options'] ) ) {
	$options['options'] = array();
}

$list_style = 'grid-2-column';
if ( isset( $options['list_style'] ) && ! empty( $options['list_style'] ) ) {
	$list_style = $options['list_style'];
}

// default selected
$current = array(
	'key'   => '',
	'label' => isset( $options['default_text'] ) && ! empty( $options['default_text'] ) ? wp_kses( $options['default_text'], bf_trans_allowed_html() ) : esc_html__( 'chose one...', 'publisher' ),
	'img'   => ''
);

if ( isset( $options['value'] ) && ! empty( $options['value'] ) ) {
	if ( isset( $options['options'][ $options['value'] ] ) ) {
		$current        = $options['options'][ $options['value'] ];
		$current['key'] = $options['value'];
	}
}
$select_options = '';
foreach ( (array) $options['options'] as $key => $option ) {
	$select_options .= '<li data-value="' . esc_attr( $key ) . '" data-label="' . esc_attr( $option['label'] ) . '" class="image-select-option ' . ( $key == $current['key'] ? 'selected' : '' ) . '">
        <img src="' . esc_attr( $option['img'] ) . '" alt="' . esc_attr( $option['label'] ) . '"/><p>' . wp_kses( $option['label'], bf_trans_allowed_html() ) . '</p>
    </li>';
}

echo '<div class="better-select-image"><div class="select-options">
<span class="selected-option">' . $current['label'] . '</span>
    <div class="better-select-image-options"><ul class="options-list ' . esc_attr( $list_style ) . ' bf-clearfix">' . $select_options /* escaped before */ . '</ul>
    </div>
</div>
<input type="hidden" name="' . esc_attr( $options['input_name'] ) . '" id="' . esc_attr( $options['input_name'] ) . '" value="' . esc_attr( $current['key'] ) . '"/>
</div>';

