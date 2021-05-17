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
							<span class="breadcrumbs__link">Картины</span>
						</li>
					</ul>
				</div>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="row">
					<div class="col-lg-3">
						<?php get_template_part('template-parts/picture-filter'); ?>
					</div>
					<div class="col-9">
						<div class="catalog-cards">
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'loop-templates/content-loop', 'artist-picture' );
							endwhile;
							custom_pagination();
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
