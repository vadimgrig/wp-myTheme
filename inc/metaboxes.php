<?php
function wpstd_metaboxes() {
	add_meta_box('news_metabox', esc_html__('News Settings'), 'wpstd_news_meta_box', 'News', 'normal', 'high');
}

add_action( 'add_meta_boxes', 'wpstd_metaboxes' );

function wpstd_news_meta_box($post) {
	?>
	<label for="news_type"><?php _e('News Type', 'wpstd'); ?></label>

	<?php
}