<?php
/*
	Template Name: Главная страница
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

global $current_user;
global $is_partner;

$title    = get_field( 'title' );
$subtitle = get_field( 'subtitle' );
$picture  = get_field( 'picture' );

$popup_title = get_field( 'popup_title' );
$popup_text  = get_field( 'popup_text' );

$pictures_gallery   = get_field( 'pictures_gallery' );
$pictures_recommend = get_field( 'pictures_recommend' );
$pictures_sea       = get_field( 'pictures_sea' );

function generate_wp_query( $count, $post_in, $user_roles ) {
	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => $count,
		'post__in'       => $post_in,
		'meta_query'     => [
			'relation' => 'AND',
			[ 'key' => 'is_active', 'value' => '1' ],
		]
	];

	if ( ! empty( $user_roles ) ) {
		//For partners
		if ( in_array( 'um_partner', $user_roles ) ) {
			$args['meta_query'] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
			];

			return new WP_Query( $args );
		}
	}

	//For subscribers
	$args['meta_query'] = [
		'relation' => 'AND',
		[ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => '=' ],
	];

	return new WP_Query( $args );
}

?>
    <div class="main-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
					<?php if ( $title ): ?>
                        <h1 class="main-section__title">
							<?php echo $title; ?>
                        </h1>
					<?php endif; ?>

					<?php if ( $is_partner ): ?>
                        <div class="main-section__subtitle">
                            Парнёрская версия
                        </div>
					<?php endif; ?>

					<?php if ( $subtitle ): ?>
                        <div class="main-section__text">
							<?php echo $subtitle; ?>
                        </div>
					<?php endif; ?>

					<?php if ( $popup_title && $popup_text ): ?>
                        <a href="#about-popup" data-fancybox class="btn btn--full btn--lg">Подробнее </a>
					<?php endif; ?>


					<?php if ( $picture ): ?>
                        <img class="main-section__img" src="<?php echo $picture; ?>" alt="?php echo $title; ?>">
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php if ( $pictures_gallery ): ?>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__header">
                        <h2 class="section__title">Галерея</h2>
                        <div class="section__notice"><span>Будьте в курсе </span></div>
                    </div>
                    <div class="product-cards">
                        <div class="row">
							<?php
							$query = generate_wp_query( 6, $pictures_gallery, $current_user->roles );
							$index = 0;

							while ( $query->have_posts() ):
								$query->the_post();
								$column = '6';

								if ( $index < 3 ) {
									$column = '4';
								} elseif ( $index === 3 ) {
									$column = '12';
								}
								$artist_id = get_field( 'artist' );
								$artist    = get_post( $artist_id );
								?>
                                <div class="col-lg-<?php echo $column; ?> col-md-6">
                                    <div class="product-card">
										<?php get_template_part( 'template-parts/favorite-button' ); ?>
                                        <a href="<?php echo get_permalink(); ?>" class="product-card__img">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                        </a>
                                        <p class="product-card__title">
                                            <a href="/artist/<?php echo $artist->post_name; ?>/" target="_blank">
												<?php echo $artist->post_title; ?>
                                            </a>
                                        </p>
                                        <div class="product-card__subtitle">
											<?php echo get_the_title(); ?>
                                        </div>
                                    </div>
                                </div>
								<?php $index ++; endwhile; ?>
                        </div>
                    </div>
                    <a href="/picture/" class="btn btn--border btn--lg product-cards-btn">Показать ещё</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $pictures_recommend ): ?>
    <section class="section section--grey">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__header">
                        <h2 class="section__title">Рекомендуем</h2>
                        <div class="section__notice"><span>Обратите внимание</span></div>
                    </div>
                    <div class="product-cards">
                        <div class="row">
							<?php
							$query = generate_wp_query( 5, $pictures_recommend, $current_user->roles );
							$index = 0;

							while ( $query->have_posts() ):
								$query->the_post();
								$artist_id = get_field( 'artist' );
								$artist    = get_post( $artist_id );
								?>
                                <div class="col-lg-<?php echo $index == 2 ? '12' : '6'; ?> col-md-6">
                                    <div class="product-card">
										<?php get_template_part( 'template-parts/favorite-button' ); ?>
                                        <a href="<?php echo get_permalink(); ?>" class="product-card__img">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                        </a>
                                        <p class="product-card__title">
                                            <a href="/artist/<?php echo $artist->post_name; ?>/" target="_blank">
												<?php echo $artist->post_title; ?>
                                            </a>
                                        </p>
                                        <div class="product-card__subtitle">
											<?php echo get_the_title(); ?>
                                        </div>
                                    </div>
                                </div>
								<?php $index ++; endwhile; ?>
                        </div>
                    </div>
                    <a href="/picture/" class="btn btn--border btn--lg product-cards-btn">Показать ещё</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $pictures_sea ): ?>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__header">
                        <h2 class="section__title">Морской пейзаж</h2>
                        <div class="section__notice"><span>Тематическая подборка</span></div>
                    </div>
                    <div class="product-cards">
                        <div class="row">
							<?php
							$query = generate_wp_query( 6, $pictures_sea, $current_user->roles );
							$index = 0;

							while ( $query->have_posts() ):
								$query->the_post();
								$column = 'col-12';

								if ( $index > 0 && $index < 3 ) {
									$column = 'col-lg-6 col-md-6';
								} elseif ( $index > 2 ) {
									$column = 'col-lg-4 col-md-6';
								}
								$artist_id = get_field( 'artist' );
								$artist    = get_post( $artist_id );
								?>
                                <div class="<?php echo $column; ?>">
                                    <div class="product-card">
										<?php get_template_part( 'template-parts/favorite-button' ); ?>
                                        <a href="<?php echo get_permalink(); ?>" class="product-card__img">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                        </a>
                                        <p class="product-card__title">
                                            <a href="/artist/<?php echo $artist->post_name; ?>/" target="_blank">
												<?php echo $artist->post_title; ?>
                                            </a>
                                        </p>
                                        <div class="product-card__subtitle">
											<?php echo get_the_title(); ?>
                                        </div>
                                    </div>
                                </div>
								<?php $index ++; endwhile; ?>
                        </div>
                    </div>
                    <a href="/picture/" class="btn btn--border btn--lg product-cards-btn">Показать ещё</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $popup_title && $popup_text ): ?>
    <div class="d-none">
        <div class="popup-about" id="about-popup">
            <div class="popup-about__title">
				<?php echo $popup_title; ?>
            </div>
            <div class="popup-about__text">
				<?php echo $popup_text; ?>
            </div>
            <button class="btn btn--full btn--lg close-modal" data-fancybox-close>Закрыть окно</button>
        </div>
    </div>
<?php endif; ?>
<?php
get_footer();
