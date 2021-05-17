<?php
/*
	Template Name: Изменить пароль
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $current_user;

if ( ! $current_user->exists() ) {
	wp_safe_redirect( '/' );
}

get_header();

$user_id      = $current_user->ID;
$first_name   = get_user_meta( $user_id, 'first_name', true );
$last_name    = get_user_meta( $user_id, 'last_name', true );
?>

	<section class="section-first product">
		<div class="container">
			<?php require_once 'template-parts/breadcrumb.php'; ?>
			<div class="row">
				<div class="col-12">
					<div class="lk">
						<div class="lk__header">
							<div class="lk__title">
								<?php the_title(); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="lk__user">
								<?php echo "$first_name $last_name"; ?>
							</div>
							<a href="" class="lk__link">
							<span>
								Просмотр профиля
							</span>
							</a>
							<?php profile_navigation( 4 ); ?>
						</div>
						<div class="col-lg-8">
							<form class="form" id="change_password_form" action="" method="POST">
								<div class="form__row">
									<div class="form__field-label">
										Текущий пароль
									</div>
									<div class="form__field form__field--grey">
										<input type="password"
										       name="current_password"
										       class="form__field-input"
										       required
										>
									</div>
								</div>
								<div class="form__row">
									<div class="form__field-label">
										Новый пароль
									</div>
									<div class="form__field form__field--grey">
										<input type="password"
										       name="new_password"
										       id="new_password"
										       class="form__field-input"
										       required
										>
									</div>
								</div>
								<div class="form__row">
									<div class="form__field-label">
										Повторите новый пароль
									</div>
									<div class="form__field form__field--grey">
										<input type="password"
										       name="confirm_password"
										       id="confirm_password"
										       class="form__field-input"
										       required
										>
									</div>
								</div>

								<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
								<?php wp_nonce_field( 'change_password_action', 'change_password_nonce' ); ?>

								<button type="submit" class="form__btn btn btn--full btn--dynamic">
									Обновить пароль
								</button>
								<p id="form-status" style="text-align: center"></p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<script>
        window.addEventListener('DOMContentLoaded', (event) => {
            //Form submit
            $('#change_password_form').validate({
                errorElement: 'em',
                submitHandler: function (form) {
                    let formData = new FormData;
                    formData.append('current_password', $('input[name=current_password]').val());
                    formData.append('new_password', $('input[name=new_password]').val());
                    formData.append('confirm_password', $('input[name=confirm_password]').val());
                    formData.append('user_id', $('input[name=user_id]').val());
                    formData.append('nonce', $('input[name=change_password_nonce]').val());

                    const formStatus = $('#form-status');

                    $.ajax({
                        url: '/wp-admin/admin-ajax.php?action=change_password',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: 'POST',
                        beforeSend: function () {
                            formStatus.text('Отправка...');
                        },
                        success: function (jqXHR) {
                            formStatus.text('Новый пароль сохранен');
                            location.reload();
                        },
                        error: function (jqXHR) {
                            formStatus.text(jqXHR.responseJSON.result);
                        },
                    });
                }
            });
        });
	</script>

<?php
get_footer();
