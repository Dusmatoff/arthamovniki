<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $show_favorite;
$artist_id = get_field( 'artist' );
$artist    = get_post( $artist_id );
?>

<div class="col-lg-4 col-md-6">
    <div class="product-card">
        <button class="add-to-fav">
            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M2.03402 1.40214C2.93973 0.712591 4.11711 0.392799 5.24601 0.531968C6.23314 0.636714 7.16735 1.10086 7.87578 1.79189C8.22703 2.14351 8.57976 2.49402 8.92953 2.84713C9.36073 2.43184 9.76751 1.99102 10.2113 1.58869C10.9005 0.990188 11.7773 0.610435 12.6863 0.523085C13.5513 0.435734 14.4441 0.603032 15.2129 1.01351C16.3295 1.58795 17.1764 2.6628 17.4721 3.88349C17.7123 4.82658 17.6283 5.84554 17.2438 6.73941C17.1083 7.07252 16.9114 7.37455 16.7045 7.66658C16.5201 7.91309 16.2992 8.12887 16.0823 8.34614C13.6979 10.7309 11.3128 13.1149 8.92879 15.5C6.45855 13.0249 3.98387 10.5547 1.51214 8.08113C0.913642 7.4582 0.495396 6.66242 0.337351 5.81186C0.280351 5.56388 0.27739 5.30923 0.25 5.05754C0.254442 4.48495 0.342532 3.90829 0.552396 3.37308C0.847019 2.59396 1.37112 1.90515 2.03402 1.40214Z"/>
            </svg>
        </button>
        <a href="<?php echo get_permalink(); ?>" class="product-card__img">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
        </a>
        <p class="product-card__title">
            <a href="/artist/<?php echo $artist->post_name; ?>/" target="_blank">
				<?php echo $artist->post_title; ?>
            </a>
        </p>
        <div class="product-card__subtitle">
			<?php echo get_the_title(); ?>
        </div>
    </div>
</div>
