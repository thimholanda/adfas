<?php 
/*
Plugin Name: Magic Members 
Plugin URI: https://www.magicmembers.com/
Description: Magic Members is a premium Wordpress Membership Plugin that turn your WordPress blog into a powerful, fully automated membership site.
Author: Magical Media Group
Author URI: http://www.magicalmediagroup.com/
Text Domain: mgm
Version: 1.8.63
Build: 2.9.0
Distribution: 03/22/2017
Requires: Atleast WP 3.1+, Tested upto WP 4.7.3
*/ 
// versioned core: for loading different versions from single installation 
$core = 'core'; 
// reset
if($version = get_option('mgm_core_version')) $core = 'core-'.$version; 
// load init class 
$mgm_init_cls = @include_once( $core . '/mgm_init.php'); 
// init
$mgm_init = new $mgm_init_cls;
// setup
$mgm_init->start();