<?php
get_header();
?>

<div>
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

	<?php

	if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post();
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


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php get_template_part('parts/content') ?>

		<?php
			the_title();
			echo "<br>";
		endwhile;

		?>

		<div class="pagination">
			<?php echo paginate_links($args = [
				'prev_text' => __('<< Pr'),
				'next_text' => __('Nx >>'),
			]) ?>
		</div>

	<?php


	else : ?>
		<?php get_template_part('parts/content', 'none') ?>

	<?php endif;  ?>
</div>
<?php
if (is_singular('news')) {
	get_sidebar('news');
} else {
	get_sidebar();
}
get_footer();
