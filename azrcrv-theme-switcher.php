<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Theme Switcher
 * Description: Allows users to easily switch themes (ideal for allowing light/dark mode).
 * Version: 1.1.6
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/
 * Text Domain: theme-switcher
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname( __FILE__).'/pluginmenu/menu.php');
add_action('admin_init', 'azrcrv_create_plugin_menu_ts');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup actions, filters and shortcodes
 *
 * @since 1.0.0
 *
 */
// add actions
add_action('admin_menu', 'azrcrv_ts_create_admin_menu');

// add filters
add_filter('plugin_action_links', 'azrcrv_ts_add_plugin_action_link', 10, 2);

/**
 * Add Theme Switcher menu to plugin menu
 *
 * @since 1.0.0
 *
 */
function azrcrv_ts_create_admin_menu(){
	global $admin_page_hooks;
    
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Theme Switcher Settings", "theme-switcher")
						,esc_html__("Theme Switcher", "theme-switcher")
						,'manage_options'
						,"azrcrv-ts"
						,"azrcrv_ts_display_options");
}

/**
 * Add plugin action link on plugins page.
 *
 * @since 1.1.4
 *
 */
function azrcrv_ts_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-ts"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'theme-switcher').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Display Settings page
 *
 * @since 1.0.0
 *
 */
function azrcrv_ts_display_options(){
	if (!current_user_can('manage_options')){
		$error = new WP_Error('not_found', esc_html__('You do not have sufficient permissions to access this page.' , 'theme-switcher'), array('response' => '200'));
		if(is_wp_error($error)){
			wp_die($error, '', $error->get_error_data());
		}
    }
	?>
	<div id="azrcrv-ts-general" class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<p>
			<?php esc_html_e('This plugin allows users to switch themese on the front-end on a per user setting. Configure plugin via the included widget.', 'theme-switcher'); ?>
		</p>
	</div>
	
<?php
}

// register activation hook
register_activation_hook(__FILE__, 'azrcrv_ts_set_default_options');

/**
 * Copy options for plugin
 *
 * @since 1.0.0
 *
 */
function azrcrv_ts_set_default_options($networkwide){
	
	// set defaults for multi-site
	if (function_exists('is_multisite') && is_multisite()){
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide){
			global $wpdb;

			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			$original_blog_id = get_current_blog_id();

			foreach ($blog_ids as $blog_id){
				switch_to_blog($blog_id);

				if (get_option('widget_azrcrv-ts') === false){
					if (get_option('widget_azc-ts-theme-switcher-widget') === false){
						//
					}else{
						add_option('widget_azrcrv-ts', get_option('widget_azc-ts-theme-switcher-widget'));
					}
				}
			}

			switch_to_blog($original_blog_id);
		}else{
			if (get_option('widget_azrcrv-ts') === false){
				if (get_option('widget_azc-ts-theme-switcher-widget') === false){
					//
				}else{
					add_option('widget_azrcrv-ts', get_option('widget_azc-ts-theme-switcher-widget'));
				}
			}
		}
		if (get_site_option('widget_azrcrv-ts') === false){
			if (get_option('widget_azc-ts-theme-switcher-widget') === false){
				//
			}else{
				add_option('widget_azrcrv-ts', get_option('widget_azc-ts-theme-switcher-widget'));
			}
		}
	}
	//set defaults for single site
	else{
		if (get_option('widget_azrcrv-ts') === false){
			if (get_option('widget_azc-ts-theme-switcher-widget') === false){
				//
			}else{
				add_option('widget_azrcrv-ts', get_option('widget_azc-ts-theme-switcher-widget'));
			}
		}
	}
}

/**
 * Theme Switcher class.
 *
 * @since 1.0.0
 *
 */
class azrcrv_ts_ThemeSwitcherWidgetClass extends WP_Widget {
	/**
	 * Return widget in widgets admin panel
	 *
	 * @since 1.0.0
	 *
	 */
	function __construct()
	{
		return $this->WP_Widget('azrcrv-ts', 'Theme Switcher by azurecurve', array('description' => esc_html__('A widget with options for switching themes.', 'theme-switcher')));
	}
	
