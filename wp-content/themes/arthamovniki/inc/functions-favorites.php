<?php

function add_to_favorites( $postId, $userId ) {
	if ( $userId != '0' ) {
		$favorites = get_user_meta( $userId, 'favorite_pictures', true );

		if ( ! $favorites ) {
			$favorites = [];
		}

		if ( ! in_array( $postId, $favorites ) ) {
			$favorites[] = $postId;
		}

		update_user_meta( $userId, 'favorite_pictures', $favorites );
	} else {
		//TODO Add to cookie
		$favorites = $_COOKIE['favorite_pictures'];
		if ( ! isset( $_COOKIE['favorite_pictures'] ) ) {
			setcookie( 'favorite_pictures', $postId, time() + 31556926 );
		}
	}

	return $favorites;
}

function delete_from_favorites( $postId, $userId ) {
	if ( ! $userId ) {
		$userId = get_current_user_id();
	}
	$favorites = get_user_meta( $userId, 'favorite_pictures', true );
	if ( ! $favorites ) {
		return true;
	}
	if ( ( $key = array_search( $postId, $favorites ) ) !== false ) {
		unset( $favorites[ $key ] );
	}
	update_user_meta( $userId, 'favorite_pictures', $favorites );

	return true;
}

function get_favorites( $userId ) {
	if ( ! $userId ) {
		//TODO Get from cookie
		$favorites = '';
	}

	$favorites = get_user_meta( $userId, 'favorite_pictures', true );

	if ( ! $favorites ) {
		$favorites = [];
	}

	return $favorites;
}

function picture_in_favorites( $postId, $userId ) {
	$favorites = get_favorites( $userId );

	return in_array( $postId, $favorites );
}

function picture_favorite_ajax_handler() {
	check_ajax_referer( 'ajax_nonce' );

	$favorite_properties       = [ $_POST['picture'] ];
	$user_id                   = $_POST['user'];
	$favorites_properties_args = [
		'post_type'      => 'picture',
		'posts_per_page' => 1,
		'post__in'       => $favorite_properties,
	];

	$favorites_query = new WP_Query( $favorites_properties_args );

	if ( $favorites_query->have_posts() ) {
		while ( $favorites_query->have_posts() ) {
			$favorites_query->the_post();
			global $post;
			if ( picture_in_favorites( $post->ID, $user_id ) ) {
				delete_from_favorites( $post->ID, $user_id );
			} else {
				add_to_favorites( $post->ID, $user_id );
			}
			get_template_part( 'template-parts/favorite-button' );
		}
		wp_reset_query();
	} else {
		echo "Ошибка";
	}

	die;
}

add_action( 'wp_ajax_picture_favorite_ajax_handler', 'picture_favorite_ajax_handler' );