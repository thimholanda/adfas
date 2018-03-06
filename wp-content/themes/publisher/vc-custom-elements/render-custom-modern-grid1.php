<?php

    class RenderCustomModernGrid1
    {
        private static $html = '';

        public static function makeQuery()
        {
            $loop_control = 0;
            // Main Banner Query
            $args = [
                'post_type'         =>  'grid_principal',
                'posts_per_page'    => 4,
            ];

            $result = [];

            $query = new WP_Query($args);

            if($query->have_posts())
            {
                while($query->have_posts())
                {
                    $query->the_post();

                    $loop_control++;

                    $post_object = get_field('post');

                    global $post;
                    $post = $post_object;
                    setup_postdata($post);

                    $result['id'] = get_the_id();
                    $result['title'] = get_the_title();
                    $result['image'] = get_the_post_thumbnail_url(get_the_id());
                    $result['permalink'] = get_the_permalink();
                    $result['author_id'] = $post->post_author;
                    $result['author_name'] = get_the_author_meta('display_name', $result['author_id']);
                    $result['author_url'] = get_author_posts_url($result['author_id']);
                    $result['date_time'] = get_the_date('c');
                    $result['formated_date'] = get_the_date('l, F j, Y, H:i a');
                    $result['post_time'] = get_the_date('M j, Y');
                    $result['comments_number'] = get_comments_number($result['id']);

                    // select html piece

                    switch ($loop_control)
                    {
                        case 1:
                            self::getHtml1($result);
                            break;

                        case 2:
                            self::getHtml2($result);
                            break;

                        case 3:
                            self::getHtml3($result);
                            break;

                        case 4:
                            self::getHtml4($result);
                            break;
                    }
                }
            }

            wp_reset_postdata();



        }

        public static function getHtml1($post)
        {
            self::$html = "
<div class=\"wpb_wrapper\">
    <div class=\" bs-listing bs-listing-modern-grid-listing-1 bs-listing-single-tab\">
        <div class=\"listing listing-modern-grid listing-modern-grid-1 clearfix slider-overlay-simple-gr\">
            <div class=\"mg-col mg-col-1\">
                <article
                        class=\"post-{$post['id']} type-post format-standard has-post-thumbnail listing-item-1 listing-item listing-mg-item listing-mg-1-item\"
                        itemscope=\"itemscope\" itemtype=\"http://schema.org/Article\">
                    <div class=\"item-content\">
                        <a class=\"img-cont\" itemprop=\"url\" rel=\"bookmark\"
                           href=\"{$post['permalink']}\"
                           style=\"background-image: url({$post['image']})\"></a>
                        <div class=\"content-container\">
                            <h2 class=\"title\">
                                <a class=\"post-url\" itemprop=\"url\" rel=\"bookmark\"
                                   href=\"{$post['permalink']}\">
                                    <span class=\"post-title\" itemprop=\"headline\">{$post['title']}</span>
                                </a>
                            </h2>
                            <div class=\"post-meta\">

                                <a href=\"{$post['author_url']}\" itemscope=\"itemscope\" itemprop=\"url\"
                                   title=\"Navegue Autor artigos\" class=\"post-author-a\">
                                    <i class=\"post-author author\" itemprop=\"author\" itemscope=\"itemscope\"
                                       itemtype=\"http://schema.org/Person\">
                                        {$post['author_name']} </i>
                                </a>
                                <span class=\"time\"><time class=\"post-published updated\"
                                                         datetime=\"{$post['date_time']}\"
                                                         title=\"{$post['formated_date']}\">{$post['post_time']}</time></span>
                                <a href=\"{$post['permalink']}/#respond\"
                                   title=\"Deixe um comentário sobre: &#8203;&#8203;&amp; ldquo;{$post['title']} &amp; rdquo;\"
                                   class=\"comments\" itemprop=\"interactionCount\"><i class=\"fa fa-comments-o\"></i> {$post['comments_number']}</a>
                            </div>
                        </div>
                    </div>
                    <meta itemprop=\"headline\" content=\"{$post['post_title']}\">
                    <meta itemprop=\"url\"
                          content=\"{$post['permalink']}\">
                    <meta itemprop=\"datePublished\" content=\"{$post['date_time']}\">
                    <meta itemprop=\"image\"
                          content=\"{$post['image']}\">
                    <meta itemprop=\"author\" content=\"{$post['author_name']}\">
                    <meta itemprop=\"interactionCount\" content=\"{$post['comments_number']}\">
                </article>
            ";

        }

        public static function getHtml2($post){
            self::$html .= "
                </div>
            <div class=\"mg-col mg-col-2\">
                <div class=\"mg-row mg-row-1\">
                    <article
                            class=\"post-{$post['id']} type-post format-standard has-post-thumbnail listing-item-2 listing-item listing-mg-item listing-mg-1-item \"
                            itemscope=\"itemscope\" itemtype=\"http://schema.org/Article\">
                        <div class=\"item-content\">
                            <a class=\"img-cont\" itemprop=\"url\" rel=\"bookmark\"
                               href=\"{$post['permalink']}\"
                               style=\"background-image: url({$post['image']})\"></a>
                            
                            <div class=\"content-container\">
                                <h2 class=\"title\">
                                    <a class=\"post-url\" itemprop=\"url\" rel=\"bookmark\"
                                       href=\"{$post['permalink']}\">
                                        <span class=\"post-title\" itemprop=\"headline\">{$post['title']}</span>
                                    </a>
                                </h2>
                                <div class=\"post-meta\">

                                    <a href=\"{$post['author_url']}\" itemscope=\"itemscope\"
                                       itemprop=\"url\" title=\"Navegue Autor artigos\" class=\"post-author-a\">
                                        <i class=\"post-author author\" itemprop=\"author\" itemscope=\"itemscope\"
                                           itemtype=\"http://schema.org/Person\">
                                            {$post['author_name']} </i>
                                    </a>
                                    <span class=\"time\"><time class=\"post-published updated\"
                                                             datetime=\"{$post['date_time']}\"
                                                             title=\"{$post['formated_date']}\">{$post['post_time']}</time></span>
                                    <a href=\"{$post['permalink']}/#respond\"
                                       title=\"Deixe um comentário sobre: &#8203;&#8203;&amp; ldquo;{$post['title']} &amp; rdquo;\"
                                       class=\"comments\" itemprop=\"interactionCount\"><i class=\"fa fa-comments-o\"></i>
                                        {$post['comments_number']}</a></div>
                            </div>
                        </div>
                        <meta itemprop=\"headline\"
                              content=\"{$post['title']}\">
                        <meta itemprop=\"url\"
                              content=\"{$post['permalink']}\">
                        <meta itemprop=\"datePublished\" content=\"{$post['date_time']}\">
                        <meta itemprop=\"image\" content=\"{$post['image']}\">
                        <meta itemprop=\"author\" content=\"{$post['author_name']}\">
                        <meta itemprop=\"interactionCount\" content=\"{$post['comments_number']}\">
                    </article>
                </div>
            ";
        }

        public static function getHtml3($post){
            self::$html .= "
                
                <div class=\"mg-row mg-row-2\">
                    <div class=\"item-3-cont\">
                        <article
                                class=\"post-{$post['id']} type-post format-standard has-post-thumbnail listing-item-3 listing-item listing-mg-item listing-mg-1-item\"
                                itemscope=\"itemscope\" itemtype=\"http://schema.org/Article\">
                            <div class=\"item-content\">
                                <a class=\"img-cont\" itemprop=\"url\" rel=\"bookmark\"
                                   href=\"{$post['permalink']}\"
                                   style=\"background-image: url({$post['image']})\"></a>
                                <div class=\"content-container\">
                                    <h2 class=\"title\">
                                        <a class=\"post-url\" itemprop=\"url\" rel=\"bookmark\"
                                           href=\"{$post['permalink']}\">
                                            <span class=\"post-title\" itemprop=\"headline\">{$post['title']}</span>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                            <meta itemprop=\"headline\" content=\"{$post['title']}\">
                            <meta itemprop=\"url\"
                                  content=\"{$post['permalink']}\">
                            <meta itemprop=\"datePublished\" content=\"{$post['date_time']}\">
                            <meta itemprop=\"image\"
                                  content=\"{$post['image']}\">
                            <meta itemprop=\"author\" content=\"{$post['author_name']}\">
                            <meta itemprop=\"interactionCount\" content=\"{$post['comments_number']}\">
                        </article>
                    </div>
            
            ";
        }

        public static function getHtml4($post){
            self::$html .= "
                <div class=\"item-4-cont\">
                        <article
                                class=\"post-{$post['id']} type-post format-standard has-post-thumbnail listing-item-4 listing-item listing-mg-item listing-mg-1-item\"
                                itemscope=\"itemscope\" itemtype=\"http://schema.org/Article\">
                            <div class=\"item-content\">
                                <a class=\"img-cont\" itemprop=\"url\" rel=\"bookmark\"
                                   href=\"{$post['permalink']}\"
                                   style=\"background-image: url({$post['image']})\"></a>
                                <div class=\"content-container\">
                                    <h2 class=\"title\">
                                        <a class=\"post-url\" itemprop=\"url\" rel=\"bookmark\"
                                           href=\"{$post['permalink']}\">
                                            <span class=\"post-title\" itemprop=\"headline\">{$post['title']}</span>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                            <meta itemprop=\"headline\"
                                  content=\"{$post['title']}\">
                            <meta itemprop=\"url\"
                                  content=\"{$post['permalink']}\">
                            <meta itemprop=\"datePublished\" content=\"{$post['date_time']}\">
                            <meta itemprop=\"image\"
                                  content=\"{$post['image']}\">
                            <meta itemprop=\"author\" content=\"{$post['author_name']}\">
                            <meta itemprop=\"interactionCount\" content=\"{$post['comments_number']}\">
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
            ";
        }

        public static function getResult()
        {
            self::makeQuery();

            return self::$html;
        }

    }