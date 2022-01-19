<?php
/*
	Template Name: Общий каталог
*/

get_header();

$default_posts_per_page = get_option( 'posts_per_page' );

$args = [
	'post_type'      => 'picture',
	'posts_per_page' => $default_posts_per_page,
	'meta_query'     => [
		'relation' => 'AND',
		[ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => '=' ],
		[ 'key' => 'is_active', 'value' => '1' ],
	],
	'meta_key'       => 'order_number',
	'orderby'        => [ 'meta_value_num' => 'ASC' ],
];

$query = new WP_Query( $args );
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
							<span class="breadcrumbs__link">Общий каталог</span>
						</li>
					</ul>
					<h1 class="text-center mb-4">
                        Общий каталог
					</h1>
				</div>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="row">
					<div class="col-lg-3">
						<?php get_template_part( 'template-parts/picture-filter' ); ?>
					</div>
					<div class="col-9 catalog-col-xs-12">
						<div class="catalog-cards">
							<?php
							$url = home_url( 'catalog-everyone' );

							hamovniki_pagination( [
								'base'     => $url . '/%_%',
								'add_args' => get_query_var( 'paginationArgs' )
							] );

							while ( $query->have_posts() ) :
								$query->the_post();
								get_template_part( 'loop-templates/content-loop', 'artist-picture' );
							endwhile;

							wp_reset_postdata();

							hamovniki_pagination( [
								'base'     => $url . '/%_%',
								'add_args' => get_query_var( 'paginationArgs' )
							] );
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php
get_footer();
