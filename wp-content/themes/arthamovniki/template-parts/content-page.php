<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Art_Hamovniki
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="lk">
        <div class="lk__header">
            <div class="lk__title">
	            <?php the_title(); ?>
            </div>
        </div>
    </div>

	<?php //arthamovniki_post_thumbnail(); ?>

	<div class="entry-content row">
		<?php
		the_content();

		/*wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arthamovniki' ),
				'after'  => '</div>',
			)
		);*/
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
