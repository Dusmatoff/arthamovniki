<?php
global $current_user;
$user_roles = $current_user->roles;

$id        = get_the_ID();
$image_src = get_the_post_thumbnail_url() ?: '/wp-content/themes/arthamovniki/img/ava-default.jpg';
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
		if ( ! empty( $user_roles ) ) {
			if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ) {
				$args = [
					'post_type'      => 'picture',
					'posts_per_page' => 5,
					'post_status'    => 'any',
					'meta_query'     => [
						'relation' => 'AND',
						[ 'key' => 'artist', 'value' => $id ],
					]
				];
			}

			if ( in_array( 'um_partner', $user_roles ) ) {
				$args = [
					'post_type'      => 'picture',
					'posts_per_page' => 5,
					'meta_query'     => [
						'relation' => 'AND',
						[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
						[ 'key' => 'is_active', 'value' => '1' ],
						[ 'key' => 'artist', 'value' => $id ]
					]
				];
			}
		}

		$args = [
			'post_type'      => 'picture',
			'posts_per_page' => 5,
			'meta_query'     => [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => 'IN' ],
				[ 'key' => 'is_active', 'value' => '1' ],
				[ 'key' => 'artist', 'value' => $id ]
			],
			'meta_key'       => 'order_number',
			'orderby'        => [ 'meta_value_num' => 'ASC' ],
		];

		$query = new WP_Query( $args );

		while ( $query->have_posts() ) :
			$query->the_post();
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
		<?php endwhile;
		wp_reset_postdata(); ?>
    </div>
</div>

