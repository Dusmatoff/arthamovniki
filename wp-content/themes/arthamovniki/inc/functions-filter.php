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
					<?php echo ! empty( $_GET ) && isset( $_GET[ $termName ] ) && in_array( $term->slug, $_GET[ $termName ] ) ? 'checked' : ''; ?>
                >
                <div class="filter__label-text">
					<?php echo $term->name ?>
                </div>
            </label>
		<?php endforeach;
	endif;
}

function render_term_radio( $termName ) {
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
                       type="radio"
                       name="<?php echo $termName ?>[]"
                       value="<?php echo $term->slug ?>"
                       id="<?php echo $termName . '-' . $term->slug ?>"
					<?php echo ! empty( $_GET ) && isset( $_GET[ $termName ] ) && in_array( $term->slug, $_GET[ $termName ] ) ? 'checked' : ''; ?>
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
    $enable_numeric_sort = get_option('options_enable_numeric_sort');

	if ( $query->is_main_query() && is_post_type_archive( 'picture' ) && ! is_admin() ) {
		$args  = [ 'meta_query' => (array) $query->get( 'meta_query' ) ];
		$price = isset( $_GET['price'] ) ? $_GET['price'] : null;
		$size  = isset( $_GET['size'] ) ? $_GET['size'] : null;
		$see = isset($_GET['see']) ? $_GET['see'] : 'everyone';
		$args  = get_products_meta_filter( $args, $price, $size, $current_user->roles );
		$query->set( 'meta_query', $args['meta_query'] );

        if ($enable_numeric_sort) {
	        $query->set('orderby', 'meta_value_num');
	        $query->set('meta_key', 'order_number');
	        $query->set('order', 'ASC');
        }
	}

	if ( $query->is_main_query() && is_post_type_archive( 'artist' ) && ! is_admin() ) {
		if ($enable_numeric_sort) {
			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', 'order_number');
			$query->set('order', 'ASC');
		}
	}

}

add_action( 'pre_get_posts', 'filter_picture_archive_query' );

function pictures_filter_ajax_handler() {
	check_ajax_referer( 'ajax_nonce' );

	global $current_user;

	$args = [
		'post_type'   => 'picture',
		'post_status' => 'publish',
		'meta_key'    => 'order_number',
		'orderby'     => 'meta_value_num',
		'order'       => 'ASC',
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
	get_template_part( 'loop-templates/loop-pictures' );
	die();
}

add_action( 'wp_ajax_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );
add_action( 'wp_ajax_nopriv_pictures_filter_ajax_handler', 'pictures_filter_ajax_handler' );

function get_products_meta_filter( $args, $price, $size, $user_roles = [] ) {
	$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : [];
	//Only active pictures
	$meta_query[] = [ 'relation' => 'AND', [ 'key' => 'is_active', 'value' => '1' ] ];

	if ( $price !== null ) {
		if ( ! is_array( $price ) ) {
			if ( $price === '50' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => '50000',
					'compare' => '<=',
					'type'    => 'numeric'
				];
			}

			if ( $price === '50_150' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '50000', '150000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price === '150_400' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '150000', '400000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price === '400_1m' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => [ '400000', '1000000' ],
					'compare' => 'BETWEEN',
					'type'    => 'numeric'
				];
			}

			if ( $price === '1m' ) {
				$meta_query[] = [
					'key'     => 'our_price_in_filter',
					'value'   => '1000000',
					'compare' => '>=',
					'type'    => 'numeric'
				];
			}

			//$meta_query[] = [ 'key' => 'our_price_in_filter', 'value' => [ '' ], 'compare' => 'NOT IN' ];
		} else {
			$between_array = [ 'relation' => 'OR' ];

			foreach ( $price as $item ) {
				switch ( $item ) {
					case '50':
						$result = [
							'key'     => 'our_price_in_filter',
							'value'   => 50000,
							'compare' => '<=',
							'type'    => 'numeric'
						];
						array_push( $between_array, $result );
						break;
					case '50_150':
						$result = [
							'key'     => 'our_price_in_filter',
							'value'   => [ 50000, 150000 ],
							'compare' => 'BETWEEN',
							'type'    => 'numeric'
						];
						array_push( $between_array, $result );
						break;
					case '150_400':
						$result = [
							'key'     => 'our_price_in_filter',
							'value'   => [ 150000, 400000 ],
							'compare' => 'BETWEEN',
							'type'    => 'numeric'
						];
						array_push( $between_array, $result );
						break;
					case '400_1m':
						$result = [
							'key'     => 'our_price_in_filter',
							'value'   => [ 400000, 1000000 ],
							'compare' => 'BETWEEN',
							'type'    => 'numeric'
						];
						array_push( $between_array, $result );
						break;
					case '1m':
						$result = [
							'key'     => 'our_price_in_filter',
							'value'   => 1000000,
							'compare' => '>',
							'type'    => 'numeric'
						];
						array_push( $between_array, $result );
						break;
				}
			}

			array_push( $meta_query, $between_array );
		}
	}

	if ( $size !== null ) {
		if ( ! is_array( $size ) ) {
			if ( $size == 1 ) {
				$meta_query[] = [
					'relation' => 'OR',
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
						'key'     => 'width',
						'value'   => [ 50, 100 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 50, 100 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}

			if ( $size == 100 ) {
				$meta_query[] = [
					'relation' => 'OR',
					[
						'key'     => 'width',
						'value'   => [ 100, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 100, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}
		} else {
			if ( count( $size ) === 3 && in_array( 1, $size ) && in_array( 50, $size ) && in_array( 100, $size ) ) {
				$meta_query[] = [
					'relation' => 'OR',
					[
						'key'     => 'width',
						'value'   => [ 1, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 1, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}

			if ( count( $size ) === 2 && in_array( 1, $size ) && in_array( 50, $size ) ) {
				$meta_query[] = [
					'relation' => 'OR',
					[
						'key'     => 'width',
						'value'   => [ 1, 100 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 1, 100 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}

			if ( count( $size ) === 2 && in_array( 1, $size ) && in_array( 100, $size ) ) {
				$meta_query[] = [
					'relation' => 'OR',
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
					[
						'key'     => 'width',
						'value'   => [ 100, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 100, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}

			if ( count( $size ) === 2 && in_array( 50, $size ) && in_array( 100, $size ) ) {
				$meta_query[] = [
					'relation' => 'OR',
					[
						'key'     => 'width',
						'value'   => [ 50, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
					[
						'key'     => 'length',
						'value'   => [ 50, 1000 ],
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					],
				];
			}
		}
	}

	if ( ! empty( $user_roles ) ) {
		if ( in_array( 'administrator', $user_roles ) || in_array( 'editor', $user_roles ) || in_array( 'um_partner', $user_roles ) ) {
			$meta_query[] = [
				'relation' => 'AND',
				[ 'key' => 'who_can_see', 'value' => [ 'partners', 'everyone' ], 'compare' => 'IN' ],
			];

			$args['meta_query'] = $meta_query;

			return $args;
		}
	}

	//For subscribers
	$meta_query[] = [ 'relation' => 'AND', [ 'key' => 'who_can_see', 'value' => 'everyone', 'compare' => '=' ] ];

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
