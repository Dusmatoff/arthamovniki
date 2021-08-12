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
	global $current_user;

	if ( $query->is_main_query() && is_post_type_archive( 'picture' ) && ! is_admin() ) {
		$args  = [
			'meta_query' => (array) $query->get( 'meta_query' ),
		];
		$price = isset( $_GET['price'] ) ? $_GET['price'] : 'any';
		$size  = isset( $_GET['size'] ) ? $_GET['size'] : 'any';
		$args  = get_products_meta_filter( $args, $price, $size, $current_user->roles );
		$query->set( 'meta_query', $args['meta_query'] );
	}
}

add_action( 'pre_get_posts', 'filter_picture_archive_query' );

function pictures_filter_ajax_handler() {
	check_ajax_referer( 'ajax_nonce' );

	global $current_user;

	$args = [
		'post_type'   => 'picture',
		'post_status' => 'publish',
	];
	//$args = get_products_title_filter($args, $_POST['title']);
	//$args = get_products_authors_filter($args, $_POST['author']);
	$args = get_products_meta_filter( $args, $_POST['price'], $_POST['size'], $current_user->roles );
	$args = get_products_taxonomy_filter( $args, $_POST['picture_category'], $_POST['picture_subject'] );

	$result      = query_posts( $args );
	$allowedArgs = [
		'size',
		'price',
		'picture_category',
		'picture_subject',
	];
	set_query_var( 'paginationArgs', array_filter( array_intersect_key( $_POST, array_flip( $allowedArgs ) ) ) );
	get_template_part('loop-templates/loop-pictures');
	die();
}

add_action( 'wp_ajax_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );
add_action( 'wp_ajax_nopriv_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );

function get_products_meta_filter( $args, $price, $size, $user_roles = [] ) {
	$meta_query   = isset( $args['meta_query'] ) ? $args['meta_query'] : [];
	$prices_array = [ '0', '50000', '50000_150000', '150000_400000', '400000_1000000', '1000001' ];
	$sizes_array  = [ '0', '50', '100' ];

	//Only active pictures
	$meta_query[] = [
		'relation' => 'AND',
		[ 'key' => 'is_active', 'value' => '1' ],
	];

	if ( isset( $price ) && in_array( $price, $prices_array ) ) {
		if ( $price == 0 ) {
			$meta_query[] = [ 'key' => 'our_price_in_filter', 'value' => [ '' ], 'compare' => 'NOT IN' ];
		} else {
			if ( $price == '50000' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => $price,
					'compare' => '<=',
					'type'    => 'numeric'
				];
			}

			if ( $price == '50000_150000' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '50000', '150000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price == '150000_400000' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '150000', '400000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price == '400000_1000000' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '400000', '1000000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price == '1000001' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => '1000000',
					'compare' => '>',
					'type'    => 'numeric'
				];
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

	if ( ! empty( $user_roles ) ) {
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) ||  in_array( 'um_partner', $user_roles ) ) {
			$meta_query[] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
			];

			$args['meta_query'] = $meta_query;

			return $args;
		}
	}

	//For subscribers
	$meta_query[] = [
		'relation' => 'AND',
		[ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => '=' ],
	];

	$args['meta_query'] = $meta_query;

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