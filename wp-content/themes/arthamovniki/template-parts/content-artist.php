<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Art_Hamovniki
 */

$artist_id          = get_the_ID();
$artist_birth_death = get_field( 'artist_birth_death' );
$artist_address     = get_field( 'artist_address' );
$image_src          = get_the_post_thumbnail_url() ?: '/wp-content/themes/arthamovniki/img/ava-default.png';

function generate_artist_pictures_query() {
	global $current_user;
	$user_roles = $current_user->roles;

	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'   => 'is_active',
				'value' => 1
			]
		]
	];

	if ( ! empty( $user_roles ) ) {
		//For admin and manager
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ) {
			return new WP_Query( $args );
		}

		//For partners
		if ( in_array( 'um_partner', $user_roles ) ) {
			$args['meta_query'] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
				[ 'key' => 'is_active', 'value' => '1' ],
			];

			return new WP_Query( $args );
		}
	}

	//For subscribers
	$args['meta_query'] = [
		'relation' => 'AND',
		[ 'key' => 'who_can_see', 'value' => [ 'hide_from_catalog', 'everyone' ], 'compare' => 'IN' ],
		[ 'key' => 'is_active', 'value' => '1' ],
	];

	return new WP_Query( $args );
}

?>

<section class="section-first product">
    <div class="container">
		<?php require_once 'breadcrumb-artist.php'; ?>
        <div class="row">
            <div class="col-12">
                <div class="author">
                    <div class="author__data">
                        <div class="author__data-ava">
                            <img src="<?php echo $image_src; ?>">
                        </div>
                        <div class="author__data-content">
                            <div class="author__data-name">
								<?php the_title(); ?>
								<?php if ( $artist_birth_death ) {
									echo "($artist_birth_death)";
								} ?>
                            </div>
							<?php if ( $artist_address ): ?>
                                <div class="author__data-location">
                                    <svg width="10" height="13" viewBox="0 0 10 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.27273 5.03627C9.27273 2.46808 7.20455 0.399902 4.63636 0.399902C2.06818 0.399902 0 2.46808 0 5.03627C0 7.60445 4.63636 12.3999 4.63636 12.3999C4.63636 12.3999 9.27273 7.60445 9.27273 5.03627ZM2.47727 4.94536C2.47727 3.76354 3.45455 2.78627 4.63636 2.78627C5.81818 2.78627 6.79545 3.74081 6.79545 4.94536C6.79545 6.12718 5.84091 7.10445 4.63636 7.10445C3.45455 7.10445 2.47727 6.12718 2.47727 4.94536Z"
                                              fill="#BA884D"/>
                                    </svg>
									<?php echo $artist_address; ?>
                                </div>
							<?php endif; ?>
                        </div>
                    </div>
                    <div class="author__text">
						<?php the_content(); ?>
                    </div>
                </div>

                <div class="catalog-cards catalog-cards--middle">
					<?php
					$query = generate_artist_pictures_query();

					while ( $query->have_posts() ) {
						$query->the_post();
						$picture_artist_id = get_field( 'artist', get_the_ID() );
						if ( $picture_artist_id == $artist_id ) {
							get_template_part( 'loop-templates/content', 'loop-artist-picture' );
						}
					}
					wp_reset_postdata();
					?>
                </div>
            </div>
        </div>
    </div>
</section>