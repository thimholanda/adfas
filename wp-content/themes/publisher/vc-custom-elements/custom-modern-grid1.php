<?php

/*
Element Description: Custom Modern Grid 1
*/

// Element Class
class vcInfoBox extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
    }

    // Element Mapping
    public function vc_infobox_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __('Custom Modern Grid 1', 'text-domain'),
                'base' => 'vc_infobox',
                'description' => __('This Modern Grid gets Destaques cpt', 'text-domain'),
                'category' => __('Custom Elements', 'text-domain'),
            )
        );

    }


    // Element HTML
    public function vc_infobox_html( $atts ) {


        require_once ('render-custom-modern-grid1.php');

        return RenderCustomModernGrid1::getResult();

    }

} // End Element Class


// Element Class Init
new vcInfoBox();


