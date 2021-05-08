<?php
$args = [
	'post_type'      => 'picture',
	'posts_per_page' => 6,
	'post_status'    => 'publish',
	'orderby'        => 'rand',
	'post__not_in'   => [ $post->ID ],
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'   => 'is_active',
			'value' => 1
		],
	]
];

$query = new WP_Query( $args );
?>
    <section class="section section--grey">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__header">
                        <h2 class="section__title">Рекомендуемые картины</h2>
                        <div class="section__notice">
                            <span>Обратите внимание</span>
                        </div>
                    </div>
                    <div class="product-cards">
                        <div class="row">
							<?php
                                while ( $query->have_posts() ) {
                                    $query->the_post();

                                    get_template_part( 'loop-templates/content', 'loop-picture' );
                                }

							    wp_reset_postdata();
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
wp_reset_postdata();