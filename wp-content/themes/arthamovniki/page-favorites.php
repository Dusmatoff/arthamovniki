<?php
/*
	Template Name: Избранное
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $current_user;

get_header();
?>
    <section class="section-first product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item">
                            <a href="" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__link">Избранное</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <p>Напоминаем вам если вы не зарегистрированы на сайте, раздел избранное создаётся с помощью файлов
                    Cookies Эти файлы позволяют сайту узнавать пользователя без регистрации, но после удаления вами
                    файлов Cookies на вашем компьютере, добавленные вами в избранное картины могут не сохраниться.</p>
                <div class="col-12">
					<?php
					$favorite_properties  = get_favorites( $current_user->ID );
					$number_of_properties = count( $favorite_properties );
					$show_favorite        = true;

					if ( $number_of_properties > 0 ): ?>
                    <div class="lk">
                        <div class="lk__header">
                            <div class="lk__title">
                                Избранное – <?php echo $number_of_properties; ?>
                            </div>
                            <!--<a href="#action-popup" data-fancybox class="btn btn--dynamic btn--full">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Очистить избранное
                            </a>
                            -->
                        </div>
                    </div>
                    <div class="catalog-cards catalog-cards--middle">
						<?php
						$favorites_properties_args = [
							'post_type'      => 'picture',
							'post_status'    => [ 'publish' ],
							'posts_per_page' => $number_of_properties,
							'post__in'       => $favorite_properties,
							'orderby'        => 'post__in',
						];

						$favorites_query = new WP_Query( $favorites_properties_args );

						if ( $favorites_query->have_posts() ) :
							while ( $favorites_query->have_posts() ) :
								$favorites_query->the_post();
								get_template_part( 'loop-templates/content', 'loop-artist-picture' );
							endwhile;
							wp_reset_query();
						else:
							?>
                            <div class="alert alert-warning" role="alert">
                                <h4>Ничего не найдено</h4>
                            </div>
						<?php
						endif;
						else:
							?>
                            <div class="alert alert-warning" role="alert">
                                <h3>Вы пока не добавили ничего в избранное</h3>
                            </div>
						<?php
						endif;
						?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
