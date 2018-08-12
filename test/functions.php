<?php
/**
 * wp-test functions and definitions
 *
 * @package wp-test
 */

if ( ! function_exists( 'wptest_setup' ) ) {

	add_action( 'after_setup_theme', 'wptest_setup' );
	function wptest_setup() {

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'menu' => 'Site menu'
		) );

		/**
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

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 47,
			'width'       => 157,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}

}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'wptest_scripts' );
function wptest_scripts() {
	wp_enqueue_style( 'wptest-style', get_stylesheet_uri() );
	wp_enqueue_style( 'wptest-fa', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', '5.2.0' );
	wp_enqueue_style( 'wptest-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400&amp;subset=cyrillic' );
	wp_register_script( 'wptest-jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', '3.3.1', true );
	wp_enqueue_script( 'wptest-bootstrap', get_template_directory_uri() . '/js/vendor/bootstrap/bootstrap.min.js', array( 'wptest-jquery' ), '4.1.3', true );
}

/**
 * Customize search widget.
 */
add_filter( 'get_search_form', 'my_search_form', 100 );
function my_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '" >
    <label for="s">
    <span class="screen-reader-text">' . __( 'Search for:' ) . '</span>
    <input type="search" class="search-field" placeholder="Поиск" value="' . get_search_query() . '" name="s">
    </label>
    <input type="submit" class="search-submit" value="' . esc_attr__( 'Search' ) . '" />
    </form>';

	return $form;
}

/**
 * Initialize Custom Post Types.
 */
add_action( 'init', 'wptest_cpt' );
function wptest_cpt() {
	register_post_type( 'carousel', array(
		'labels'             => array(
			'name'               => 'Слайдшоу',
			'singular_name'      => 'Элемент слайдшоу',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый элемент слайдшоу',
			'edit_item'          => 'Редактировать элемент слайдшоу',
			'new_item'           => 'Новый элемент слайдшоу',
			'view_item'          => 'Посмотреть элемент слайдшоу',
			'search_items'       => 'Найти элемент слайдшоу',
			'not_found'          => 'Элементов слайдшоу не найдено',
			'not_found_in_trash' => 'В корзине элементов слайдшоу не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Слайдшоу'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'menu_icon'          => 'dashicons-slides',
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array( 'category' )
	) );

	register_post_type( 'news', array(
		'labels'             => array(
			'name'               => 'Новости', // Основное название типа записи
			'singular_name'      => 'Новость', // отдельное название записи типа Book
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую новость',
			'edit_item'          => 'Редактировать новость',
			'new_item'           => 'Новая новость',
			'view_item'          => 'Посмотреть новость',
			'search_items'       => 'Найти новость',
			'not_found'          => 'Новостей не найдено',
			'not_found_in_trash' => 'В корзине новостей не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Новости'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'menu_icon'          => 'dashicons-clipboard',
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	) );
}

/**
 * Add Woocommerce support.
 */
add_action( 'after_setup_theme', 'wptest_woocommerce_support' );
function wptest_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Remove sorting & results count.
 */
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );