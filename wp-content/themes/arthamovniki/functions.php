<?php
/**
 * Art Hamovniki functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Art_Hamovniki
 */
global $current_user;
global $is_partner;
$is_partner = is_current_user_partner( $current_user );

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.16' );
}

if ( ! function_exists( 'arthamovniki_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function arthamovniki_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Art Hamovniki, use a find and replace
		 * to change 'arthamovniki' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'arthamovniki', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1'      => esc_html__( 'Primary', 'arthamovniki' ),
				'menu-footer' => esc_html__( 'Footer', 'arthamovniki' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'arthamovniki_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'arthamovniki_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arthamovniki_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'arthamovniki_content_width', 640 );
}

add_action( 'after_setup_theme', 'arthamovniki_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arthamovniki_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'arthamovniki' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'arthamovniki' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'arthamovniki_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arthamovniki_scripts() {
	wp_enqueue_style( 'arthamovniki-main-style', get_stylesheet_directory_uri() . '/css/main.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'arthamovniki-style', get_stylesheet_uri(), array(), _S_VERSION );
	//wp_enqueue_style( 'image-uploader-css', get_template_directory_uri() . '/css/image-uploader.min.css' );
	//wp_style_add_data( 'arthamovniki-style', 'rtl', 'replace' );

	/*wp_enqueue_script( 'arthamovniki-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}*/

	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
	}
	wp_enqueue_script( 'arthamovniki-jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', [], '3.4.1', true );
	wp_enqueue_script( 'arthamovniki-plugins', get_template_directory_uri() . '/js/plugins.min.js', [], _S_VERSION, true );
	wp_enqueue_script( 'arthamovniki-main-js', get_template_directory_uri() . '/js/main.min.js', [], _S_VERSION, true );

	if ( is_page_template( 'page-account.php' ) || is_page_template( 'page-add-picture.php' ) || is_page_template( 'page-change-password.php' ) || is_page_template( 'page-edit-picture.php' ) ) {
		wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', [ 'arthamovniki-jquery' ], '1.19.2', true );
		wp_enqueue_script( 'jquery-validate-additional-methods', get_template_directory_uri() . '/js/additional-methods.min.js', [ 'arthamovniki-jquery' ], '1.19.2', true );
		wp_enqueue_script( 'jquery-validation-messages', get_template_directory_uri() . '/js/jquery-validation-messages.js', [ 'jquery-validate' ], '1', true );
	}

	if ( is_page_template( 'page-add-picture.php' ) || is_page_template( 'page-edit-picture.php' ) ) {
		wp_enqueue_script( 'chosen-script', get_template_directory_uri() . '/js/chosen.jquery.min.js', [ 'arthamovniki-jquery' ], '1.8.7', true );
		wp_enqueue_style( 'chosen-css', get_template_directory_uri() . '/css/chosen.css' );

		wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery.ui.widget.js', [ 'arthamovniki-jquery' ], '1.12.1', true );
		wp_enqueue_style( 'jquery-fileupload-css', get_template_directory_uri() . '/css/jquery.fileupload.css' );
		wp_enqueue_style( 'jquery-fileupload-ui-css', get_template_directory_uri() . '/css/jquery.fileupload-ui.css' );
		wp_enqueue_script( 'tmpl', get_template_directory_uri() . '/js/tmpl.min.js', [ 'arthamovniki-jquery' ], '1' );
		wp_enqueue_script( 'load-image-all', get_template_directory_uri() . '/js/load-image.all.min.js', [ 'arthamovniki-jquery' ], '1', true );
		wp_enqueue_script( 'jquery-fileupload', get_template_directory_uri() . '/js/jquery.fileupload.js', [ 'arthamovniki-jquery' ], '1', true );
		wp_enqueue_script( 'jquery-fileupload-process', get_template_directory_uri() . '/js/jquery.fileupload-process.js', [ 'arthamovniki-jquery' ], '1', true );
		wp_enqueue_script( 'jquery-fileupload-image', get_template_directory_uri() . '/js/jquery.fileupload-image.js', [ 'arthamovniki-jquery' ], '1', true );
		//wp_enqueue_script( 'jquery-fileupload-video', get_template_directory_uri() . '/js/jquery.fileupload-video.js', [ 'arthamovniki-jquery' ], '1', true );
		wp_enqueue_script( 'jquery-fileupload-validate', get_template_directory_uri() . '/js/jquery.fileupload-validate.js', [ 'arthamovniki-jquery' ], '1', true );
		wp_enqueue_script( 'jquery-fileupload-ui', get_template_directory_uri() . '/js/jquery.fileupload-ui.js', [ 'arthamovniki-jquery' ], '1', true );
	}

	wp_enqueue_script( 'picture-favorite', get_stylesheet_directory_uri() . '/js/pictureFavorite.js', [], _S_VERSION, true );

	if ( is_page_template( 'page-favorites.php' ) ) {
		wp_enqueue_script( 'favorites-page', get_stylesheet_directory_uri() . '/js/favoritesPage.js', [], _S_VERSION, true );
	}

	if ( is_archive() ) {
		wp_enqueue_script( 'picture-filter', get_stylesheet_directory_uri() . '/js/pictureFilter.js', [], _S_VERSION, true );
	}

	wp_localize_script( 'arthamovniki-main-js', 'Ajax', [
		'nonce' => wp_create_nonce( 'ajax_nonce' ),
		'url'   => admin_url( 'admin-ajax.php' ),
	] );
}

add_action( 'wp_enqueue_scripts', 'arthamovniki_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions navigations
 */
require get_template_directory() . '/inc/functions-navigations.php';

/**
 * Functions account
 */
require get_template_directory() . '/inc/functions-account.php';

/**
 * Functions pictures
 */
require get_template_directory() . '/inc/functions-pictures.php';

/**
 * Functions favorites
 */
require get_template_directory() . '/inc/functions-favorites.php';

/**
 * Functions filter pictures
 */
require get_template_directory() . '/inc/functions-filter.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom menu
 */
require get_template_directory() . '/inc/HamovnikiNavMenu.php';
require get_template_directory() . '/inc/HamovnikiMobileMenu.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom pagination template
 */
function hamovniki_pagination( $args = [], $class = 'pagination' ) {
	$see = isset( $_GET['see'] ) ? $_GET['see'] : 'everyone';

	if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		[
			'end_size'           => 3,
			'mid_size'           => 1,
			'prev_next'          => true,
			'prev_text'          => '<',
			'next_text'          => '>',
			'screen_reader_text' => '??????????????????',
			'type'               => 'array',
			'current'            => max( 1, get_query_var( 'paged' ) ),
		]
	);

	$links = paginate_links( $args );
	?>
    <nav aria-label="<?php echo $args['screen_reader_text']; ?>">
        <ul class="pagenavi">
			<?php
			echo '<li class="pagenavi__item"><a href=' . get_pagenum_link( 1 ) . '><<</a></li>';

			foreach ( $links as $key => $link ) {
				?>
                <li class="pagenavi__item <?php echo strpos( $link, 'current' ) ? 'current' : ''; ?>">
					<?php echo str_replace( 'page-numbers', 'pagenavi__link', $link ); ?>
                </li>
				<?php
			}

			echo '<li class="pagenavi__item"><a href=' . get_pagenum_link( $GLOBALS['wp_query']->max_num_pages ) . '>>></a></li>';
			?>
        </ul>
    </nav>
	<?php
}

/**
 * Check current user role
 */
function is_current_user_partner( $user = null ) {
	if ( ! $user ) {
		$user = wp_get_current_user();
	}

	return in_array( 'um_partner', $user->roles );
}

/**
 * Custom admin column for pictures
 */
add_filter( 'manage_picture_posts_columns', function ( $columns ) {
	$new_columns = [ 'artist' => '????????????????', 'who_can_see' => '???????? ??????????' ];

	return array_slice( $columns, 0, 1 ) + $columns + $new_columns;
} );

add_action( 'manage_picture_posts_custom_column', function ( $column_name ) {
	$theme_uri   = get_stylesheet_directory_uri();
	$who_can_see = get_field( 'who_can_see' );
	$is_active   = get_field( 'is_active' );

	if ( $column_name === 'who_can_see' ) {
		if ( ! $is_active ) {
			echo "<img src='$theme_uri/img/ban.png' width='48'>";
		} else {
			switch ( $who_can_see ) {
				case 'everyone':
					echo "<span>?????????? ??????????????</span>";
					break;
				case 'museum':
					echo "<span>???????????????? ??????????????</span>";
					break;
				case 'partners':
					echo "<img src='$theme_uri/img/handshake.png' width='48'>";
					break;
				case 'hide_from_catalog':
					echo "<img src='$theme_uri/img/lock.png' width='48'>";
					break;
			}
		}
	}

	$artist_id = get_field( 'artist' );
	$artist    = get_post( $artist_id );

	if ( $column_name === 'artist' ) {
		echo "<a href='/artist/$artist->post_name/' target='_blank'>$artist->post_title</a>";
	}
} );

/**
 * Show icons for admin (picture status and who can see)
 */
function show_icon_for_admin( $post_id ) {
	$picture   = get_post( $post_id );
	$theme_uri = get_stylesheet_directory_uri();

	if ( $picture->post_status == 'draft' ) {
		echo "<img src='$theme_uri/img/pencil.png' width='48'>";
	} else {
		$who_can_see = get_field( 'who_can_see', $post_id );
		$is_active   = get_field( 'is_active', $post_id );

		if ( ! $is_active ) {
			echo "<img src='$theme_uri/img/ban.png' width='48'>";
		} else {
			switch ( $who_can_see ) {
				case 'everyone':
					echo "<span>?????????? ????????</span>";
					break;
				case 'museum':
					echo "<span>???????????????? ??????????????</span>";
					break;
				case 'partners':
					echo "<img src='$theme_uri/img/handshake.png' width='48'>";
					break;
				case 'hide_from_catalog':
					echo "<img src='$theme_uri/img/lock.png' width='48'>";
					break;
			}
		}
	}
}

/**
 * Fix order numbers for all pictures & authors
 */
add_action( 'wp_ajax_fix_pictures_order_numbers', 'fix_pictures_order_numbers' );
function fix_pictures_order_numbers() {
	$catalog_type = $_GET['type'];

	$query = new WP_Query;

	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
		'meta_key'       => 'order_number',
		'orderby'        => [ 'meta_value_num' => 'ASC' ],
		'meta_query'     => [
			[ 'key' => 'who_can_see', 'value' => $catalog_type ],
		]
	];

	$pictures = $query->query( $args );

	for ( $i = 0; $i < count( $pictures ); $i ++ ) {
		$post_title = $pictures[ $i ]->post_title;
		$num        = $i + 1;
		update_post_meta( $pictures[ $i ]->ID, 'order_number', $num );
		echo "<p>???????????????????? ?????????? ?????? $post_title ???????????????? ???? $num<p>";
	}

	wp_die();
}

add_action( 'wp_ajax_fix_authors_order_numbers', 'fix_authors_order_numbers' );
function fix_authors_order_numbers() {
	$artists = get_posts( [
		'post_type'      => 'artist',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
		'meta_key'       => 'order_number',
		'orderby'        => [ 'meta_value_num' => 'ASC' ],
	] );

	for ( $i = 0; $i < count( $artists ); $i ++ ) {
		$post_title = $artists[ $i ]->post_title;
		$num        = $i + 1;
		update_post_meta( $artists[ $i ]->ID, 'order_number', $num );
		echo "<p>???????????????????? ?????????? ?????? $post_title ???????????????? ???? $num<p>";
	}

	wp_die();
}

/**
 * Admin styles
 */
add_action( 'admin_enqueue_scripts', 'arthamovniki_admin_styles' );
function arthamovniki_admin_styles() {
	global $pagenow;

	if ( 'post.php' === $pagenow && isset( $_GET['post'] ) && 'picture' === get_post_type( $_GET['post'] ) ) {
		wp_enqueue_style( 'arthamovniki_admin_css', get_template_directory_uri() . '/css/admin-style.css', false, _S_VERSION );
	}
}

/**
 * Picture save
 */
add_action( 'acf/save_post', 'picture_save_postmeta' );
function picture_save_postmeta( $post_id ) {
	if ( 'picture' !== $_POST['post_type'] ) {
		return;
	}

	$width  = get_field( 'width', $post_id );
	$length = get_field( 'length', $post_id );

	$size = generate_picture_size( $width, $length );
	update_post_meta( $post_id, 'size', $size );
}

add_action( 'wp_ajax_fix_pictures_sizes', 'fix_pictures_sizes' );
function fix_pictures_sizes() {
	$query = new WP_Query;

	$args = [
		'post_type'      => 'picture',
		'posts_per_page' => - 1,
		'post_status'    => 'any'
	];

	$pictures = $query->query( $args );

	for ( $i = 0; $i < count( $pictures ); $i ++ ) {
		$width  = get_field( 'width', $pictures[ $i ]->ID );
		$length = get_field( 'length', $pictures[ $i ]->ID );

        if (!empty($width) && !empty($length)) {
	        $size = generate_picture_size( $width, $length );
	        update_post_meta( $pictures[ $i ]->ID, 'size', $size );
	        $post_title = $pictures[ $i ]->post_title;
	        echo "<p>???????????? ?????? $post_title ???????????????? ???? $size<p>";
        }
	}

	wp_die();
}

function generate_artist_pictures_args($count, $who_can_see, $artist_id)
{
	return [
		'post_type'      => 'picture',
		'posts_per_page' => $count,
		'meta_query'     => [
			'relation' => 'AND',
			[ 'key' => 'who_can_see', 'value' => $who_can_see, 'compare' => '=' ],
			[ 'key' => 'is_active', 'value' => '1' ],
			[ 'key' => 'artist', 'value' => $artist_id ]
		],
		'meta_key'       => 'order_number',
		'orderby'        => [ 'meta_value_num' => 'ASC' ],
	];
}
