<?php
/**
 * KitchinCar Gourmet Championship functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KitchinCar_Gourmet_Championship
 */

define( 'KGC_THEME_DIR', __DIR__ );

if ( ! function_exists( 'kitchincar_gourmet_championship_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kitchincar_gourmet_championship_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on KitchinCar Gourmet Championship, use a find and replace
	 * to change 'kitchincar-gourmet-championship' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kitchincar-gourmet-championship', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'kitchincar-gourmet-championship' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kitchincar_gourmet_championship_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'title-tag' );
}
endif;
add_action( 'after_setup_theme', 'kitchincar_gourmet_championship_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kitchincar_gourmet_championship_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kitchincar_gourmet_championship_content_width', 640 );
}
add_action( 'after_setup_theme', 'kitchincar_gourmet_championship_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kitchincar_gourmet_championship_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kitchincar-gourmet-championship' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kitchincar-gourmet-championship' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kitchincar_gourmet_championship_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kitchincar_gourmet_championship_scripts() {
	wp_enqueue_script( 'kitchincar-gourmet-championship-navigation', get_template_directory_uri() . '/js/video.js', array(), '20170904', true );

	wp_enqueue_script( 'kitchincar-gourmet-championship-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'kitchincar-gourmet-championship-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kitchincar_gourmet_championship_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';





add_action('init', 'register_shop_custom_post');
function register_shop_custom_post() {
    register_post_type(
        'kgc_shop', array(
            'label' => '出店情報',
            'description' => '',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-carrot',
            'menu_position' => 5,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'query_var' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail','editor','excerpt','custom-fields'),
            'taxonomies' => array('release_cat'),
            'labels' => array(
                'name' => '出店情報',
                'singular_name' => '出店情報',
                'menu_name' => '出店情報',
                'add_new' => '新規追加',
                'add_new_item' => '出店情報の新規追加',
                'edit' => '編集',
                'edit_item' => '出店情報の編集',
                'new_item' => '新しい出店情報',
                'view' => '表示',
                'view_item' => '出店情報の出店情報',
                'search_items' => '出店情報の検索',
                'not_found' => '見つかりません',
                'not_found_in_trash' => 'ゴミ箱にはありません。',
                'parent' => '親',
            )
        )
    );
    register_taxonomy(
        'kgc_shop_cat',
        'kgc_shop',
        array(
            'hierarchical' => true,
            'label' => '出店カテゴリー',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => '出店カテゴリー'
        )
    );

	/**
	 * For 'area category' in 2017
	 */
    register_taxonomy(
        'kgc_area',
        'kgc_shop',
        array(
            'hierarchical' => false,
            'label' => '出店エリア',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => '出店エリア'
        )
    );
	/**
	 * 開催年。プラグインから移動。なんとなく…
	 */
	register_taxonomy(
		'kgc_number',
		array( 'kgc_entry', 'kgc_shop' ),
		array(
			'label' => '開催年',
			'hierarchical' => false
		)
	);
}

add_image_size( 'kgc_thumbnail', 231, 117, true );
add_image_size( 'kgc_thumbnail_post', 400, 400, true );
add_image_size( 'kgc_thumbnail_car', 100, 100, true );
add_image_size( 'kgc-post-image', 400, 150, true );
add_image_size( 'kgc_news_thumbnail', 200, 200, array( 'center', 'center' ) );

require_once locate_template('functions/navigation.php');
require_once locate_template('functions/frontnews.php');

/** 以下、2017年用 @author Toshimichi Mimoto <mimosafa@gmail.com> */

/**
 * エントリー台数をGET する関数
 *
 * @param string|integer $year
 * @return integer
 */
function kgc_get_entries_num( $year ) {
	if ( $year == '2016') {
		$numposts = $wpdb->get_var(
			"SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'kgc_shop'"
		);
		if (0 < $numposts) {
			$numposts = number_format($numposts);
		}
		return $numposts;
	}
	if ( $year == '2017' ) {
		return 40;
	}
	return 0;
}

add_action( 'pre_get_posts', function( $q ) {
	if ( $q->is_main_query() && $q->is_post_type_archive( 'kgc_shop' ) ) {
		$args = array(
			array(
				'taxonomy' => 'kgc_number',
				'field'    => 'slug',
				'terms'    => '2017',
			),
		);
		$q->set( 'tax_query', $args );
		if ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] === 'list' ) {
			$q->set( 'orderby', 'meta_value_num' );
			$q->set( 'meta_key', 'kgc_entry_number_2017' );
			$q->set( 'order', 'ASC' );
			return;
		}
		$q->set( 'orderby', 'rand' );
		return;
	}
	if ( $q->is_main_query() && $q->is_tax( 'kgc_area' ) ) {
		$q->set( 'orderby', 'meta_value_num' );
		$q->set( 'meta_key', 'kgc_entry_number_2017' );
		$q->set( 'order', 'ASC' );
		return;
	}
} );
