<?php
/**
 * Mediora Clinic Theme functions and definitions
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MEDIORA_VERSION' ) ) {
	define( 'MEDIORA_VERSION', '1.0.0' );
}

if ( ! defined( 'MEDIORA_DIR' ) ) {
	define( 'MEDIORA_DIR', get_template_directory() );
}

if ( ! defined( 'MEDIORA_URI' ) ) {
	define( 'MEDIORA_URI', get_template_directory_uri() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mediora_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'mediora-clinic', MEDIORA_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 630, true );

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 75,
			'width'       => 382,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Switch default core markup to output valid HTML5.
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary_menu' => esc_html__( 'Menu chính', 'mediora-clinic' ),
			'footer_menu'  => esc_html__( 'Menu chân trang', 'mediora-clinic' ),
		)
	);
}
add_action( 'after_setup_theme', 'mediora_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function mediora_enqueue_scripts() {
	// Google Fonts: Montserrat & Playfair Display
	$fonts_url = 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap';
	wp_enqueue_style( 'mediora-fonts', $fonts_url, array(), null );

	// Bootstrap 5 Grid (Lightweight 12 columns)
	wp_enqueue_style( 'bootstrap-grid', MEDIORA_URI . '/assets/css/bootstrap-grid.min.css', array(), '5.3.3' );

	// Swiper Slider CSS
	wp_enqueue_style( 'swiper-bundle', MEDIORA_URI . '/assets/css/swiper-bundle.min.css', array(), '11.0.0' );

	// Mediora Luxury Theme CSS
	wp_enqueue_style( 'mediora-style', MEDIORA_URI . '/assets/css/theme-style.css', array( 'bootstrap-grid', 'swiper-bundle' ), MEDIORA_VERSION );

	// Main style.css metadata
	wp_enqueue_style( 'mediora-theme-root', get_stylesheet_uri(), array( 'mediora-style' ), MEDIORA_VERSION );

	// Swiper Slider JS
	wp_enqueue_script( 'swiper-bundle', MEDIORA_URI . '/assets/js/swiper-bundle.min.js', array(), '11.0.0', true );

	// Mediora Main JS
	wp_enqueue_script( 'mediora-main', MEDIORA_URI . '/assets/js/theme-main.js', array( 'swiper-bundle' ), MEDIORA_VERSION, true );

	// Localize script data for AJAX booking and interactions
	$localized_data = array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'mediora_booking_nonce' ),
		'thanks'  => esc_html__( 'Cảm ơn bạn! Bác sĩ chuyên khoa MEDIORA sẽ liên hệ tư vấn trong thời gian sớm nhất.', 'mediora-clinic' ),
		'error'   => esc_html__( 'Gửi chưa thành công, vui lòng thử lại hoặc gọi hotline trực tiếp.', 'mediora-clinic' ),
	);
	wp_localize_script( 'mediora-main', 'medioraData', $localized_data );
	wp_localize_script( 'mediora-main', 'MEDIORA', $localized_data );
}
add_action( 'wp_enqueue_scripts', 'mediora_enqueue_scripts' );

/**
 * Preconnect for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function mediora_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'mediora-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'mediora_resource_hints', 10, 2 );

/**
 * Include theme modules and helper files.
 */
require_once MEDIORA_DIR . '/inc/template-tags.php';
require_once MEDIORA_DIR . '/inc/customizer.php';
require_once MEDIORA_DIR . '/inc/post-types.php';
require_once MEDIORA_DIR . '/inc/ajax-booking.php';

if ( ! function_exists( 'mediora_fallback_menu' ) ) {
	/**
	 * Fallback static navigation menu if no WordPress menu is assigned.
	 *
	 * @param array $args wp_nav_menu args.
	 * @return void
	 */
	function mediora_fallback_menu( $args = array() ) {
		$menu_class = ! empty( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : 'main-nav';
		$items = array(
			'#gioi-thieu'     => esc_html__( 'Giới thiệu', 'mediora-clinic' ),
			'#dich-vu'        => esc_html__( 'Dịch vụ', 'mediora-clinic' ),
			'#co-so-vat-chat' => esc_html__( 'Cơ sở vật chất', 'mediora-clinic' ),
			'#bac-si'         => esc_html__( 'Đội ngũ bác sĩ', 'mediora-clinic' ),
			'#cau-chuyen'     => esc_html__( 'Khách hàng', 'mediora-clinic' ),
			'#lien-he'        => esc_html__( 'Liên hệ', 'mediora-clinic' ),
		);

		echo '<ul class="' . $menu_class . '">';
		foreach ( $items as $anchor => $label ) {
			$url = is_front_page() ? $anchor : home_url( '/' . $anchor );
			echo '<li><a class="nav-link" href="' . esc_url( $url ) . '">' . $label . '</a></li>';
		}
		echo '</ul>';
	}
}
