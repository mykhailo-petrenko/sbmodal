=== SBModal ===
Contributors: sevenbytes
Tags: modal, bootstrap, pop ups, bootstrap popup
Requires at least: 4.0.1
Tested up to: 4.1
Stable tag: 1.0
Plugin Name: SBModal
Plugin URI: http://seven-bytes.com/plugins/sbmodal
Description: Ease using Bootstrap Modals in WordPress
License: MIT
License URI: http://opensource.org/licenses/MIT

Provides ease Bootstrap Modals management. A lot of options and ease of extensibility.

== Description ==

You could easily create Bootstrap Modals.

It requires only: 
1. Set content
1. Provide call Selector

For content editing you may use WP WYSIWYG editor. Also you could use shortcodes to add form from CF7, for example.

== Installation ==

1. Upload `sbmodal` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. GOTO Usage

== Usage ==

= Create Modal =

1. GOTO "Modals" -> "Add New"
1. Input Title, Content and Footer. You should necessarily fill Content field. Title and Footer is optional.
1. Configure Modal behaviour in "Options" metabox (right sidebar).

= Options =

*	Select Template: Simple (display only content),  Middle (title + content), Full (title + content + footer).
*	Call Selector - jQuery selector for element which open Modal by click (Examples: a[href="#OpenModal"], a#click_me, a.open-modal)
*	Width - Aliases for standart Bootstrap styles: Large (modal-lg), Middle (modal-md), Small (modal-sm).
*	Max Width - You could provide INT value to limit width of Modal
*	Class - custom class
*	ID - custom ID

= Filters =

*	sbmodal_client_templates_path - path to folder with templates. From template root. ()
*	sbmodal_templates - array with templates ('slug' => __('Template Name', 'sbmodal')). 
*	sbmodal_width_classes - array with modal width classes ('modal-width-class' => __('Class Name', 'sbmodal'),).


== Frequently Asked Questions ==

= How Could I customise Modal templates =
@TODO: write customise guide


== Screenshots ==
1. Modal edit page.
2. How its look like on front.

== Changelog ==

= 1.0 * Initial release.

== Upgrade Notice ==