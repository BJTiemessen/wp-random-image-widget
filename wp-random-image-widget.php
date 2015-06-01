<?php
/******************************************************************************
* Plugin Name: WP Random Image Widget
* Plugin URI: https://www.bjtiemessen.com
* Description: An image widget that displays a random image on each page load.
* Version: 0.0.1
* Author: BJ Tiemessen
* Author URI: http://www.bjtiemessen.com
* License: GPL-2.0+
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: wp-random-image-widget
******************************************************************************/

//Don't run this directly
if ( ! defined( 'ABSPATH' ) ) exit;

//Define the plugin directory path
if(!defined('WPRIW_DIR'))
{
	define('WPRIW_DIR', plugin_dir_path(__FILE__));
}

//Include functions and libraries
require_once(WPRIW_DIR.'includes/class-wpriw-widget.php');
require_once(WPRIW_DIR.'includes/class-wpriw-widget-plugin.php');

$wpriw = new WP_Random_Image_Widget_Plugin();
add_action('plugins_loaded', array($wpriw, 'load'));