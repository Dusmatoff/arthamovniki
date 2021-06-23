<?php

while ( have_posts() ) :
	the_post();
	get_template_part( 'loop-templates/content-loop', 'artist-picture' );
endwhile;

the_posts_pagination( [
	'show_all'           => true,
	'prev_text'          => __( '<' ),
	'next_text'          => __( '>' ),
	'screen_reader_text' => __( 'Навигация' ),
] );