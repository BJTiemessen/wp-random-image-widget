<?php
/******************************************************************************
* The main plugin class for loading the widget and attaching hooks
******************************************************************************/

/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class WP_Random_Image_Widget_Plugin
{
	/******************************************************************************
	* Set up the widget hooks
	******************************************************************************/
	public function load()
	{
		add_action('widgets_init', array($this, 'register_widget'));
		add_action('init', array($this, 'load_assets'));
	}

	/******************************************************************************
	* Register the widget
	******************************************************************************/
	public function register_widget()
	{
		register_widget('WP_Random_Image_Widget');
	}

	/******************************************************************************
	* Register scripts and styles
	******************************************************************************/
	public function load_assets()
	{
		//load the css file
		wp_register_style('wp-random-image-widget-admin', plugin_dir_path(__FILE__).'css/wp-random-image-widget.css');
		//load the javascript file
		wp_register_script('wp-random-image-widget-admin', plugin_dir_path(__FILE__).'js/wp-random-image-widget.js');
	}
} // END class 