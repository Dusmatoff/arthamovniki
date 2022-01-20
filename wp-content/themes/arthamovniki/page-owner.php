<?php
/*
	Template Name: Страница владельца
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

global $current_user;
$user_roles = $current_user->roles;

$owner_id = $_GET['id'];

if ( empty( $owner_id ) ) {
	wp_safe_redirect( '/' );
}

$owner = get_user_by( 'ID', $owner_id );

$owner_title    = get_user_meta( $owner_id, 'owner_title', true );
$owner_subtitle = get_user_meta( $owner_id, 'owner_subtitle', true );
$owner_text     = get_user_meta( $owner_id, 'owner_text', true );

$is_admin = in_array('administrator', $user_roles);

function generate_owner_pictures_query( $owner_id, $who_can_see, $user_roles ) {
	if ( ! empty( $user_roles ) ) {
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ) {
			$args = [
				'post_type'      => 'picture',
				'posts_per_page' => - 1,
				'post_status'    => 'any',
				'author'         => $owner_id,
				'meta_key'       => 'order_number',
				'orderby'        => [ 'meta_value_num' => 'ASC' ],
				'meta_query'     => [
					'relation' => 'AND',
					[ 'key' => 'who_can_see', 'value' => $who_can_see, 'compare' => '=' ],
				]
			];

			return new WP_Query( $args );
		}
	}

	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
		'author'         => $owner_id,
		'meta_query'     => [
			'relation' => 'AND',
			[ 'key' => 'who_can_see', 'value' => $who_can_see, 'compare' => '=' ],
			[ 'key' => 'is_active', 'value' => '1' ],
		]
	];

	return new WP_Query( $args );
}

?>
    <section class="section-first product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__link">
                                <?php echo $owner->data->display_name; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owner">
						<?php if ( $owner_title ): ?>
                            <h1 class="owner__title">
								<?php echo $owner_title; ?>
                            </h1>
						<?php endif; ?>
						<?php if ( $owner_title ): ?>
                            <h1 class="owner__subtitle">
								<?php echo $owner_subtitle; ?>
                            </h1>
						<?php endif; ?>
                        <div class="owner__text">
                            <p><?php echo $owner_text; ?></p>
                        </div>
                    </div>

                    <div class="catalog-cards catalog-cards--middle">
						<?php
						$museum_catalog = generate_owner_pictures_query( $owner_id, 'museum', $user_roles );

						while ( $museum_catalog->have_posts() ) {
							$museum_catalog->the_post();
							get_template_part( 'loop-templates/content', 'loop-artist-picture' );
						}
						wp_reset_postdata();
						?>

						<?php
						$everyone_catalog = generate_owner_pictures_query( $owner_id, 'everyone', $user_roles );

						while ( $everyone_catalog->have_posts() ) {
							$everyone_catalog->the_post();
							get_template_part( 'loop-templates/content', 'loop-artist-picture' );
						}
						wp_reset_postdata();
						?>

						<?php
						if ( ! empty( $user_roles ) ) {
							if ( in_array( 'um_partner', $user_roles ) ) {
								$partners_catalog = generate_owner_pictures_query( $owner_id, 'partners', $user_roles );

								while ( $partners_catalog->have_posts() ) {
									$partners_catalog->the_post();
									get_template_part( 'loop-templates/content', 'loop-artist-picture' );
								}
								wp_reset_postdata();
							}
						}
						?>

						<?php
						$hide_from_catalog = generate_owner_pictures_query( $owner_id, 'hide_from_catalog', $user_roles );

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
<?php
get_footer();