	/**
	 * Return widget
	 *
	 * @since 1.0.0
	 *
	 */
	function widget($args, $instance)
	{
		global $theme_switcher;
		$title = empty($instance['title']) ? 'Theme Switcher' : $instance['title'];
		echo $args['before_widget'];
		echo $args['before_title'].$title.$args['after_title'];
		echo $theme_switcher->theme_switcher_markup($instance['displaytype'], $instance);
		echo $args['after_widget'];
	}
	
	/**
	 * Update
	 *
	 * @since 1.0.0
	 *
	 */
	function update($new_instance, $old_instance) 
	{
		return $new_instance;
	}
	
	/**
	 * Show widget settings in admin panel
	 *
	 * @since 1.0.0
	 *
	 */
	function form($instance) 
	{
		$type = $instance['displaytype'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<span><?php esc_html_e('Title:', 'theme-switcher'); ?></span>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</label>
		</p>
			
		<p><label for="<?php echo $this->get_field_id('displaytype'); ?>"><?php esc_html_e('Display themes as:', 'theme-switcher'); ?></label></p>
		<p>
			<span><input type="radio" name="<?php echo $this->get_field_name('displaytype'); ?>" value="list" <?php
				if ('list' == $type){
					echo ' checked="checked"';
				}
			?> /> <?php esc_html_e('List', 'theme-switcher'); ?></span>
			<span><input type="radio" name="<?php echo $this->get_field_name('displaytype'); ?>" value="dropdown" <?php 
				if ('dropdown' == $type){
					echo ' checked="checked"';
				}
			?>/> <?php esc_html_e('Dropdown', 'theme-switcher'); ?></span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('prefix'); ?>">
				<span><?php esc_html_e('Ignore themes with prefix:', 'theme-switcher'); ?></span>
				<input type="text" name="<?php echo $this->get_field_name('prefix'); ?>" id="<?php echo $this->get_field_id('prefix'); ?>" value="<?php echo esc_attr($instance['prefix']); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('with'); ?>">
				<span><?php esc_html_e('Only include themes with:', 'theme-switcher'); ?></span>
				<input type="text" name="<?php echo $this->get_field_name('with'); ?>" id="<?php echo $this->get_field_id('with'); ?>" value="<?php echo esc_attr($instance['with']); ?>" />
			</label>
		</p>
		<?php
	}
}

/**
 * Theme switcher widget on site
 *
 * @since 1.0.0
 *
 */
class azrcrv_ts_ThemeSwitcherClass {
	
	/**
	 * Add actions and filters
	 *
	 * @since 1.0.0
	 *
	 */
	public function init()
	{
		add_action('init', array(&$this, 'set_theme_cookie'));
		add_action('widgets_init', array(&$this, 'event_widgets_init'));
		
		add_filter('stylesheet', array(&$this, 'get_stylesheet'));
		add_filter('template', array(&$this, 'get_template'));
	}
	
	/**
	 * Initiate and register widget
	 *
	 * @since 1.0.0
	 *
	 */
	function event_widgets_init()
	{
		register_widget('azrcrv_ts_ThemeSwitcherWidgetClass');
	}
	
	/**
	 * Get stylesheet
	 *
	 * @since 1.0.0
	 *
	 */
	function get_stylesheet($stylesheet = ''){
		$themename = $this->get_theme();

		if (empty($themename)){
			return $stylesheet;
		}

		$themes = wp_get_themes();
		foreach ($themes as $stylesheetdata => $theme_data){
			if($themename == $theme_data->get('Name')){
				$theme = wp_get_theme($theme_data->get_stylesheet());
			}
		}	
		
		if (empty($theme)){
			return $stylesheet;
		}

		// Don't let people peek at unpublished themes.
		if (isset($theme['Status']) && $theme['Status'] != 'publish')
			return $stylesheet;	
		return $theme['Stylesheet'];
	}
	
	/**
	 * Get theme template
	 *
	 * @since 1.0.0
	 *
	 */
	function get_template($template){
		$themename = $this->get_theme();

		if (empty($themename)){
			return $template;
		}

		$themes = wp_get_themes();
		foreach ($themes as $stylesheetdata => $theme_data){
			if($themename == $theme_data->get('Name')){
				$theme = wp_get_theme($theme_data->get_stylesheet);
			}
		}
		
		if (empty($theme)){
			return $template;
		}

		// Don't let people peek at unpublished themes.
		if (isset($theme['Status']) && $theme['Status'] != 'publish')
			return $template;		

		return $theme['Template'];
	}
	
