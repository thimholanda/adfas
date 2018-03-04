<?php

/**
 * Used for retrieving social data from social sites and caching them
 */
class Better_Social_Counter_Data_Manager {


    /**
     * Contain live instance object class
     *
     * @var Better_Social_Counter_Data_Manager
     */
    private static $instance;


    /**
     * Cached value for counts
     *
     * @var array
     */
    private $cache = array();


    /**
     * Contain sites that supported in class
     *
     * @var array
     */
    private $supported_sites = array(
        'facebook',
        'twitter',
        'google',
        'youtube',
        'dribbble',
        'vimeo',
        'delicious',
        'soundcloud',
        'github',
        'behance',
        'vk',
        'vine',
        'pinterest',
        'flickr',
        'steam',
        'instagram',
        'forrst',
        'mailchimp',
        'envato',
        'posts',
        'comments',
        'members',
    );


    /**
     * Used for retrieving instance of class
     *
     * @param bool $fresh
     * @return Better_Social_Counter_Data_Manager
     */
    public static function self( $fresh = false ){

        // get fresh instance
        if( $fresh ){
            self::$instance = new Better_Social_Counter_Data_Manager();
            return self::$instance;
        }

        if( isset( self::$instance ) && ( self::$instance instanceof Better_Social_Counter_Data_Manager ) )
            return self::$instance;

        self::$instance = new Better_Social_Counter_Data_Manager();

        return self::$instance;
    }


    /**
     * Used for retrieving data for a social site
     *
     * @param $id
     * @param bool $fresh
     * @return bool|mixed
     */
    public function get_transient( $id, $fresh = false ){

        if( isset( $this->cache[$id] ) && ! $fresh )
            return $this->cache[$id];

        // id = better framework social counter cache ;)
        $temp = get_transient( 'better_social_counter_data_' . $id );

        if( $temp === false )
            return false;

        $this->cache[$id] = $temp;

        return $temp;
    }


    /**
     * Save a value in WP cache system
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function set_transient( $id, $data ){

        return set_transient( 'better_social_counter_data_' . $id, $data, Better_Social_Counter::get_option( 'cache_time' ) * HOUR_IN_SECONDS );

    }

    /**
     * clear cache in WP cache system
     *
     * @param $id
     * @return bool
     */
    public function clear_transient( $id ){

        return delete_transient( 'better_social_counter_data_' . $id );

    }


    /**
     * Deletes cached data
     *
     * @param string $key
     */
    public static function clear_cache( $key = 'all' ){

        if( $key == 'all' ){

            global $wpdb;

            $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE %s", '_transient_better_social_counter_data_%' ) );
            $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE %s", '_transient_timeout_better_social_counter_data_%' ) );

        }else{

            self::self()->clear_transient( $key );

        }

    }


    /**
     * Format number to human friendly style
     *
     * @param $number
     * @return string
     */
    private function format_number( $number ){

        if( !is_numeric( $number ) ) return $number ;

        if( $number >= 1000000 )
            return round( ( $number / 1000 ) / 1000 , 1) . "M";

        elseif( $number >= 100000 )
            return round( $number / 1000, 0 ) . "k";

        else
            return @number_format( $number );

    }


    /**
     * used for getting sites data in out of class
     *
     * @param string $id
     * @return array
     */
    public static function get_full_data( $id = '' ){

        // at first create an instance of class
        self::self();

        // if id empty or invalid id
        if( empty( $id ) || ! in_array( $id, self::self()->supported_sites ) )
            return '';

        $id = str_replace( '-', '_', $id );

        $function = 'get_'.$id.'_full_data';

        if( method_exists( self::self(), $function ) ){

            return call_user_func( array( self::self(), $function ) );

        }else{
            return false;
        }

    }


    /**
     * used for getting sites data in out of class
     *
     * @param string $id
     * @return array
     */
    public static function get_short_data( $id = '' ){

        // at first create an instance of class
        self::self();

        // if id empty or invalid id
        if( empty( $id ) || ! in_array( $id, self::self()->supported_sites ) )
            return '';

        $id = str_replace( '-', '_', $id );

        $function = 'get_'.$id.'_short_data';

        if( method_exists( self::self(), $function ) ){

            return call_user_func( array( self::self(), $function ) );

        }else{
            return false;
        }

    }


    /**
     * Get remote data
     *
     * @param $url
     * @param bool $json
     * @return array|mixed|string
     */
    private function remote_get( $url, $json = true ) {

        $get_request = wp_remote_get( $url , array( 'timeout' => 18 , 'sslverify' => false ) );

        $request = wp_remote_retrieve_body( $get_request );

        if( $json )
            $request = @json_decode( $request , true );

        return $request;

    }


