<?php
/*
	Template Name: Редактировать картину
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


global $current_user;
$picture_id = $_GET['id'];
$hash       = $_GET['hash'];

if ( ! $current_user->exists() || empty( $picture_id ) || $hash != md5( 'edit-picture' . $picture_id ) ) {
	wp_safe_redirect( '/' );
}

get_header();

$user_id      = $current_user->ID;
$picture_data = get_post( $picture_id );
$images       = get_field( 'images', $picture_id );
$artist_id    = get_field( 'artist', $picture_id );
$price        = get_field( 'price', $picture_id );
$year         = get_field( 'year', $picture_id );
$length       = get_field( 'length', $picture_id );
$width        = get_field( 'width', $picture_id );
$is_active    = get_field( 'is_active', $picture_id );

$picture_categories  = get_terms( [ 'taxonomy' => 'picture_category', 'hide_empty' => false ] );
$categories          = get_the_terms( $picture_id, 'picture_category' );
$selected_categories = [];
foreach ( $picture_categories as $category ) {
	foreach ( $categories as $cat ) {
		if ( $category->term_id == $cat->term_id ) {
			array_push( $selected_categories, $cat->term_id );
		}
	}
}

$picture_subjects  = get_terms( [ 'taxonomy' => 'picture_subject', 'hide_empty' => false ] );
$subjects          = get_the_terms( $picture_id, 'picture_subject' );
$selected_subjects = [];
foreach ( $picture_subjects as $subject ) {
	foreach ( $subjects as $sub ) {
		if ( $subject->term_id == $sub->term_id ) {
			array_push( $selected_subjects, $sub->term_id );
		}
	}
}

$picture_techniques  = get_terms( [ 'taxonomy' => 'picture_technique', 'hide_empty' => false ] );
$techniques          = get_the_terms( $picture_id, 'picture_technique' );
$selected_techniques = [];
foreach ( $picture_techniques as $technique ) {
	foreach ( $techniques as $tech ) {
		if ( $technique->term_id == $tech->term_id ) {
			array_push( $selected_techniques, $tech->term_id );
		}
	}
}

$owner_description = get_field( 'owner_description', $picture_id );

$photo_upload_nonce = wp_create_nonce( 'photo_upload_action' );
$photo_delete_nonce = wp_create_nonce( 'photo_delete_nonce' );
?>
    <style>
        .chosen-container {
            width: 100% !important;
        }
    </style>

    <section class="section-first product">
        <div class="container">
			<?php require_once 'template-parts/breadcrumb.php'; ?>
            <div class="lk">
                <div class="lk__header">
                    <div class="lk__title">
                        Редактировать картину - <?php echo $picture_data->post_title; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="form lk-form" id="edit_picture_form" action="" type="POST"
                          enctype="multipart/form-data">
                        <div class="form__row">
                            <div class="form__field-label">Изображения картины*</div>
                            <!--<div class="input-images"></div>-->

                            <!--<div class="upload-field">
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
                            </div>-->

                            <div id="photo-upload">
                                <span class="btn btn--full fileinput-button">
                                    <span>Добавить изображения</span>
                                    <input type="file" name="photo" multiple accept="image/*"/>
                                </span>
                                <div role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div style="width: 0%;"></div>
                                </div>
                                <div class="progress-extended">&nbsp;</div>
                                <table role="presentation" class="table table-striped" style="width: 100%">
                                    <tbody class="files memorial-block__loading-block">
									<?php if ( ! empty( $images ) ): foreach ( $images as $item ):
										$attachment_url = wp_get_attachment_url( $item );
										$attached_file = get_attached_file( $item );
										$file_name = basename( $attached_file );
										$file_size = filesize( $attached_file );
										?>
                                        <tr class="template-download fade image in memorial-block__upload-card-block">
                                            <td class="memorial-block__upload-card-photo">
                                                <img src="<?php echo $attachment_url; ?>" style="max-width: 150px;">
                                            </td>
                                            <td class="memorial-block__upload-card-name">
												<?php echo $file_name; ?>
                                            </td>
                                            <td class="memorial-block__upload-card-size">
												<?php echo round( $file_size / 1024 ); ?> KB
                                            </td>
                                            <td>
                                                <a href="javascript:;"
                                                   class="memorial-block__upload-delete-link delete"
                                                   data-type="DELETE"
                                                   data-url="/wp-admin/admin-ajax.php?action=photo_delete&id=<?php echo $item; ?>&nonce=<?php echo $photo_delete_nonce; ?>"
                                                >
                                                    <span>Удалить</span>
                                                </a>
                                            </td>
                                        </tr>
									<?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                                <table role="presentation" class="table table-striped" style="width: 100%">
                                    <tbody class="files memorial-block__loading-block"></tbody>
                                </table>
                            </div>
							<?php require_once 'inc/fileupload-templates.php'; ?>

                        </div>
                        <div class="form__row">
                            <div class="form__field-header">
                                <div class="form__radio-group">
                                    <label for="fixed-radio" class="form__radio">
                                        <input type="radio"
                                               name="who_can_see"
                                               id="fixed-radio"
                                               class="form__radio-input"
                                               value="everyone"
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
                                               value="partners"
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
                        <div class="form__row">
                            <b>Художник:</b> <?php echo get_the_title( $artist_id ); ?>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">
                                Цена картины*
                            </div>
                            <div class="form__field form__field--grey">
                                <input type="number"
                                       min="1"
                                       name="price"
                                       class="form__field-input"
                                       value="<?php echo $price; ?>"
                                       required
                                >
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">Название картины*</div>
                            <div class="form__field form__field--grey">
                                <input type="text"
                                       name="picture_name"
                                       class="form__field-input"
                                       value="<?php echo $picture_data->post_title; ?>"
                                       required
                                >
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form__field-label">Год создания</div>
                                    <div class="form__field form__field--grey">
                                        <input type="number"
                                               min="1"
                                               name="year"
                                               class="form__field-input"
                                               value="<?php echo $year; ?>"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form__field-label">Ширина, см*</div>
                                    <div class="form__field form__field--grey">
                                        <input type="number"
                                               min="1"
                                               name="width"
                                               class="form__field-input"
                                               value="<?php echo $width; ?>"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form__field-label">Высота, см*</div>
                                    <div class="form__field form__field--grey">
                                        <input type="number"
                                               min="1"
                                               class="form__field-input"
                                               name="length"
                                               value="<?php echo $length; ?>"
                                               required
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">Темы</div>
                            <div class="form__field-group">
                                <div class="form__field form__field--grey">
                                    <select class="form__field-select chosen-select"
                                            name="categories[]"
                                            id="categories"
                                            data-placeholder="Выберите темы"
                                            multiple>
										<?php foreach ( $picture_categories as $category ): ?>
                                            <option value="<?php echo $category->slug; ?>"
												<?php if ( in_array( $category->term_id, $selected_categories ) ) {
													echo 'selected';
												} ?>
                                            >
												<?php echo $category->name; ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">Сюжеты</div>
                            <div class="form__field-group">
                                <div class="form__field form__field--grey">
                                    <select class="form__field-select chosen-select"
                                            name="subjects[]"
                                            id="subjects"
                                            data-placeholder="Выберите сюжеты"
                                            multiple>
										<?php foreach ( $picture_subjects as $subject ): ?>
                                            <option value="<?php echo $subject->slug; ?>"
												<?php if ( in_array( $subject->term_id, $selected_subjects ) ) {
													echo 'selected';
												} ?>
                                            >
												<?php echo $subject->name; ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">Техники</div>
                            <div class="form__field-group">
                                <div class="form__field form__field--grey">
                                    <select class="form__field-select chosen-select"
                                            name="techniques[]"
                                            id="techniques"
                                            data-placeholder="Выберите техники"
                                            multiple>
										<?php foreach ( $picture_techniques as $technique ): ?>
                                            <option value="<?php echo $technique->slug; ?>"
												<?php if ( in_array( $technique->term_id, $selected_techniques ) ) {
													echo 'selected';
												} ?>
                                            >
												<?php echo $technique->name; ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__field-label">Описание картины</div>
                            <div class="form__field form__field--grey">
                                <textarea class="form__field-textarea form__field-textarea--xl"
                                          name="description"><?php echo $owner_description; ?></textarea>
                            </div>
                            <input type="hidden" name="picture_id" value="<?php echo $picture_id; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
							<?php wp_nonce_field( 'edit_picture_action', 'edit_picture_nonce' ); ?>
                        </div>
                        <button class="btn btn--full btn--lg" type="submit">
                            Сохранить
                        </button>
                        <p id="form-status" style="text-align: center"></p>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $('.chosen-select').chosen({no_results_text: 'Ничего не найдено'});

            //Images
            let photoJson = <?php echo json_encode( $images ) ?>;
            window.uploadedPhotosId = photoJson ? photoJson.reduce((acc, curr) => (acc[curr] = curr, acc), {}) : [];
            let photoUpload = $('#photo-upload');
            photoUpload.fileupload({
                url: '/wp-admin/admin-ajax.php?action=photo_upload&photo_upload_nonce=<?php echo $photo_upload_nonce; ?>',
                maxFileSize: 10485760,// 10 MB
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png|tiff)$/i,
                autoUpload: true,
                maxNumberOfFiles: 10,
                messages: {
                    maxNumberOfFiles: 'Лимит файлов исчерпан',
                    acceptFileTypes: 'Формат не подходит. Попробуйте другой файл',
                    maxFileSize: 'Слишком большой размер. Попробуйте другой файл',
                }
            });
            photoUpload.on('fileuploaddone', function (e, data) {
                let postId = data.result.files[0].postId;
                window.uploadedPhotosId[postId] = postId;
            }).on('fileuploaddestroyed', function (e, data) {
                    let url = data.url;
                    let urlArray = url.split('&');
                    let id = urlArray[1].split('=');
                    delete window.uploadedPhotosId[id[1]];
                }
            ).on('fileuploaddestroy', function (e, data) {
                    return confirm('Действительно хотите удалить это изображение?');
                }
            );

            //Form submit
            $('#edit_picture_form').validate({
                errorElement: 'em',
                submitHandler: function (form) {
                    //const images = $('.image-uploader input')[0].files;
                    //const images = $('#files')[0].files;
                    const price = $('input[name=price]').val();
                    const pictureName = $('input[name=picture_name]').val();

                    if (price !== '' && pictureName !== '') {
                        let formData = new FormData;

                        /*$.each($('#files'), function (i, obj) {
                            $.each(obj.files, function (j, file) {
                                formData.append('images' + j, file);
                            })
                        });*/

                        formData.append('who_can_see', $('input[name=who_can_see]:checked').val());
                        formData.append('price', price);
                        formData.append('picture_name', pictureName);
                        formData.append('year', $('input[name=year]').val());
                        formData.append('width', $('input[name=width]').val());
                        formData.append('length', $('input[name=length]').val());
                        formData.append('categories', $('#categories').val());
                        formData.append('subjects', $('#subjects').val());
                        formData.append('techniques', $('#techniques').val());
                        formData.append('description', $('textarea[name=description]').val().trim());
                        formData.append('picture_id', $('input[name=picture_id]').val());
                        formData.append('user_id', $('input[name=user_id]').val());
                        formData.append('edit_picture_nonce', $('input[name=edit_picture_nonce]').val());
                        formData.append('images', Object.keys(window.uploadedPhotosId).join());

                        const formStatus = $('#form-status');

                        $.ajax({
                            url: '/wp-admin/admin-ajax.php?action=edit_picture',
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            type: 'POST',
                            beforeSend: function () {
                                formStatus.text('Отправка...');
                            },
                            success: function (success) {
                                formStatus.text(success.result);
                                window.location.href = '/my-pictures/';
                            },
                            error: function (jqXHR) {
                                formStatus.text(jqXHR.responseJSON.result);
                            },
                        });
                    } else {
                        alert('Пожалуйста заполните обязательные поля');
                    }
                }
            });
        });
    </script>

<?php
get_footer();
