<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpstd
 */

if (!is_active_sidebar('newsidebar')) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar('newsidebar'); ?>
</aside><!-- #secondary -->