	/**
	 * Get selected theme from cookie
	 *
	 * @since 1.0.0
	 *
	 */
	function get_theme(){
		if (! empty($_COOKIE["wptheme".COOKIEHASH])){
			return $_COOKIE["wptheme".COOKIEHASH];
		} else {
			return '';
		}
	}
	
	/**
	 * Set selected theme in cookie
	 *
	 * @since 1.0.0
	 *
	 */
	function set_theme_cookie(){
		load_plugin_textdomain('theme-switcher');
		$expire = time() + 30000000;
		if (! empty($_GET["wptheme"])){
			setcookie(
				"wptheme".COOKIEHASH,
				stripslashes($_GET["wptheme"]),
				$expire,
				COOKIEPATH
			);
			$redirect = remove_query_arg('wptheme');
			wp_redirect($redirect);
			exit;
		}
	}
	
	/**
	 * Show theme switcher to user
	 *
	 * @since 1.0.0
	 *
	 */
	function theme_switcher_markup($style = "text", $instance = array()){
		if (! $theme_data = wp_cache_get('themes-data', 'azrcrv-ts')){
			$themes = (array) wp_get_themes(array('allowed' => 'site'));
			if (function_exists('is_site_admin')){
				$allowed_themes = (array) get_site_option('allowedthemes');
				foreach($themes as $key => $theme){
				    if(isset($allowed_themes[ wp_specialchars($theme[ 'Stylesheet' ]) ]) == false){
						unset($themes[ $key ]);
				    }
				}
			}

			$default_theme = wp_get_theme();

			$theme_data = array();
			foreach ((array) $themes as $theme_name => $data){
				// Skip unpublished themes.
				if (empty($theme_name) || isset($themes[$theme_name]['Status']) && $themes[$theme_name]['Status'] != 'publish'){
				}else{
					if (substr($themes[$theme_name]['Name'],0,strlen($themes[$theme_name]['Name'])) != $instance['prefix']){
						if (strlen($instance['with']) == 0 or stripos($themes[$theme_name]['Name'], $instance['with']) !== false){
							$theme_data[str_replace('?',$_SERVER["REQUEST_URI"].'?',add_query_arg('wptheme', $themes[$theme_name]['Name'], get_option('home')))] = $data['Name'];
						}
					}
				}
			}
			
			asort($theme_data);

			wp_cache_set('themes-data', $theme_data, 'azrcrv-ts');
		}
	
		$ts = '';
		if ($style == 'dropdown'){
			$ts .= '<div style="width: 90%; margin: auto; ">';
			$ts .= '<select style="width: 100%;" name="themeswitcher" onchange="location.href=this.options[this.selectedIndex].value;">';
		}else{
			$ts .= '<ul id="themeswitcher">';
		}

		foreach ($theme_data as $url => $theme_name){
			if (
				! empty($_COOKIE["wptheme".COOKIEHASH]) && $_COOKIE["wptheme".COOKIEHASH] == $theme_name ||
				empty($_COOKIE["wptheme".COOKIEHASH]) && ($theme_name == $default_theme)
			){
				$pattern = 'dropdown' == $style ? '<option value="%1$s" selected="selected">%2$s</option>' : '<li>%2$s</li>';
			} else {
				$pattern = 'dropdown' == $style ? '<option value="%1$s">%2$s</option>' : '<li><a href="%1$s">%2$s</a></li>';
			}				
			$ts .= sprintf($pattern,
				esc_attr($url),
				esc_html($theme_name)
			);

		}

		if ('dropdown' == $style){
			$ts .= '</select>';
			$ts .= '</div>';
		}else{
			$ts .= '</ul>';
		}
		return $ts;
	}
}

$theme_switcher = new azrcrv_ts_ThemeSwitcherClass();
$theme_switcher->init();

function azc_ts_theme_switcher($type = '')
{
	global $theme_switcher;
	echo $theme_switcher->theme_switcher_markup($type);
}

?>