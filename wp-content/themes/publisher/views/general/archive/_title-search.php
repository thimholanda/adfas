<?php
/**
 * _title-search.php
 *---------------------------
 * Search result page title template
 *
 */

global $wp_query;

// search result count
$result_count = $wp_query->found_posts;

// Pre title
$pre_title = sprintf(
	publisher_translation_get( 'archive_search_title' ),
	'<i>' . get_search_query() . '</i>',
	'<span class="result-count">' . $wp_query->found_posts . '</span>'
);

// Search query
$searched_keyword = get_search_query();

?>
<section class="archive-title search-title">
	<div class="pre-title"><span><?php echo $pre_title; // escaped before ?></span></div>
	<h1 class="page-heading"><span class="h-title"><?php echo $searched_keyword; // escaped before ?></span> <span
			class="count">(<?php echo $result_count; // escaped before ?>)</span></h1>
</section>
