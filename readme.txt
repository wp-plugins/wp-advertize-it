=== Plugin Name ===
Contributors: benohead, amazingweb-gmbh
Donate link: http://benohead.com/donate/
Tags: ad, ad banner, ad block, ads, ads display, ads in widgets, ads on website, ads plugin, adsense, adsense plugin, advertisement, advertisements, advertiser, advertising, Goggle AdSense, google ads, google adsense, insert ads, insert ads automatically, insert Google ads, publisher, widget
Requires at least: 3.0.1
Tested up to: 4.0.1
Stable tag: 0.8.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily insert as many ads as you want anywhere on your website: in posts, pages and in the sidebar. 

== Description ==

This plugin provides allows you to easily insert ads anywhere on your website. You can define ad blocks containing ads from Google Adsense, Amazon, Commissure Junction...

Enabling advertizing on your website is as easy as:

* Defining a few ad blocks copy&pasting code from Google, Amazon, CJ...
* Selecting for each of the predefined positions which ad block should be shown.
* Setting options where ads should be suppressed.

The following locations are currently supported:

* Home page below title	
* Posts below title	
* After first post paragraph	
* Middle of post	
* Before last post paragraph	
* Posts below content	
* Posts below comments	
* Pages below title	
* After first page paragraph	
* Middle of page	
* Before last page paragraph	
* Pages below content	
* Pages below comments	
* Below footer	

A widget is also available to display in a sidebar.

And the following options are available:

* Suppress ads on posts
* Suppress ads on pages
* Suppress ads on attachment pages
* Suppress ads on category pages
* Suppress ads on tag pages
* Suppress ads on home page
* Suppress ads on front page
* Suppress ads on archive pages
* Suppress ads for logged in users
* Suppress ads for specific posts/pages by ID
* Suppress ads for posts/pages in a specific category
* Suppress ads for posts/pages with a specific tag
* Suppress ads for posts/pages by a specific author
* Suppress ads for posts/pages with a specific post format
* Suppress ads for posts/pages of a specific post type
* Suppress ads which URL contains one of the specified strings
* Suppress ads in the post for small posts (minimum number of characters, words, paragraphs)

If you need more fine grain control on where and whether ads are displayed or not, this plugin also defines supports:

* Inserting an ad block calling a PHP function
* Inserting an ad block using a short code
* Inserting an ad block in the visual editor using a button
* Adding a comment in the text editor to:
    * suppress all ads when displaying this post (except in a list of posts)
    * suppress the ad below the post or page title
    * suppress the ad after the first paragraph
    * suppress the ad in the middle of the post or page
    * suppress the ad before the last paragraph
    * suppress the ad below the post or page content
    * suppress the ad below the comments
    * suppress the ad widget
    * suppress the footer

You can also create your own sidebar ads by using the new ad image widget:

* Add the widget to the sidebar.
* Upload an image, select an image from the media library or just type in a URL pointing to an image
* Specify a description (shown when the image doesn't load and as tooltip on mouseover)
* Specify a link URL which will be opened when clicked
* Decide whether to maximize the width of the image and whether to open the link in  a new window.

== Installation ==

1. Upload the folder `wp-advertize-it` to the `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Define some ad blocks in the settings and place them using the settings UI, the php function or the short code.

== Frequently Asked Questions ==

= How can I contact you with a complaint, a question or a suggestion? =
Send an email to henri.benoit@gmail.com

== Screenshots ==

1. Define multiple ad blocks.

2. Define which ad block should be displayed where.

3. Set options about when/where ads should not be displayed.

4. Widget to drag and drop

5. Widget configuration

== Changelog ==

= 0.8.2 =

* Setting ads between posts to none now works

= 0.8.1 =

* Removed output to error log.

= 0.8 =

* Support ads between posts (Show X ads, each after Y posts).

= 0.7.5 =

* Disabling of ads with HTML comments or post ID does not affect the list of posts (home page) anymore.

= 0.7.4 =

* Fixed more php warnings and notices

= 0.7.3 =

* Fixed "Call to undefined function get_the_permalink()" error in WordPress versions less than 3.9

= 0.7.2 =

* Fixed more php warnings and notices
* Fixed category filter

= 0.7.1 =

* Fixed php warnings and notices

= 0.7 =

* Moved from EditArea to ACE editor

= 0.6.1 =

* Fixed incompatibility with WP Site Mapping

= 0.6 =

* Added new widget to where you can upload an image (or choose an existing image in your media library) and specify a link URL.

= 0.5.1 =

* Bug fix

= 0.5 =

* Suppress ads on error page
* Suppress ads on author page
* Suppress ads for specific languages (this option is only available with the plugin qTranslate or mqTranslate)
* Suppress ads on WPtouch mobile site
* Suppress ads for specific referrers
* Suppress ads for specific IP addresses

= 0.4.1 =

* Bug fix

= 0.4 =

* Suppress ads by post format and post type
* Suppress based on substrings in URL
* Suppress for small posts (with a minimum number characters, words and paragraphs)

= 0.3 =

* Suppress ads by category, tag and author

= 0.2 =

* Suppress ads by post/page ID

= 0.1 =

* First version.

== Upgrade Notice ==

n.a.
