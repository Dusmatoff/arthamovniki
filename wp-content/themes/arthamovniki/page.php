<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
                                <span class="breadcrumbs__link"><?php the_title(); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
            </div>
        </section>

<?php
//get_sidebar();
get_footer();
