<?php
$field_object = Better_Framework::html()->add( 'input' )->type( 'text' );

$field_object->name( $options['input_name'] );

if ( $options['value'] !== FALSE ) {
	$field_object->val( esc_attr( $options['value'] ) );
}

if ( isset( $options['rtl'] ) && $options['rtl'] !== FALSE ) {
	$field_object->class( 'rtl' );
}

if ( isset( $options['ltr'] ) && $options['ltr'] !== FALSE ) {
	$field_object->class( 'ltr' );
}

if ( isset( $options['placeholder'] ) && $options['placeholder'] !== '' ) {
	$field_object->attr( 'placeholder', $options['placeholder'] );
}

$has_prefix_or_suffix          = ! empty( $options['prefix'] ) || ! empty( $options['suffix'] );
$prefix_suffix_wrapper_classes = array();
if ( ! empty( $options['prefix'] ) ) {
	$prefix_suffix_wrapper_classes[] = 'bf-field-with-prefix';
}
if ( ! empty( $options['suffix'] ) ) {
	$prefix_suffix_wrapper_classes[] = 'bf-field-with-suffix';
}

$output = '';

if ( $has_prefix_or_suffix ) {
	$output .= '<div class="' . implode( $prefix_suffix_wrapper_classes, ' ' ) . '">';
}

if ( ! empty( $options['prefix'] ) ) {
	$output .= "<span class='bf-prefix-suffix'>{$options['prefix']}</span>";
}

$output .= $field_object->display();

if ( ! empty( $options['suffix'] ) ) {
	$output .= "<span class='bf-prefix-suffix'>{$options['suffix']}</span>";
}

if ( $has_prefix_or_suffix ) {
	$output .= '</div>';
}

echo $output;  // escaped before

echo $this->get_filed_input_desc( $options ); // escaped before