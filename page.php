<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpstd
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while (have_posts()) :
		the_post();
		the_title();

		get_template_part('parts/content', 'page');
		wp_link_pages();

		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;
	endwhile;
	?>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
