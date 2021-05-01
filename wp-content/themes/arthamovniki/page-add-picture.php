<?php
/*
	Template Name: Добавить картину
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$user = wp_get_current_user();

if ( ! wp_get_current_user()->exists() ) {
	wp_safe_redirect( '/' );
}

get_header();

$user_id      = $user->ID;
$step_1_text  = get_field( 'step_1_text', 'option' );
$step_1_video = get_field( 'step_1_video', 'option' );
$step_2_text  = get_field( 'step_2_text', 'option' );
$step_2_video = get_field( 'step_2_video', 'option' );
$step_3_text  = get_field( 'step_3_text', 'option' );
$step_3_video = get_field( 'step_3_video', 'option' );
$step_4_text  = get_field( 'step_4_text', 'option' );
$step_4_video = get_field( 'step_4_video', 'option' );

$artists = get_posts(
	[
		'post_type'      => 'artist',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	]
);
?>
    <style>
        .chosen-container {
            width: 100% !important;
        }
    </style>

    <section class="section-first product">
        <div class="container">
			<?php require_once 'template-parts/breadcrumb.php'; ?>
            <div class="row">
                <div class="col-12">
                    <form class="form lk-form" id="add_picture_form" action="" type="POST"
                          enctype="multipart/form-data">
                        <div class="lk-form__step active" id="step-1">
                            <div class="lk">
                                <div class="lk__header">
                                    <div class="lk__title">
                                        Добавить картину шаг 1 из 4
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="instraction">
                                        <div class="instraction__title">
											<?php echo $step_1_text; ?>
                                        </div>
                                        <div class="instraction__video">
											<?php echo $step_1_video; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form__row">
                                        <div class="form__field-label">Изображения картины*</div>
                                        <!-- <div class="input-images"></div> -->
                                        <div class="upload-field">
                                            <div class="upload-field__results">

                                            </div>
                                            <div class="upload-field__footer">
                                                <label for="files" class="upload">
                                                    <input id="files" type="file" required name="images[]" multiple
                                                           class="upload__input">
                                                    <div class="upload__text">
                                                        Добавить изображения
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__field-header">
                                            <div class="form__radio-group">
                                                <label for="fixed-radio" class="form__radio">
                                                    <input type="radio"
                                                           name="who_can_see"
                                                           id="fixed-radio"
                                                           class="form__radio-input"
                                                           checked
                                                    >
                                                    <div class="form__radio-marker"></div>
                                                    <div class="form__radio-text">Картина видна всем</div>
                                                </label>
                                                <label for="query-radio" class="form__radio">
                                                    <input type="radio"
                                                           name="who_can_see"
                                                           id="query-radio"
                                                           class="form__radio-input"
                                                    >
                                                    <div class="form__radio-marker"></div>
                                                    <div class="form__radio-text">Картина видна только партнерам
                                                        галереи
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="tooltip">
                                                <div class="tooltip__icon">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.06577 4.87207C8.30341 4.87207 7.66706 5.13836 7.15777 5.57089C6.64847 6.00342 6.35041 6.35442 6.26465 7.41325H7.81953C7.85341 6.88384 7.97994 6.76154 8.19859 6.56036C8.41724 6.35919 8.68882 6.23319 9.01441 6.23319C9.34 6.23319 9.60524 6.32531 9.81065 6.53548C10.0166 6.74513 10.1193 7.00242 10.1193 7.31901C10.1193 7.6356 10.0203 7.89819 9.82388 8.1126L8.88577 9.04913C8.61153 9.32336 8.55435 9.5436 8.47282 9.71036C8.3913 9.87713 8.47124 10.1307 8.47124 10.4732V11.1191H9.53006V10.6787C9.53006 10.3367 9.68306 10.0709 9.83765 9.88242C9.89694 9.81413 10.0139 9.73048 10.1135 9.63201C10.2119 9.53301 10.3506 9.4176 10.492 9.28472C10.6334 9.15236 10.7567 9.04278 10.8425 8.95701C10.9277 8.87178 11.0564 8.72566 11.2194 8.52025C11.5016 8.17772 11.6456 7.74942 11.6456 7.23536C11.6456 6.48995 11.4074 5.91025 10.9277 5.49413C10.447 5.0796 9.82812 4.87207 9.06577 4.87207Z"/>
                                                        <path d="M8.96945 11.7236C8.69945 11.7236 8.46862 11.8184 8.27539 12.0063C8.08268 12.1948 7.98633 12.4193 7.98633 12.6808C7.98633 12.9418 8.0848 13.1647 8.28174 13.3489C8.47868 13.5332 8.71215 13.6248 8.98162 13.6248C9.25162 13.6248 9.48298 13.5305 9.67568 13.3426C9.86786 13.1541 9.96474 12.9291 9.96474 12.6681C9.96474 12.4071 9.86574 12.1842 9.6688 11.9995C9.47292 11.8152 9.23945 11.7236 8.96945 11.7236Z"/>
                                                        <path d="M9 0C4.02935 0 0 4.02935 0 9C0 13.9706 4.02935 18 9 18C13.9706 18 18 13.9706 18 9C18 4.02935 13.9706 0 9 0ZM9 16.4118C4.90659 16.4118 1.58824 13.0934 1.58824 9C1.58824 4.90659 4.90659 1.58824 9 1.58824C13.0934 1.58824 16.4118 4.90659 16.4118 9C16.4118 13.0934 13.0934 16.4118 9 16.4118Z"/>
                                                    </svg>
                                                </div>
                                                <div class="tooltip__message">
                                                    <!-- <b>Фиксированная цена</b> — это есть много вариантов , но большинство из них имеет не всегда приемлемые все другие известные генераторы -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__footer justify-content-end">
                                        <a href="" class="btn btn--full btn--lg" id="step-next-1">Далле</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="lk-form__step" id="step-2">
                            <div class="lk">
                                <div class="lk__header">
                                    <div class="lk__title">
                                        Добавить картину шаг 2 из 4
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="instraction">
                                        <div class="instraction__title">
											<?php echo $step_2_text; ?>
                                        </div>
                                        <div class="instraction__video">
											<?php echo $step_2_video; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form__row">
                                        <div class="form__field-label">Художник (выберите из списка)</div>
                                        <div class="form__field">
                                            <select class="form__field-select chosen-select">
                                                <?php foreach ($artists as $artist): ?>
                                                    <option value="<?php echo $artist->ID; ?>">
	                                                    <?php echo $artist->post_title; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="author-row d-none">
                                            <div class="form__field-label">Год рождения, годы жизни художника, например:
                                                1948 г.р. или 1857-1923 г
                                            </div>
                                            <div class="form__field form__field--grey">
                                                <input type="text" class="form__field-input">
                                            </div>
                                        </div>
                                        <a href="" class="remove-link add-author">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.65685 2.34315L7.71947 13.5942M2 8L13.2511 8.06262L2 8Z"
                                                      stroke="#AAAAAA" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <span>
											Добавить нового художника
										</span>
                                        </a>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__field-label">
                                            Цена картины*
                                        </div>
                                        <div class="form__field form__field--grey">
                                            <input type="text" placeholder="1 руб" required class="form__field-input">
                                        </div>
                                    </div>
                                    <div class="form__footer">
                                        <a href="" class="back-btn" id="step-back-2">
                                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.30356 0.629883L1.33238 4.81783L5.30356 8.62988M1.33008 4.78094H11.8115H1.33008Z"
                                                      stroke-width="1.5"/>
                                            </svg>
                                            Назад
                                        </a>
                                        <a href="" class="btn btn--full btn--lg" id="step-next-2">Далле</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lk-form__step" id="step-3">
                            <div class="lk">
                                <div class="lk__header">
                                    <div class="lk__title">
                                        Добавить картину шаг 3 из 4
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="instraction">
                                        <div class="instraction__title">
											<?php echo $step_3_text; ?>
                                        </div>
                                        <div class="instraction__video">
											<?php echo $step_3_video; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">

                                    <div class="form__row">
                                        <div class="form__field-label">Название картины*</div>
                                        <div class="form__field form__field--grey">
                                            <input type="text" required class="form__field-input">
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form__field-label">Год создания</div>
                                                <div class="form__field form__field--grey">
                                                    <input type="text" class="form__field-input">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form__field-label">Ширина, см*</div>
                                                <div class="form__field form__field--grey">
                                                    <input type="text" required class="form__field-input">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form__field-label">Длина, см*</div>
                                                <div class="form__field form__field--grey">
                                                    <input type="text" required class="form__field-input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__field-label">Категории</div>
                                        <div class="form__field-group">
                                            <div class="form__field form__field--grey">
                                                <input type="text" class="form__field-input">
                                            </div>
                                            <a href="" class="btn btn--border btn--lg">
                                                Добавить
                                            </a>
                                        </div>
                                        <div class="form__field-sublabel">
                                            Разделите рубрики запятыми
                                        </div>
                                        <a href="" class="link">Выберите наиболее используемые категории</a>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__field-label">Сюжеты</div>
                                        <div class="form__field-group">
                                            <div class="form__field form__field--grey">
                                                <input type="text" class="form__field-input">
                                            </div>
                                            <a href="" class="btn btn--border btn--lg">
                                                Добавить
                                            </a>
                                        </div>
                                        <div class="form__field-sublabel">
                                            Разделите рубрики запятыми
                                        </div>
                                        <a href="" class="link">Выберите наиболее используемые сюжеты</a>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__field-label">Техники</div>
                                        <div class="form__field-group">
                                            <div class="form__field form__field--grey">
                                                <input type="text" class="form__field-input">
                                            </div>
                                            <a href="" class="btn btn--border btn--lg">
                                                Добавить
                                            </a>
                                        </div>
                                        <div class="form__field-sublabel">
                                            Разделите рубрики запятыми
                                        </div>
                                        <a href="" class="link">Выберите наиболее используемые техники</a>
                                    </div>
                                    <div class="form__footer">
                                        <a href="" class="back-btn" id="step-back-3">
                                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.30356 0.629883L1.33238 4.81783L5.30356 8.62988M1.33008 4.78094H11.8115H1.33008Z"
                                                      stroke-width="1.5"/>
                                            </svg>
                                            Назад
                                        </a>
                                        <a href="" class="btn btn--full btn--lg" id="step-next-3">Далле</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="lk-form__step" id="step-4">
                            <div class="lk">
                                <div class="lk__header">
                                    <div class="lk__title">
                                        Добавить картину шаг 4 из 4
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="instraction">
                                        <div class="instraction__title">
											<?php echo $step_4_text; ?>
                                        </div>
                                        <div class="instraction__video">
											<?php echo $step_4_video; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">

                                    <div class="form__row">
                                        <div class="form__field-label">Описание картины</div>
                                        <div class="form__field form__field--grey">
                                            <textarea class="form__field-textarea form__field-textarea--xl"></textarea>
                                        </div>
                                    </div>
                                    <div class="form__footer">
                                        <a href="" class="back-btn" id="step-back-4">
                                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.30356 0.629883L1.33238 4.81783L5.30356 8.62988M1.33008 4.78094H11.8115H1.33008Z"
                                                      stroke-width="1.5"/>
                                            </svg>
                                            Назад
                                        </a>
                                        <button class="btn btn--full btn--lg">Опубликовать</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $('.chosen-select').chosen();

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
