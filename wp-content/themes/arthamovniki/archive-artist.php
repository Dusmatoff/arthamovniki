<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Art_Hamovniki
 */

get_header();
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
                            <span class="breadcrumbs__link">Авторы</span>
                        </li>
                    </ul>
                </div>
            </div>
			<?php if ( have_posts() ) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="authors">
							<?php
							$url = home_url('picture');
							hamovniki_pagination([
								'base' => $url . '/%_%',
								'add_args' => get_query_var('paginationArgs')
							]);

							while ( have_posts() ) :
								the_post();
								get_template_part( 'loop-templates/content-loop', 'artist' );
							endwhile;

							hamovniki_pagination([
								'base' => $url . '/%_%',
								'add_args' => get_query_var('paginationArgs')
							]);

							wp_reset_postdata();
							?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </section>
<?php
get_footer();
