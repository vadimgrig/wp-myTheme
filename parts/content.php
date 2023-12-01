<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-post-id="<?php the_id(); ?>">
	<div><?php the_content(); ?></div>
	<a href="<?php the_permalink(); ?>">Read More</a>
</article>