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
	    <?php get_template_part('template-parts/favorite-button'); ?>
        <a href="<?php echo get_permalink(); ?>" class="product-card__img">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
        </a>
        <p class="product-card__title">
            <a href="/artist/<?php echo $artist->post_name; ?>/">
				<?php echo $artist->post_title; ?>
            </a>
        </p>
        <div class="product-card__subtitle">
			<?php echo get_the_title(); ?>
        </div>
    </div>
</div>
