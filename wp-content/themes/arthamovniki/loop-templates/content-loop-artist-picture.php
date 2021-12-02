<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $current_user;
$id               = get_the_ID();
$artist_id        = get_field( 'artist' );
$artist           = get_post( $artist_id );
$year             = get_field( 'year' );
$length           = get_field( 'length' );
$width            = get_field( 'width' );
$categories       = get_the_terms( $id, 'picture_technique' );
$categories_names = [];
foreach ( $categories as $category ) {
	$name = get_term( $category->term_id )->name;
	array_push( $categories_names, $name );
}
$author_id        = get_the_author_meta( 'ID' );
$owner            = get_user_by( 'ID', $author_id );
$show_owner_link  = get_user_meta( $author_id, 'show_owner_link', true );
$show_modal_info  = get_user_meta( $author_id, 'show_modal_info', true );
$owner_modal_info = get_user_meta( $author_id, 'owner_modal_info', true );
$first_name       = get_user_meta( $owner->ID, 'first_name', true );
$last_name        = get_user_meta( $owner->ID, 'last_name', true );
?>
<div class="catalog-card">
    <div class="catalog-card__img">
		<?php get_template_part( 'template-parts/favorite-button' ); ?>
        <a href="<?php echo get_permalink(); ?>">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
        </a>
    </div>
    <div class="catalog-card__content">
        <div class="catalog-card__title">
            <a href="<?php echo get_permalink(); ?>">
				<?php echo get_the_title(); ?>
            </a>
        </div>
        <ul class="catalog-card__info">
            <li class="catalog-card__info-item">
                <div class="catalog-card__info-item-title">
                    Автор
                </div>
                <a href="/artist/<?php echo $artist->post_name; ?>/" class="catalog-card__info-item-value">
					<?php echo $artist->post_title; ?>
                </a>
            </li>
            <li class="catalog-card__info-item">
                <div class="catalog-card__info-item-title">
                    Год
                </div>
                <div class="catalog-card__info-item-value">
					<?php echo $year; ?>
                </div>
            </li>
            <li class="catalog-card__info-item">
                <div class="catalog-card__info-item-title">
                    Размер
                </div>
                <div class="catalog-card__info-item-value">
					<?php echo "$length х $width см"; ?>
                </div>
            </li>
            <li class="catalog-card__info-item">
                <div class="catalog-card__info-item-title">
                    Материалы
                </div>
                <div class="catalog-card__info-item-value">
					<?php echo implode( ', ', $categories_names ); ?>
                </div>
            </li>
            <li class="catalog-card__info-item">
                <div class="catalog-card__info-item-title">
                    Продавец
                </div>
				<?php if ( $show_owner_link == '' || $show_owner_link == '1' ): ?>
                    <a href="/owner/?id=<?php echo $owner->ID; ?>"
                       class="catalog-card__info-item-value"
                    >
						<?php echo $first_name . ' ' . $last_name; ?>
                    </a>
				<?php elseif ( $show_modal_info == '' || $show_modal_info == '1' ): ?>
                    <a href="#owner-popup-<?php echo $author_id; ?>"
                       data-fancybox=""
                       class="catalog-card__info-item-value"
                    >
						<?php echo $first_name . ' ' . $last_name; ?>
                    </a>
				<?php else: ?>
                    <span class="catalog-card__info-item-value">
                        <?php echo $first_name . ' ' . $last_name; ?>
                    </span>
				<?php endif; ?>
            </li>
			<?php if ( in_array( 'administrator', $current_user->roles ) ): ?>
                <li class="catalog-card__info-item">
                    <div class="catalog-card__info-item-title">
                        Доступность
                    </div>
                    <div class="catalog-card__info-item-value">
						<?php show_icon_for_admin( $id ); ?> (<?php the_field( 'order_number' ); ?>)
                    </div>
                </li>
			<?php endif; ?>
        </ul>
    </div>
</div>

<div class="d-none">
    <div class="author-popup" id="owner-popup-<?php echo $author_id; ?>">
        <div class="author-popup__title">
			<?php echo $owner->data->display_name; ?>
        </div>
        <div class="author-popup__text">
			<?php echo $owner_modal_info; ?>
        </div>
    </div>
</div>

