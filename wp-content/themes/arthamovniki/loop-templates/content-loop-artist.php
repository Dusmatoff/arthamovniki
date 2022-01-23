<?php
global $current_user;
$user_roles = $current_user->roles;

$id        = get_the_ID();
$image_src = get_the_post_thumbnail_url() ?: '/wp-content/themes/arthamovniki/img/ava-default.jpg';

$max_count_pictures = 5;
?>
<div class="authors__item">
    <a href="<?php the_permalink( $id ); ?>" class="authors__item-ava">
        <img src="<?php echo $image_src; ?>">
    </a>
    <div class="authors__item-info">
        <a href="<?php the_permalink( $id ); ?>" class="authors__item-name">
			<?php the_title(); ?>
        </a>
		<?php if ( in_array( 'administrator', $user_roles ) ): ?>
            <span>(№<?php the_field( 'order_number' ); ?>)</span>
		<?php endif; ?>
    </div>
    <div class="authors__item-pictures">
		<?php
		$museum_catalog = new WP_Query( generate_artist_pictures_args( $max_count_pictures, 'museum', $id ) );

		while ( $museum_catalog->have_posts() && $max_count_pictures > 0 ) :
			$max_count_pictures --;
			$museum_catalog->the_post();
			$title = get_the_title();
			?>
            <div class="authors__item-pictures-item">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                         alt="<?php echo $title; ?>"
                         title="<?php echo $title; ?>"
                    >
                </a>
            </div>
		<?php
		endwhile;
		wp_reset_postdata();
		?>

		<?php
		if ( $max_count_pictures > 0 ):
			$everyone_catalog = new WP_Query( generate_artist_pictures_args( $max_count_pictures, 'everyone', $id ) );

			while ( $everyone_catalog->have_posts() && $max_count_pictures > 0 ) :
				$max_count_pictures --;
				$everyone_catalog->the_post();
				$title = get_the_title();
				?>
                <div class="authors__item-pictures-item">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>"
                             alt="<?php echo $title; ?>"
                             title="<?php echo $title; ?>"
                        >
                    </a>
                </div>
			<?php
			endwhile;
		endif;
		wp_reset_postdata();
		?>
    </div>
</div>

