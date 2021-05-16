<?php
function render_term_checkboxes( $termName ) {
	if ( $terms = get_terms( [
		'taxonomy'   => $termName,
		'orderby'    => 'name',
		'hide_empty' => false,
	] ) ) :

		foreach ( $terms as $term ) : ?>
            <label for="<?php echo $termName . '-' . $term->slug ?>"
                   class="filter__label"
            >
                <input class="filter__label-input"
                       type="checkbox"
                       name="<?php echo $termName ?>[]"
                       value="<?php echo $term->slug ?>"
                       id="<?php echo $termName . '-' . $term->slug ?>"
					<?php echo ! empty( $_GET ) && in_array( $term->slug, $_GET[ $termName ] ) ? 'checked' : ''; ?>
                >
                <div class="filter__label-text">
					<?php echo $term->name ?>
                </div>
            </label>
		<?php endforeach;
	endif;
}

function filter_picture_archive_query( $query ) {
	if ( $query->is_main_query() && is_post_type_archive( 'picture' ) ) {
		$args  = [
			'meta_query' => (array) $query->get( 'meta_query' ),
		];
		$price = $_GET['price'];
		$size  = $_GET['size'];
		$args  = get_products_meta_filter( $args, $price, $size );
		$query->set( 'meta_query', $args['meta_query'] );
	}
}

add_action( 'pre_get_posts', 'filter_picture_archive_query' );

function pictures_filter_ajax_handler() {
	check_ajax_referer( 'ajax_nonce' );
	$args = [
		'post_type'   => 'picture',
		'post_status' => 'publish',
	];
	//$args = get_products_title_filter($args, $_POST['title']);
	//$args = get_products_authors_filter($args, $_POST['author']);
	$args = get_products_meta_filter( $args, $_POST['price'], $_POST['size'] );
	$args = get_products_taxonomy_filter( $args, $_POST['picture_category'], $_POST['picture_subject'] );

	query_posts( $args );
	$allowedArgs = [
		'title',
		'author',
		'size',
		'price',
		'picture_category',
		'picture_subject',
	];
	set_query_var( 'paginationArgs', array_filter( array_intersect_key( $_POST, array_flip( $allowedArgs ) ) ) );

	while ( have_posts() ) :
		the_post();
		get_template_part( 'loop-templates/content-loop', 'artist-picture' );
	endwhile;
	custom_pagination();

	//get_template_part('loop-templates/loop-pictures');

	die;
}

add_action( 'wp_ajax_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );
add_action( 'wp_ajax_nopriv_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );

function get_products_meta_filter( $args, $price, $size ) {
	$meta_query   = isset( $args['meta_query'] ) ? $args['meta_query'] : [];
	$prices_array = [ '0', '50000', '100000', '301000' ];
	$sizes_array  = [ '0', '50', '100' ];

	if ( isset( $price ) && in_array( $price, $prices_array ) ) {
		if ( $price == 0 ) {
			$meta_query[] = [ 'key' => 'price', 'value' => [ '' ], 'compare' => 'NOT IN' ];
		} else {
		    if ($price == '50000'){
			    $meta_query[] = [ 'key' => 'price', 'value' => $price, 'compare' => '<=', 'type' => 'numeric' ];
            }

			if ($price == '100000'){
				$meta_query[] = [ 'key' => 'price', 'value' => [ '50000', '100000' ], 'compare' => 'BETWEEN', 'type' => 'numeric' ];
			}

			if ($price == '301000'){
				$meta_query[] = [ 'key' => 'price', 'value' => '300000', 'compare' => '>=', 'type' => 'numeric' ];
			}
		}
	}

	if ( isset( $size ) && in_array( $size, $sizes_array ) ) {
		if ( $size == 0 ) {
			$meta_query[] = [
				'relation' => 'AND',
				[
					'key'     => 'width',
					'value'   => [ 1, 50 ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric',
				],
				[
					'key'     => 'length',
					'value'   => [ 1, 50 ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric',
				],
			];
		}

		if ( $size == 50 ) {
			$meta_query[] = [
				'relation' => 'OR',
				[
					'relation' => 'AND',
					[ 'key' => 'width', 'value' => [ 1, 100 ], 'compare' => 'BETWEEN', 'type' => 'numeric' ],
					[ 'key' => 'length', 'value' => [ 51, 100 ], 'compare' => 'BETWEEN', 'type' => 'numeric' ],
				],
				[
					'relation' => 'AND',
					[ 'key' => 'width', 'value' => [ 51, 100 ], 'compare' => 'BETWEEN', 'type' => 'numeric' ],
					[ 'key' => 'length', 'value' => [ 1, 100 ], 'compare' => 'BETWEEN', 'type' => 'numeric', ],
				],
			];
		}

		if ( $size == 100 ) {
			$meta_query[] = [
				'relation' => 'OR',
				[ 'key' => 'width', 'value' => 100, 'compare' => '>', 'type' => 'numeric' ],
				[ 'key' => 'length', 'value' => 100, 'compare' => '>', 'type' => 'numeric' ],
			];
		}
	}

	if ( count( $meta_query ) ) {
		$args['meta_query'] = $meta_query;
	}

	return $args;
}

function get_products_taxonomy_filter( $args, $pictureCategories, $pictureSubjs ) {
	$tax = isset( $args['tax_query'] ) ? $args['tax_query'] : [];

	if ( $pictureCategories && is_array( $pictureCategories ) ) {
		$tax[] = [
			'taxonomy' => 'picture_category',
			'field'    => 'slug',
			'terms'    => $pictureCategories,
		];
	}

	if ( $pictureSubjs && is_array( $pictureSubjs ) ) {
		$tax[] = [
			'taxonomy' => 'picture_subject',
			'field'    => 'slug',
			'terms'    => $pictureSubjs,
		];
	}

	if ( count( $tax ) ) {
		$args['tax_query'] = $tax;
	}

	return $args;
}

/*
function empty_author_value($value, $post_id, $field)
{
	$user = new WP_User($value);
	if ($user && in_array('um_artist', $user->roles)) {
		return $value;
	}
	return null;
}

add_filter('acf/load_value/name=author', 'empty_author_value', 10, 3);

add_filter( 'posts_where', 'like_title_posts_where', 10, 2 );
function like_title_posts_where( $where, $wp_query ) {
	global $wpdb;
	if ( $like_title = $wp_query->get( 'like_title' ) ) {
		$like_title = trim( $like_title );
		$where      .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $like_title ) ) . '%\'';
	}

	return $where;
}

function get_products_authors_filter( $args, $author ) {
	if ( ! $author ) {
		return $args;
	}
	$author               = trim( $author );
	$users                = get_users( [
		'search'         => '*' . $author . '*',
		'search_columns' => [
			'login',
			'nicename',
		],
		'fields'         => 'ID',
	] );
	$args['meta_query'][] = [
		'key'     => 'author',
		'value'   => $users,
		'compare' => 'IN',
	];

	return $args;
}


function get_products_title_filter( $args, $title ) {
	if ( $title ) {
		$args['like_title'] = $title;
	}

	return $args;
}
*/