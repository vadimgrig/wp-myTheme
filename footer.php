<?php wp_footer(); ?>
<?php
wp_nav_menu(
	array(
		'theme_location' => 'footer_nav',
		'menu_id' => 'footer_nav',
		'menu_class' => 'foot__nav-class',
		'container' => 'nav'
	)
);
?>

</body>

</html>