<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpstd
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head() ?>
</head>

<body <?php body_class("body_my_class secondary"); ?>>
	<?php wp_body_open(); ?>

	<?php
	// esc_html__('word', 'Text Domain');

	// esc_html_e('word', 'Text Domain');

	$city = "Odess";
	$country = "Ukraine";

	printf(esc_html__('My Cyty is %1$s and my country is %2$s', 'wpstd'), $city, $country);
	$name = 'Vadym';
	echo wp_kses(__('%1$s <strong>Vadym</strong>', 'wpstd'), array('strong' => array()));

	$rating = '5';

	printf(_n('%s star', '%s stars', $rating, 'wpstd'), $rating);



	// wp_nav_menu(
	// 	array(
	// 		'theme_location' => 'header_nav',
	// 		'menu_id' => 'head_nav',
	// 		'menu_class' => 'head__nav-class',
	// 		'container' => 'div',
	// 		'before' => 'текст',
	// 		'link_before' => '1111',

	// 	)
	// );
	// get_search_form();

	// $name = 'Vadym <a href="/">Stolyarenko</a> <em>fdfdfdfdfdfdfdf</em> <strong>Loginnnnnnnnnnnnn</strong>';

	// echo esc_html($name);

	// echo esc_attr($name) esc_attr = функция которая проверяет нет 

	// $args = array(
	// 	'a' => array(
	// 		'href' => array()
	// 	),
	// 	'strong' => array(),
	// 	'em' => array()
	// );

	// echo wp_kses_post($name);

	?>
	<!-- <input name="author" value="<?php //echo esc_attr($name) 
																		?>"> -->

	<!-- <a href="<?php //echo esc_url(home_url("/")); 
								?>">Link</a> -->