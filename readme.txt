=== JM Breaking News ===
Contributors: ArenaPigskin
Tags: breaking news, banner
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 1.0
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
1.0 - Initial Release