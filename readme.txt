=== Theme Switcher ===
Contributors: azurecurve
Tags: themes, switching, theme, switcher, day, night, light, dark
Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/
Donate link: https://development.azurecurve.co.uk/support-development/
Requires at least: 1.0.0
Tested up to: 1.0.0
Requires PHP: 5.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows users to easily switch themes (ideal for allowing light/dark mode).

== Description ==
Allows users to easily switch themes (ideal for allowing light/dark mode).

Theme switcher functionality is made available to users via a widget; settings done via widget administration.

Settings available to display available themes as a list or select drop-down; widget admin allows themes with certain prefix to be excluded and/or to include only themes containing a certain word or part of a word.

As an alternative to using the widget, the function azc_ts_theme_switcher() can be called directly; add 'dropdown' as a parameter to have the select drop-down, instead of the list, of themes returned.

== Installation ==
To install the Theme Switcher plugin:
* Download the plugin from <a href='https://github.com/azurecurve/azrcrv-theme-switcher/'>GitHub</a>.
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Add the azurecurve Theme Switcher widget to one of your sidebars (select list/drop down and configure other parameters if required), or call azrcrv_ts_theme_switcher() directly.

== Changelog ==
Changes and feature additions for the Theme Switcher plugin:
= 1.0.1 =
* Update azurecurve menu for easier maintenance.
* Move require of azurecurve menu below security check.
= 1.0.0 =
* First version for ClassicPress forked from azurecurve Theme Switcher which was forked from Theme Switcher.

== Frequently Asked Questions ==
= Is this plugin compatible with both WordPress and ClassicPress? =
* Yes, this plugin will work with both.