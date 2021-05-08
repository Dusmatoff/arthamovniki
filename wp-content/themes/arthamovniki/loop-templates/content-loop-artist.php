<?php
$id                 = get_the_ID();
$artist_birth_death = get_field( 'artist_birth_death' );
$artist_address     = get_field( 'artist_address' );
?>
<div class="authors__item">
    <div class="authors__item-ava">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>">
    </div>
    <div class="authors__item-info">
        <div class="authors__item-name">
			<?php the_title(); ?>
        </div>
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
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'   => 'is_active',
					'value' => 1
				],
				[
					'key'   => 'artist',
					'value' => $id
				],
			]
		];

		$query = new WP_Query( $args );

		while ( $query->have_posts() ) :
			$query->the_post();
			?>
            <div class="authors__item-pictures-item">
                <img src="img/product-card-img-1.jpg" alt="">
            </div>
		<?php endwhile; ?>
    </div>
    <a href="<?php echo get_permalink(); ?>" class="btn btn--border btn--lg">
        Смотреть
    </a>
</div>

