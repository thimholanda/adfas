var Publisher_Theme = (function($) {
    "use strict";

    return {

        init: function(){

            // Pretty Photo Settings
            this.prettyPhotoSettings = {
                social_tools: false,
                show_title: false,
                markup: '<div class="pp_pic_holder"> \
						<div class="ppt"></div> \
						<div class="pp_content_container"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image"></a> \
                                        <a class="pp_close" href="#"></a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#"><i class="fa fa-chevron-right"></i></a> \
											<a class="pp_previous" href="#"><i class="fa fa-chevron-left"></i></a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous"><i class="fa fa-backward"></i></a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next"><i class="fa fa-forward"></i></a> \
											</div> \
											<p class="pp_description"></p> \
										</div> \
									</div> \
								</div> \
							</div> \
					</div> \
					<div class="pp_overlay"></div>',
                gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous"><i class="fa fa-chevron-left"></i></a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next"><i class="fa fa-chevron-right"></i></a> \
							</div>'
            };
            // Setup Responsive Header
            this.setup_responsive_header();

            // Setup Back To Top Button
            this.back_to_top();

            this.handleAjaxifiedComments();

            this.setup_post();
            var bodyClasses = $(document.body).attr('class'),
                matches = bodyClasses.toString().match(/\bpostid\-(\d+)\b/i);
            if( matches )
                this.handleInfinitySinglePostLoading(matches[1]);

            this.woo_commerce();

            this.visual_composer();
        },


        /**
         * Define elements that use elementQuery on local/cross domain
         */
        fix_element_query: function(){

            if( typeof elementQuery != 'function' ){
                return;
            }

            elementQuery({
                ".listing": {
                    "max-width": [ "450px", "560px", "900px", "1000px" ]
                },
                ".listing-item-blog": {
                    "max-width": [ "420px", "560px"]
                },
                ".listing-modern-grid": {
                    "max-width": [ "780px", "620px", "480px", "370px" ]
                },
                ".listing-mg-3-item": {
                    "max-width": [ "300px"]
                },
                ".bs-slider": {
                    "max-width": [ "370px"]
                },
                ".bs-slider-item": {
                    "max-width": [ "780px", "520px", "370px"]
                },
                ".listing-item-classic": {
                    "max-width": ["380px"]
                },
                ".bs-shortcode-row": {
                    "max-width": ["450px", "600px", "700px"]
                }
            });

        },

        is_rtl: function(){
            return $('body').hasClass('rtl');
        },

        /**
         * Setup Menu
         */
        setup_responsive_header: function() {

            // Show/Hide Menu Box
            $('.responsive-header .menu-container .menu-handler').click(function( e ) {

                e.preventDefault();

                var $container = $(this).parent();

                // Hide search box
                if( $container.hasClass('close') ){
                    $('.responsive-header .search-container').removeClass('open').addClass('close');
                }

                $container.toggleClass( 'open').toggleClass('close');

            });


            // Show/Hide Search Box
            $('.responsive-header .search-container .search-handler').click(function( e ) {

                e.preventDefault();

                var $container = $(this).parent();

                // Hide menu box
                if( $container.hasClass('close') ){
                    $('.responsive-header .menu-container').removeClass('open').addClass('close');
                }

                $container.toggleClass( 'open').toggleClass('close');

            });

            // Clone main menu if is not available specifiably for responsive
            if( $('.responsive-header .menu-container .menu-box').is(':empty') ){

                // Appends cloned menu to page
                $('.responsive-header .menu-container .menu-box').html( $('.main-menu.menu').clone().removeClass('main-menu').addClass('resp-menu').prop( 'id', 'resp-navigation' ) );
            }

            // remove abandoned mega menus
            $('.responsive-header .menu-container .menu-box .mega-menu.tabbed-grid-posts,.responsive-header .menu-container .menu-box .mega-menu.mega-grid-posts').remove();

            // Add show children list button
            $('.responsive-header .menu-container .resp-menu li > a').each(function() {

                var $li = $(this).parent();

                if( ! $li.hasClass('menu-item-mega-grid-posts') && ! $li.hasClass('menu-item-mega-tabbed-grid-posts') && $li.children("ul,.mega-menu").length > 0 ){
                    $li.append('<span class="children-button"><i class="fa fa-angle-down"></i></span>');
                }

            });

            // Show/Hide children list on click "children-button"
            $('.responsive-header .menu-container .resp-menu .children-button').click(function() {

                $(this).closest('li').toggleClass('open-sub');

                if( $(this).find('.fa-angle-down').length ){
                    $(this).find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
                }else{
                    $(this).find('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
                }

                return false;
            });

            $('.responsive-header-container').bsPinning();


            $('.better-newsticker').betterNewsticker({
                control_nav: true
            });

        },


        /**
         * Setup Menu
         */
        setup_menu: function() {

            $('ul.menu.bsm-pure').addClass('bsm-initialized').removeClass('bsm-pure');

            // Trick to make menu animations awesome
            var bsm_helper_function_enter; // enter function for add bsm-enter
            var bsm_helper_function_leave; // enter function for add bsm-leave
            $('.menu.bsm-initialized li.menu-item-has-children').each(function(){

                var $this = $(this);

                if( $this.is(':hover') ){
                    $this.addClass('bsm-enter');
                }else{
                    $this.addClass('bsm-leave');
                }

            }).on( "mouseenter", function(){
                var $this = $(this),
                    $that = $this;

                $this.removeClass('bsm-leave');

                bsm_helper_function_enter = function(){
                    $that.closest('.menu-item-has-children').addClass('bsm-enter');
                };

                setTimeout(
                    function(){
                        bsm_helper_function_enter();
                    }, 1 );

            }).on( "mouseleave", function(){
                var $this = $(this),
                    $that = $this;

                $this.removeClass('bsm-enter');

                bsm_helper_function_leave = function(){
                    $that.addClass('bsm-leave');
                };

                setTimeout( function(){
                    bsm_helper_function_leave();
                } , 200);
            });

            var _sticky_header_classes = '' +
                '#header .main-menu-wrapper,' +
                ' .site-header.header-style-5.full-width > .content-wrap,' +
                ' .site-header.header-style-5.boxed > .content-wrap > .container,' +
                ' .site-header.header-style-6.full-width > .content-wrap,' +
                ' .site-header.header-style-6.boxed > .content-wrap > .container,' +
                ' .site-header.header-style-8.full-width > .content-wrap,' +
                ' .site-header.header-style-8.boxed > .content-wrap > .container';

            var current_header_id = $('.site-header').attr("class").match(/header-style-[\w-]*\b/)[0];

            // Sticky main menu initializer
            if( $('body').hasClass( 'main-menu-sticky-smart' ) )
                $(_sticky_header_classes).bsPinning({
                    smart: true,
                    wrapper_class: 'bspw-' + current_header_id
                });
            else if( $('body').hasClass( 'main-menu-sticky' ) )
                $(_sticky_header_classes).bsPinning({
                    smart: false,
                    wrapper_class: 'bspw-header bspw-' + current_header_id
                });

        },


        /**
         * Setup Sliders
         */
        setup_sliders: function(){

            if( ! $.fn.flexslider ){
                return;
            }

            $('.gallery-slider .better-slider').flexslider({
                namespace:      "better-",
                animation:      "fade",
                controlNav:     false,
                smoothHeight:   true,
                animationSpeed: "200",
                start: function(slider){
                    window.dispatchEvent(new Event('resize')); // Fix for EQ
                }
            }).find('.better-control-nav').addClass( 'square' );

        },


        /**
         * Setup Video Players
         */
        setup_video_players: function(){

            $('.single-featured, .the-content, .sidebar, .post, .bs-embed, .entry-content').fitVids({
                ignore: '.bsp-player > iframe'
            });

        },


        /**
         * Small style fixes with jquery that can't done with css!
         */
        small_style_fixes: function(){

            // Show/Hide Topbar search box
            $('.site-header .search-container .search-handler').click(function() {

                $(this).closest('.main-menu-container').toggleClass( 'search-open').toggleClass('search-close');

                var $search_container = $(this).closest('.search-container');

                $search_container.toggleClass( 'open').toggleClass('close');

                // Set focus to search input
                if( $search_container.hasClass( 'open' ) ){
                    $(this).find('.fa').removeClass('fa-search').addClass('fa-close')
                    $search_container.find('.search-field').focus();
                }else{
                    $(this).find('.fa').addClass('fa-search').removeClass('fa-close')
                    $search_container.find('.search-field').focusout();
                }

            });

            // Show/Hide Topbar search box
            $('.site-header .shop-cart-container').hover(function(e) {

                e.preventDefault();

                $(this).closest('.main-menu-container').toggleClass( 'cart-open').toggleClass('cart-close');

                var $search_container = $(this);

                $search_container.toggleClass( 'open').toggleClass('close');

            });

            // calendar widget fix
            $(".widget.widget_calendar table td a").each( function(){
                $(this).parent().addClass('active-day');
            });

            // IE 10 detection for style fixing
            if( $.browser.msie && $.browser.version == 10) {
                $("html").addClass("ie ie10");
            }

            // add term class to tab heading
            $('.section-heading.multi-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                if( $(this).hasClass( 'active' ) ){
                    e.preventDefault();
                    return;
                }

                if( typeof $(e.target).parent().attr('class') == 'undefined' ){
                    return true;
                }

                var $parent = $(e.target).closest('.section-heading'),
                    classNames = $(e.target).find('.h-text').attr('class').split(" ");

                var selected_tab_term = '';

                // find term class
                jQuery.each( classNames, function( index, value){
                    if( value.match(/main-term-/)){
                        selected_tab_term = value;
                        return false;
                    }
                });

                // remove term classes from parent
                jQuery.each( $parent.attr('class').split(" "), function( index, value){
                    if( value.match(/main-term-/)){
                        $parent.removeClass(value);
                    }
                });

                $parent.addClass( selected_tab_term).find('a.active').removeClass('active');

                $(this).addClass('active');
            });

            // Fix for element query
            $('[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                window.dispatchEvent(new Event('resize')); // Fix for EQ
            });
            $(".panel-collapse").on("shown.bs.collapse", function (e) {
                window.dispatchEvent(new Event('resize')); // Fix for EQ
            });
            $(".bs-accordion-shortcode .panel-heading a").on("click", function (e) {
                if( ! $(this).closest('.panel-heading').hasClass('active') )
                    $(this).closest('.panel').addClass('open');
            });
            $(".panel-collapse").on("hide.bs.collapse", function (e) {
                $(e.target).closest( '.panel' ).removeClass('open');
            });

            // Sticky sidebars and columns
            var sticky_config = { };
            if( $('body').hasClass( 'main-menu-sticky-smart' ) || $('body').hasClass( 'main-menu-sticky' ) ){
                sticky_config.top =  $('#header .main-menu-wrapper').height();
            }
            if( $('body').hasClass('active-sticky-sidebar') && $(window).width() > 780 ){
                $('.wpb_widgetised_column').closest('.wpb_column').hcSticky(sticky_config);
                $('.sidebar-column').hcSticky(sticky_config);
            }

            var $stickyColumn = $('.sticky-column');
            $stickyColumn.hcSticky(sticky_config);// for vc columns

            $(window).on('resize.bs-sticky-column', function () {

                if (window.innerWidth <= 780 && !$stickyColumn.data('hcSticky-destroy')) {
                    $stickyColumn.hcSticky('stop')
                                 .hcSticky('destroy')
                                 .data('hcSticky-destroy', true)
                                .removeAttr('style');
                }

            });
            //

            // BS_Listing Tabs animation fix
            $('.bs-listing a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                var $_target =  $($(this).attr('href'));
                if(  $_target.hasClass('active') )
                    return;
                $(this).closest('.bs-listing').find('.tab-pane').removeClass('bs-tab-animated');
                $_target.addClass('bs-tab-animated');
            });

            // Tabbed grid posts
            $('.tabbed-grid-posts .tabs-section > li > a').click(function() {
                if( $(this).attr('href') != '#' ) window.location = $(this).attr('href');
            }).hover(function() {
                $(this).tab('show');
            });
            $('.tabbed-grid-posts .tabs-section > li > a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                var $_target =  $($(this).data('target'));
                if(  $_target.hasClass('active') )
                    return;
                $(this).closest('.tabbed-grid-posts').find('.tab-pane').removeClass('bs-tab-animated');
                $_target.addClass('bs-tab-animated');
            });

            // move to content
            $('.move-to-content .fa').click(function(){
                $('body,html').animate({
                        scrollTop: $('.content-column').offset().top - 25
                    }, 700
                );
            });

            $('.post-tp-4-header,.post-tp-5-header').each(function () {
                var $item = $(this);
                var $item_parallax = $(this).find('.post-header-title');

                jQuery(window).scroll(function () {

                    var scroll = jQuery(window).scrollTop();
                    var header_height = $item.height();

                    if( scroll < $item.offset().top || scroll > $item.offset().bottom ){
                        $item_parallax
                                .css({'-webkit-transform': 'translate3d(0px, 0px, 0px)'})
                                .css({'transform': 'translate3d(0px, 0px, 0px)'})
                                .css({'opacity': '1'});
                        return;
                    }

                    $item_parallax
                        .css({'-webkit-transform': 'translate3d(0px, ' + Math.ceil(( scroll - ( $item.offset().top ) ) / 5.3) + 'px, 0px)'})
                        .css({'transform': 'translate3d(0px, ' + Math.ceil(( scroll - ( $item.offset().top ) ) / 5.3) + 'px, 0px)'})
                        .css({'opacity': ( ( scroll - header_height ) / 333.333 ) * -1 });

                });
            });

            $(".footer-instagram-3 .bs-instagram-photos").simplyScroll({ frameRate: 70 });

            // highlight all posts tab for better UX
            $('.post-author .section-heading .other-link').click(function (e) {
               $(this).addClass('active');
            })

        },


        /**
         * BetterStudio Editor Shortcodes Setup
         */
        betterstudio_editor_shortcodes: function(){

            $('.bs-accordion-shortcode').on( 'show.bs.collapse', function(e) {
                $(e.target).prev('.panel-heading').addClass('active');
            }).on('hide.bs.collapse', function(e) {
                    $(e.target).prev('.panel-heading').removeClass('active');
            });

        },


        /**
         * Back to top button
         */
        back_to_top: function(){

            var $back_to_top = $('.back-top');

            if( $back_to_top.length == 0 )
                return;

            $back_to_top.click(function(){
                $('body,html').animate({
                        scrollTop: 0
                    }, 700
                );
            });

            $(window).scroll(function(){
                ( $(this).scrollTop() > 300 ) ? $back_to_top.addClass('is-visible') : $back_to_top.removeClass('is-visible fade-out1 fade-out2 fade-out3 fade-out4');

                switch ( true ){

                    case ( $(this).scrollTop() > 2400 ):
                        $back_to_top.addClass('fade-out4');
                        break;

                    case ( $(this).scrollTop() > 1700 ):
                        $back_to_top.removeClass('fade-out3').addClass('fade-out3');
                        break;

                    case ( $(this).scrollTop() > 1000 ):
                        $back_to_top.removeClass('fade-out4 fade-out3').addClass('fade-out2');
                        break;

                    case ( $(this).scrollTop() > 500 ):
                        $back_to_top.removeClass('fade-out4 fade-out3 fade-out2').addClass('fade-out1');
                        break;
                }

            });

        },


        /**
         * Setup Popup
         */
        popup: function(){

            // If light box is not active
            if( ! $('body').hasClass( 'active-light-box' ) ){
                return;
            }

            // disabled on mobile screens
            if( ! $.fn.prettyPhoto || $(window).width() < 700 ){
                return;
            }

            var filter_only_images = function() {

                if( ! $(this).attr('href') )
                    return false;

                if( typeof $(this).data('not-rel') != 'undefined')
                    return false;

                return $(this).attr('href').match(/\.(jp?g|png|bmp|gif)$/);
            };

            $('.entry-content a,.single-featured a').has('img').filter(filter_only_images).attr('rel', 'prettyPhoto');

            var gallery_id = 1;

            $('.entry-content .gallery,.entry-content .tiled-gallery').each(function() {

                $(this).find('a').has('img').filter(filter_only_images).attr('rel', 'prettyPhoto[gallery_'+ gallery_id +']');

                gallery_id++;

            });

            $("a[rel^='prettyPhoto']").prettyPhoto( Publisher_Theme.prettyPhotoSettings );

        },


        /**
         * Setup Gallery
         */
        gallery: function(){

            if( ! $.fn.fotorama ){
                return;
            }

            var $fotoramaDiv = jQuery('.fotorama').fotorama({
                width: '100%',
                loop: true,
                margin: 10,
                thumbwidth: 85,
                thumbheight: 45,
                thumbmargin: 9,
                transitionduration: 800,
                arrows: false,
                click:false,
                swipe:true
            }).on('fotorama:show', function(e, fotorama, extra){

                var $gallery = $(this).closest('.better-gallery');

                $gallery.find('.count .current').html( fotorama.activeFrame.i );

            });

            // Activate light box gallery if active
            if( $('body').hasClass( 'active-light-box' ) && $.fn.prettyPhoto || $(window).width() < 700 ){

                jQuery('.better-gallery').on( 'click', '.slide-link', function(){

                    event.preventDefault();

                    var $gallery = $(this).closest('.better-gallery');
                    var gallery_id = $gallery.data('gallery-id');

                    var pps = Publisher_Theme.prettyPhotoSettings;

                    pps.changepicturecallback = function(){
                        $('#gallery-' + gallery_id).find('.fotorama').data('fotorama').show( $('.pp_gallery').find('li').index($('.selected')) );
                    };

                    $.fn.prettyPhoto( pps );

                    $.prettyPhoto.open( window["prt_gal_img_"+gallery_id], window["prt_gal_cap_"+gallery_id], window["prt_gal_cap_"+gallery_id]);

                    $.prettyPhoto.changePage( $('#gallery-' + gallery_id).find('.fotorama').data('fotorama').activeFrame.i - 1 );

                    return false;
                });

            }

            // Next Button
            jQuery('.better-gallery .gallery-title .next').click(function(){

                var fotorama = $(this).closest('.better-gallery').find('.fotorama').data('fotorama');
                fotorama.show('>');

            });

            // Previous Button
            jQuery('.better-gallery .gallery-title .prev').click(function(){

                var fotorama = $(this).closest('.better-gallery').find('.fotorama').data('fotorama');
                fotorama.show('<');

            });

        },

        bsPrettyTabs: function() {
            $('.section-heading.multi-tab').bsPrettyTabs({
                moreContainer: '<a href="#" class="bs-pretty-tabs-more other-link"><span class="h-text">' + publisher_theme_global_loc.translations.tabs_all + ' <i class="fa fa-angle-down" aria-hidden="true"></i></span></a><div class="bs-pretty-tabs-elements"></div>',
                getContainerWidth: function(totalWidth) {
                    var firstLinkWidth = $('a:not(.other-link)',this.$element).width();
                    firstLinkWidth += Math.floor(firstLinkWidth * .17);

                    return totalWidth - firstLinkWidth;
                },
                mustDisplayClass: 'main-link'
            });
        },

        /**
         * Handle pagination elements
         *
         * @param context
         */
        bsPagination: function(context) {

            if( ! $.fn.Better_Ajax_Pagination ){
                return;
            }

            $('.bs-ajax-pagination',context).parent()
                                    .Better_Ajax_Pagination();

        },

        /**
         * Initialize and handle deferred blocks
         */
        initDeferredElements: function () {

            if( ! $.fn.Better_Deferred_Loading ){
                return;
            }

            var self = this;
            $.fn.Better_Deferred_Loading({
                /**
                 * Handle new block pagination if exits
                 * @param $wrapper {jQuery}  new block wrapper jquery object
                 */
                afterSuccessDeferredAjax: function ($wrapper) {
                    self.bsPagination($wrapper);
                }
            });
        },

        handleAjaxifiedComments: function () {
            $(document).on('click', '.comment-ajaxified-placeholder', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $wrapper = $this.closest('.comments-template');

                $this.hide();
                var $loading = $('<div></div>', {
                    'class': 'deferred-loading-container',
                    height: 40
                });
                $loading.append('<div class="bs-pagin-loading-wrapper">' + publisher_theme_global_loc.loading + '</div>');
                $loading.appendTo($wrapper);

                $.ajax({
                     url: publisher_theme_global_loc.ajax_url,
                     type: 'post',
                     dataType: 'json',
                     data: $.extend(
                         $this.data(),
                         {
                             action: 'ajaxified-comments'
                         }
                     )
                 })
                 .done(function (res) {
                     $wrapper.replaceWith(res.rawHTML);
                     $('.deferred-loading-container', $wrapper).remove();
                     $(document).trigger('ajaxified-comments-loaded', [$wrapper,res])
                 });
            });
        },


        handleInfinitySinglePostLoading: function (post_id) {

            if( ! $('body').hasClass( 'single' ) || ! $('body').hasClass( 'infinity-related-post' ) )
                return;

            if (typeof OnScreen !== 'function')
                return;

            var triggerEventID = 'infinity-single-post-loading';
            var $wrapper = $('.content-column');
            var allPosts = [
                parseInt( $wrapper.find('.single-post-content').attr('id').replace(/[^0-9\.]/g, '') )
            ],
                self = this,
                xhr;
            var os = new OnScreen({
                tolerance: -500,
                container: window
            });


            function appendHtmlIfNeeded() {
                if (!$(triggerEventID).length) {
                    $("<div></div>", {
                        id: triggerEventID
                    }).appendTo($wrapper);
                }
            }

            function onScreenEventHandler(el) {
                unRegisterOnScreenEvent();

                var $infContainer = $(el),
                    $loading = $('<div></div>', {
                        'class': 'deferred-loading-container',
                        height: 200
                    });
                $loading.append('<div class="bs-pagin-loading-wrapper">' + publisher_theme_global_loc.loading + '</div>');
                $loading.appendTo($infContainer);

                if (xhr) {
                    xhr.abort();
                }

                xhr = $.ajax({
                           url: publisher_theme_global_loc.ajax_url,
                           type: 'post',
                           dataType: 'json',
                           data: {
                               action: 'ajax-get-post',
                               post_ID: post_id,
                               loaded_posts: allPosts
                           }
                       })
                       .done(function (res) {
                           $('.deferred-loading-container', $infContainer).remove();

                           if (res.rawHTML) {
                               $infContainer.before(res.rawHTML);
                           }

                           if (res.post_id) {
                               allPosts.push(res.post_id);
                           }

                           if(res.haveNext) {
                               registerOnScreenEvent();
                           }

                           self.setup_post();
                       });
            }

            function registerOnScreenEvent() {
                os.on('enter', "#" + triggerEventID, onScreenEventHandler);
            }

            function unRegisterOnScreenEvent() {
                os.off('enter', "#" + triggerEventID);
            }

            appendHtmlIfNeeded();
            registerOnScreenEvent();
        },

        setup_post:function() {

            // Setup gallery
            this.gallery();

            // Setup Sliders
            this.setup_sliders();

            // Setup Video Players
            this.setup_video_players();

            // Small Fixes With jQuery For Elements Styles
            this.small_style_fixes();

            // BetterStudio Editor Shortcodes Setup
            this.betterstudio_editor_shortcodes();

            // Setup sticky menu
            this.setup_menu();

            // Setup Popup
            this.popup();

            // Define elements that use elementQuery
            this.fix_element_query();

            this.bsPrettyTabs();

            this.bsPagination();

            this.initDeferredElements();
        },

        woo_commerce: function () {

            // Ads highlighted to custom tab (section-heading)
            var _bs_inside_css_class_event_flag = false;
            $(".woocommerce div.product .woocommerce-tabs ul.tabs li").bind('cssClassChanged', function(){

                // flag to stop infinity calls of css class
                if( _bs_inside_css_class_event_flag == true ){
                    return;
                }else{
                    _bs_inside_css_class_event_flag = true;
                }

                if( $(this).hasClass( 'active' ) ){
                    $(this).closest( 'ul.tabs' ).find('a.active').removeClass('active');
                    $(this).find('a').addClass('active');
                }

                _bs_inside_css_class_event_flag = false;
            });

            // Update Menu Cart  Badge Count
            $(window).on('added_to_cart',function( e, data, data2 ){

                if( typeof data['total-items-in-cart'] != 'undefined' && $( '.main-menu-container .shop-cart-container').length >= 1 ){
                    if( $( '.main-menu-container .shop-cart-container .cart-handler .cart-count').length < 1 ){
                        $( '.main-menu-container .shop-cart-container .cart-handler').append( '<span class="cart-count">' + data['total-items-in-cart'] + '</span>' )
                    }else{
                        $( '.main-menu-container .shop-cart-container .cart-handler .cart-count').html( data['total-items-in-cart'] )
                    }
                }

            });

        },


        visual_composer: function () {

            // fix full width style
            if( this.is_rtl() ){
                $(document).on( 'vc-full-width-row', function ( e, element ) {
                    $(element).css( 'right', $(element).css('left')  );
                    $(element).css('left', '');
                } );
            }

        }

    };// /return
})(jQuery);

// Load when ready
jQuery(document).ready(function() {

    Publisher_Theme.init();

});
