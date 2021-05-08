<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Art_Hamovniki
 */

$id               = get_the_ID();
$picture_data     = get_post( $id );
$picture_name     = get_the_title();
$artist_id        = get_field( 'artist' );
$artist           = get_post( $artist_id );
$price            = get_field( 'price' );
$manager_price    = get_field( 'manager_price' );
$formatted_price  = ! empty( $manager_price ) ? $manager_price : number_format( $price ) . ' ₽';
$images           = get_field( 'images' );
$year             = get_field( 'year' );
$length           = get_field( 'length' );
$width            = get_field( 'width' );
$categories       = get_the_terms( $id, 'picture_category' );
$categories_names = [];
foreach ( $categories as $category ) {
	$name = get_term( $category->term_id )->name;
	array_push( $categories_names, $name );
}

$manager_description = get_field( 'manager_description' );

$images_url_array = [];
foreach ( $images as $image_id ) {
	$url = wp_get_attachment_image_url( $image_id, 'full' );
	array_push( $images_url_array, $url );
}

$owner            = get_user_by( 'ID', $picture_data->post_author );
$show_owner_link  = get_user_meta( $picture_data->post_author, 'show_owner_link', true );
$show_modal_info  = get_user_meta( $picture_data->post_author, 'show_modal_info', true );
$owner_modal_info = get_user_meta( $picture_data->post_author, 'owner_modal_info', true );
?>

<section class="section-first product">
    <div class="container">
		<?php require_once 'breadcrumb-picture.php'; ?>
        <div class="row">
            <div class="col-lg-7">
                <div class="product__header d-lg-none">
                    <h1 class="product__title">
						<?php echo $picture_name; ?>
                    </h1>
                    <div class="product__price">
						<?php echo $formatted_price; ?>
                    </div>
                </div>
                <div class="gallery">
	                <?php get_template_part('template-parts/favorite-button'); ?>
                    <div class="gallery__images">
						<?php foreach ( $images_url_array as $url ): ?>
                            <a href="<?php echo $url; ?>" data-fancybox="images" class="gallery__images-item">
                                <img src="<?php echo $url; ?>" alt="<?php echo $picture_name; ?>">
                            </a>
						<?php endforeach; ?>
                    </div>
                    <div class="gallery__thumbs">
						<?php foreach ( $images_url_array as $url ): ?>
                            <div class="gallery__thumbs-item">
                                <img src="<?php echo $url; ?>" alt="<?php echo $picture_name; ?>">
                            </div>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="product__header d-none d-lg-block">
                    <h1 class="product__title">
						<?php echo $picture_name; ?>
                    </h1>
                    <div class="product__price">
						<?php echo $formatted_price; ?>
                    </div>
                </div>
                <ul class="product__info">
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Автор
                        </div>
                        <a href="/artist/<?php echo $artist->post_name; ?>/"
                           class="product__info-item-value"
                           target="_blank"
                        >
							<?php echo $artist->post_title; ?>
                        </a>
                    </li>
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Год
                        </div>
                        <div class="product__info-item-value">
							<?php echo $year; ?>
                        </div>
                    </li>
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Размер
                        </div>
                        <div class="product__info-item-value">
							<?php echo "$width*$length"; ?>
                        </div>
                    </li>
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Техника
                        </div>
                        <div class="product__info-item-value">
							<?php echo implode( ', ', $categories_names ); ?>
                        </div>
                    </li>
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Описание
                        </div>
                        <div class="product__info-item-value">
							<?php echo $manager_description; ?>
                        </div>
                    </li>
                    <li class="product__info-item">
                        <div class="product__info-item-title">
                            Владелец
                        </div>
						<?php if ( $show_owner_link == '' || $show_owner_link == '1' ): ?>
                            <a href="/owner/?id=<?php echo $owner->ID; ?>"
                               class="catalog-card__info-item-value"
                               target="_blank"
                            >
								<?php echo $owner->data->display_name; ?>
                            </a>
						<?php elseif ( $show_modal_info == '' || $show_modal_info == '1' ): ?>
                            <a href="#owner-popup" data-fancybox="" class="catalog-card__info-item-value">
								<?php echo $owner->data->display_name; ?>
                            </a>
						<?php else: ?>
                            <span class="catalog-card__info-item-value">
								<?php echo $owner->data->display_name; ?>
                            </span>
						<?php endif; ?>
                    </li>
                </ul>
                <div class="share-block">
                    <div class="share-block__title">
                        Поделиться:
                    </div>
					<?php echo do_shortcode( '[addtoany]' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/related-pictures' ); ?>

<div class="d-none">
    <div class="author-popup" id="owner-popup">
        <div class="author-popup__title">
			<?php echo $owner->data->display_name; ?>
        </div>
        <div class="author-popup__text">
			<?php echo $owner_modal_info; ?>
        </div>
    </div>
</div>

