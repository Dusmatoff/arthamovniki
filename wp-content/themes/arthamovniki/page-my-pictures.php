<?php
/*
	Template Name: Мои картины
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $current_user;

if ( ! $current_user->exists() ) {
	wp_safe_redirect( '/' );
}

get_header();

$user_id    = $current_user->ID;
$first_name = get_user_meta( $user_id, 'first_name', true );
$last_name  = get_user_meta( $user_id, 'last_name', true );

$user_pictures = get_posts( [
	'numberposts' => - 1,
	'post_type'   => 'picture',
	'post_status' => 'any',
	'author'      => $user_id
] );

wp_nonce_field( 'delete_picture_action', 'delete_picture_nonce' );
wp_nonce_field( 'status_picture_action', 'status_picture_nonce' );
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
                            <a href="/owner/?id=<?php echo $user_id; ?>" class="lk__link">
							    <span>Просмотр профиля</span>
                            </a>
							<?php profile_navigation( 1 ); ?>
                        </div>
                        <div class="col-lg-8">
                            <div class="catalog-cards catalog-cards--middle">
								<?php foreach ( $user_pictures as $picture ):
									$is_active = get_field( 'is_active', $picture->ID );
									$who_can_see = get_field( 'who_can_see', $picture->ID );
									$permalink = get_permalink($picture->ID);
									?>
                                    <div class="catalog-card">
                                        <a href="<?php echo $permalink; ?>" class="catalog-card__img">
                                            <img src="<?php echo get_the_post_thumbnail_url( $picture->ID ); ?>">
                                        </a>
                                        <div class="catalog-card__content">
                                            <div class="catalog-card__title">
												<?php echo $picture->post_title; ?>
                                            </div>
                                            <div class="catalog-card__row">
                                                <?php if ($picture->post_status == 'publish'): ?>
                                                    <div class="catalog-card__col">
                                                        <a href="<?php echo $permalink; ?>"
                                                           class="btn btn--h-md btn--border"
                                                           target="_blank"
                                                        >
                                                            Посмотреть
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    Еще не одобрено админом
                                                <?php endif; ?>
                                                <div class="catalog-card__col">
													<?php if ( $is_active ): ?>
                                                        <a href="#status-popup"
                                                           data-fancybox
                                                           class="btn btn--h-md btn--full"
                                                           onclick="statusChangeId = <?php echo $picture->ID; ?>"
                                                        >
                                                            Деактивировать
                                                        </a>
													<?php else: ?>
                                                        <a href="#status-popup"
                                                           data-fancybox
                                                           class="btn btn--h-md btn--black"
                                                           onclick="statusChangeId = <?php echo $picture->ID; ?>"
                                                        >
                                                            Активировать
                                                        </a>
													<?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="catalog-card__row">
                                                <div class="catalog-card__col">
                                                    <a href="/edit-picture/?id=<?php echo $picture->ID; ?>&hash=<?php echo md5('edit-picture'.$picture->ID); ?>"
                                                       class="edit-link">
                                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.12301 2.21325L9.77169 3.90422M1.17487 9.22941L1.00156 10.7545C0.997537 10.7886 1.00131 10.8231 1.01261 10.8556C1.02391 10.888 1.04243 10.9175 1.06679 10.9417C1.09115 10.966 1.12071 10.9845 1.15325 10.9957C1.18579 11.007 1.22047 11.0108 1.25468 11.0067L2.77565 10.8317C2.82667 10.8255 2.87408 10.8023 2.91019 10.7658L10.8662 2.811C10.9086 2.76878 10.9423 2.71865 10.9652 2.66347C10.9882 2.60828 11 2.54913 11 2.4894C11 2.42966 10.9882 2.37051 10.9652 2.31533C10.9423 2.26014 10.9086 2.21001 10.8662 2.1678L9.84238 1.14276C9.79998 1.10015 9.74954 1.06634 9.69396 1.04326C9.63839 1.02018 9.57878 1.0083 9.51857 1.0083C9.45837 1.0083 9.39875 1.02018 9.34318 1.04326C9.2876 1.06634 9.23716 1.10015 9.19477 1.14276L1.241 9.09759C1.20487 9.13299 1.18161 9.17937 1.17487 9.22941V9.22941Z"
                                                                  stroke-width="1.4"/>
                                                        </svg>
                                                        <span>
													Редактировать
												</span>
                                                    </a>
                                                </div>
                                                <div class="catalog-card__col">
                                                    <a href="#delete-popup"
                                                       data-fancybox
                                                       class="remove-link"
                                                       onclick="deleteId = <?php echo $picture->ID; ?>"
                                                    >
                                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 1L1.08855 9M1 1L8.91145 9L1 1Z" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        <span>
													Удалить
												</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="catalog-card__row">
                                                <div class="form__radio-group">
                                                    <a href="#see-popup"
                                                       data-fancybox
                                                       data-id="<?php echo $picture->ID; ?>"
                                                       data-visibility="everyone"
                                                       onclick="changeVisibility(this)"
                                                    >
                                                        <label for="radio-<?php echo $picture->ID; ?>-all"
                                                               class="form__radio">
                                                            <input type="radio"
                                                                   id="radio-<?php echo $picture->ID; ?>-all"
                                                                   class="form__radio-input"
                                                                <?php echo $who_can_see == 'everyone' ? 'checked' : ''; ?>
                                                            >
                                                            <div class="form__radio-marker"></div>
                                                            <div class="form__radio-text">
                                                                Картина видна всем
                                                            </div>
                                                        </label>
                                                    </a>
                                                    <br/>
                                                    <a href="#see-popup"
                                                       data-fancybox
                                                       data-id="<?php echo $picture->ID; ?>"
                                                       data-visibility="partners"
                                                       onclick="changeVisibility(this)"
                                                    >
                                                        <label for="radio-<?php echo $picture->ID; ?>-partner"
                                                               class="form__radio">
                                                            <input type="radio"
                                                                   id="radio-<?php echo $picture->ID; ?>-partner"
                                                                   class="form__radio-input"
                                                                <?php echo $who_can_see == 'partners' ? 'checked' : ''; ?>
                                                            >
                                                            <div class="form__radio-marker"></div>
                                                            <div class="form__radio-text">
                                                                Картину показывать только партнерам галереи
                                                            </div>
                                                        </label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="d-none">
        <div class="action-popup" id="delete-popup">
            <div class="action-popup__title">
                Вы уверены, что хотите удалить картину?
            </div>
            <div class="action-popup__footer">
                <a href="" data-fancybox-close class="btn btn--border">Нет</a>
                <button class="btn btn--full" onclick="deletePicture();">Да, удалить</button>
            </div>
        </div>

        <div class="action-popup" id="status-popup">
            <div class="action-popup__title">
                Вы уверены, что хотите изменить статус картины?
            </div>
            <div class="action-popup__footer">
                <a href="" data-fancybox-close class="btn btn--border">Нет</a>
                <button class="btn btn--full" onclick="changePictureStatus();">Да, изменить</button>
            </div>
        </div>

        <div class="action-popup" id="see-popup">
            <div class="action-popup__title">
                Видимость меняется
            </div>
            <div class="action-popup__footer">
                Загрузка...
            </div>
        </div>
    </div>

    <script>
        var deleteId = null;
        var statusChangeId = null;

        function deletePicture() {
            const deleteNonce = $('#delete_picture_nonce').val();

            jQuery.ajax({
                type: 'GET',
                url: `/wp-admin/admin-ajax.php?action=delete_picture&id=${deleteId}&nonce=${deleteNonce}`,
                complete: function (jqXHR) {
                    location.reload();
                }
            });
        }

        function changePictureStatus() {
            const statusNonce = $('#status_picture_nonce').val();

            jQuery.ajax({
                type: 'GET',
                url: `/wp-admin/admin-ajax.php?action=change_picture_status&id=${statusChangeId}&nonce=${statusNonce}`,
                complete: function (jqXHR) {
                    location.reload();
                }
            });
        }

        function changeVisibility(el) {
            const statusNonce = $('#status_picture_nonce').val();
            const id = $(el).data('id');
            const visibilityName = $(el).data('visibility');

            jQuery.ajax({
                type: 'GET',
                url: `/wp-admin/admin-ajax.php?action=change_picture_visibility&id=${id}&visibilityName=${visibilityName}&nonce=${statusNonce}`,
                complete: function (jqXHR) {
                    location.reload();
                }
            });
        }
    </script>

<?php
get_footer();
