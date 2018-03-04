jQuery.ajax({
    type    : "GET",
    url     : better_post_views_vars.admin_ajax_url,
    data    : {
        action:                 'better_post_views',
        better_post_views_id:   better_post_views_vars.post_id
    }
});