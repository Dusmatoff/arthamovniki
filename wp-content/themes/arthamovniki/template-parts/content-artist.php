<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Art_Hamovniki
 */

$artist_id = get_the_ID();
$theme_uri = get_stylesheet_directory_uri();
$image_src = get_the_post_thumbnail_url() ?: $theme_uri . '/img/ava-default.jpg';

function generate_artist_pictures_query() {
	global $current_user;
	$user_roles = $current_user->roles;

	if ( ! empty( $user_roles ) ) {
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ) {
			$args = [
				'post_type'      => 'picture',
				'posts_per_page' => - 1,
				'post_status'    => 'any',
			];

			return new WP_Query( $args );
		}

		if ( in_array( 'um_partner', $user_roles ) ) {
			$args = [
				'post_type'      => 'picture',
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
				'meta_query'     => [
					'relation' => 'AND',
					[
						'key'     => 'who_can_see',
						'value'   => [ 'partners', 'everyone', 'hide_from_catalog' ],
						'compare' => 'IN'
					],
					[ 'key' => 'is_active', 'value' => '1' ],
				]
			];

			return new WP_Query( $args );
		}
	}

	//For subscribers
	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
		'meta_query'     => [
			'relation' => 'AND',
			[ 'key' => 'who_can_see', 'value' => [ 'hide_from_catalog', 'everyone' ], 'compare' => 'IN' ],
			[ 'key' => 'is_active', 'value' => '1' ],
		]
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
                            </div>
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