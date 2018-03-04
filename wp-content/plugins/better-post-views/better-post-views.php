<?php
/*
Plugin Name: Better Post Views
Plugin URI: http://betterstudio.com
Description: Enables you to display how many times a post/page had been viewed.
Version: 1.1.0
Author: BetterStudio
Author URI: http://betterstudio.com
License: GPL2
*/


/**
 * Better_Post_Views class wrapper for make changes safe in future
 *
 * @return Better_Post_Views
 */
function Better_Post_Views(){
    return Better_Post_Views::self();
}


// Initialize Better Post Views
Better_Post_Views();


/**
 * Handy function to show post views count
 *
 * @param   bool        $echo       Echo  views count
 * @param   string      $prefix     Prefix text to views count text
 * @param   string      $postfix    Postfix text to views count text
 * @param   string      $display    Display it or not? Use "show", "hide" and "default"
 * @param   string      $template   Custom template for result
 *
 * @return  mixed|void
 */
function The_Better_Views( $echo = true, $prefix = '', $postfix = '', $display = 'default', $template = '' ){
    if( $echo ){
        Better_Post_Views()->the_views( $echo, $prefix, $postfix, $display, $template );
    }else{
        return Better_Post_Views()->the_views( $echo, $prefix, $postfix, $display, $template );
    }
}


/**
 * Class Better_Post_Views
 */
class Better_Post_Views{


    /**
     * Contains Better_Post_Views version number that used for assets for preventing cache mechanism
     *
     * @var string
     */
    private static $version = '1.1.0';


    /**
     * Contains Better_Post_Views option panel ID
     *
     * @var string
     */
    private static $panel_id = 'better_post_views';


    /**
     * Contains Better_Post_Views view count meta ID
     *
     * @var string
     */
    private static $meta_id_daily = 'better-views-count';


    /**
     * Contains Better_Post_Views meta id of last 7 days data
     *
     * @var string
     */
    private static $meta_id_7days_data = 'better-views-7days-data';

    /**
     * Contains Better_Post_Views meta id of 7 days last day
     *
     * @var string
     */
    private static $meta_id_7days_total = 'better-views-7days-total';


    /**
     * Inner array of instances
     *
     * @var array
     */
    protected static $instances = array();


    function __construct(){

        // Register text domain
        load_plugin_textdomain( 'better-studio', false, 'better-post-views/languages' );

        // Admin panel options
        add_filter( 'better-framework/panel/options' , array( $this , 'setup_option_panel' ) );

        // Initialize
        add_action( 'better-framework/after_setup', array( $this, 'init' ) );

        // Enqueue assets
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_assets') );

    }


    /**
     * Used for accessing plugin directory URL
     *
     * @param string $append
     *
     * @return string
     */
    public static function dir_url( $append = '' ){
        return plugin_dir_url( __FILE__ ) . $append;
    }


    /**
     * Used for accessing plugin directory path
     *
     * @param string $append
     *
     * @return string
     */
    public static function dir_path( $append = '' ){
        return plugin_dir_path( __FILE__ ) . $append;
    }


    /**
     * Returns Better Post Views current Version
     *
     * @return string
     */
    public static function get_version(){
        return self::$version ;
    }


