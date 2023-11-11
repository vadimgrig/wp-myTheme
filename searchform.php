<form action="<?php echo home_url("/") ?>" method="get" class="search__form">
	<input type="text" class="search__input" name="s" value="<?php the_search_query() ?>">
	<button type="submit" class="search__button">Search</button>
</form>