=== JM Breaking News ===
Contributors: ArenaPigskin
Tags: breaking news, banner
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 1.8
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Display a breaking news banner for a selected amount of time anywhere on your site.

== Description ==
The JM Breaking News Plugin allows you to display a breaking news banner with custom text and a custom link for as long as you want anywhere on the site.

== Installation ==
To have WordPress download and install the plugin, go to the WordPress dashboard, click "Plugins", click "Add New" and search for "JM Breaking News" and click "Install." To manually download and install the plugin, download the plugin, either from the plugin site or the plugin's page from the Plugin Directory. The in the WordPress dashboard, go to "Plugins" then "Add New" then "Upload Plugin" and upload the plugin's zip file.

Once the plugin has been uploaded and activated, add the following code into your theme where you want it to be shown.
`<?php
if (function_exists('jm_breaking_news')) {
	echo jm_breaking_news();
} ?>`

The banner has a width of 100%, so it will fit into any size container; however, the best use for the banner is to have it in the header.

== Screenshots ==
1. The editor screen to add breaking news.
2. The breaking news banner in action on the web site.

== Changelog ==
= 1.8 =
- Added color options for the background of the body section and the text.
- Tested to work with WordPress 4.8.

= 1.7 =
- Tested to work with WordPress 4.7.

= 1.6 =
- Added: Breaking News shortcode to put a breaking news banner inside a post.
- Tested to work with WordPress 4.6.

= 1.5 =
- Added: Breaking News widget that allows users to display the breaking news banner in the sidebar.
- Added: Translations for French, German, Italian, Russian and Spanish.
- Tested to work with WordPress 4.5.

= 1.4 =
- Added option to change background color of "Breaking News" half of the banner.
- Tested to work with WordPress 4.4

= 1.3.1 =
- Removed 'http:' from the functions to enqueue the Google fonts

= 1.3 =
- Tested to work with WordPress 4.3
- Fixed vertical margin for "Breaking News" text to even it out.
- Added a line-height of 1.2 for text on the right side to even it out.

= 1.2.1 =
- Fixes: Issue with the JavaScript file for the breaking news post type admin area not being included in the plugin.

= 1.2 =
- Added: Option for users to select whether the link will be internal or external.
- Added: A select option of posts for the user to select if it's an internal link.

= 1.1 =
- Added: default value of 1 for the time limit.
- Added: wp_reset_query at the end of the jm_breaking_news function to keep the banner from interfering with the page query.
- Changed: the left side font to Oswald.
- Changed: the right side font to Lato.
- Changed: the left side background to #C42B2B.
- Changed: the right side background to #252525.

= 1.0 =
- Initial Release