    /**
     * Build the required object instance
     *
     * @param string $object
     * @param bool $fresh
     * @param bool $just_include
     *
     * @return Better_Post_Views|null
     */
    public static function factory( $object = 'self', $fresh = false , $just_include = false ){

        if( isset( self::$instances[$object] ) && ! $fresh ){
            return self::$instances[$object];
        }

        switch( $object ){

            /**
             * Main Better_Post_Views Class
             */
            case 'self':
                $class = 'Better_Post_Views';
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
     * Used for accessing alive instance of Better_Post_Views
     *
     * static
     * @since 1.0
     * @return Better_Post_Views
     */
    public static function self(){
        return self::factory();
    }

	
    /**
     * Used for retrieving options simply and safely for next versions
     *
     * @param $option_key
     *
     * @return mixed|null
     */
    public static function get_option( $option_key ){
        return bf_get_option( $option_key, self::$panel_id );
    }


    /**
     *  Init the plugin
     */
    function init(){

        // Increment post views count
        add_action( 'wp_head', array( $this, 'wp_head' ) );

        // Add ajax action to do views increment
        add_action( 'wp_ajax_better_post_views', array( $this, 'increment_views_ajax' ) );
        add_action( 'wp_ajax_nopriv_better_post_views', array( $this, 'increment_views_ajax' ) );

        // Registers shortcode
        add_shortcode( 'better-post-views', array( $this, 'views_shortcode' ) );
        add_filter( 'betterstudio-editor-shortcodes', array( $this, 'register_shortcode_to_editor' ) );

        // adding view count into WP admin columns
        add_action('manage_posts_custom_column', array( $this, 'add_views_column_content' ) );
        add_filter('manage_posts_columns', array( $this, 'add_views_column' ));
        add_action('manage_pages_custom_column', array( $this, 'add_views_column_content' ) );
        add_filter('manage_pages_columns', array( $this, 'add_views_column' ) );

        // Admin sortable columns manager
        add_filter('manage_edit-post_sortable_columns', array( $this, 'manage_admin_sortable_columns' ));
        add_filter('manage_edit-page_sortable_columns', array( $this, 'manage_admin_sortable_columns') );

        // Handle's admin sortable columns
        add_action('pre_get_posts', array( $this, 'handle_admin_sortable_columns'));

    }


    /**
     * Callback: Enqueue css and js files
     *
     * Action: wp_enqueue_scripts
     */
    function enqueue_assets(){

        global $post;

        // Enqueue only when there is active cache plugin
        if( ! defined( 'WP_CACHE' ) || ! WP_CACHE )
            return;

        if( is_archive() || is_home() )
            return;

        if( ! wp_is_post_revision( $post ) && is_singular() && $this->should_count() ){

            wp_enqueue_script( 'better-post-views-cache', $this->dir_url( 'js/better-post-views.js' ), array( 'jquery' ), $this->get_version(), true );

            wp_localize_script(
                'better-post-views-cache',
                'better_post_views_vars',
                apply_filters(
                    'better-post-views/js/localized-vars',
                    array(
                        'admin_ajax_url'    =>  admin_url( 'admin-ajax.php' ),
                        'post_id'           =>  intval( $post->ID ),
                    )
                )
            );

        }

    }


    /**
     * Callback: Setup setting panel
     *
     * Filter: better-framework/panel/options
     *
     * @param $options
     *
     * @return array
     */
    function setup_option_panel( $options ){

        $field['count'] = array(
            'name'      =>  __( 'Count functionality', 'better-studio' ),
            'id'        =>  'count',
            'std'       =>  'daily',
            'type'      =>  'select',
            'desc'      =>  __( 'You can change the counting functionality wih this. If you need to soort posts byre view count in last 7 days you should select the 7 days but if you need to count simply the total post views then select the dasily.', 'better-studio' ),
            'options' => array(
                'daily'     => __( 'Daily', 'better-studio' ),
                '7days'     => __( '7 Days', 'better-studio' ),
            )
        );
        $field['counts_for'] = array(
            'name'      =>  __( 'Count views from', 'better-studio' ),
            'id'        =>  'counts_for',
            'std'       =>  'guest',
            'type'      =>  'select',
            'desc'      =>  __( 'Chose where the counter should be increment.', 'better-studio' ),
            'options' => array(
                'everyone'  => __( 'Everyone', 'better-studio' ),
                'guest'     => __( 'Guests Only', 'better-studio' ),
                'registered'=> __( 'Registered Users Only', 'better-studio' ),
            )
        );
        $field['exclude_bots'] = array(
            'name'      =>  __('Exclude bot\'s form views count','better-studio'),
            'id'        =>  'exclude_bots',
            'std'       =>  '0' ,
            'type'      =>  'switch',
            'on-label'  =>  __( 'Yes', 'better-studio' ),
            'off-label' =>  __( 'No', 'better-studio' ),
        );
        $field['views_template'] = array(
            'name'      =>  __( 'Views template', 'better-studio' ),
            'id'        =>  'views_template',
            'type'      =>  'text',
            'std'       =>  '%VIEW_COUNT% views',
            'desc'      =>  __( 'Allowed variables: <br>- %VIEW_COUNT% <br>- %VIEW_COUNT_ROUNDED%', 'better-studio' )
        );

        // Language  name for smart admin texts
        $lang = bf_get_current_lang();
        if( $lang != 'none' ){
            $lang = bf_get_language_name( $lang );
        }else{
            $lang = '';
        }

        $options[self::$panel_id] = array(
            'config' => array(
                'parent'                =>  'better-studio',
                'slug' 			        =>  'better-studio/better-post-views',
                'name'                  =>  __( 'Better Post Views', 'better-studio' ),
                'page_title'            =>  __( 'Better Post Views', 'better-studio' ),
                'menu_title'            =>  __( 'Post Views', 'better-studio' ),
                'capability'            =>  'manage_options',
                'icon_url'              =>  null,
                'position'              =>  80.05,
                'exclude_from_export'   =>  false,
            ),
            'texts'         =>  array(

                'panel-desc-lang'       =>  '<p>' . __( '%s Language Options.', 'better-studio' ) . '</p>',
                'panel-desc-lang-all'   =>  '<p>' . __( 'All Languages Options.', 'better-studio' ) . '</p>',

                'reset-button'      => ! empty( $lang ) ? sprintf( __( 'Reset %s Options', 'better-studio' ), $lang ) : __( 'Reset Options', 'better-studio' ),
                'reset-button-all'  => __( 'Reset All Options', 'better-studio' ),

                'reset-confirm'     =>  ! empty( $lang ) ? sprintf( __( 'Are you sure to reset %s options?', 'better-studio' ), $lang ) : __( 'Are you sure to reset options?', 'better-studio' ),
                'reset-confirm-all' => __( 'Are you sure to reset all options?', 'better-studio' ),

                'save-button'       =>  ! empty( $lang ) ? sprintf( __( 'Save %s Options', 'better-studio' ), $lang ) : __( 'Save Options', 'better-studio' ),
                'save-button-all'   =>  __( 'Save All Options', 'better-studio' ),

                'save-confirm-all'  =>  __( 'Are you sure to save all options? this will override specified options per languages', 'better-studio' )

            ),
            'panel-name'        => _x( 'Better Post Views', 'Panel title', 'better-studio' ),
            'panel-desc'        =>  '<p>' . __( 'Enables you to display how many times a post/page had been viewed.', 'better-studio' ) . '</p>',
            'fields'            => $field
        );

        return $options;
    }


    /**
     * Callback: Increment post views for posts and pages
     *
     * Action: wp_head
     */
    function wp_head(){

        global $post;

        if( is_int( $post ) ){
            $post = get_post( $post );
        }
        // Count only for singulars nad published posts
        if( wp_is_post_revision( $post ) || ! is_singular() ) return;

	    // Count if no active cache plugin
	    if( ! $this->should_count() || ( defined( 'WP_CACHE' ) && WP_CACHE ) ) return;

	    $this->increment_views( $post->ID );
    }


    /**
     * Callback: Used to increment views count by ajax
     *
     * Ajax Action: better_post_views
     */
    function increment_views_ajax(){

        if( empty( $_GET['better_post_views_id'] ) )
            exit();

        if( ! defined( 'WP_CACHE' ) || ! WP_CACHE )
            exit();

        $post_id = intval( $_GET['better_post_views_id'] );

        if( $post_id > 0 ){
	        echo $this->increment_views( $post_id );
        }

        exit();
    }


	/**
	 * Increments views count
	 *
	 * @param int|string    $post_id
	 *
	 * @return int
	 */
    function increment_views( $post_id ){

	    if( is_int( $post_id ) ){
		    $post = get_post( $post_id );
	    }else{
		    global $post;
		    $post = get_post( $post );
	    }

	    //
	    // Just current day
	    //

	    // Get post current day view count
	    if( ! $current_day_views = get_post_meta( $post->ID, self::$meta_id_daily, true ) ){
		    $current_day_views = 1;
	    }else{
		    $current_day_views += 1;
	    }

	    update_post_meta( $post->ID, self::$meta_id_daily, $current_day_views );

	    //
	    // Last 7 days views
	    //

	    // Stop counting if it's not enable to count 7days
	    if( ! $this->is_active( '7days' ) )
		    return $current_day_views;

	    $current_day = date( 'N' ) - 1;
	    $current_date = date( 'U' );

	    // Get views data of week
	    $last_7day_data = get_post_meta( $post->ID, self::$meta_id_7days_data, true );

	    // Check to be initialized before or not
	    if( is_array( $last_7day_data ) && ! empty( $last_7day_data['current_date'] ) ){

		    $current_day_of_the_year = date( 'z', $current_date );
		    $last_7day_day_of_the_year = date( 'z', $last_7day_data['current_date'] );

		    // The day was not changed since the last update
		    if( $last_7day_day_of_the_year == $current_day_of_the_year ){
			    $last_7day_data[$current_day]['views']++;
		    } else {

			    // Reset the current day to 1
			    $last_7day_data[$current_day]['views'] = 1;

			    // Set the current date
			    $last_7day_data[$current_day]['date'] = $current_date;

			    // Reset entries older than last 7 days
			    $one_week_ago = $current_date - 604800;
			    foreach( $last_7day_data as $day => $day_data ){

				    // don't exclude current_date
				    if( $day == 'current_date' )
					    continue;

				    if( $day_data['date'] < $one_week_ago ){
					    unset( $last_7day_data[$day] ); // remove entry
				    }
			    }

		    }

		    // Update last day with the current day
		    $last_7day_data['current_date'] = $current_date;

		    // Sum the 7days total count
		    $last_7day_sum = 0;
		    foreach( $last_7day_data as $day => $parameters ){

			    // don't exclude current_date
			    if( $day == 'current_date' )
				    continue;

			    $last_7day_sum += $parameters['views'];

		    }

	    }
	    // Initialize last 7 days data
	    else {

		    // base data
		    $last_7day_data = array(
			    'current_date'  => $current_date
		    );

		    // Set current day and total last 7 days total views to 1
		    $last_7day_sum = $last_7day_data[$current_day]['views'] = 1;

		    // Set the current date
		    $last_7day_data[$current_day]['date'] = $current_date;

	    }

	    // Update last 7 days data
	    update_post_meta( $post->ID, self::$meta_id_7days_data, $last_7day_data );

	    // Update last 7 days total views
	    update_post_meta( $post->ID, self::$meta_id_7days_total, $last_7day_sum );

	    return $current_day_views;

    }


    /**
     * Handy function used to detect should count views for current page or not
     *
     * @return bool
     */
    function should_count(){

        global $user_ID;

        $should_count = false;

        switch( $this->get_option( 'counts_for' ) ){

            // Count for all users
            case 'everyone':
                $should_count = true;
                break;

            // Count only for guest users ( non logged in users )
            case 'guest':
                if( empty( $_COOKIE[USER_COOKIE] ) && intval( $user_ID ) === 0 ){
                    $should_count = true;
                }
                break;

            // Count only for logged in users
            case 'registered':
                if( intval( $user_ID ) > 0 ){
                    $should_count = true;
                }
                break;
        }

        // Count if this is bot!
        if( $this->get_option( 'exclude_bots' ) ){

            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            foreach( $this->get_bots() as $bot ){

                if( stristr( $user_agent, $bot ) !== false ){
                    $should_count = false;
                    break;
                }

            }
        }

        return $should_count;
    }


    /**
     * Handy function to retrieve all identified bots list
     *
     * @return array
     */
    function get_bots(){

        return array(
            'Google Bot'    =>  'googlebot',
            'Google Bot2'   =>  'google',
            'MSN'           =>  'msnbot',
            'Alex'          =>  'ia_archiver',
            'Lycos'         =>  'lycos',
            'Ask Jeeves'    =>  'jeeves',
            'Altavista'     =>  'scooter',
            'AllTheWeb'     =>  'fast-webcrawler',
            'Inktomi'       =>  'slurp@inktomi',
            'Turnitin.com'  =>  'turnitinbot',
            'Technorati'    =>  'technorati',
            'Yahoo'         =>  'yahoo',
            'Findexa'       =>  'findexa',
            'NextLinks'     =>  'findlinks',
            'Gais'          =>  'gaisbo',
            'WiseNut'       =>  'zyborg',
            'WhoisSource'   =>  'surveybot',
            'Bloglines'     =>  'bloglines',
            'BlogSearch'    =>  'blogsearch',
            'PubSub'        =>  'pubsub',
            'Syndic8'       =>  'syndic8',
            'RadioUserland' =>  'userland',
            'Gigabot'       =>  'gigabot',
            'Become.com'    =>  'become.com',
            'Baidu'         =>  'baiduspider',
            'so.com'        =>  '360spider',
            'Sogou'         =>  'spider',
            'soso.com'      =>  'sosospider',
            'Yandex'        =>  'yandex'
        );

    }


    /**
     * Handy function to show post views count
     *
     * @param   bool        $echo       Echo  views count
     * @param   string      $prefix     Prefix text to views count text
     * @param   string      $postfix    Postfix text to views count text
     * @param   string      $display    Display it or not? Use "show", "hide" and "default"
     * @param   string      $template   Custom template for result
     *
     * @return  mixed|void
     */
    function the_views( $echo = true, $prefix = '', $postfix = '', $display = 'default', $template = '' ){

        switch( $display ){

            // Force to show
            case 'show':
                $should_display = true;
                break;

            // Force to hide
            case 'hide':
                $should_display = false;
                break;

            default:
                $should_display = true;

        }

        if( $should_display ){

            $output = $this->get_views( get_the_ID(), $prefix, $postfix, $template );

            if( $echo ){
                echo $output;
            }else{
                return $output;
            }

        }elseif( ! $echo ){

            return '';

        }

    }


    /**
     * Used for getting raw text of views count without any filter
     *
     * @param int       $post_id    Post ID
     * @param string    $prefix     Counts result prefix
     * @param string    $postfix    Counts result postfix
     * @param string    $template   Count result template
     *
     * @return mixed|void
     */
    function get_views( $post_id = 0, $prefix = '', $postfix = '', $template = '' ){

        if( $post_id === 0) {
            $post_id = get_the_ID();
        }

        if( empty( $template ) ){
            $template = $this->get_option( 'views_template' );
        }

        // Get post view count
        if( ! $post_views = get_post_meta( $post_id, self::$meta_id_daily, true ) ){
            $post_views = 0;
        }

        return apply_filters( 'better-post-views/views', $prefix.str_replace(
                array(
                    '%VIEW_COUNT%',
                    '%VIEW_COUNT_ROUNDED%'
                ),
                array(
                    number_format_i18n( $post_views ),
                    $this->format_number( $post_views )
                ),
                stripslashes( $template )
            ) . $postfix
        );

    }


    /**
     * Callback: display views count with shortcode
     *
     * Shortcode Callback: better-post-views
     *
     * @param $atts
     * @return mixed|void
     */
    function views_shortcode( $atts ) {

        $attributes = shortcode_atts(
            array(
                'id'        =>  0,
                'prefix'    =>  '',
                'postfix'   =>  '',
                'template'  =>  '',
            ),
            $atts
        );

        return $this->get_views( $attributes['id'], $attributes['prefix'], $attributes['postfix'], $attributes['template'] );

    }


    /**
     * Callback: Registers shortcode to BetterStudio Editor Shortcodes Plugin
     *
     * @param $shortcodes
     *
     * @return mixed
     */
    public function register_shortcode_to_editor( $shortcodes ){

        $_shortcodes = array();

        $_shortcodes['sep' . rand( 0, 9999 )] = array(
            'type'          =>  'separator',
        );

        $_shortcodes['post-views'] = array(
            'type'          =>  'menu',
            'label'         =>  __( 'Better Post Views', 'better-studio' ),
            'register'      =>  false,
            'items'         =>  array(

                'better-post-views1'  => array(
                    'type'          =>  'button',
                    'label'         =>  __( 'Post Views Count - Simple', 'better-studio' ),
                    'register'      =>  false,
                    'content'       =>  '[better-post-views]',
                ),

                'better-post-views2'  => array(
                    'type'          =>  'button',
                    'label'         =>  __( 'Post Views Count - Complex', 'better-studio' ),
                    'register'      =>  false,
                    'content'       =>  '[better-post-views prefix="Prefix - " postfix=" - Postfix" template=" have %VIEW_COUNT% view "]',
                ),

            )
        );

        return $shortcodes + $_shortcodes;
    }


    /**
     * Format number to human friendly style
     *
     * @param $number
     * @return string
     */
    private function format_number( $number ){

        if( ! is_numeric( $number ) )
            $number = intval( $number );

        if( $number >= 1000000 )
            return round( ( $number / 1000 ) / 1000 , 1 ) . "M";

        elseif( $number >= 100000 )
            return round( $number / 1000, 0 ) . "k";

        else
            return @number_format( $number );

    }


    /**
     * Callback: Used to adding views column to WP columns
     *
     * Filter Callback: manage_posts_columns
     * Filter Callback: manage_pages_columns
     *
     * @param   $columns
     *
     * @return mixed
     */
    function add_views_column( $columns ){
        $columns['better-post-views'] = __( 'Views', 'better-studio' );
        return $columns;
    }


    /**
     * Callback: Used to handling views column value
     *
     * Filter Callback: manage_posts_columns
     * Filter Callback: manage_pages_columns
     *
     * @param   $column
     *
     * @return mixed
     */
    function add_views_column_content( $column ){
        if( $column == 'better-post-views' ){
            echo $this->get_views();
        }
    }


    /**
     * Callback: Handel's admin sortable columns
     *
     * Filter: manage_edit-post_sortable_columns
     * Filter: manage_edit-page_sortable_columns
     *
     * @param $query
     */
    function handle_admin_sortable_columns( $query ){

        if( ! is_admin() )
            return;

        $orderby = $query->get( 'orderby' );

        if( 'better-post-views' == $orderby ){
            $query->set( 'meta_key', self::$meta_id_daily );
            $query->set( 'orderby', 'meta_value_num' );
        }

    }


    /**
     * Callback: Manages admin sortable columns
     *
     * Filter: manage_edit-post_sortable_columns
     * Filter: manage_edit-page_sortable_columns
     *
     * @param $defaults
     * @return mixed
     */
    function manage_admin_sortable_columns( $defaults ){

        $defaults['better-post-views'] = 'better-post-views';

        return $defaults;
    }


    /**
     * Use to detect plugins are counting what type of data
     *
     * @param string $id    ID for checking that type is active or not
     * @return mixed
     */
    function is_active( $id = '' ){

	    $count = $this->get_option( 'count' );

	    switch ( $id ){

		    case 'daily':
			    return  ( $count == '7days' || $count == $id ) ? true : false;

		    case '7days':
			    return $count == $id;
		        break;

	    }
	    
        return false;
    }

}