<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'loop-templates/content-loop', 'artist-picture' );
	endwhile;
	custom_pagination();
?>
