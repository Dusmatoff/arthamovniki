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

function generate_artist_pictures_query( $artist_id, $who_can_see ) {
	global $current_user;
	$user_roles = $current_user->roles;

	if ( ! empty( $user_roles ) ) {
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ) {
			$args = [
				'post_type'      => 'picture',
				'posts_per_page' => - 1,
				'post_status'    => 'any',
				'meta_key'       => 'order_number',
				'orderby'        => [ 'meta_value_num' => 'ASC' ],
				'meta_query'     => [
					'relation' => 'AND',
					[ 'key' => 'artist', 'value' => $artist_id ],
					[ 'key' => 'who_can_see', 'value' => $who_can_see, 'compare' => '=' ],
				],
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
			[ 'key' => 'who_can_see', 'value' => $who_can_see, 'compare' => '=' ],
			[ 'key' => 'is_active', 'value' => '1' ],
			[ 'key' => 'artist', 'value' => $artist_id ],
		],
		'meta_key'       => 'order_number',
		'orderby'        => [ 'meta_value_num' => 'ASC' ],
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
                            <img src="<?php echo $image_src; ?>" alt="Автор">
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
					$museum_catalog = generate_artist_pictures_query( $artist_id, 'museum' );

					while ( $museum_catalog->have_posts() ) {
						$museum_catalog->the_post();
						get_template_part( 'loop-templates/content', 'loop-artist-picture' );
					}
					wp_reset_postdata();
					?>

					<?php
					$everyone_catalog = generate_artist_pictures_query( $artist_id, 'everyone' );

					while ( $everyone_catalog->have_posts() ) {
						$everyone_catalog->the_post();
						get_template_part( 'loop-templates/content', 'loop-artist-picture' );
					}
					wp_reset_postdata();
					?>

					<?php
					if ( ! empty( $user_roles ) ) {
						if ( in_array( 'um_partner', $user_roles ) ) {
							$everyone_catalog = generate_artist_pictures_query( $artist_id, 'partners' );

							while ( $everyone_catalog->have_posts() ) {
								$everyone_catalog->the_post();
								get_template_part( 'loop-templates/content', 'loop-artist-picture' );
							}
							wp_reset_postdata();
						}
					}
					?>

					<?php
					$hide_from_catalog = generate_artist_pictures_query( $artist_id, 'hide_from_catalog' );

					while ( $hide_from_catalog->have_posts() ) {
						$hide_from_catalog->the_post();
						get_template_part( 'loop-templates/content', 'loop-artist-picture' );
					}
					wp_reset_postdata();
					?>
                </div>
            </div>
        </div>
    </div>
</section>
