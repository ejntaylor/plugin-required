<?php
/**
 * Plugin Name: Required Plugins
 * Plugin URI: http://raison.co
 * Description: Set the required plugins for a site
 * Version: 1.0.0
 * Author: Elliot
 * Author URI: http://raison.co/
 * Requires at least: 4.0.0
 * Tested up to: 4.0.0
 *
 * Text Domain: required-plugins
 * Domain Path: /languages/
 *
 * @package Required_Plugin
 * @author Raisonon
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// define

define('PLUGREQ_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
define('PLUGREQ_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . PLUGREQ_PLUGIN_NAME);
define('PLUGREQ_PLUGIN_URL', WP_PLUGIN_URL . '/' . PLUGREQ_PLUGIN_NAME);



// Plugin activation

require_once('includes/plugin_activation.php');			// required plugins





// simple settings

if ( ! class_exists('WordPress_SimpleSettings') )
	require( plugin_dir_path( $file ) . '/classes/wordpress-simple-settings.php');

class requiredPlugin extends WordPress_SimpleSettings {
	var $prefix = 'required'; // this is super recommended

	function __construct() {
		parent::__construct(); // this is required

		// Actions
		register_activation_hook(__FILE__, array($this, 'activate') );
	}

	function activate() {

		$plugin_array = Array(
			1 => array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
				'required' => true,
			) ,
			2 => array(
				'name' => 'Wordpress SEO',
				'slug' => 'wordpress-seo',
				'required' => false,
			) ,
			3 => array(
				'name' => 'Usersnap',
				'slug' => 'usersnap',
				'required' => false,
			) ,
			4 => array(
				'name' => 'Video User Manuals',
				'slug' => 'video-user-manuals',
				'required' => false,
			) ,
			5 => array(
				'name' => 'Woo Dojo',
				'slug' => 'woodojo',
				'required' => true,
			) ,
			6 => array(
				'name' => 'Manage WP',
				'slug' => 'worker',
				'required' => false,
			) ,
			7 => array(
				'name' => 'WooThemes Updater',
				'slug' => 'woothemes-updater',
				'required' => true,
			) ,
			8 => array(
				'name' => 'Advanced Custom Fields',
				'slug' => 'advanced-custom-fields',
				'required' => true,
			) ,
			9 => array(
				'name' => 'BWP Minify',
				'slug' => 'bwp-minify',
				'required' => false,
			) ,
			10 => array(
				'name' => 'Cookies for Comments',
				'slug' => 'cookies-for-comments',
				'required' => false,
			) ,
		);
		$this->add_setting('req_plugins_arr', $plugin_array );

	}
}


$requiredPlugin = new requiredPlugin();


// submenu

add_action('admin_menu', 'register_my_custom_submenu_page');

function register_my_custom_submenu_page() {
//	add_submenu_page( 'tools.php', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
	add_submenu_page( 'plugins.php', __( 'Required Plugins', 'required-plugins' ), __( 'Required Plugin', 'required-plugins' ), 'manage_options', 'required-plugins', 'my_custom_submenu_page_callback' ) ;

}

function my_custom_submenu_page_callback() {
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>Required Plugins List</h2>';
	echo '</div>';
	
	require_once('includes/menu_settings.php');			// required plugins

	

}





?>