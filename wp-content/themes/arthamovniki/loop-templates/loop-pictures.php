<?php
$url = home_url('picture');
hamovniki_pagination([
	'base' => $url . '/%_%',
	'add_args' => get_query_var('paginationArgs')
]);

while ( have_posts() ) :
	the_post();
	get_template_part( 'loop-templates/content-loop', 'artist-picture' );
endwhile;

hamovniki_pagination([
	'base' => $url . '/%_%',
	'add_args' => get_query_var('paginationArgs')
]);