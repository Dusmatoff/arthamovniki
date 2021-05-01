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
	$user_id      = $_POST['user_id'];

	try {
		update_user_meta( $user_id, 'first_name', $first_name );
		update_user_meta( $user_id, 'last_name', $last_name );
		update_user_meta( $user_id, 'phone_number', $phone_number );
		update_user_meta( $user_id, 'user_country', $user_country );
		update_user_meta( $user_id, 'user_city', $user_city );

		wp_send_json( [ 'result' => 'Данные сохранены' ], 200 );
	} catch ( Error $error ) {
		wp_send_json( [ 'result' => $error->getMessage() ], 400 );
	}
}
/****************************************************
 * AJAX Save account
 *****************************************************/