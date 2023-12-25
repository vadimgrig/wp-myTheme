<?php

/*
* Template name: Homepage Template
*/
get_header();
?>
<div class="new">

	<?php
	$args = array(
		'post_type' => 'news',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'Catnews',
				'field' => 'slug',
				'terms' => array('testg-1'),
			),
			array(
				'taxonomy' => 'Catyear',
				'field' => 'slug',
				'terms' => array('2077'),
			),
		),
	);
	$news = new WP_Query($args);
	?>

	<?php if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post();
			the_title();
			echo "<br>";
	?>

			<?php get_template_part('parts/content') ?>

		<?php

		endwhile;
	else : ?>
		<?php get_template_part('parts/content', 'none') ?>

	<?php endif;
	wp_reset_postdata();
	?>

	<?php
	$args = array(
		'post_type' => 'post',
		'cat' => 4,
		'posts_per_page' => -1
	);
	$blogpost = new WP_Query($args);
	?>

	<?php if ($blogpost->have_posts()) : while ($blogpost->have_posts()) : $blogpost->the_post();
			the_title();
			echo "<br>";
	?>

			<?php get_template_part('parts/content') ?>

		<?php

		endwhile;
	else : ?>
		<?php get_template_part('parts/content', 'none') ?>

	<?php endif;
	wp_reset_postdata();
	?>
</div>
<?php
// get_sidebar();
// get_footer();
