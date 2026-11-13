<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up until <main id="primary">
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hotline     = mediora_get_option( 'hotline', '0945.334.832' );
$hotline_tel = mediora_clean_phone( $hotline );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	// MedicalClinic & Physician Schema.org JSON-LD Structured Data
	mediora_render_schema();
	?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Chuyển tới nội dung chính', 'mediora-clinic' ); ?>
	</a>

	<header id="masthead" class="site-header">
		<div class="container-fluid">
			<div class="row h-100 align-items-center g-0">
				<!-- Brand Logo -->
				<div class="col-auto">
					<?php if ( has_custom_logo() ) : ?>
						<div class="logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/Logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="382" height="75">
						</a>
					<?php endif; ?>
				</div>

				<!-- Desktop Main Navigation -->
				<div class="col d-none d-xl-flex justify-content-center">
					<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Menu chính', 'mediora-clinic' ); ?>">
						<?php
						if ( has_nav_menu( 'primary_menu' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary_menu',
									'container'      => false,
									'menu_class'     => 'main-nav',
									'fallback_cb'    => 'mediora_fallback_menu',
								)
							);
						} else {
							mediora_fallback_menu( array( 'menu_class' => 'main-nav' ) );
						}
						?>
					</nav>
				</div>

				<!-- Desktop Hotline & Consultation CTA -->
				<div class="col-auto d-none d-xl-block">
					<div class="header-cta">
						<a class="hotline" href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>">
							<svg class="hotline-icon" viewBox="0 0 24 24" fill="currentColor" width="20" height="20" aria-hidden="true">
								<path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
							</svg>
							<span><?php echo esc_html( $hotline ); ?></span>
						</a>
						<a href="<?php echo esc_url( is_front_page() ? '#lien-he' : home_url( '/#lien-he' ) ); ?>" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult">
							<?php esc_html_e( 'Đăng ký tư vấn', 'mediora-clinic' ); ?>
						</a>
					</div>
				</div>

				<!-- Mobile Hamburger Button -->
				<div class="col d-flex d-xl-none justify-content-end">
					<button class="btn btn-burger" type="button" aria-label="<?php esc_attr_e( 'Mở menu điều hướng', 'mediora-clinic' ); ?>" aria-controls="mobileDrawer">
						<span></span><span></span><span></span>
					</button>
				</div>
			</div>
		</div>
	</header>

	<!-- Offcanvas Mobile Drawer Navigation -->
	<aside class="mobile-drawer" id="mobileDrawer" aria-label="<?php esc_attr_e( 'Menu di động', 'mediora-clinic' ); ?>">
		<div class="mobile-drawer__header">
			<div class="mobile-drawer__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/Logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="180" height="35">
				</a>
			</div>
			<button type="button" class="mobile-drawer__close" aria-label="<?php esc_attr_e( 'Đóng menu', 'mediora-clinic' ); ?>">&times;</button>
		</div>
		<div class="mobile-drawer__body">
			<?php
			if ( has_nav_menu( 'primary_menu' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary_menu',
						'container'      => false,
						'menu_class'     => 'mobile-nav',
						'fallback_cb'    => 'mediora_fallback_menu',
					)
				);
			} else {
				mediora_fallback_menu( array( 'menu_class' => 'mobile-nav' ) );
			}
			?>
		</div>
		<div class="mobile-drawer__footer">
			<a class="hotline" href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>">
				<svg class="hotline-icon" viewBox="0 0 24 24" fill="currentColor" width="20" height="20" aria-hidden="true">
					<path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
				</svg>
				<span><?php echo esc_html( $hotline ); ?></span>
			</a>
			<a href="<?php echo esc_url( is_front_page() ? '#lien-he' : home_url( '/#lien-he' ) ); ?>" class="btn btn-consult btn-gold-pill w-100" data-bs-toggle="modal" data-bs-target="#popupConsult">
				<?php esc_html_e( 'Đăng ký tư vấn', 'mediora-clinic' ); ?>
			</a>
		</div>
	</aside>
	<div class="mobile-drawer__overlay" aria-hidden="true"></div>

	<main id="primary" class="site-main">
