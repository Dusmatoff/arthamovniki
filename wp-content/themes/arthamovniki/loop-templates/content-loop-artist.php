<?php
global $current_user;
$user_roles = $current_user->roles;

$id                 = get_the_ID();
$artist_birth_death = get_field( 'artist_birth_death' );
$artist_address     = get_field( 'artist_address' );
$image_src          = get_the_post_thumbnail_url() ?: '/wp-content/themes/arthamovniki/img/ava-default.png';
?>
<div class="authors__item">
    <a href="<?php the_permalink( $id ); ?>" class="authors__item-ava">
        <img src="<?php echo $image_src; ?>">
    </a>
    <div class="authors__item-info">
        <a href="<?php the_permalink( $id ); ?>" class="authors__item-name">
			<?php the_title(); ?>
        </a>
		<?php if ( $artist_address ): ?>
            <div class="authors__item-loc">
				<?php echo $artist_address; ?>
            </div>
		<?php endif; ?>
    </div>
    <div class="authors__item-pictures">
		<?php
		$args = [
			'post_type'      => 'picture',
			'posts_per_page' => - 1,
			'post_status'    => 'publish'
		];

		if ( in_array( 'um_partner', $user_roles ) ) {
			$args['meta_query'] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
				[ 'key' => 'is_active', 'value' => '1' ],
				[ 'key' => 'artist', 'value' => $id ]
			];
		} else {
			$args['meta_query'] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => '=' ],
				[ 'key' => 'is_active', 'value' => '1' ],
				[ 'key' => 'artist', 'value' => $id ]
			];
		}

		$query = new WP_Query( $args );

		while ( $query->have_posts() ) :
			$query->the_post();
			$title = get_the_title();
			?>
            <div class="authors__item-pictures-item">
                <a href="<?php the_permalink(); ?>" target="_blank">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                         alt="<?php echo $title; ?>"
                         title="<?php echo $title; ?>"
                    >
                </a>
            </div>
		<?php endwhile;
		wp_reset_postdata(); ?>
    </div>
    <a href="<?php the_permalink( $id ); ?>" class="btn btn--border btn--lg">
        Смотреть
    </a>
</div>

