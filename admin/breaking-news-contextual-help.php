<?php 
/**
* breaking-news-contextual-help.php
*
* The file that creates the contextual help section when adding or editing a breaking news item.
* 
* @author Jacob Martella
* @package JM Breaking News
* @version 1.8
*/
function jm_breaking_news_contextual_help( $contextual_help, $screen_id, $screen ) {
	if ( ( $screen->id == 'jm_breaking_news' ) or ( $screen->id == 'edit-jm_breaking_news' ) ) {
		$contextual_help = '<h2>' . __( 'Breaking News Help', 'jm-breaking-news' ) . '</h2>';
		$contextual_help .= '<ul>';
		$contextual_help .= '<li>' . __( 'Title', 'jm-breaking-news' ) . '<br />' . __( 'The title is the text that is shown in the breaking news banner.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'Internal/External Link', 'jm-breaking-news' ) . '<br />' . __( 'This radio box option allows you to select whether the link is internal or external. The appropriate option will then appear below.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'External Link', 'jm-breaking-news' ) . '<br />' . __( 'This text box is where you can add the external link, if there is one, to the breaking news box.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'Internal Link', 'jm-breaking-news' ) . '<br />' . __( 'This select menu allows you to select a post on your site to link to in the breaking news box.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'Target', 'jm-breaking-news' ) . '<br />' . __( 'Check this box to open the link in a new window.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'Time Limit', 'jm-breaking-news' ) . '<br />' . __( 'Set a time limit for the breaking news banner to show.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '<li>' . __( 'Background Color', 'jm-breaking-news' ) . '<br />' . __( 'Set a background color for the "Breaking News" half of the banner.', 'jm-breaking-news' ) . '</li>';
		$contextual_help .= '</ul>';
	}

	return $contextual_help;
}
add_action( 'contextual_help', 'jm_breaking_news_contextual_help', 10, 3 );
?>