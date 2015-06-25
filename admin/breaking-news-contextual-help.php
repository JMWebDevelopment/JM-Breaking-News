<?php 
/**
* breaking-news-contextual-help.php
*
* The file that creates the contextual help section when adding or editing a breaking news item.
* 
* @author Jacob Martella
* @package JM Breaking News
* @version 1.1
*/
function jm_breaking_news_contextual_help($contextual_help, $screen_id, $screen) {
	if (($screen->id == 'jm_breaking_news') or ($screen->id == 'edit-jm_breaking_news')) {
		$contextual_help = '<h2>' . __('Breaking News Help', 'jm-breaking-news') . '</h2>';
		$contextual_help .= '<ul>';
		$contextual_help .= '<li>' . __('Title', 'jm-breaking-news') . '<br />' . __('The title is the text that is shown in the breaking news banner.', 'jm-breaking-news') . '</li>';
		$contextual_help .= '<li>' . __('Link', 'jm-breaking-news') . '<br />' . __('Add the link to the breaking news story. It can be from your site or from another site.', 'jm-breaking-news') . '</li>';
		$contextual_help .= '<li>' . __('Target', 'jm-breaking-news') . '<br />' . __('Check this box to open the link in a new window.', 'jm-breaking-news') . '</li>';
		$contextual_help .= '<li>' . __('Time Limit', 'jm-breaking-news') . '<br />' . __('Set a time limit for the breaking news banner to show.', 'jm-breaking-news') . '</li>';
		$contextual_help .= '</ul>';
	}

	return $contextual_help;
}
add_action('contextual_help', 'jm_breaking_news_contextual_help', 10, 3);
?>