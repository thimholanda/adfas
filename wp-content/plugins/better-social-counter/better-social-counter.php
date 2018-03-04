<?php
/*
Plugin Name: Better Social Counter Widget
Plugin URI: http://betterstudio.com
Description: BetterStudio Social Counter Widget
Version: 1.4.8.2
Author: BetterStudio
Author URI: http://betterstudio.com
License: GPL2
*/


/**
 * Better_Social_Counter class wrapper
 *
 * @return Better_Social_Counter
 */
function Better_Social_Counter(){
    return Better_Social_Counter::self();
}


// Initialize Up Better Social Counter
Better_Social_Counter();


/**
 * Class Better_Social_Counter
 */
class Better_Social_Counter{


    /**
     * Contains BSC version number that used for assets for preventing cache mechanism
     *
     * @var string
     */
    public static $version = '1.4.8.2';


    /**
     * Contains BSC option panel id
     *
     * @var string
     */
    public static $panel_id = 'better_social_counter_options';


    /**
     * Inner array of instances
     *
     * @var array
     */
    protected static $instances = array();


    function __construct(){

        define( 'BETTER_SOCIAL_COUNTER_DIR_URL' , plugin_dir_url( __FILE__ ) );
        define( 'BETTER_SOCIAL_COUNTER_DIR_PATH' , plugin_dir_path( __FILE__ ) );

        // need BF_Social_Counter class for retrieving data
        include $this->dir_path( 'includes/class-better-social-counter-data-manager.php' );

        // Register included BF to loader
        add_filter( 'better-framework/loader', array( $this, 'better_framework_loader' ) );

        // Enable needed sections
        add_filter( 'better-framework/sections', array( $this, 'better_framework_sections' ) );

        // need BF_Social_Counter class for retrieving data
        include $this->dir_path( 'includes/panel-options.php' );

        // Active and new shortcodes
        add_filter( 'better-framework/shortcodes', array( $this, 'setup_shortcodes' ) );

        // Initialize
        add_action( 'better-framework/after_setup', array( $this, 'init' ) );

        // Callback for resetting data
        add_filter( 'better-framework/panel/reset/result', array( $this , 'callback_panel_reset_result'), 10, 2 );

        // Callback for importing data
        add_filter( 'better-framework/panel/import/result', array( $this , 'callback_panel_import_result'), 10, 3 );

        // Callback used for clearing cache after save
        add_filter( 'better-framework/panel/save/result', array( $this , 'callback_panel_save_result'), 10, 2 );

        // Enqueue assets
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

        // Enqueue admin scripts
        add_action( 'admin_enqueue_scripts', array( $this , 'admin_enqueue' ) );

        // Clear BF transients on plugin activation and deactivation
        register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
        register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );

