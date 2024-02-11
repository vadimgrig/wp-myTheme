<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpstd
 */

get_header();
?>

<div>
	!!!!!!!!!!!!!!!!!!!!!!!!!!!
	<header class="page-header">
		<?php
		the_archive_title('<h1 class="page-title">', '</h1>');
		the_archive_description('<div class="archive-description">', '</div>');
		?>
	</header><!-- .page-header -->

	<?php
	$news = new WP_Query(array('post_type' => 'news', 'post_per_page' => 2));

	if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post(); ?>

			<?php get_template_part('parts/content') ?>

		<?php endwhile;
	else : ?>
		<?php get_template_part('parts/content', 'none') ?>

	<?php endif;  ?>
</div>
sdfsdf
<?php
// get_sidebar();
get_footer();
