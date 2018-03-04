<?php

// Admin panel options
add_filter( 'better-framework/panel/options' , 'better_weather_option_panel' );

if( ! function_exists( 'better_weather_option_panel' ) ){

	/**
	 * Setup setting panel
	 *
	 * @param $options
	 * @return array
	 */
	function better_weather_option_panel( $options ){

		//
		// Facebook
		//
		$fields[] = array(
			'name'          =>  __( 'Facebook', 'better-studio' ),
			'id'            =>  'facebook_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-facebook'
		);
		$fields[] = array(
			'name'          =>  __( 'Facebook Instructions', 'better-studio' ),
			'id'            =>  'facebook-help',
			'type'          =>  'info',
			'std'           =>  __('<ol>
            <li>Read <a href="https://goo.gl/0WBQTi">official documentation to create new app</a>.</li>
            <li>Paste it in the "Link to you Facebook page" input box below</li>
          </ol>
                    ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Facebook Page ID/Name', 'better-studio' ),
			'id'            =>  'facebook_page',
			'desc'          =>  __( 'Enter Your Facebook Page Name or ID.', 'better-studio' ),
			'type'          =>  'text',
			'std'           =>  'BetterSTU'
		);
		$fields[] = array(
			'name'          =>  __( 'App ID', 'better-studio' ),
			'id'            =>  'facebook_app_id',
			'desc'          =>  __( 'Enter Your Facebook Page Name or ID.', 'better-studio' ),
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'App Secret', 'better-studio' ),
			'id'            =>  'facebook_app_secret',
			'desc'          =>  __( 'Enter Your Facebook Page Name or ID.', 'better-studio' ),
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'facebook_title',
			'type'          =>  'text',
			'std'           =>  __( 'Likes', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'facebook_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Facebook', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'facebook_button',
			'type'          =>  'text',
			'std'           =>  __( 'Like our page', 'better-studio' )
		);


		//
		// Twitter
		//
		$fields[] = array(
			'name'          =>  __( 'Twitter', 'better-studio' ),
			'id'            =>  'twitter_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-twitter'
		);
		$fields[] = array(
			'name'          =>  __( 'Twitter Instructions', 'better-studio' ),
			'id'            =>  'twitter-help',
			'type'          =>  'info',
			'std'           =>  __('
        <p>You need to authenticate yourself to Twitter with creating an app for get access information to retrieve your followers count and display them on your page.</p><ol>
            <li>Go to <a href="http://goo.gl/tyCR5W" target="_blank">https://apps.twitter.com/app/new</a> and log in, if necessary</li>
            <li>Enter your Application Name, Description and your website address. You can leave the callback URL empty.</li>
            <li>Submit the form by clicking the Create your Twitter Application</li>
            <li>Go to the "Keys and Access Token" tab and copy the consumer key (API key) and consumer secret</li>
            <li>Paste them in the following input boxes</li>
          </ol>
                        ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);

		$fields[] = array(
			'name'          =>  __( 'Twitter Username', 'better-studio' ),
			'id'            =>  'twitter_username',
			'type'          =>  'text',
			'std'           =>  'BetterSTU'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'twitter_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'twitter_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'twitter_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Twitter', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Consumer key', 'better-studio' ),
			'id'            =>  'twitter_api_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __('Consumer Secret','better-studio'),
			'id'            =>  'twitter_api_secret',
			'type'          =>  'text',
			'std'           =>  ''
		);


		//
		// Google+
		//
		$fields[] = array(
			'name'          =>  __( 'Google+', 'better-studio' ),
			'id'            =>  'google_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-gplus'
		);
		$fields[] = array(
			'name'          =>  __( 'Google+ Instructions', 'better-studio' ),
			'id'            =>  'google-help',
			'type'          =>  'info',
			'std'           =>  __('
                <ul>
                <li>Create a project/app in <a href="http://goo.gl/UA0m6L" target="_blank">https://console.developers.google.com/project</a></li>
                <li>Inside your project go to <strong>APIs &amp; auth</strong> → <strong>APIs</strong> and turn on the <strong>Google+ API</strong></li>
                <li>Go to <strong>APIs &amp; auth</strong> →  <strong>APIs</strong> → <strong>Credentials</strong> → <strong>Public API access</strong> and click in the <strong>CREATE A NEW KEY</strong> button.</li>
                <li>Select the <strong>Browser key</strong> option and click in the <strong>CREATE</strong> button</li>
                <li>After you\'re done, Copy your API key and paste it in <strong>Page Key</strong> field.</li>
            </ul>
                                ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Google+ Page ID/Name', 'better-studio' ),
			'id'            =>  'google_page',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Page Key', 'better-studio' ),
			'id'            =>  'google_page_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'google_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'google_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'google_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Google', 'better-studio' )
		);

		//
		// Youtube
		//
		$fields[] = array(
			'name'          =>  __( 'Youtube', 'better-studio' ),
			'id'            =>  'youtube_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-youtube'
		);
		$fields[] = array(
			'name'          =>  __( 'Youtube Instructions', 'better-studio' ),
			'id'            =>  'youtube-help',
			'type'          =>  'info',
			'std'           =>  __('
                    <ul>
                    <li>Create a project/app in <a href="http://goo.gl/UA0m6L" target="_blank">https://console.developers.google.com/project</a></li>
                    <li>Inside your project go to <strong>APIs &amp; auth</strong> → <strong>APIs</strong> and turn on the <strong>Youtube Data API</strong></li>
                    <li>Go to <strong>APIs &amp; auth</strong> →  <strong>APIs</strong> → <strong>Credentials</strong> → <strong>Public API access</strong> and click in the <strong>CREATE A NEW KEY</strong> button.</li>
                    <li>Select the <strong>Browser key</strong> option and click in the <strong>CREATE</strong> button</li>
                    <li>After you\'re done, Copy your API key and paste it in <strong>API Key</strong> field.</li>
                </ul>
                                    ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Type', 'better-studio' ),
			'id'            =>  'youtube_type',
			'type'          =>  'select',
			'std'           =>  'channel',
			'options'       =>  array(
				'channel'       =>  __( 'Channel', 'better-studio' ),
				'user'          =>  __( 'User Page', 'better-studio' ),
			)
		);
		$fields[] = array(
			'name'          =>  __( 'Youtube Channel ID or Username', 'better-studio' ),
			'id'            =>  'youtube_username',
			'type'          =>  'text',
			'std'           =>  'betterstu',
		);
		$fields[] = array(
			'name'          =>  __( 'API Key', 'better-studio' ),
			'id'            =>  'youtube_api_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'youtube_title',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'youtube_button',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribe', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'youtube_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Youtube', 'better-studio' )
		);


		//
		// Dribbble
		//
		$fields[] = array(
			'name'          =>  __( 'Dribbble', 'better-studio' ),
			'id'            =>  'dribbble_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-dribbble'
		);
		$fields[] = array(
			'name'          =>  __( 'Dribbble Instructions', 'better-studio' ),
			'id'            =>  'dribbble-help',
			'type'          =>  'info',
			'std'           =>  __('<p>You need to get the access token from your Dribbble account.</p>
                <ol>
                    <li>Go to <a href="https://goo.gl/Xtidw3" target="_blank">Applications</a> page.</li>
                    <li>Click on <strong>Register a new application</strong> button.</li>
                    <li>Fill all fields in next page and click on "<strong>Register application</strong>" button.</li>
                    <li>Copy "<strong>Client Access Token</strong>" in next page and paste in following Access Token field.</li>
                </ol>
                ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Dribbble UserName', 'better-studio' ),
			'id'            =>  'dribbble_username',
			'type'          =>  'text',
			'std'           =>  'better-studio'
		);
		$fields[] = array(
			'name'          =>  __( 'Dribbble Access Token', 'better-studio' ),
			'id'            =>  'dribbble_access_token',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'dribbble_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'dribbble_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'dribbble_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Dribbble', 'better-studio' )
		);


		//
		// Vimeo
		//
		$fields[] = array(
			'name'          =>  __( 'Vimeo', 'better-studio' ),
			'id'            =>  'vimeo_tab',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-vimeo'
		);
		$fields[] = array(
			'name'          =>  __( 'Vimeo Channel Username or Channel Slug', 'better-studio' ),
			'id'            =>  'vimeo_username',
			'type'          =>  'text',
			'std'           =>  'nicetype'
		);
		$fields[] = array(
			'name'          =>  __( 'Type', 'better-studio' ),
			'id'            =>  'vimeo_type',
			'type'          =>  'select',
			'std'           =>  'channel',
			'options'       =>  array(
				'user'          =>  __( 'User', 'better-studio' ),
				'channel'       =>  __( 'Channel', 'better-studio' ),
			)
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'vimeo_title',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'vimeo_button',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribe', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'vimeo_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Vimeo', 'better-studio' )
		);


		//
		// Delicious
		//
		$fields[] = array(
			'name'          =>  __( 'Delicious', 'better-studio' ),
			'id'            =>  'delicious_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-delicious'
		);
		$fields[] = array(
			'name'          =>  __( 'Delicious UserName', 'better-studio' ),
			'id'            =>  'delicious_username',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __('Text Below The Number','better-studio'),
			'id'            =>  'delicious_title',
			'type'          =>  'text',
			'std'           =>  __('Followers', 'better-studio')
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'delicious_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'delicious_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Delicious', 'better-studio' )
		);


		//
		// SoundCloud
		//
		$fields[] = array(
			'name'          =>  __( 'SoundCloud', 'better-studio' ),
			'id'            =>  'soundcloud_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-soundcloud'
		);
		$fields[] = array(
			'name'          =>  __( 'SoundCloud Instructions', 'better-studio' ),
			'id'            =>  'soundcloud-help',
			'type'          =>  'info',
			'std'           =>  __('
                                <ul>
                <li>Go To <a href="http://goo.gl/ZYjZhb" target="_blank">Your Applications</a> page.</li>
                <li>Click On "<strong>Register a new application</strong>" Button.</li>
                <li>Enter Your App Name and click on "<strong>Register</strong>".</li>
                <li>Check "<strong>Yes, I have read and accepted the Developer Policies</strong>" and Click on "<strong>Save App</strong>" Button</li>
                <li>Copy the "<strong>Client ID</strong>" and it in "<strong>API Key</strong>" input box.</li>
            </ul>
                                                ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'SoundCloud UserName', 'better-studio' ),
			'id'            =>  'soundcloud_username',
			'type'          =>  'text',
			'std'           =>  'muse'
		);
		$fields[] = array(
			'name'          =>  __( 'API Key', 'better-studio' ),
			'id'            =>  'soundcloud_api_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'soundcloud_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'soundcloud_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'soundcloud_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on SoundCloud', 'better-studio' )
		);


		//
		// Github
		//
		$fields[] = array(
			'name'          =>  __( 'Github', 'better-studio' ),
			'id'            =>  'github_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-github'
		);
		$fields[] = array(
			'name'          =>  __( 'Github UserName', 'better-studio' ),
			'id'            =>  'github_username',
			'type'          =>  'text',
			'std'           =>  'better-studio'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'github_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'github_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'github_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Github', 'better-studio' )
		);


		//
		// Behance
		//
		$fields[] = array(
			'name'          =>  __( 'Behance', 'better-studio' ),
			'id'            =>  'behance_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-behance'
		);
		$fields[] = array(
			'name'          =>  __( 'Behance Instructions', 'better-studio' ),
			'id'            =>  'behance-help',
			'type'          =>  'info',
			'std'           =>  __('
                            <ul>
                                <li>Go To <a href="http://goo.gl/UVclJh" target="_blank"><strong>Manage Your Applications → Register a New App</strong></a> page.</li>
                                <li>Click On "<strong>Register a new App</strong>" Button.</li>
                                <li>Enter Your App Name, Your Blog URL and Description. Then click on "<strong>Register Your App</strong>".</li>
                                <li>Copy the "<strong>API KEY / CLIENT ID</strong>" and paste it in "API Key" input box.</li>
                            </ul>
                                                        ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Behance UserName', 'better-studio' ),
			'id'            =>  'behance_username',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __('API Key','better-studio'),
			'id'            =>  'behance_api_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __('Text Below The Number','better-studio'),
			'id'            =>  'behance_title',
			'type'          =>  'text',
			'std'           =>  __('Followers', 'better-studio')
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'behance_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'behance_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Behance', 'better-studio' )
		);


		//
		// vk
		//
		$fields[] = array(
			'name'          =>  __( 'VK', 'better-studio' ),
			'id'            =>  'vk_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-vk'
		);
		$fields[] = array(
			'name'          =>  __( 'VK Community ID/Name', 'better-studio' ),
			'id'            =>  'vk_username',
			'type'          =>  'text',
			'std'           =>  'applevk'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'vk_title',
			'type'          =>  'text',
			'std'           =>  __( 'Members', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'vk_button',
			'type'          =>  'text',
			'std'           =>  __( 'Join Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'vk_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on VK', 'better-studio' )
		);


		//
		// Vine
		//
		$fields[] = array(
			'name'          =>  __( 'Vine', 'better-studio' ),
			'id'            =>  'vine_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-vine'
		);
		$fields[] = array(
			'name'          =>  __( 'Vine Profile URL', 'better-studio' ),
			'id'            =>  'vine_profile',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Account Email', 'better-studio' ),
			'id'            =>  'vine_email',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Account Password', 'better-studio' ),
			'id'            =>  'vine_pass',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'vine_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'vine_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'vine_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Vine', 'better-studio' )
		);


		//
		// Pinterest
		//
		$fields[] = array(
			'name'          =>  __( 'Pinterest', 'better-studio' ),
			'id'            =>  'pinterest_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-pinterest'
		);
		$fields[] = array(
			'name'          =>  __( 'Pinterest UserName', 'better-studio' ),
			'id'            =>  'pinterest_username',
			'type'          =>  'text',
			'std'           =>  'betterstudio'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'pinterest_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'pinterest_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'pinterest_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Pinterest', 'better-studio' )
		);


		//
		// Flickr
		//
		$fields[] = array(
			'name'          =>  __( 'Flickr', 'better-studio' ),
			'id'            =>  'flickr_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-flickr'
		);
		$fields[] = array(
			'name'          =>  __( 'Flickr Instructions', 'better-studio' ),
			'id'            =>  'flickr-help',
			'type'          =>  'info',
			'std'           =>  __('
                            <ul>
                                <li>Go to <a href="http://goo.gl/bE9Fz1" target="_blank">Create App</a> page.</li>
                                <li>Click on <strong>APPLY FOR A NON-COMMERCIAL KEY</strong> button.</li>
                                <li>Fill out the form:
                                <br>
                                    <ol>
                                        <li><strong>What\'s the name of your app? </strong> enter any name for the Application.</li>
                                        <li><strong>What are you building?</strong> enter a description for the app.</li>
                                        <li>Check the "<strong>What are you building?....</strong>" checkbox.</li>
                                        <li>Check the "<strong>I agree to comply with the Flickr API Terms of Use.</strong>" checkbox.</li>
                                        <li>Click on <strong>Register</strong> Button.</li>
                                    </ol><p></p>
                                </li>
                                <li>From the <a href="http://goo.gl/tZkovw" target="blank">Applications page</a> Copy the <strong>Key</strong> of your APP.</li>
                                <li>And paste it in "API Key" input box.</li>
                            </ul>
                                                                ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Flickr Group ID', 'better-studio' ),
			'id'            =>  'flickr_group',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'API Key', 'better-studio' ),
			'id'            =>  'flickr_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'flickr_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'flickr_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'flickr_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Flickr', 'better-studio' )
		);


		//
		// Steam
		//
		$fields[] = array(
			'name'          =>  __( 'Steam', 'better-studio' ),
			'id'            =>  'steam_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-steam'
		);
		$fields[] = array(
			'name'          =>  __( 'Steam Group Slug', 'better-studio' ),
			'id'            =>  'steam_group',
			'type'          =>  'text',
			'std'           =>  'steammusic'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'steam_title',
			'type'          =>  'text',
			'std'           =>  __( 'Members', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'steam_button',
			'type'          =>  'text',
			'std'           =>  __( 'Join Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'steam_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Steam', 'better-studio' )
		);


		//
		// Instagram
		//
		$fields[] = array(
			'name'          =>  __( 'Instagram', 'better-studio' ),
			'id'            =>  'instagram_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-instagram'
		);
		$fields[] = array(
			'name'          =>  __( 'Instagram UserName', 'better-studio' ),
			'id'            =>  'instagram_username',
			'type'          =>  'text',
			'std'           =>  'betterstudio'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'instagram_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'instagram_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'instagram_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Instagram', 'better-studio' )
		);


		// Forrst
		$fields[] = array(
			'name'          =>  __( 'Forrst', 'better-studio' ),
			'id'            =>  'forrst_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-forrst'
		);
		$fields[] = array(
			'name'          =>  __( 'Forrst UserName', 'better-studio' ),
			'id'            =>  'forrst_username',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'forrst_title',
			'type'          =>  'text',
			'std'           =>  __( 'Followers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'forrst_button',
			'type'          =>  'text',
			'std'           =>  __( 'Follow Us', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'forrst_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Forrst', 'better-studio' )
		);


		// Mailchimp
		$fields[] = array(
			'name'          =>  __( 'Mailchimp', 'better-studio' ),
			'id'            =>  'mailchimp_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-mailchimp'
		);
		$fields[] = array(
			'name'          =>  __( 'Mailchimp Instructions', 'better-studio' ),
			'id'            =>  'mailchimp-help',
			'type'          =>  'info',
			'std'           =>  __('
                                <ul>
                                    <li><a href="http://goo.gl/3qH8A7" target="_blank">How to find Mailchimp list ID</a></li>
                                    <li><a href="http://goo.gl/a834uj" target="_blank">How to find Mailchimp list URL</a></li>
                                    <li><a href="http://goo.gl/G2Bcvd" target="_blank">How to find Mailchimp API Key</a></li>
                                </ul>
                                                                    ', 'better-studio' ),
			'state'         =>  'open',
			'info-type'     =>  'help',
			'section_class' =>  'widefat',
		);
		$fields[] = array(
			'name'          =>  __( 'Mailchimp List ID', 'better-studio' ),
			'id'            =>  'mailchimp_list_id',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Mailchimp List URL', 'better-studio' ),
			'id'            =>  'mailchimp_list_url',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Mailchimp API Key', 'better-studio' ),
			'id'            =>  'mailchimp_api_key',
			'type'          =>  'text',
			'std'           =>  ''
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'mailchimp_title',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'mailchimp_button',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribe', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'mailchimp_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Mailchimp', 'better-studio' )
		);


		// Envato
		$fields[] = array(
			'name'          =>  __( 'Envato', 'better-studio' ),
			'id'            =>  'envato_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-envato'
		);
		$fields[] = array(
			'name'          =>  __( 'Envato User Name', 'better-studio' ),
			'id'            =>  'envato_username',
			'type'          =>  'text',
			'std'           =>  'Better-Studio'
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'envato_title',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribers', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Marketplace', 'better-studio' ),
			'id'            =>  'envato_marketplace',
			'type'          =>  'select',
			'std'           =>  'themeforest',
			'options'       => array(
				'themeforest'   =>  __( 'ThemeForest', 'better-studio' ),
				'codecanyon'    =>  __( 'CodeCanyon', 'better-studio' ),
				'graphicriver'  =>  __( 'GraphicRiver', 'better-studio' ),
				'photodune'     =>  __( 'PhotoDune', 'better-studio' ),
				'videohive'     =>  __( 'VideoHive', 'better-studio' ),
				'audiojungle'   =>  __( 'AudioJungle', 'better-studio' ),
				'3docean'       =>  __( '3dOcean', 'better-studio' ),
				'activeden'     =>  __( 'ActiveDen', 'better-studio' ),
			)
		);
		$fields[] = array(
			'name'          =>  __( 'Button Text', 'better-studio' ),
			'id'            =>  'envato_button',
			'type'          =>  'text',
			'std'           =>  __( 'Subscribe', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'envato_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join us on Envato', 'better-studio' )
		);


		// Posts
		$fields[] = array(
			'name'          =>  __( 'Posts', 'better-studio' ),
			'id'            =>  'posts_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-posts',
			'margin-top'    =>  '10',
		);
		$fields[] = array(
			'name'          =>  __( 'Show Posts Count?', 'better-studio' ),
			'id'            =>  'posts_enabled',
			'type'          =>  'switch',
			'std'           =>  '0',
			'on-label'      =>  __( 'Show', 'better-studio' ),
			'off-label'     =>  __( 'Hide', 'better-studio' ),
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'posts_title',
			'type'          =>  'text',
			'std'           =>  __( 'Posts', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'posts_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join our site', 'better-studio' )
		);


		// Comments
		$fields[] = array(
			'name'          =>  __( 'Comments', 'better-studio' ),
			'id'            =>  'comments_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-comments',
		);
		$fields[] = array(
			'name'          =>  __( 'Show Comments Count?', 'better-studio' ),
			'id'            =>  'comments_enabled',
			'type'          =>  'switch',
			'std'           =>  '0',
			'on-label'      =>  __( 'Show', 'better-studio' ),
			'off-label'     =>  __( 'Hide', 'better-studio' ),
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'comments_title',
			'type'          =>  'text',
			'std'           =>  __( 'Comments', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'comments_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join our site', 'better-studio' )
		);

		// Members
		$fields[] = array(
			'name'          =>  __( 'Members', 'better-studio' ),
			'id'            =>  'members_title',
			'type'          =>  'tab',
			'icon'          =>  'bsfi-members',
		);
		$fields[] = array(
			'name'          =>  __( 'Show Members Count?', 'better-studio' ),
			'id'            =>  'members_enabled',
			'type'          =>  'switch',
			'std'           =>  '0',
			'on-label'      =>  __( 'Show', 'better-studio' ),
			'off-label'     =>  __( 'Hide', 'better-studio' ),
		);
		$fields[] = array(
			'name'          =>  __( 'Text Below The Number', 'better-studio' ),
			'id'            =>  'members_title',
			'type'          =>  'text',
			'std'           =>  __( 'Members', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Join Text', 'better-studio' ),
			'id'            =>  'members_title_join',
			'type'          =>  'text',
			'std'           =>  __( 'Join our site', 'better-studio' )
		);


		//
		// Typography
		//
		$fields[] = array(
			'name'          =>  __( 'Typography' , 'better-studio' ),
			'id'            =>  'typography',
			'type'          =>  'tab',
			'icon'          =>  'bsai-typography',
			'margin-top'    =>  '20',
		);

		$fields[] = array(
			'name'          =>  __( 'Social Counter Typography', 'better-studio' ),
			'type'          => 'group',
			'state'         => 'close',
		);
		$fields['typo_title'] = array(
			'name'          =>  __( 'Follower Counts Number', 'better-studio' ),
			'id'            =>  'typo_title',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '400',
				'subset'        =>  'latin',
				'size'          =>  '12',
				'transform'     =>  'initial',
			),
			'desc'          =>  __( 'You can change typography of sites follow texts with this option.', 'better-studio' ),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-counter.style-modern .item-title',
						'.better-social-counter.style-box .item-title',
						'.better-social-counter.style-clean .item-title',
						'.better-social-counter.style-button .item-title',
					),
					'type'  => 'font',
				)
			),
		);
		$fields['typo_count'] = array(
			'name'          =>  __( 'Followers Title', 'better-studio' ),
			'id'            =>  'typo_count',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '700',
				'subset'        =>  'latin',
				'size'          =>  '14',
				'transform'     =>  'initial',
			),
			'desc'          =>  __( 'You can change typography of sites followers count text with this option.', 'better-studio' ),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-counter.style-box .item-count',
						'.better-social-counter.style-clean .item-count',
						'.better-social-counter.style-modern .item-count',
						'.better-social-counter.style-button .item-count',
					),
					'type'  => 'font',
				)
			),
		);
		$fields['typo_item_name'] = array(
			'name'          =>  __( 'Site Title', 'better-studio' ),
			'id'            =>  'typo_item_name',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '600',
				'subset'        =>  'latin',
				'size'          =>  '14',
				'transform'     =>  'initial',
			),
			'desc'          =>  __( 'You can change typography of sites title text with this option.', 'better-studio' ),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-counter.style-big-button .item-name',
					),
					'type'  => 'font',
				)
			),
		);
		$fields['typo_item_title_join'] = array(
			'name'          =>  __( 'Site Title Join', 'better-studio' ),
			'id'            =>  'typo_item_title_join',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '400',
				'subset'        =>  'latin',
				'size'          =>  '13',
				'transform'     =>  'initial',
			),
			'desc'          =>  __( 'You can change typography of sites followers count text with this option.', 'better-studio' ),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-counter.style-big-button .item-title-join',
					),
					'type'  => 'font',
				)
			),
		);


		$fields[] = array(
			'name'          =>  __( 'Social Banner Typography', 'better-studio' ),
			'type'          => 'group',
			'state'         => 'close',
		);
		$fields['social_banner_typo_count'] = array(
			'name'          =>  __( 'Followers Count', 'better-studio' ),
			'id'            =>  'social_banner_typo_count',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '300',
				'subset'        =>  'latin',
				'size'          =>  '22',
				'transform'     =>  'uppercase',
			),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-banner .banner-item .item-count',
					),
					'type'  => 'font',
				)
			),
		);
		$fields['social_banner_typo_title'] = array(
			'name'          =>  __( 'Followers Title', 'better-studio' ),
			'id'            =>  'social_banner_typo_title',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '700',
				'subset'        =>  'latin',
				'size'          =>  '12',
				'transform'     =>  'uppercase',
			),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-banner .banner-item .item-title',
					),
					'type'  => 'font',
				)
			),
		);
		$fields['social_banner_typo_button'] = array(
			'name'          =>  __( 'Follow Button', 'better-studio' ),
			'id'            =>  'social_banner_typo_button',
			'type'          =>  'typography',
			'std'           => array(
				'family'        =>  'Open Sans',
				'variant'       =>  '700',
				'subset'        =>  'latin',
				'size'          =>  '13',
				'transform'     =>  'uppercase',
			),
			'preview'       =>  true,
			'preview_tab'   =>  'title',
			'css-echo-default'  =>  true,
			'css'           => array(
				array(
					'selector' => array(
						'.better-social-banner .banner-item .item-button',
					),
					'type'  => 'font',
				)
			),
		);


		//
		// Caching Options
		//
		$fields[] = array(
			'name'          =>  __( 'Caching Options' , 'better-studio' ),
			'id'            =>  'cache_options_title',
			'type'          =>  'tab',
			'icon'          =>  'bsai-database',
		);
		$fields[] = array(
			'name'          =>  __( 'Maximum Lifetime of Cache', 'better-studio' ),
			'id'            =>  'cache_time',
			'type'          =>  'select',
			'std'           =>  2,
			'options'       =>  array(
				1   =>  __( '1 hours', 'better-studio' ),
				2   =>  __( '2 hours', 'better-studio' ),
				3   =>  __( '3 hours', 'better-studio' ),
				4   =>  __( '4 hours', 'better-studio' ),
				5   =>  __( '5 hours', 'better-studio' ),
				6   =>  __( '6 hours', 'better-studio' ),
				7   =>  __( '7 hours', 'better-studio' ),
				8   =>  __( '8 hours', 'better-studio' ),
				9   =>  __( '9 hours', 'better-studio' ),
				10  =>  __( '10 hours', 'better-studio' ),
				11  =>  __( '11 hours', 'better-studio' ),
				12  =>  __( '12 hours', 'better-studio' ),
				13  =>  __( '13 hours', 'better-studio' ),
				14  =>  __( '14 hours', 'better-studio' ),
				15  =>  __( '15 hours', 'better-studio' ),
				16  =>  __( '16 hours', 'better-studio' ),
				17  =>  __( '17 hours', 'better-studio' ),
				18  =>  __( '18 hours', 'better-studio' ),
				19  =>  __( '19 hours', 'better-studio' ),
				20  =>  __( '20 hours', 'better-studio' ),
				21  =>  __( '21 hours', 'better-studio' ),
				22  =>  __( '22 hours', 'better-studio' ),
				23  =>  __( '23 hours', 'better-studio' ),
				24  =>  __( '24 hours', 'better-studio' ),

			)
		);
		$fields[] = array(
			'name'          =>  __( 'Clear Data Base Saved Caches', 'better-studio' ),
			'id'            =>  'cache_clear_all',
			'type'          =>  'ajax_action',
			'button-name'   =>  '<i class="fa fa-refresh"></i> ' . __( 'Clear All Caches', 'better-studio' ),
			'callback'      =>  'Better_Social_Counter::clear_cache_all',
			'confirm'       =>  __( 'Are you sure for deleting all caches?', 'better-studio' ),
			'desc'          =>  __( 'This allows you to clear all caches that are saved in data base.', 'better-studio' )
		);


		//
		// Backup & Restore
		//
		$fields[] = array(
			'name'          =>  __( 'Backup & Restore' , 'better-studio' ),
			'id'            =>  'backup_restore',
			'type'          =>  'tab',
			'icon'          =>  'bsai-export-import',
			'margin-top'    =>  '30',
		);
		$fields[] = array(
			'name'          =>  __( 'Backup / Export', 'better-studio' ),
			'id'            =>  'backup_export_options',
			'type'          =>  'export',
			'file_name'     =>  'better-social-counter-options-backup',
			'panel_id'      =>  Better_Social_Counter::$panel_id,
			'desc'          =>  __( 'This allows you to create a backup of your options and settings. Please note, it will not backup anything else.', 'better-studio' )
		);
		$fields[] = array(
			'name'          =>  __( 'Restore / Import', 'better-studio' ),
			'id'            =>  'import_restore_options',
			'type'          =>  'import',
			'panel_id'      =>  Better_Social_Counter::$panel_id,
			'desc'          =>  __( '<strong>It will override your current settings!</strong> Please make sure to select a valid backup file.', 'better-studio' )
		);

		// Language  name for smart admin texts
		$lang = bf_get_current_lang();
		if( $lang != 'none' ){
			$lang = bf_get_language_name( $lang );
		}else{
			$lang = '';
		}

		$options[Better_Social_Counter::$panel_id] = array(
			'config' => array(
				'parent'                =>  'better-studio',
				'slug' 			        =>  'better-studio/better-social-counter',
				'name'                  =>  __( 'Better Social Counter', 'better-studio' ),
				'page_title'            =>  __( 'Better Social Counter', 'better-studio' ),
				'menu_title'            =>  'Social Counter',
				'capability'            =>  'manage_options',
				'menu_slug'             =>  __( 'BetterSocialCounter', 'better-studio' ),
				'icon_url'              =>  null,
				'position'              =>  80.02,
				'exclude_from_export'   =>  false,
			),
			'texts'         =>  array(

				'panel-desc-lang'       =>  '<p>' . __( '%s Language Options.', 'better-studio' ) . '</p>',
				'panel-desc-lang-all'   =>  '<p>' . __( 'All Languages Options.', 'better-studio' ) . '</p>',

				'reset-button'          =>  ! empty( $lang ) ? sprintf( __( 'Reset %s Options', 'better-studio' ), $lang ) : __( 'Reset Options', 'better-studio' ),
				'reset-button-all'      =>  __( 'Reset All Options', 'better-studio' ),

				'reset-confirm'         =>  ! empty( $lang ) ? sprintf( __( 'Are you sure to reset %s options?', 'better-studio' ), $lang ) : __( 'Are you sure to reset options?', 'better-studio' ),
				'reset-confirm-all'     =>  __( 'Are you sure to reset all options?', 'better-studio' ),

				'save-button'           =>  ! empty( $lang ) ? sprintf( __( 'Save %s Options', 'better-studio' ), $lang ) : __( 'Save Options', 'better-studio' ),
				'save-button-all'       =>  __( 'Save All Options', 'better-studio' ),

				'save-confirm-all'      =>  __( 'Are you sure to save all options? this will override specified options per languages', 'better-studio' )

			),
			'panel-name'                =>  _x( 'Better Social Counter', 'Panel title', 'better-studio' ),
			'panel-desc'                =>  '<p>' . __( 'Setup social networks, Translate texts, change typography and create backup.', 'better-studio' ) . '</p>',
			'fields'                    =>  $fields
		);

		return $options;
	}

}