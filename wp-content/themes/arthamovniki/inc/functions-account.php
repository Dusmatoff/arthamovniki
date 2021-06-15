<?php
/****************************************************
 * AJAX Save account
 *****************************************************/
add_action( 'wp_ajax_save_account', 'save_account' );
function save_account() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['save_account_nonce'], 'save_account_action' ) ) {
		wp_send_json( [ 'result' => 'Bad nonce field' ], 400 );
	}

	$first_name   = $_POST['first_name'];
	$last_name    = $_POST['last_name'];
	$phone_number = $_POST['phone_number'];
	$user_country = $_POST['user_country'];
	$user_city    = $_POST['user_city'];
	$user_description    = $_POST['user_description'];
	$user_id      = $_POST['user_id'];

	try {
		update_user_meta( $user_id, 'first_name', $first_name );
		update_user_meta( $user_id, 'last_name', $last_name );
		update_user_meta( $user_id, 'phone_number', $phone_number );
		update_user_meta( $user_id, 'user_country', $user_country );
		update_user_meta( $user_id, 'user_city', $user_city );
		update_user_meta( $user_id, 'description', $user_description );
		update_user_meta( $user_id, 'owner_text', $user_description );

		wp_send_json( [ 'result' => 'Данные сохранены' ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}
/****************************************************
 * AJAX Save account
 *****************************************************/

/****************************************************
 * AJAX Change password
 *****************************************************/
add_action( 'wp_ajax_change_password', 'ajax_change_password' );
function ajax_change_password() {
	if ( wp_verify_nonce( $_POST['nonce'], 'change_password_action' ) ) {
		$current_password = $_POST['current_password'];
		$new_password     = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];

		if ( $new_password == $confirm_password ) {
			$user_id = $_POST['user_id'];
			$user    = get_user_by( 'ID', $user_id );

			if ( $user ) {
				$auth = wp_authenticate( $user->data->user_login, $current_password );

				if ( is_wp_error( $auth ) ) {
					wp_send_json( [ 'result' => 'Неправильный пароль' ], 400 );
				}

				try {
					wp_set_password( $new_password, $user->ID );
					wp_send_json( [ 'result' => 'Новый пароль сохранен' ], 200 );
				} catch ( Error $error ) {
					wp_send_json( [ 'result' => $error->getMessage() ], 400 );

				}
			}

			wp_send_json( [ 'result' => 'Пользователь не найден' ], 400 );
		}

		wp_send_json( [ 'result' => 'Пожалуйста подтвердите новый пароль.' ], 400 );
	}

	wp_send_json( [ 'result' => 'Bad nonce' ], 400 );
}
/****************************************************
 * AJAX Change password
 *****************************************************/