    /**
     * Used for checking if a social site fields is prepared for getting data
     *
     * @param $id
     * @return bool
     */
    public function is_active( $id ){

        if( ! in_array( $id, $this->supported_sites ) )
            return false;

        switch( $id ){

            case 'facebook':
                if( Better_Social_Counter::get_option( 'facebook_page' ) == ''     ||
                    Better_Social_Counter::get_option( 'facebook_app_secret' ) == ''  ||
                    Better_Social_Counter::get_option( 'facebook_app_id' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }

                break;

            case 'twitter':
                if( Better_Social_Counter::get_option( 'twitter_api_key' ) == ''     ||
                    Better_Social_Counter::get_option( 'twitter_api_secret' ) == ''  ||
                    Better_Social_Counter::get_option( 'twitter_username' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'google':
                if( Better_Social_Counter::get_option( 'google_page' ) == ''     ||
                    Better_Social_Counter::get_option( 'google_page_key' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'youtube':
                if( Better_Social_Counter::get_option( 'youtube_username' ) == '' ||
                    Better_Social_Counter::get_option( 'youtube_api_key' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'dribbble':
                if( Better_Social_Counter::get_option( 'dribbble_username' ) == '' || Better_Social_Counter::get_option( 'dribbble_access_token' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vimeo':
                if( Better_Social_Counter::get_option( 'vimeo_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'delicious':
                if( Better_Social_Counter::get_option( 'delicious_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'soundcloud':
                if( Better_Social_Counter::get_option( 'soundcloud_username' ) == '' ||
                    Better_Social_Counter::get_option( 'soundcloud_api_key' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'github':
                if( Better_Social_Counter::get_option( 'github_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'behance':
                if( Better_Social_Counter::get_option( 'behance_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vk':
                if( Better_Social_Counter::get_option( 'vk_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vine':
                if( Better_Social_Counter::get_option( 'vine_profile' ) == '' ||
                    Better_Social_Counter::get_option( 'vine_email' ) == ''   ||
                    Better_Social_Counter::get_option( 'vine_pass' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'pinterest':
                if( Better_Social_Counter::get_option( 'pinterest_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'flickr':
                if( Better_Social_Counter::get_option( 'flickr_group' ) == '' ||
                    Better_Social_Counter::get_option( 'flickr_key' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'steam':
                if( Better_Social_Counter::get_option( 'steam_group' ) == '' )
                    return false;
                return true;
                break;

            case 'instagram':
                if( Better_Social_Counter::get_option( 'instagram_username' ) == '' )
                    return false;
                return true;
                break;

            case 'forrst':
                if( Better_Social_Counter::get_option( 'forrst_username' ) == '' )
                    return false;
                return true;
                break;

            case 'mailchimp':
                if( Better_Social_Counter::get_option( 'mailchimp_list_id' ) == '' ||
                    Better_Social_Counter::get_option( 'mailchimp_list_url' ) == ''   ||
                    Better_Social_Counter::get_option( 'mailchimp_api_key' ) == ''
                ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'envato':
                if( Better_Social_Counter::get_option( 'envato_username' ) == '' )
                    return false;
                return true;
                break;

            case 'posts':
                if( ! Better_Social_Counter::get_option( 'posts_enabled' ) )
                    return false;
                return true;
                break;

            case 'comments':
                if( ! Better_Social_Counter::get_option( 'comments_enabled' ) )
                    return false;
                return true;
                break;

            case 'members':
                if( ! Better_Social_Counter::get_option( 'members_enabled' ) )
                    return false;
                return true;
                break;


        }

    }



    /**
     * Used for checking if a social site fields is prepared for getting data
     *
     * minimum requirements will be checked.
     *
     * @param $id
     * @return bool
     */
    public function is_min_active( $id ){

        if( ! in_array( $id, $this->supported_sites ) )
            return false;

        switch( $id ){

            case 'facebook':
                if( Better_Social_Counter::get_option( 'facebook_page' ) == '' ){
                    return false;
                }else{
                    return true;
                }

                break;

            case 'twitter':
                if( Better_Social_Counter::get_option( 'twitter_api_key' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'google':
                if( Better_Social_Counter::get_option( 'google_page' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'youtube':
                if( Better_Social_Counter::get_option( 'youtube_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'dribbble':
                if( Better_Social_Counter::get_option( 'dribbble_username' ) == '' || Better_Social_Counter::get_option( 'dribbble_access_token' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vimeo':
                if( Better_Social_Counter::get_option( 'vimeo_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'delicious':
                if( Better_Social_Counter::get_option( 'delicious_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'soundcloud':
                if( Better_Social_Counter::get_option( 'soundcloud_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'github':
                if( Better_Social_Counter::get_option( 'github_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'behance':
                if( Better_Social_Counter::get_option( 'behance_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vk':
                if( Better_Social_Counter::get_option( 'vk_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'vine':
                if( Better_Social_Counter::get_option( 'vine_profile' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'pinterest':
                if( Better_Social_Counter::get_option( 'pinterest_username' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'flickr':
                if( Better_Social_Counter::get_option( 'flickr_group' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'steam':
                if( Better_Social_Counter::get_option( 'steam_group' ) == '' )
                    return false;
                return true;
                break;

            case 'instagram':
                if( Better_Social_Counter::get_option( 'instagram_username' ) == '' )
                    return false;
                return true;
                break;

            case 'forrst':
                if( Better_Social_Counter::get_option( 'forrst_username' ) == '' )
                    return false;
                return true;
                break;

            case 'mailchimp':
                if( Better_Social_Counter::get_option( 'mailchimp_list_id' ) == '' ){
                    return false;
                }else{
                    return true;
                }
                break;

            case 'envato':
                if( Better_Social_Counter::get_option( 'envato_username' ) == '' )
                    return false;
                return true;
                break;

            case 'posts':
                if( ! Better_Social_Counter::get_option( 'posts_enabled' ) )
                    return false;
                return true;
                break;

            case 'comments':
                if( ! Better_Social_Counter::get_option( 'comments_enabled' ) )
                    return false;
                return true;
                break;

            case 'members':
                if( ! Better_Social_Counter::get_option( 'members_enabled' ) )
                    return false;
                return true;
                break;

        }

    }


    /**
     * Used for retrieving an array that contain sites list with specified active sites for widgets backend fields
     *
     * @return array
     */
    function get_widget_options_list(){

        $result = array();
        $active_items = array();

        //
        // Facebook
        //
        $facebook_active = $this->is_active( 'facebook' );

        $temp = array( 'facebook' => array(
            'label'     =>  'Facebook',
            'css-class' =>  $facebook_active ? 'active-item' : 'disable-item'
        ) );

        if( $facebook_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['facebook'] = $temp['facebook'];
        }


        //
        // Twitter
        //
        $twitter_active = $this->is_active( 'twitter' );

        $temp = array( 'twitter' => array(
            'label'     =>  'Twitter',
            'css-class' =>  $twitter_active ? 'active-item' : 'disable-item'
        ) );

        if( $twitter_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['twitter'] = $temp['twitter'];
        }


        //
        // Google+
        //
        $google_active = $this->is_active( 'google' );

        $temp = array( 'google' => array(
            'label'     =>  'Google+',
            'css-class' =>  $google_active ? 'active-item' : 'disable-item'
        ));

        if( $google_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['google'] = $temp['google'];
        }


        //
        // Youtube
        //
        $youtube_active = $this->is_active( 'youtube' );

        $temp = array( 'youtube' => array(
            'label'     =>  'Youtube',
            'css-class' =>  $youtube_active ? 'active-item' : 'disable-item'
        ));

        if( $youtube_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['youtube'] = $temp['youtube'];
        }


        //
        // Dribbble
        //
        $dribbble_active = $this->is_active( 'dribbble' );

        $temp = array( 'dribbble' => array(
            'label'     =>  'Dribbble',
            'css-class' =>  $dribbble_active ? 'active-item' : 'disable-item'
        ));

        if( $dribbble_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['dribbble'] = $temp['dribbble'];
        }


        //
        // Vimeo
        //
        $vimeo_active = $this->is_active( 'vimeo' );

        $temp = array( 'vimeo' => array(
            'label'     =>  'Vimeo',
            'css-class' =>  $vimeo_active ? 'active-item' : 'disable-item'
        ));

        if( $vimeo_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vimeo'] = $temp['vimeo'];
        }


        //
        // Delicious
        //
        $delicious_active = $this->is_active( 'delicious' );

        $temp = array( 'delicious' => array(
            'label'     =>  'Delicious',
            'css-class' =>  $delicious_active ? 'active-item' : 'disable-item'
        ));

        if( $delicious_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['delicious'] = $temp['delicious'];
        }


        //
        // SoundCloud
        //
        $soundcloud_active = $this->is_active( 'soundcloud' );

        $temp = array( 'soundcloud' => array(
            'label'     =>  'SoundCloud',
            'css-class' =>  $soundcloud_active ? 'active-item' : 'disable-item'
        ));

        if( $soundcloud_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['soundcloud'] = $temp['soundcloud'];
        }


        //
        // Github
        //
        $github_active = $this->is_active( 'github' );

        $temp = array( 'github' => array(
            'label'     =>  'Github',
            'css-class' =>  $github_active ? 'active-item' : 'disable-item'
        ));

        if( $github_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['github'] = $temp['github'];
        }


        //
        // Behance
        //
        $behance_active = $this->is_active( 'behance' );

        $temp = array( 'behance' => array(
            'label'     =>  'Behance',
            'css-class' =>  $behance_active ? 'active-item' : 'disable-item'
        ));

        if( $behance_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['behance'] = $temp['behance'];
        }


        //
        // VK
        //
        $vk_active = $this->is_active( 'vk' );

        $temp = array( 'vk' => array(
            'label'     =>  'VK',
            'css-class' =>  $vk_active ? 'active-item' : 'disable-item'
        ));

        if( $vk_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vk'] = $temp['vk'];
        }


        //
        // Vine
        //
        $vine_active = $this->is_active( 'vine' );

        $temp = array( 'vine' => array(
            'label'     =>  'Vine',
            'css-class' =>  $vine_active ? 'active-item' : 'disable-item'
        ));

        if( $vine_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vine'] = $temp['vine'];
        }


        //
        // Pinterest
        //
        $pinterest = $this->is_active( 'pinterest' );

        $temp = array( 'pinterest' => array(
            'label'     =>  'Pinterest',
            'css-class' =>  $pinterest ? 'active-item' : 'disable-item'
        ));

        if( $pinterest ){
            $active_items =  $active_items + $temp;
        }else{
            $result['pinterest'] = $temp['pinterest'];
        }


        //
        // Flickr
        //
        $flickr_active = $this->is_active( 'flickr' );

        $temp = array( 'flickr' => array(
            'label'     =>  'Flickr',
            'css-class' =>  $flickr_active ? 'active-item' : 'disable-item'
        ));

        if( $flickr_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['flickr'] = $temp['flickr'];
        }


        //
        // Steam
        //
        $steam_active = $this->is_active( 'steam' );

        $temp = array( 'steam' => array(
            'label'     =>  'Steam',
            'css-class' =>  $steam_active ? 'active-item' : 'disable-item'
        ));

        if( $steam_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['steam'] = $temp['steam'];
        }


        //
        // Instagram
        //
        $instagram_active = $this->is_active( 'instagram' );

        $temp = array( 'instagram' => array(
            'label'     =>  'Instagram',
            'css-class' =>  $instagram_active ? 'active-item' : 'disable-item'
        ));

        if( $instagram_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['instagram'] = $temp['instagram'];
        }


        //
        // Forrst
        //
        $forrst_active = $this->is_active( 'forrst' );

        $temp = array( 'forrst' => array(
            'label'     =>  'Forrst',
            'css-class' =>  $forrst_active ? 'active-item' : 'disable-item'
        ));

        if( $forrst_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['forrst'] = $temp['forrst'];
        }


        //
        // Mailchimp
        //
        $mailchimp_active = $this->is_active( 'mailchimp' );

        $temp = array( 'mailchimp' => array(
            'label'     =>  'Mailchimp',
            'css-class' =>  $mailchimp_active ? 'active-item' : 'disable-item'
        ));

        if( $mailchimp_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['mailchimp'] = $temp['mailchimp'];
        }


        //
        // Envato
        //
        $envato_active = $this->is_active( 'envato' );

        $temp = array( 'envato' => array(
            'label'     =>  'Envato',
            'css-class' =>  $envato_active ? 'active-item' : 'disable-item'
        ));

        if( $envato_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['envato'] = $temp['envato'];
        }


        //
        // Posts
        //
        $posts_active = $this->is_active( 'posts' );

        $temp = array( 'posts' => array(
            'label'     =>  'Posts',
            'css-class' =>  $posts_active ? 'active-item' : 'disable-item'
        ));

        if( $posts_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['posts'] = $temp['posts'];
        }


        //
        // Comments
        //
        $comments_active = $this->is_active( 'comments' );

        $temp = array( 'comments' => array(
            'label'     =>  'Comments',
            'css-class' =>  $comments_active ? 'active-item' : 'disable-item'
        ));

        if( $comments_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['comments'] = $temp['comments'];
        }


        //
        // Members
        //
        $members_active = $this->is_active( 'members' );

        $temp = array( 'members' => array(
            'label'     =>  'Members',
            'css-class' =>  $members_active ? 'active-item' : 'disable-item'
        ));

        if( $members_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['members'] = $temp['members'];
        }


        // add active sites to top of list
        $result = $active_items + $result;

        return $result;
    }


    /**
     * Used for retrieving an array that contain sites list with specified active sites for widgets backend fields
     *
     * @return array
     */
    function get_deferred_widget_options_list(){

        $result = array();
        $active_items = array();

        $saved_options = get_option( 'better_social_counter_options' );

        //
        // Facebook
        //
        $facebook_active = true;

        if( empty( $saved_options['facebook_page'] ) ||
            empty( $saved_options['facebook_app_secret'] ) ||
            empty( $saved_options['facebook_app_id'] )
        )
            $facebook_active = false;

        $temp = array( 'facebook' => array(
            'label'     =>  'Facebook',
            'css-class' =>  $facebook_active ? 'active-item' : 'disable-item'
        ) );

        if( $facebook_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['facebook'] = $temp['facebook'];
        }


        //
        // Twitter
        //
        $twitter_active = true;

        if( empty( $saved_options['twitter_api_key'] ) ||
            empty( $saved_options['twitter_api_secret'] ) ||
            empty( $saved_options['twitter_username'] )
        )
            $twitter_active = false;

        $temp = array( 'twitter' => array(
            'label'     =>  'Twitter',
            'css-class' =>  $twitter_active ? 'active-item' : 'disable-item'
        ) );

        if( $twitter_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['twitter'] = $temp['twitter'];
        }


        //
        // Google+
        //
        $google_active = true;

        if( empty( $saved_options['google_page'] ) || empty( $saved_options['google_page_key'] ) )
            $google_active = false;

        $temp = array( 'google' => array(
            'label'     =>  'Google+',
            'css-class' =>  $google_active ? 'active-item' : 'disable-item'
        ));

        if( $google_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['google'] = $temp['google'];
        }


        //
        // Youtube
        //
        $youtube_active = true;

        if( empty( $saved_options['youtube_username'] ) || empty( $saved_options['youtube_api_key'] ) )
            $youtube_active = false;

        $temp = array( 'youtube' => array(
            'label'     =>  'Youtube',
            'css-class' =>  $youtube_active ? 'active-item' : 'disable-item'
        ));

        if( $youtube_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['youtube'] = $temp['youtube'];
        }


        //
        // Dribbble
        //
        $dribbble_active = true;

        if( empty( $saved_options['dribbble_username'] ) || empty( $saved_options['dribbble_access_token'] ) )
            $dribbble_active = false;

        $temp = array( 'dribbble' => array(
            'label'     =>  'Dribbble',
            'css-class' =>  $dribbble_active ? 'active-item' : 'disable-item'
        ));

        if( $dribbble_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['dribbble'] = $temp['dribbble'];
        }


        //
        // Vimeo
        //
        $vimeo_active = true;

        if( empty( $saved_options['vimeo_username'] ) )
            $vimeo_active = false;

        $temp = array( 'vimeo' => array(
            'label'     =>  'Vimeo',
            'css-class' =>  $vimeo_active ? 'active-item' : 'disable-item'
        ));

        if( $vimeo_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vimeo'] = $temp['vimeo'];
        }


        //
        // Delicious
        //
        $delicious_active = true;

        if( empty( $saved_options['delicious_username'] ) )
            $delicious_active = false;

        $temp = array( 'delicious' => array(
            'label'     =>  'Delicious',
            'css-class' =>  $delicious_active ? 'active-item' : 'disable-item'
        ));

        if( $delicious_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['delicious'] = $temp['delicious'];
        }


        //
        // SoundCloud
        //
        $soundcloud_active = true;

        if( empty( $saved_options['soundcloud_username'] ) || empty( $saved_options['soundcloud_api_key'] ) )
            $soundcloud_active = false;

        $temp = array( 'soundcloud' => array(
            'label'     =>  'SoundCloud',
            'css-class' =>  $soundcloud_active ? 'active-item' : 'disable-item'
        ));

        if( $soundcloud_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['soundcloud'] = $temp['soundcloud'];
        }


        //
        // Github
        //
        $github_active = true;

        if( empty( $saved_options['github_username'] ) )
            $github_active = false;

        $temp = array( 'github' => array(
            'label'     =>  'Github',
            'css-class' =>  $github_active ? 'active-item' : 'disable-item'
        ));

        if( $github_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['github'] = $temp['github'];
        }


        //
        // Behance
        //
        $behance_active = true;

        if( empty( $saved_options['behance_username'] ) )
            $behance_active = false;

        $temp = array( 'behance' => array(
            'label'     =>  'Behance',
            'css-class' =>  $behance_active ? 'active-item' : 'disable-item'
        ));

        if( $behance_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['behance'] = $temp['behance'];
        }


        //
        // VK
        //
        $vk_active = true;

        if( empty( $saved_options['vk_username'] ) )
            $vk_active = false;

        $temp = array( 'vk' => array(
            'label'     =>  'VK',
            'css-class' =>  $vk_active ? 'active-item' : 'disable-item'
        ));

        if( $vk_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vk'] = $temp['vk'];
        }


        //
        // Vine
        //
        $vine_active = true;

        if( empty( $saved_options['vine_profile'] ) ||  empty( $saved_options['vine_email'] ) ||  empty( $saved_options['vine_pass'] ) )
            $vine_active = false;

        $temp = array( 'vine' => array(
            'label'     =>  'Vine',
            'css-class' =>  $vine_active ? 'active-item' : 'disable-item'
        ));

        if( $vine_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['vine'] = $temp['vine'];
        }


        //
        // Pinterest
        //
        $pinterest = true;

        if( empty( $saved_options['pinterest_username'] ) )
            $pinterest = false;

        $temp = array( 'pinterest' => array(
            'label'     =>  'Pinterest',
            'css-class' =>  $pinterest ? 'active-item' : 'disable-item'
        ));

        if( $pinterest ){
            $active_items =  $active_items + $temp;
        }else{
            $result['pinterest'] = $temp['pinterest'];
        }


        //
        // Flickr
        //
        $flickr_active = true;

        if( empty( $saved_options['flickr_group'] ) ||  empty( $saved_options['flickr_key'] ) )
            $flickr_active = false;

        $temp = array( 'flickr' => array(
            'label'     =>  'Flickr',
            'css-class' =>  $flickr_active ? 'active-item' : 'disable-item'
        ));

        if( $flickr_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['flickr'] = $temp['flickr'];
        }


        //
        // Steam
        //
        $steam_active = true;

        if( empty( $saved_options['steam_group'] ) )
            $steam_active = false;

        $temp = array( 'steam' => array(
            'label'     =>  'Steam',
            'css-class' =>  $steam_active ? 'active-item' : 'disable-item'
        ));

        if( $steam_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['steam'] = $temp['steam'];
        }


        //
        // Instagram
        //
        $instagram_active = true;

        if( empty( $saved_options['instagram_username'] ) )
            $instagram_active = false;

        $temp = array( 'instagram' => array(
            'label'     =>  'Instagram',
            'css-class' =>  $instagram_active ? 'active-item' : 'disable-item'
        ));

        if( $instagram_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['instagram'] = $temp['instagram'];
        }


        //
        // Forrst
        //
        $forrst_active = true;

        if( empty( $saved_options['forrst_username'] ) )
            $forrst_active = false;

        $temp = array( 'forrst' => array(
            'label'     =>  'Forrst',
            'css-class' =>  $forrst_active ? 'active-item' : 'disable-item'
        ));

        if( $forrst_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['forrst'] = $temp['forrst'];
        }


        //
        // Mailchimp
        //
        $mailchimp_active = true;

        if( empty( $saved_options['mailchimp_list_id'] ) || empty( $saved_options['mailchimp_list_url'] ) || empty( $saved_options['mailchimp_api_key'] ) )
            $mailchimp_active = false;

        $temp = array( 'mailchimp' => array(
            'label'     =>  'Mailchimp',
            'css-class' =>  $mailchimp_active ? 'active-item' : 'disable-item'
        ));

        if( $mailchimp_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['mailchimp'] = $temp['mailchimp'];
        }


        //
        // Envato
        //
        $envato_active = true;

        if( empty( $saved_options['envato_username'] ) )
            $envato_active = false;

        $temp = array( 'envato' => array(
            'label'     =>  'Envato',
            'css-class' =>  $envato_active ? 'active-item' : 'disable-item'
        ));

        if( $envato_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['envato'] = $temp['envato'];
        }


        //
        // Posts
        //
        $posts_active = true;

        if( empty( $saved_options['posts_enabled'] ) && $saved_options['posts_enabled'] == false )
            $posts_active = false;

        $temp = array( 'posts' => array(
            'label'     =>  'Posts',
            'css-class' =>  $posts_active ? 'active-item' : 'disable-item'
        ));

        if( $posts_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['posts'] = $temp['posts'];
        }


        //
        // Comments
        //
        $comments_active = true;

        if( empty( $saved_options['comments_enabled'] ) && $saved_options['comments_enabled'] == false )
            $comments_active = false;

        $temp = array( 'comments' => array(
            'label'     =>  'Comments',
            'css-class' =>  $comments_active ? 'active-item' : 'disable-item'
        ));

        if( $comments_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['comments'] = $temp['comments'];
        }

        //
        // Members
        //
        $members_active = true;

        if( empty( $saved_options['members_enabled'] ) && $saved_options['members_enabled'] == false )
            $members_active = false;

        $temp = array( 'members' => array(
            'label'     =>  'Members',
            'css-class' =>  $members_active ? 'active-item' : 'disable-item'
        ));

        if( $members_active ){
            $active_items =  $active_items + $temp;
        }else{
            $result['members'] = $temp['members'];
        }


        // add active sites to top of list
        $result = $active_items + $result;

        return $result;
    }


    /**
     * Returns sites list for select option
     *
     * @param bool $remove_extra remove extra sites for banner shortcode
     *
     * @return array
     */
    public function get_select_options_for_banner( $remove_extra = true ){

        // Temp for active sites
        $sites_list = array();

        // Make final select options
        foreach( self::get_widget_options_list() as $id => $site ){

            if( $site['css-class'] == 'disable-item' ){

                $sites_list[$id] = array(
                    'label'     =>  $site['label'] . ' ' . __( '( Disable )', 'better-studio' ),
                    'disabled'  =>  true
                );

            }else{

                $sites_list[$id] = $site['label'];

            }
        }

        // Remove extra items
        if( $remove_extra ){
            unset( $sites_list['posts'] );
            unset( $sites_list['comments'] );
            unset( $sites_list['members'] );
        }

        return $sites_list;
    }


    /**
     * Used for retrieving data for facebook
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_facebook_full_data( $id = 'facebook' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( 'facebook' ) === false ){

            $facebook_page          = Better_Social_Counter::get_option( 'facebook_page' );
            $facebook_app_id        = Better_Social_Counter::get_option( 'facebook_app_id' );
            $facebook_app_secret    = Better_Social_Counter::get_option( 'facebook_app_secret' );

            if( $facebook_page !== '' ){
                try {
                    $data = $this->remote_get( "https://graph.facebook.com/{$facebook_page}?access_token={$facebook_app_id}|{$facebook_app_secret}" );

                    if( isset($data['likes']) )
                        $result = (int) $data['likes'];
                    else
                        $result = 0;

                } catch (Exception $e) {}
            }

            if( ! isset( $result ) )
                $result = 0;

            // Final result
            $final_result = array(
                'link'      =>  'http://www.facebook.com/' . $facebook_page,
                'count'     =>  $this->format_number( $result ),
                'title'     =>  Better_Social_Counter::get_option( 'facebook_title' ),
                'title_join'=>  Better_Social_Counter::get_option( 'facebook_title_join' ),
                'button'    =>  Better_Social_Counter::get_option( 'facebook_button' ),
                'name'      =>  __( 'Facebook', 'betterstudio' ),
            );

            $this->set_transient( 'facebook', $final_result );

            return $final_result;

        }

        return $this->get_transient('facebook');
    }


    /**
     * Used for retrieving short data for facebook
     *
     * @param string $id
     * @return array|bool
     */
    private function get_facebook_short_data( $id = 'facebook' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  'http://www.facebook.com/' . Better_Social_Counter::get_option( 'facebook_page' ),
            'title'     =>  Better_Social_Counter::get_option( 'facebook_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'facebook_title_join' ),
            'name'      =>  __( 'Facebook', 'betterstudio' ),
        );

    }


    /**
     * Used for retrieving data for twitter
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_twitter_full_data( $id = 'twitter' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient($id) !== false )
            return $this->get_transient($id);

        // get active token if exists
        $active_token = get_option( 'better_social_counter_twitter_token' );

        // getting new active auth bearer
        if( ! $active_token ){

            // preparing credentials
            $credentials = Better_Social_Counter::get_option( 'twitter_api_key' ) . ':' . Better_Social_Counter::get_option( 'twitter_api_secret' );

            $auth = base64_encode( $credentials );

            // http post arguments
            $args = array(
                'method' => 'POST',
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => 'Basic ' . $auth,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                ),
                'body' => array( 'grant_type' => 'client_credentials' )
            );

            add_filter( 'https_ssl_verify', '__return_false' );

            $response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

            $keys = json_decode( wp_remote_retrieve_body( $response ) );

            if( $keys ) {
                update_option( 'better_social_counter_twitter_token', $keys->access_token );
                $active_token = $keys->access_token;
            }
        }

        $args = array(
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(
                'Authorization' => "Bearer $active_token"
            )
        );

        add_filter( 'https_ssl_verify', '__return_false' );

        $twitter_username = Better_Social_Counter::get_option( 'twitter_username' );

        $api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=" . $twitter_username;

        $response = wp_remote_get( $api_url, $args );

        if( ! is_wp_error( $response ) ) {

            $followers = json_decode( wp_remote_retrieve_body( $response ) );

            $result = $followers->followers_count;
        }
        else{
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  'http://twitter.com/' . $twitter_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'twitter_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'twitter_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'twitter_button' ),
            'name'      =>  __( 'Twitter', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for twitter
     *
     * @param string $id
     * @return array|bool
     */
    private function get_twitter_short_data( $id = 'twitter' ){

        if( ! $this->is_min_active( $id ) )
            return false;

         return array(
            'link'      =>  'http://twitter.com/' . Better_Social_Counter::get_option( 'twitter_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'twitter_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'twitter_title_join' ),
            'name'      =>  __( 'Twitter', 'betterstudio' ),
        );

    }


    /**
     * Used for retrieving data for Google Plus
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_google_full_data( $id = 'google' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $google_page = Better_Social_Counter::get_option( 'google_page' );

        try{
            // Get googleplus data
            $googleplus_data = $this->remote_get( 'https://www.googleapis.com/plus/v1/people/'. $google_page .'?key=' . Better_Social_Counter::get_option( 'google_page_key' ) );

            if ( isset( $googleplus_data['circledByCount'] ) ) {

                $googleplus_count = (int) $googleplus_data['circledByCount'] ;

                $result = $googleplus_count;

            }

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  'https://plus.google.com/' . $google_page,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'google_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'google_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'google_button' ),
            'name'      =>  __( 'Google+', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Google Plus
     *
     * @param string $id
     * @return array|bool
     */
    private function get_google_short_data( $id = 'google' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  'https://plus.google.com/' . Better_Social_Counter::get_option( 'google_page' ),
            'title'     =>  Better_Social_Counter::get_option( 'google_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'google_title_join' ),
            'name'      =>  __( 'Google+', 'betterstudio' ),
        );

    }


    /**
     * Used for retrieving data for Youtube
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_youtube_full_data( $id = 'youtube' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $youtube_type       = Better_Social_Counter::get_option( 'youtube_type' );
        $youtube_username   = Better_Social_Counter::get_option( 'youtube_username' );
        $youtube_api_key    = Better_Social_Counter::get_option( 'youtube_api_key' );

        try{

            if( $youtube_type == 'channel' )
                $data = $this->remote_get( "https://www.googleapis.com/youtube/v3/channels?part=statistics&id={$youtube_username}&key={$youtube_api_key}");
            else
                $data = $this->remote_get( "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername={$youtube_username}&key={$youtube_api_key}");

            $result = (int) @$data['items'][0]['statistics']['subscriberCount'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      => 'http://youtube.com/channel/'. $youtube_username,
            'count'     => $this->format_number( $result ),
            'title'     => Better_Social_Counter::get_option( 'youtube_title' ),
            'title_join'=> Better_Social_Counter::get_option( 'youtube_title_join' ),
            'button'    => Better_Social_Counter::get_option( 'youtube_button' ),
            'name'      =>  __( 'Youtube', 'betterstudio' ),
        );

        if( $youtube_type == 'channel' )
            $final_result['link'] = 'http://youtube.com/channel/'. $youtube_username;
        else
            $final_result['link'] = 'http://youtube.com/user/'. $youtube_username;

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Youtube
     *
     * @param string $id
     * @return array|bool
     */
    private function get_youtube_short_data( $id = 'youtube' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  'http://youtube.com/' . Better_Social_Counter::get_option( 'youtube_type' ) .'/'. Better_Social_Counter::get_option( 'youtube_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'youtube_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'youtube_title_join' ),
            'name'      =>  __( 'Youtube', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Dribbble
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_dribbble_full_data( $id = 'dribbble' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $dribbble_username = Better_Social_Counter::get_option( 'dribbble_username' );
        $dribbble_access_token = Better_Social_Counter::get_option( 'dribbble_access_token' );

        try{
            $data = $this->remote_get( "http://api.dribbble.com/v1/users/$dribbble_username?access_token=$dribbble_access_token" );
            $result = (int) $data['followers_count'];
        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  'http://dribbble.com/' . $dribbble_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'dribbble_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'dribbble_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'dribbble_button' ),
            'name'      =>  __( 'Dribbble', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Dribbble
     *
     * @param string $id
     * @return array|bool
     */
    private function get_dribbble_short_data( $id = 'dribbble' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  'http://dribbble.com/' . Better_Social_Counter::get_option( 'dribbble_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'dribbble_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'dribbble_title_join' ),
            'name'      =>  __( 'Dribbble', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Vimeo
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_vimeo_full_data( $id = 'vimeo' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $vimeo_type = Better_Social_Counter::get_option( 'vimeo_type' );
        $vimeo_username = Better_Social_Counter::get_option( 'vimeo_username' );

        try {
            if( $vimeo_type == 'user' ){

                $data = $this->remote_get( "http://vimeo.com/api/v2/" . $vimeo_username . "/info.json" );

                $result = ( (int) $data['total_videos_uploaded']) + ( (int) $data['total_videos_appears_in'] );

            }elseif( $vimeo_type == 'channel' ){

                $data = $this->remote_get( "http://vimeo.com/api/v2/channel/" . $vimeo_username . "/info.json" );

                $result = (int) $data['total_subscribers'];

            }

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;


        $link = 'http://vimeo.com/';

        if( $vimeo_type == 'channel' ){

            $link .= 'channels/' . $vimeo_username;

        }else{

            $link .= $vimeo_username;

        }

        // Final result
        $final_result = array(
            'link'      => $link,
            'count'     => $this->format_number( $result ),
            'title'     => Better_Social_Counter::get_option( 'vimeo_title' ),
            'title_join'=> Better_Social_Counter::get_option( 'vimeo_title_join' ),
            'button'    => Better_Social_Counter::get_option( 'vimeo_button' ),
            'name'      =>  __( 'Vimeo', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Vimeo
     *
     * @param string $id
     * @return array
     */
    private function get_vimeo_short_data( $id = 'vimeo' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        $vimeo_username = Better_Social_Counter::get_option( 'vimeo_username' );

        $vimeo_type = Better_Social_Counter::get_option( 'vimeo_type' );

        $link = 'http://vimeo.com/';

        if( $vimeo_type == 'channel' ){
            $link .= 'channels/' . $vimeo_username;
        }else{
            $link .= $vimeo_username;
        }

        return array(
            'link'      => $link,
            'title'     => Better_Social_Counter::get_option( 'vimeo_title' ),
            'title_join'=> Better_Social_Counter::get_option( 'vimeo_title_join' ),
            'name'      =>  __( 'Vimeo', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Delicious
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_delicious_full_data( $id = 'delicious' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $delicious_username = Better_Social_Counter::get_option( 'delicious_username' );

        try{

            $data = $this->remote_get( "http://feeds.delicious.com/v2/json/userinfo/" . $delicious_username );

            $result = (int) $data[2]['n'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://delicious.com/" . $delicious_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'delicious_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'delicious_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'delicious_button' ),
            'name'      =>  __( 'Delicious', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Delicious
     *
     * @param string $id
     * @return array|bool
     */
    private function get_delicious_short_data( $id = 'delicious' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://delicious.com/" . Better_Social_Counter::get_option( 'delicious_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'delicious_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'delicious_title_join' ),
            'name'      =>  __( 'Delicious', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for SoundCloud
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_soundcloud_full_data( $id = 'soundcloud' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $soundcloud_username = Better_Social_Counter::get_option( 'soundcloud_username' );

        try{

            $data = $this->remote_get("http://api.soundcloud.com/users/" . $soundcloud_username . ".json?consumer_key=" . Better_Social_Counter::get_option( 'soundcloud_api_key' ) );

            $result = (int) $data['followers_count'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://soundcloud.com/" . $soundcloud_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'soundcloud_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'soundcloud_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'soundcloud_button' ),
            'name'      =>  __( 'Soundcloud', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for SoundCloud
     *
     * @param string $id
     * @return array|bool
     */
    private function get_soundcloud_short_data( $id = 'soundcloud' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://soundcloud.com/" . Better_Social_Counter::get_option( 'soundcloud_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'soundcloud_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'soundcloud_title_join' ),
            'name'      =>  __( 'Soundcloud', 'betterstudio' ),
        );

    }


    /**
     * Used for retrieving data for Github
     * TODO: add git hub repositories count
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_github_full_data( $id = 'github' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $github_username = Better_Social_Counter::get_option( 'github_username' );

        try{

            $data = $this->remote_get("https://api.github.com/users/" . $github_username );

            $result = (int) $data['followers'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://github.com/" . $github_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'github_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'github_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'github_button' ),
            'name'      =>  __( 'Github', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Github
     * TODO: add git hub repositories count
     *
     * @param string $id
     * @return array|bool
     */
    private function get_github_short_data( $id = 'github' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://github.com/" . Better_Social_Counter::get_option( 'github_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'github_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'github_title_join' ),
            'name'      =>  __( 'Github', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for behance
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_behance_full_data( $id = 'behance' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $behance_username = Better_Social_Counter::get_option( 'behance_username' );

        try{

            $data = $this->remote_get("http://www.behance.net/v2/users/". $behance_username . "?api_key=" . Better_Social_Counter::get_option( 'behance_api_key' ) );

            $result = (int) $data['user']['stats']['followers'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://www.behance.net/" . $behance_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'behance_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'behance_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'behance_button' ),
            'name'      =>  __( 'Behance', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for behance
     *
     * @param string $id
     * @return array|bool
     */
    private function get_behance_short_data( $id = 'behance' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://www.behance.net/" . Better_Social_Counter::get_option( 'behance_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'behance_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'behance_title_join' ),
            'name'      =>  __( 'Behance', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for VK
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_vk_full_data( $id = 'vk' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $vk_username = Better_Social_Counter::get_option( 'vk_username' );

        try{

            $data = $this->remote_get( "http://api.vk.com/method/groups.getById?gid=". $vk_username ."&fields=members_count" );

            $result = (int) $data['response'][0]['members_count'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://vk.com/" . $vk_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'vk_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'vk_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'vk_button' ),
            'name'      =>  __( 'VK', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for VK
     *
     * @param string $id
     * @return array|bool
     */
    private function get_vk_short_data( $id = 'vk' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://vk.com/" . Better_Social_Counter::get_option( 'vk_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'vk_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'vk_title_join' ),
            'name'      =>  __( 'VK', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Vine
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_vine_full_data( $id = 'vine' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        try{
            if( ! class_exists( 'BSC_Vine' ) ){
                require_once Better_Social_Counter()->dir_path() . 'includes/libs/class-bsc-vine.php';
            }

            $vine = new BF_Vine( Better_Social_Counter::get_option( 'vine_email' ), Better_Social_Counter::get_option( 'vine_pass' ) );

            $result = $vine->me();

            $result = $result['followerCount'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://vine.com/" . Better_Social_Counter::get_option( 'vine_profile' ),
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'vine_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'vine_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'vine_button' ),
            'name'      =>  __( 'Vine', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Vine
     *
     * @param string $id
     * @return array|bool
     */
    private function get_vine_short_data( $id = 'vine' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://vine.com/" . Better_Social_Counter::get_option( 'vine_profile' ),
            'title'     =>  Better_Social_Counter::get_option( 'vine_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'vine_title_join' ),
            'name'      =>  __( 'Vine', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Pinterest
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_pinterest_full_data( $id = 'pinterest' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $pinterest_username = Better_Social_Counter::get_option( 'pinterest_username' );

        try{

            $html = $this->remote_get( "http://www.pinterest.com/" . $pinterest_username , false);

            $doc = new DOMDocument();

            @$doc->loadHTML($html);

            $metas = $doc->getElementsByTagName('meta');

            for( $i = 0; $i < $metas->length; $i++ ){

                $meta = $metas->item( $i );

                if( $meta->getAttribute('name') == 'pinterestapp:followers' ){

                    $result = $meta->getAttribute('content');

                    break;

                }

            }

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://www.pinterest.com/" . $pinterest_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'pinterest_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'pinterest_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'pinterest_button' ),
            'name'      =>  __( 'Pinterest', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Pinterest
     *
     * @param string $id
     * @return array|bool
     */
    private function get_pinterest_short_data( $id = 'pinterest' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      => "http://www.pinterest.com/" . Better_Social_Counter::get_option( 'pinterest_username' ) ,
            'title'     =>  Better_Social_Counter::get_option( 'pinterest_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'pinterest_title_join' ),
            'name'      =>  __( 'Pinterest', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Flickr
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_flickr_full_data( $id = 'flickr' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $flickr_group = Better_Social_Counter::get_option( 'flickr_group' );

        try{

            $data = $this->remote_get( "https://api.flickr.com/services/rest/?method=flickr.groups.getInfo&api_key=" . Better_Social_Counter::get_option( 'flickr_key' ) . "&group_id=" . $flickr_group ."&format=json&nojsoncallback=1" );

            $result = (int) $data['group']['members']['_content'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'link'      =>  "https://www.flickr.com/groups/$flickr_group",
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'flickr_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'flickr_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'flickr_button' ),
            'name'      =>  __( 'Flickr', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Flickr
     *
     * @param string $id
     * @return array|bool
     */
    private function get_flickr_short_data( $id = 'flickr' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "https://www.flickr.com/groups/" . Better_Social_Counter::get_option( 'flickr_group' ),
            'title'     =>  Better_Social_Counter::get_option( 'flickr_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'flickr_title_join' ),
            'name'      =>  __( 'Flickr', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Steam
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_steam_full_data( $id = 'steam' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $steam_group = Better_Social_Counter::get_option( 'steam_group' );

        try{

            $data = $this->remote_get( "http://steamcommunity.com/groups/$steam_group/memberslistxml" , false );

            $data = @new SimpleXmlElement( $data );

            $result =  (int) $data->groupDetails->memberCount;

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://steamcommunity.com/groups/$steam_group",
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'steam_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'steam_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'steam_button' ),
            'name'      =>  __( 'Steam', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Steam
     *
     * @param string $id
     * @return array|bool
     */
    private function get_steam_short_data( $id = 'steam' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://steamcommunity.com/groups/" . Better_Social_Counter::get_option( 'steam_group' ),
            'title'     =>  Better_Social_Counter::get_option( 'steam_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'steam_title_join' ),
            'name'      =>  __( 'Steam', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Instagram
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_instagram_full_data( $id = 'instagram' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $instagram_username = Better_Social_Counter::get_option( 'instagram_username' );

        try{

            $data = $this->remote_get(  "http://instagram.com/{$instagram_username}#" , false );

            $pattern = "/\"followed_by\":[ ]*{\"count\":(.*?)}/";

            preg_match( $pattern, $data, $matches);

            if( ! empty( $matches[1] ) ){

                $result = (int) $matches[1];

            }else{
                $result = 0;
            }

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // Final result
        $final_result = array(
            'link'      =>  "http://instagram.com/$instagram_username",
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'instagram_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'instagram_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'instagram_button' ),
            'name'      =>  __( 'Instagram', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Instagram
     *
     * @param string $id
     * @return array|bool
     */
    private function get_instagram_short_data( $id = 'instagram' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      => "http://instagram.com/" . Better_Social_Counter::get_option( 'instagram_username' ),
            'title'     => Better_Social_Counter::get_option( 'instagram_title' ),
            'title_join'=> Better_Social_Counter::get_option( 'instagram_title_join' ),
            'name'      =>  __( 'Instagram', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Forrst
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_forrst_full_data( $id = 'forrst' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $forrst_username = Better_Social_Counter::get_option( 'forrst_username' );

        try{

            $data = $this->remote_get( "http://forrst.com/api/v2/users/info?username=" . $forrst_username );

            $result = (int) $data['resp']['typecast_followers'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'link'      =>  "http://zurb.com/forrst/people/" . $forrst_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'forrst_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'forrst_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'forrst_button' ),
            'name'      =>  __( 'Forrst', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Forrst
     *
     * @param string $id
     * @return array|bool
     */
    private function get_forrst_short_data( $id = 'forrst' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  "http://zurb.com/forrst/people/" . Better_Social_Counter::get_option( 'forrst_username' ),
            'title'     =>  Better_Social_Counter::get_option( 'forrst_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'forrst_title_join' ),
            'name'      =>  __( 'Forrst', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Mailchimp
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_mailchimp_full_data( $id = 'mailchimp' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        try{

            // Mail chimp API wrapper
            require_once Better_Social_Counter()->dir_path() . 'includes/libs/mailchimp/class-mcapi.php';

            $mc_list_id = Better_Social_Counter::get_option( 'mailchimp_list_id' );

            $mc_api_key = Better_Social_Counter::get_option( 'mailchimp_api_key' );

            $mc_api = new MCAPI( $mc_api_key );

            $lists = $mc_api->lists();

            $result = 0;

            if( isset( $lists['data'] ) )
                foreach( (array) $lists['data'] as $list ){

                    if( $list['id'] == $mc_list_id ){

                        $result = $list['stats']['member_count'];
                        break;

                    }
                }

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'link'      =>  Better_Social_Counter::get_option( 'mailchimp_list_url' ),
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'mailchimp_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'mailchimp_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'mailchimp_button' ),
            'name'      =>  __( 'Mailchimp', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Mailchimp
     *
     * @param string $id
     * @return array|bool
     */
    private function get_mailchimp_short_data( $id = 'mailchimp' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'link'      =>  Better_Social_Counter::get_option( 'mailchimp_list_url' ),
            'title'     =>  Better_Social_Counter::get_option( 'mailchimp_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'mailchimp_title_join' ),
            'name'      =>  __( 'Mailchimp', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving data for Envato
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_envato_full_data( $id = 'envato' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        $envato_username    = Better_Social_Counter()->get_option( 'envato_username' );
        $envato_marketplace = Better_Social_Counter()->get_option( 'envato_marketplace' );

        if( empty( $envato_marketplace ) )
            $envato_marketplace = 'themeforest';

        try{

            $data = $this->remote_get( "http://marketplace.envato.com/api/edge/user:$envato_username.json" );

            if( isset( $data['user']['followers'] ) )
                $result = (int) $data['user']['followers'];

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'link'      =>  'http://' . $envato_marketplace . '.net/user/' . $envato_username . '?ref=' . $envato_username,
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'envato_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'envato_title_join' ),
            'button'    =>  Better_Social_Counter::get_option( 'envato_button' ),
        );

        switch( $envato_marketplace ){

            case 'themeforest':
                $final_result['name']  = __( 'ThemeForest', 'betterstudio' );
                break;

            case 'codecanyon':
                $final_result['name']  = __( 'CodeCanyon', 'betterstudio' );
                break;

            case 'graphicriver':
                $final_result['name']  = __( 'GraphicRiver', 'betterstudio' );
                break;

            case 'photodune':
                $final_result['name']  = __( 'PhotoDune', 'betterstudio' );
                break;

            case 'videohive':
                $final_result['name']  = __( 'VideoHive', 'betterstudio' );
                break;

            case 'audiojungle':
                $final_result['name']  = __( 'AudioJungle', 'betterstudio' );
                break;

            case '3docean':
                $final_result['name']  = __( '3dOcean', 'betterstudio' );
                break;

            case 'activeden':
                $final_result['name']  = __( 'ActiveDen', 'betterstudio' );
                break;

            default:
                $final_result['name']  = __( 'Envato', 'betterstudio' );
                break;
        }

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving data for Envato
     *
     * @param string $id
     * @return array|bool
     */
    private function get_envato_short_data( $id = 'envato' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        $envato_username    = Better_Social_Counter()->get_option( 'envato_username' );
        $envato_marketplace = Better_Social_Counter()->get_option( 'envato_marketplace' );

        if( empty( $envato_marketplace ) )
            $envato_marketplace = 'themeforest';

        $final_result = array(
            'link'      =>  'http://' . $envato_marketplace . '.net/user/' . $envato_username . '?ref=' . $envato_username,
            'title'     =>  Better_Social_Counter::get_option( 'envato_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'envato_title_join' ),
        );

        switch( $envato_marketplace ){

            case 'themeforest':
                $final_result['name']  = __( 'ThemeForest', 'betterstudio' );
                break;

            case 'codecanyon':
                $final_result['name']  = __( 'CodeCanyon', 'betterstudio' );
                break;

            case 'graphicriver':
                $final_result['name']  = __( 'GraphicRiver', 'betterstudio' );
                break;

            case 'photodune':
                $final_result['name']  = __( 'PhotoDune', 'betterstudio' );
                break;

            case 'videohive':
                $final_result['name']  = __( 'VideoHive', 'betterstudio' );
                break;

            case 'audiojungle':
                $final_result['name']  = __( 'AudioJungle', 'betterstudio' );
                break;

            case '3docean':
                $final_result['name']  = __( '3dOcean', 'betterstudio' );
                break;

            case 'activeden':
                $final_result['name']  = __( 'ActiveDen', 'betterstudio' );
                break;

            default:
                $final_result['name']  = __( 'Envato', 'betterstudio' );
                break;
        }

        return $final_result;
    }


    /**
     * Used for retrieving posts data
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_posts_full_data( $id = 'posts' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        try{

            $count_posts = wp_count_posts();

            $result = $count_posts->publish ;

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'posts_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'posts_title_join' ),
            'name'      =>  __( 'Posts', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving posts data
     *
     * @param string $id
     * @return array|bool
     */
    private function get_posts_short_data( $id = 'posts' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'title'     =>  Better_Social_Counter::get_option( 'posts_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'posts_title_join' ),
            'name'      =>  __( 'Posts', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving comments data
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_comments_full_data( $id = 'comments' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        try{

            $comments_count = wp_count_comments();

            $result = $comments_count->approved ;

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'comments_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'comments_title_join' ),
            'name'      =>  __( 'Comments', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving comments data
     *
     * @param string $id
     * @return array|bool
     */
    private function get_comments_short_data( $id = 'comments' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'title'     =>  Better_Social_Counter::get_option( 'comments_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'comments_title_join' ),
            'name'      =>  __( 'Comments', 'betterstudio' ),
        );
    }


    /**
     * Used for retrieving members data
     *
     * @param string $id
     * @return bool|mixed
     */
    private function get_members_full_data( $id = 'members' ){

        if( ! $this->is_active( $id ) )
            return false;

        if( $this->get_transient( $id ) !== false )
            return $this->get_transient( $id );

        try{

            $members_count = count_users();

            $result = $members_count['total_users'] ;

        }catch( Exception $e ){
            $result = 0;
        }

        if( ! isset( $result ) )
            $result = 0;

        // final result
        $final_result = array(
            'count'     =>  $this->format_number( $result ),
            'title'     =>  Better_Social_Counter::get_option( 'members_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'members_title_join' ),
            'name'      =>  __( 'Members', 'betterstudio' ),
        );

        $this->set_transient( $id, $final_result );

        return $final_result;
    }


    /**
     * Used for retrieving members data
     *
     * @param string $id
     * @return array|bool
     */
    private function get_members_short_data( $id = 'members' ){

        if( ! $this->is_min_active( $id ) )
            return false;

        return array(
            'title'     =>  Better_Social_Counter::get_option( 'members_title' ),
            'title_join'=>  Better_Social_Counter::get_option( 'members_title_join' ),
            'name'      =>  __( 'Members', 'betterstudio' ),
        );
    }

}