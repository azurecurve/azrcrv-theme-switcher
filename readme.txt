=== Theme Switcher ===

Description:	Provide dark/light mode or other theme choices to your users.
Version:		1.2.5
Tags:			themes, switching, theme, switcher, day, night, light, dark
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/
Download link:	https://github.com/azurecurve/azrcrv-theme-switcher/releases/download/v1.2.5/azrcrv-theme-switcher.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	theme-switcher
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Provide dark/light mode or other theme choices to your users.

== Description ==

# Description

Allows users to easily switch themes (ideal for allowing light/dark mode).

Theme switcher functionality is made available to users via a widget; settings done via widget administration.

Settings available to display available themes as a list or select drop-down; widget admin allows themes with certain prefix to be excluded and/or to include only themes containing a certain word or part of a word.

As an alternative to using the widget, the function azc_ts_theme_switcher() can be called directly; add 'dropdown' as a parameter to have the select drop-down, instead of the list, of themes returned.

This plugin is multisite compatible; each site will place and configure the Theme Switcher widget.

== Installation ==

# Installation Instructions

* Download the latest release of the plugin from [GitHub](https://github.com/azurecurve/azrcrv-theme-switcher/releases/latest/).
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Configure relevant settings via the configuration page in the admin control panel (azurecurve menu).

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot file is in the plugins languages folder; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.2.5](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.5)
 * Update azurecurve menu.
 * Update readme files.

### [Version 1.2.4](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.4)
 * Update azurecurve logo.

### [Version 1.2.3](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.3)
 * Fix bug with version number.

### [Version 1.2.2](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.2)
 * Fix bug with incorrect spelling in pluginimages foldername.

### [Version 1.2.1](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.1)
 * Change use of deprecated class declaration.
 * Fix bugs causing undeclared variable errors in widget creation.
 * Update azurecurve menu.

### [Version 1.2.0](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.2.0)
 * Fix plugin action link to use admin_url() function.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.

### [Version 1.1.6](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.6)
 * Fix bug which broke plugin.
 * Fix unassigned ts variable bug.

### [Version 1.1.5](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.5)
 * Fix bug with plugin menu.
 * Update plugin menu css.

### [Version 1.1.4](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.4)
 * Change class name to avoid clash with method name.
 * Upgrade azurecurve plugin to store available plugins in options.

### [Version 1.1.3](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.3)
 * Update Update Manager class to v2.0.0.
 * Update action link.
 * Update azurecurve menu icon with compressed image.

### [Version 1.1.2](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.2)
 * Correct problem with version number.

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.1)
 * Remove duplicate load language function.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Fix issue with display of azurecurve menu.
 * Change settings page heading.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.1](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.0.1)
 * Update azurecurve menu for easier maintenance.
 * Move require of azurecurve menu below security check.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-theme-switcher/releases/tag/v1.0.0)
 * Initial release for ClassicPress forked from azurecurve Theme Switcher which was forked from Theme Switcher.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://directory.classicpress.net/plugins/update-manager) for fully integrated, no hassle, updates.

Some of the other plugins available from **azurecurve** are:
 * Avatars - [details](https://development.azurecurve.co.uk/classicpress-plugins/avatars/) / [download](https://github.com/azurecurve/azrcrv-avatars/releases/latest/)
 * BBCode - [details](https://development.azurecurve.co.uk/classicpress-plugins/bbcode/) / [download](https://github.com/azurecurve/azrcrv-bbcode/releases/latest/)
 * Breadcrumbs - [details](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/) / [download](https://github.com/azurecurve/azrcrv-breadcrumbs/releases/latest/)
 * Contact Forms - [details](https://development.azurecurve.co.uk/classicpress-plugins/contact-forms/) / [download](https://github.com/azurecurve/azrcrv-contact-forms/releases/latest/)
 * Display After Post Content - [details](https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/) / [download](https://github.com/azurecurve/azrcrv-display-after-post-content/releases/latest/)
 * Filtered Categories - [details](https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/) / [download](https://github.com/azurecurve/azrcrv-filtered-categories/releases/latest/)
 * Multisite Favicon - [details](https://development.azurecurve.co.uk/classicpress-plugins/multisite-favicon/) / [download](https://github.com/azurecurve/azrcrv-multisite-favicon/releases/latest/)
 * Shortcodes in Widgets - [details](https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/) / [download](https://github.com/azurecurve/azrcrv-shortcodes-in-widgets/releases/latest/)
 * Update Admin Menu - [details](https://development.azurecurve.co.uk/classicpress-plugins/update-admin-menu/) / [download](https://github.com/azurecurve/azrcrv-update-admin-menu/releases/latest/)
 * URL Shortener - [details](https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/) / [download](https://github.com/azurecurve/azrcrv-url-shortener/releases/latest/)
