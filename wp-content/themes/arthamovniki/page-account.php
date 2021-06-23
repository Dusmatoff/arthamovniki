<?php
/*
	Template Name: Личный кабинет
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

global $current_user;

$user_id      = $current_user->ID;
$first_name   = get_user_meta( $user_id, 'first_name', true );
$last_name    = get_user_meta( $user_id, 'last_name', true );
$phone_number = get_user_meta( $user_id, 'phone_number', true );
$user_country = get_user_meta( $user_id, 'user_country', true );
$user_city    = get_user_meta( $user_id, 'user_city', true );
$description    = get_user_meta( $user_id, 'description', true );
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
							<?php profile_navigation( 3 ); ?>
                        </div>
                        <div class="col-lg-8">
                            <form class="form" id="account_form" action="" method="POST">
                                <div class="form__row">
                                    <div class="form__field-label">
                                        Имя пользователя
                                    </div>
                                    <div class="form__field form__field--grey">
                                        <input type="text"
                                               name="user_login"
                                               class="form__field-input"
                                               value="<?php echo $current_user->data->user_login; ?>"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form__field-label">
                                                Имя
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <input type="text"
                                                       name="first_name"
                                                       class="form__field-input"
                                                       value="<?php echo $first_name; ?>"
                                                       required
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form__field-label">
                                                Фамилия
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <input type="text"
                                                       name="last_name"
                                                       class="form__field-input"
                                                       value="<?php echo $last_name; ?>"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form__field-label">
                                        Номер телефона
                                    </div>
                                    <div class="form__field form__field--grey">
                                        <input type="tel"
                                               name="phone_number"
                                               class="form__field-input"
                                               value="<?php echo $phone_number; ?>"
                                               required
                                        >
                                    </div>
                                    <!--
                                    <div class="form__controls">
                                        <a href="" class="edit-link">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.00012 2.34315L8.06273 13.5942M2.34326 8L13.5944 8.06262L2.34326 8Z"
                                                      stroke="#BA884D" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <span>
											Добавить еще номер
										</span>
                                        </a>
                                        <a href="" class="remove-link">
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1L1.08855 9M1 1L8.91145 9L1 1Z" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>
											Удалить номер
										</span>
                                        </a>
                                    </div>
                                    -->
                                </div>
                                <div class="form__row">
                                    <div class="form__field-label">
                                        Адрес электронной почты
                                    </div>
                                    <div class="form__field form__field--grey">
                                        <input type="email"
                                               name="user_email"
                                               class="form__field-input"
                                               value="<?php echo $current_user->data->user_email; ?>"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form__field-label">
                                                Страна
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <input type="text"
                                                       name="user_country"
                                                       class="form__field-input"
                                                       value="<?php echo $user_country; ?>"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form__field-label">
                                                Город
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <input type="text"
                                                       name="user_city"
                                                       class="form__field-input"
                                                       value="<?php echo $user_city; ?>"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form__field-label">
                                                Дополнительная информация
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <textarea name="user_description" class="form__field-textarea form__field-textarea--lg" style="width: 100%"><?php echo $description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
								<?php wp_nonce_field( 'save_account_action', 'save_account_nonce' ); ?>

                                <button type="submit" class="form__btn btn btn--full btn--dynamic">
                                    Обновить учётную запись
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
            $('#account_form').validate({
                errorElement: 'em',
                submitHandler: function (form) {
                    let formData = new FormData;
                    formData.append('first_name', $('input[name=first_name]').val());
                    formData.append('last_name', $('input[name=last_name]').val());
                    formData.append('phone_number', $('input[name=phone_number]').val());
                    formData.append('user_country', $('input[name=user_country]').val());
                    formData.append('user_city', $('input[name=user_city]').val());
                    formData.append('user_description', $('textarea[name=user_description]').val());
                    formData.append('user_id', $('input[name=user_id]').val());
                    formData.append('save_account_nonce', $('input[name=save_account_nonce]').val());

                    const formStatus = $('#form-status');

                    $.ajax({
                        url: '/wp-admin/admin-ajax.php?action=save_account',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: 'POST',
                        beforeSend: function () {
                            formStatus.text('Отправка...');
                        },
                        success: function (jqXHR) {
                            formStatus.text('Данные сохранены');
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
