<?php

namespace richardevcom\wppb\admin\widgets;

/**
 * WPPB Widget
 */
class WPPB_Widget extends \WP_Widget {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		parent::__construct(
			'wppb_widget',
			esc_html__('WPPB Widget', 'wppb'),
			array('description' => esc_html__('WordPress Plugin Boilerplate Widget', 'wppb'),)
		);
	}

	/**
	 * Widget output (public)
	 * 
	 * @since	1.0.0
	 * @param	array	$args	Array of widget arguments
	 * @param	array	$instance	Widget instance (previously saved data)
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		echo sprintf(__("Great! It works. Now try customizing your own widget in <code>%s</code>", 'wppb'), "admin/widgets/" . basename(__FILE__));

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('WPPB Widget Title', 'wppb');
		require_once WPPB_ADMIN_PATH . 'templates/widgets/wppb-widget.php';
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';

		return $instance;
	}
}
