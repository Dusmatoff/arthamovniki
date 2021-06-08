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

		return true;
	} else {
		if ( ! isset( $_COOKIE['hamovniki_fav'] ) ) {
			setcookie( 'hamovniki_fav', json_encode( [ $postId ] ), strtotime( '+1 year' ), '/', $_SERVER['HTTP_HOST'] );
		} else {
			$old_favorites   = json_decode( $_COOKIE['hamovniki_fav'], true );
			$old_favorites[] = $postId;
			setcookie( 'hamovniki_fav', json_encode( $old_favorites ), strtotime( '+1 year' ), '/', $_SERVER['HTTP_HOST'] );
		}

		return true;
	}
}

function delete_from_favorites( $postId, $userId ) {
	if ( $userId != '0' ) {
		$favorites = get_user_meta( $userId, 'favorite_pictures', true );

		if ( ! $favorites ) {
			return true;
		}

		if ( ( $key = array_search( $postId, $favorites ) ) !== false ) {
			unset( $favorites[ $key ] );
		}
		update_user_meta( $userId, 'favorite_pictures', $favorites );
	} else {
		$favorites = json_decode( $_COOKIE['hamovniki_fav'], true );
		if ( ( $key = array_search( $postId, $favorites ) ) !== false ) {
			unset( $favorites[ $key ] );
		}
		setcookie( 'hamovniki_fav', json_encode( $favorites ), strtotime( '+1 year' ), '/', $_SERVER['HTTP_HOST'] );
	}

	return true;
}

function get_favorites( $userId ) {
	if ( $userId == '0' ) {
		if ( isset( $_COOKIE['hamovniki_fav'] ) ) {
			return json_decode( $_COOKIE['hamovniki_fav'] );
		}
	}

	$favorites = get_user_meta( $userId, 'favorite_pictures', true );

	return $favorites == '' ? [] : $favorites;
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
		echo 'Ошибка';
	}

	die;
}

add_action( 'wp_ajax_picture_favorite_ajax_handler', 'picture_favorite_ajax_handler' );
add_action( 'wp_ajax_nopriv_picture_favorite_ajax_handler', 'picture_favorite_ajax_handler' );