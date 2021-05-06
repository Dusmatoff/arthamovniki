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

$owner             = get_user_by( 'ID', $picture_data->post_author );
$first_name        = get_user_meta( $picture_data->post_author, 'first_name', true );
$last_name         = get_user_meta( $picture_data->post_author, 'last_name', true );
$phone_number      = get_user_meta( $picture_data->post_author, 'phone_number', true );
$owner_description = get_user_meta( $picture_data->post_author, 'description', true );
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
                    <button class="add-to-fav">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.03402 1.40214C2.93973 0.712591 4.11711 0.392799 5.24601 0.531968C6.23314 0.636714 7.16735 1.10086 7.87578 1.79189C8.22703 2.14351 8.57976 2.49402 8.92953 2.84713C9.36073 2.43184 9.76751 1.99102 10.2113 1.58869C10.9005 0.990188 11.7773 0.610435 12.6863 0.523085C13.5513 0.435734 14.4441 0.603032 15.2129 1.01351C16.3295 1.58795 17.1764 2.6628 17.4721 3.88349C17.7123 4.82658 17.6283 5.84554 17.2438 6.73941C17.1083 7.07252 16.9114 7.37455 16.7045 7.66658C16.5201 7.91309 16.2992 8.12887 16.0823 8.34614C13.6979 10.7309 11.3128 13.1149 8.92879 15.5C6.45855 13.0249 3.98387 10.5547 1.51214 8.08113C0.913642 7.4582 0.495396 6.66242 0.337351 5.81186C0.280351 5.56388 0.27739 5.30923 0.25 5.05754C0.254442 4.48495 0.342532 3.90829 0.552396 3.37308C0.847019 2.59396 1.37112 1.90515 2.03402 1.40214Z"/>
                        </svg>
                    </button>
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
                        <a href="#owner-popup" data-fancybox="" class="catalog-card__info-item-value">
							<?php echo "$first_name $last_name"; ?>
                        </a>
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

<?php get_template_part('template-parts/related-pictures'); ?>

<div class="d-none">
    <div class="author-popup" id="owner-popup">
        <div class="author-popup__title">
			<?php echo "$first_name $last_name"; ?>
        </div>
        <div class="author-popup__text">
            <?php echo $owner_description; ?>
        </div>
        <div class="data">
            <a href="tel:<?php //echo $phone_number; ?>" class="data__item">
                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.00215554 0.763941C0.0526255 0.45271 0.347034 0.189144 0.667798 0.205407C1.4355 0.205968 2.20321 0.207089 2.97147 0.204846C3.32084 0.175686 3.6674 0.475141 3.66684 0.830673C3.67525 1.62249 3.77955 2.41879 4.02685 3.17304C4.12107 3.42707 4.09134 3.73774 3.89227 3.93458C3.40551 4.42918 2.91315 4.91874 2.42135 5.40886C3.04549 6.60556 3.89339 7.68954 4.93531 8.5509C5.5045 9.03709 6.14267 9.433 6.79653 9.79302C7.17225 9.42627 7.54125 9.05279 7.91136 8.68044C8.10146 8.49033 8.27026 8.25312 8.53102 8.15667C8.6886 8.12583 8.85851 8.12358 9.0116 8.17574C9.59762 8.3636 10.2066 8.47856 10.8201 8.52286C11.0865 8.55033 11.3714 8.4808 11.6215 8.60361C11.8542 8.71296 12.0134 8.96924 11.9938 9.22831C11.9944 9.99714 11.9944 10.766 11.9938 11.5354C12.0179 11.8685 11.7274 12.2111 11.3854 12.2004C8.59046 12.2616 5.80452 11.1742 3.73974 9.29953C1.34802 7.16522 -0.0628946 3.97103 0.00215554 0.763941Z"
                          fill="#BA884D"></path>
                </svg>
				<?php echo $phone_number; ?>
            </a>
            <a href="mailto:<?php //echo $owner->data->user_email; ?>" class="data__item">
                <svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.00967976 0H12.0013V1.23883L11.9905 1.07717L11.913 1.21079C10.5802 2.13703 9.24483 3.05996 7.91032 3.98538C7.5301 4.23611 7.17379 4.52561 6.77459 4.74665C6.20631 4.96522 5.51761 4.96192 4.99222 4.63118C3.3311 3.47566 1.65926 2.3325 0.00390625 1.1679C0.0113293 0.7786 0.00308146 0.3893 0.00967976 0Z"
                          fill="#BA884D"></path>
                    <path d="M0 2.90576C1.31141 3.83117 2.63932 4.73267 3.95156 5.65643C5.04275 6.50019 6.66511 6.56205 7.81157 5.79499C9.16175 4.85144 10.5202 3.92025 11.8695 2.97669C11.9017 2.98247 11.9668 2.99319 11.999 2.99896V8.53659C11.9627 8.54731 11.8901 8.56876 11.8539 8.57948C7.90477 8.57865 3.95486 8.57783 0.00494873 8.57865C0.000824788 6.68742 0.011547 4.79618 0 2.90576Z"
                          fill="#BA884D"></path>
                </svg>
				<?php echo $owner->data->user_email; ?>
            </a>
        </div>
    </div>
</div>