        // Includes BF loader if not included before
        require_once $this->dir_path( 'includes/libs/better-framework/init.php' );

    }


    /**
     * Used for accessing plugin directory URL
     *
     * @param string $address
     *
     * @return string
     */
    public static function dir_url( $address = '' ){

        return plugin_dir_url( __FILE__ ) . $address;

    }


    /**
     * Used for accessing plugin directory path
     *
     * @param string $address
     *
     * @return string
     */
    public static function dir_path( $address = '' ){

        return plugin_dir_path( __FILE__ ) . $address;

    }


    /**
     * Returns BSC current Version
     *
     * @return string
     */
    public static function get_version(){

        return self::$version ;

    }


    /**
     * Clears BF transients for avoiding of happening any problem
     */
    function plugin_activation(){

        delete_transient( '__better_framework__final_fe_css' );
        delete_transient( '__better_framework__final_fe_css_version' );
        delete_transient( '__better_framework__backend_css' );

    }


    /**
     * Clears BF transients for avoiding of happening any problem
     */
    function plugin_deactivation(){

        delete_transient( '__better_framework__final_fe_css' );
        delete_transient( '__better_framework__final_fe_css_version' );
        delete_transient( '__better_framework__backend_css' );

    }


    /**
     * Build the required object instance
     *
     * @param string $object
     * @param bool $fresh
     * @param bool $just_include
     * @return null
     */
    public static function factory( $object = 'self', $fresh = false , $just_include = false ){

        if( isset( self::$instances[$object] ) && ! $fresh ){
            return self::$instances[$object];
        }

        switch( $object ){

            /**
             * Main Better_Social_Counter Class
             */
            case 'self':
                $class = 'Better_Social_Counter';
                break;


            default:
                return null;
        }


        // Just prepare/includes files
        if( $just_include )
            return;

        // don't cache fresh objects
        if( $fresh ){
            return new $class;
        }

        self::$instances[$object] = new $class;

        return self::$instances[$object];
    }


    /**
     * Used for accessing alive instance of Better_Social_Counter
     *
     * static
     * @since 1.0
     * @return Better_Social_Counter
     */
    public static function self(){

        return self::factory();

    }


    /**
     * Used for retrieving options simply and safely for next versions
     *
     * @param $option_key
     * @return mixed|null
     */
    public static function get_option( $option_key ){

        return bf_get_option( $option_key, self::$panel_id );

    }


    /**
     * Adds included BetterFramework to loader
     *
     * @param $frameworks
     * @return array
     */
    function better_framework_loader( $frameworks ){

        $frameworks[] = array(
            'version'   =>  '2.6.2',
            'path'      =>  $this->dir_path( 'includes/libs/better-framework/' ),
            'uri'       =>  $this->dir_url( 'includes/libs/better-framework/' ),
        );

        return $frameworks;

    }


    /**
     * Activate BF needed sections
     *
     * @param $sections
     * @return mixed
     */
    function better_framework_sections( $sections ){

        $sections['vc-extender'] = true;

        return $sections;

    }


    /**
     *  Init the plugin
     */
    function init(){

        load_plugin_textdomain( 'better-studio', false, 'better-social-counter/languages' );

    }


    /**
     * Enqueue css and js files
     */
    function enqueue_assets(){

        // Enqueue "Better Social Font Icon" from framework
        Better_Framework::assets_manager()->enqueue_style( 'better-social-font-icon' );

        // Element Query
        Better_Framework::assets_manager()->enqueue_script( 'element-query' );

        // Script
        wp_enqueue_script( 'better-social-counter', $this->dir_url( 'js/script.js' ), array( 'jquery' ), Better_Social_Counter::get_version(), true );

        // Style
        wp_enqueue_style( 'better-social-counter', $this->dir_url( 'css/style.css' ), array(), Better_Social_Counter::get_version() );

    }


    /**
     *  Enqueue admin scripts
     */
    function admin_enqueue(){

        wp_enqueue_style( 'better-social-counter-admin',  $this->dir_url( 'css/admin-style.css' ), array(), Better_Social_Counter::get_version() );

    }

    /**
     * Setups Shortcodes
     *
     * @param $shortcodes
     *
     * @return array
     */
    function setup_shortcodes( $shortcodes ){

        require_once $this->dir_path('includes/shortcodes/class-better-social-counter-shortcode.php' );
        require_once $this->dir_path('includes/shortcodes/class-better-social-banner-shortcode.php' );

        require_once $this->dir_path( 'includes/widgets/class-better-social-counter-widget.php' );
        require_once $this->dir_path( 'includes/widgets/class-better-social-banner-widget.php' );

        $shortcodes['better-social-counter'] = array(
            'shortcode_class'   =>  'Better_Social_Counter_Shortcode',
            'widget_class'      =>  'Better_Social_Counter_Widget',
        );

        $shortcodes['better-social-banner'] = array(
            'shortcode_class'   =>  'Better_Social_Banner_Shortcode',
            'widget_class'      =>  'Better_Social_Banner_Widget',
        );

        return $shortcodes;
    }


    /**
     * Clears all cache inside data base
     *
     * Callback
     *
     * @return array
     */
    public static function clear_cache_all(){

        Better_Social_Counter_Data_Manager::self()->clear_cache();

        return array(
            'status'  => 'succeed',
            'msg'	  => __( 'All Cache was cleaned.', 'better-studio' ),
        );

    }


    /**
     * Filter callback: Used for changing current language on importing translation panel data
     *
     * @param $result
     * @param $data
     * @param $args
     *
     * @return array
     */
    function callback_panel_import_result( $result, $data, $args ){

        // check panel
        if( $args['panel-id'] != self::$panel_id ){
            return $result;
        }

        // change messages
        if( $result['status'] == 'succeed' ){
            $result['msg'] = __( 'Better Social Counter options imported successfully.', 'better-studio' );
        }else{
            if( $result['msg'] == __( 'Imported data is not for this panel.', 'better-studio' ) ){
                $result['msg'] = __( 'Imported data is not for Better Social Counter.', 'better-studio' );
            }else{
                $result['msg'] = __( 'An error occurred while importing options.', 'better-studio' );
            }
        }

        return $result;
    }


    /**
     * Filter callback: Used for resetting current language on resetting panel
     *
     * @param $result
     * @param $options
     *
     * @return array
     */
    function callback_panel_reset_result( $result, $options ){

        // check panel
        if( $options['id'] != self::$panel_id ){
            return $result;
        }

        // change messages
        if( $result['status'] == 'succeed' ){
            $result['msg'] = __( 'Better Social Counter options reset to default.', 'better-studio' );
        }else{
            $result['msg'] = __( 'An error occurred while resetting options.', 'better-studio' );
        }

        return $result;
    }


    /**
     * Filter callback: Used for clearing cache
     *
     * @param $output
     * @param $args
     * @return string
     */
    function callback_panel_save_result( $output, $args ){

        // change only for BSC panel
        if( $args['id'] == self::$panel_id ){
            self::clear_cache_all();
        }

        return $output;
    }

}
