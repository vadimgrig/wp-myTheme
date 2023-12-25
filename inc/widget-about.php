<?php

class wpstd_about_widget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('wpstd_about_widget', esc_html__('About Widget', 'wpstd'), array('description' => esc_html('About Widget Our', 'wpstd')));
	}

	public function widget($args, $instance)
	{
		//front end widget
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$text = apply_filters('widget_text', $instance['text']);

		echo $before_widget;

		if ($title) {
			echo $before_widget . esc_html($title) . $after_title;
		}
		if ($text) {
			echo wp_kses_post($text);
		}
		echo $after_widget;
	}
	public function form($instance)
	{
		//back end widget
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title  = '';
		}
		if (isset($instance['text'])) {
			$text = $instance['text'];
		} else {
			$text = '';
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php esc_html_e('Title', 'wpstd'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" type="text">

		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>">
				<?php esc_html_e('Title', 'wpstd'); ?>
			</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php $this->get_field_name('text'); ?>" type="text"><?php echo esc_attr($text); ?></textarea>

		</p>

<?php }
	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);

		return $instance;
	}
}
