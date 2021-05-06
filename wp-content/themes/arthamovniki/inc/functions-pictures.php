<?php
/****************************************************
 * AJAX Add picture
 *****************************************************/
add_action( 'wp_ajax_add_picture', 'add_picture' );
function add_picture() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['add_picture_nonce'], 'add_picture_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	if ( empty( $_FILES ) || empty( $_FILES['images0'] ) ) {
		wp_send_json( [ 'result' => 'Добавьте фотографии' ], 400 );
	}

	$user_id = $_POST['user_id'];

	try {
		$post_data = [
			'post_title'   => wp_strip_all_tags( $_POST['picture_name'] ),
			'post_status'  => 'publish',
			'post_author'  => $user_id,
			'post_type'    => 'picture',
		];

		$post_id = wp_insert_post( $post_data );

		if ( $post_id > 0 ) {
			//Привязка таксономий
			$categories = empty( $_POST['categories'] ) ? [] : explode( ',', $_POST['categories'] );
			$subjects   = empty( $_POST['subjects'] ) ? [] : explode( ',', $_POST['subjects'] );
			$techniques = empty( $_POST['techniques'] ) ? [] : explode( ',', $_POST['techniques'] );
			wp_set_object_terms( $post_id, $categories, 'picture_category' );
			wp_set_object_terms( $post_id, $subjects, 'picture_subject' );
			wp_set_object_terms( $post_id, $techniques, 'picture_technique' );

			add_post_meta( $post_id, 'who_can_see', $_POST['who_can_see'] );
			add_post_meta($post_id, 'owner_description', $_POST['description']);
			add_post_meta($post_id, 'manager_description', $_POST['description']);

			if ( ! empty( $_POST['artist_name'] ) ) {
				//Add new artist
				$artist_data = [
					'post_title'   => wp_strip_all_tags( $_POST['artist_name'] ),
					'post_content' => $_POST['artist_description'],
					'post_status'  => 'publish',
					'post_author'  => $user_id,
					'post_type'    => 'artist'
				];

				$artist_id = wp_insert_post( $artist_data );

				if ( $artist_id > 0 ) {
					//Add artist picture
					if ( ! empty( $_FILES['artist_picture'] ) ) {
						$attachment_id = media_handle_upload( 'artist_picture', 0 );
						set_post_thumbnail( $artist_id, $attachment_id );

						if ( is_wp_error( $attachment_id ) ) {
							wp_send_json( [ 'result' => 'Ошибка добавления фото художника.' ], 400 );
						}
					}

					add_post_meta( $artist_id, 'artist_birth_death', $_POST['artist_birth_death'] );
					add_post_meta( $artist_id, 'artist_address', $_POST['artist_address'] );

					add_post_meta( $post_id, 'artist', $artist_id );
				} else {
					wp_send_json( [ 'result' => 'Ошибка добавления художника.' ], 400 );
				}
			} else {
				add_post_meta( $post_id, 'artist', $_POST['artist'] );
			}

			add_post_meta( $post_id, 'price', $_POST['price'] );
			add_post_meta( $post_id, 'year', $_POST['year'] );
			add_post_meta( $post_id, 'width', $_POST['width'] );
			add_post_meta( $post_id, 'length', $_POST['length'] );

			//Галерея
			$images_array = [];
			foreach ( $_FILES as $key => $value ) {
				if ( $key != 'artist_picture' ) {
					//Добавляем фотографии только для картины
					$attachment_id = media_handle_upload( $key, 0 );

					if ( $key == 'images0' ) {
						set_post_thumbnail( $post_id, $attachment_id );
					}

					if ( is_wp_error( $attachment_id ) ) {
						wp_send_json( [ 'result' => 'Ошибка добавления фото картины' ], 400 );
					}

					array_push( $images_array, $attachment_id );
				}
			}
			add_post_meta( $post_id, 'images', $images_array );
		}

		wp_send_json( [ 'result' => 'Картина добавлена' ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}

/****************************************************
 * AJAX Add picture
 *****************************************************/

/****************************************************
 * AJAX Edit picture
 *****************************************************/
add_action( 'wp_ajax_edit_picture', 'edit_picture' );
function edit_picture() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['edit_picture_nonce'], 'edit_picture_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	if ( empty( $_FILES ) || empty( $_FILES['images0'] ) ) {
		wp_send_json( [ 'result' => 'Добавьте фотографии' ], 400 );
	}

	$user_id    = $_POST['user_id'];
	$picture_id = $_POST['picture_id'];

	try {
		$post_id = wp_update_post( [
			'ID'           => $picture_id,
			'post_title'   => wp_strip_all_tags( $_POST['picture_name'] ),
		], true );


		if ( $post_id > 0 ) {
			$categories = empty( $_POST['categories'] ) ? [] : explode( ',', $_POST['categories'] );
			$subjects   = empty( $_POST['subjects'] ) ? [] : explode( ',', $_POST['subjects'] );
			$techniques = empty( $_POST['techniques'] ) ? [] : explode( ',', $_POST['techniques'] );
			wp_set_object_terms( $post_id, $categories, 'picture_category' );
			wp_set_object_terms( $post_id, $subjects, 'picture_subject' );
			wp_set_object_terms( $post_id, $techniques, 'picture_technique' );

			update_post_meta($post_id, 'owner_description', $_POST['description']);
			//update_post_meta($post_id, 'manager_description', $_POST['description']);
			update_post_meta( $post_id, 'who_can_see', $_POST['who_can_see'] );
			update_post_meta( $post_id, 'price', $_POST['price'] );
			update_post_meta( $post_id, 'year', $_POST['year'] );
			update_post_meta( $post_id, 'width', $_POST['width'] );
			update_post_meta( $post_id, 'length', $_POST['length'] );

			//Галерея
			$images_array = [];
			foreach ( $_FILES as $key => $value ) {
				$attachment_id = media_handle_upload( $key, 0 );

				if ( $key == 'images0' ) {
					set_post_thumbnail( $post_id, $attachment_id );
				}

				if ( is_wp_error( $attachment_id ) ) {
					wp_send_json( [ 'result' => 'Ошибка добавления фото картины' ], 400 );
				}

				array_push( $images_array, $attachment_id );
			}
			update_post_meta( $post_id, 'images', $images_array );
		}

		wp_send_json( [ 'result' => 'Картина изменена' ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}

/****************************************************
 * AJAX Edit picture
 *****************************************************/

/****************************************************
 * AJAX Delete picture
 *****************************************************/
add_action( 'wp_ajax_delete_picture', 'delete_picture' );
function delete_picture() {
	//check nonce field
	if ( empty( $_GET ) || ! wp_verify_nonce( $_GET['nonce'], 'delete_picture_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	$id = $_GET['id'];

	$deleted = wp_delete_post( $id, true );

	if ( $deleted ) {
		$attachments = get_posts(
			[
				'post_type'      => 'attachment',
				'posts_per_page' => - 1,
				'post_status'    => 'any',
				'post_parent'    => $_GET['id'],
			]
		);

		foreach ( $attachments as $attachment ) {
			wp_delete_attachment( $attachment->ID );
		}

		wp_send_json( [ 'result' => 'Картина с id: ' . $id . ' удалена.' ], 200 );
	}

	wp_send_json( [ 'result' => 'Ошибка. Попробуйте еще раз.' ], 400 );
}

/****************************************************
 * AJAX Delete picture
 *****************************************************/

/****************************************************
 * AJAX Change picture status
 *****************************************************/
add_action( 'wp_ajax_change_picture_status', 'change_picture_status' );
function change_picture_status() {
	//check nonce field
	if ( empty( $_GET ) || ! wp_verify_nonce( $_GET['nonce'], 'status_picture_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	$is_active = get_field( 'is_active', $_GET['id'] );

	try {
		update_post_meta( $_GET['id'], 'is_active', ! $is_active );

		wp_send_json( [ 'result' => 1 ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}

/****************************************************
 * AJAX Change picture status
 *****************************************************/

/****************************************************
 * AJAX Change picture visibility
 *****************************************************/
add_action( 'wp_ajax_change_picture_visibility', 'change_picture_visibility' );
function change_picture_visibility() {
	//check nonce field
	if ( empty( $_GET ) || ! wp_verify_nonce( $_GET['nonce'], 'status_picture_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	try {
		update_post_meta( $_GET['id'], 'who_can_see', $_GET['visibilityName'] );

		wp_send_json( [ 'result' => 1 ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}
/****************************************************
 * AJAX Change picture visibility
 *****************************************************/