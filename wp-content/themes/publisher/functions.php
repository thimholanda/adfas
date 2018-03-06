<?php

$template_directory = get_template_directory() . '/';

// Loads the loader of oculus if not included before
require $template_directory . 'includes/libs/better-framework/oculus/better-framework-oculus-loader.php';

// Includes BF loader if not included before
require $template_directory . 'includes/libs/better-framework/init.php';

// handy functions and overrides
include $template_directory . 'includes/functions.php';

// Includes core of theme
include $template_directory . 'includes/libs/bs-theme-core/init.php';

// do config
include $template_directory . 'includes/pages/init.php';

// Registers and prepare all stuffs about BF that is used in theme
include $template_directory . 'includes/publisher-setup.php';
new Publisher_Setup();

// Fire up Theme
include $template_directory . 'includes/publisher.php';
new Publisher();


// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions()
{
    // Require new custom Element
    require_once( get_template_directory().'/vc-custom-elements/custom-modern-grid1.php' );
}