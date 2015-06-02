<?php
/******************************************************************************
* The widget class
******************************************************************************/

/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class WP_Random_Image_Widget extends WP_Widget
{
	public function __Construct()
	{
		$id_base = 'randomimagewidget';
		$name = __('Random Image Widget', 'text_domain');
		$options = array('description' => __('A random image from your Media Library', 'text_domain'));

		parent::__construct($id_base, $name, $options);
	}

	/******************************************************************************
	* Display the widget
	******************************************************************************/
	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$name = $instance['name'];

		$output = ''; //Start building the output

		//Make sure the image ID is a valid attachment
		if(!empty($instance['image_id']))
		{
			$image = get_post($instance['image_id']);
			if(!$image || 'attachment' != get_post_type($image))
			{
				$output .= ',!-- WP Random Image Widget Error: Invalid Attachment ID -->';
			}
		}

		$output .= $before_widget;

		//Display the widget title
		if($title)
		{
			$output .= $before_title.$title.$after_title;
		}

		//Display the name
		if($name)
		{
			$output .= '<p>Replace this text with an image</p>';
		}

		$output .= $after_widget; 

		echo $output;

	}

	/******************************************************************************
	* Display the form to edit the widget settings
	******************************************************************************/
	public function form($instance)
	{
		$defaults = array(
			'image_id'		=> '',
			'image_size'	=> 'full',
			'link'			=> '',
			'title'			=> '');

		$instance = wp_parse_args((array) $instance, $defaults);

		$instance['image_id'] = absint($instance['image_id']);
		$instance['title'] = wp_strip_all_tags($instance['title']);

		$image_id = $instance['image_id'];

		?>
		<div class="random-image-widget-admin-form">
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'text_domain'); ?></label>
				<input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat">
			</p>
		</div>
		<?php

	}

	/******************************************************************************
	* Save and sanitize widget settings
	******************************************************************************/
	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		//Strip tags from title and name to remove html
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name']  = strip_tags($new_instance['name']);
		//Sanitize image ID
		$instance['image_id'] = absint($new_instance['image_id']);

		return $instance;
	}
} // END class 