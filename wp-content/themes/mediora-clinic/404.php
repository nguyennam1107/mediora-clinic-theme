<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="error-404-page py-5 d-flex align-items-center" style="min-height: 70vh;">
	<div class="wrap text-center py-5">
		<div class="error-404__content mx-auto" style="max-width: 680px; background: rgba(18, 24, 32, 0.7); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 24px; padding: 60px 32px; box-shadow: 0 20px 50px rgba(0,0,0,0.6);">
			<!-- Large Luxury 404 Badge -->
			<div class="error-404__badge mb-3" style="font-family: var(--font-head); font-size: clamp(80px, 14vw, 140px); font-weight: 800; line-height: 1; letter-spacing: 0.05em; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
				404
			</div>

			<h1 class="h2 text-white mb-3" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em;">
				<?php esc_html_e( 'Không Tìm Thấy Trang', 'mediora-clinic' ); ?>
			</h1>

			<p class="text-muted mb-4" style="font-size: 18px; line-height: 1.6;">
				<?php esc_html_e( 'Trang bạn tìm kiếm không tồn tại hoặc đã được di chuyển.', 'mediora-clinic' ); ?>
			</p>

			<div class="error-404__actions d-flex flex-wrap justify-content-center gap-3 mt-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-consult btn-gold-pill">
					<span><?php esc_html_e( 'Quay lại Trang Chủ', 'mediora-clinic' ); ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/#dich-vu' ) ); ?>" class="btn btn-gold-outline">
					<span><?php esc_html_e( 'Khám phá Dịch vụ', 'mediora-clinic' ); ?></span>
				</a>
			</div>

			<!-- Secondary Links -->
			<div class="error-404__nav mt-5 pt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
				<p class="text-muted mb-3" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">
					<?php esc_html_e( 'Các liên kết nhanh:', 'mediora-clinic' ); ?>
				</p>
				<div class="d-flex flex-wrap justify-content-center gap-4" style="font-size: 15px;">
					<a href="<?php echo esc_url( home_url( '/#gioi-thieu' ) ); ?>" class="text-white"><?php esc_html_e( 'Giới thiệu', 'mediora-clinic' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#co-so-vat-chat' ) ); ?>" class="text-white"><?php esc_html_e( 'Cơ sở vật chất', 'mediora-clinic' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#bac-si' ) ); ?>" class="text-white"><?php esc_html_e( 'Đội ngũ bác sĩ', 'mediora-clinic' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#cau-chuyen' ) ); ?>" class="text-white"><?php esc_html_e( 'Khách hàng', 'mediora-clinic' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#lien-he' ) ); ?>" class="text-white"><?php esc_html_e( 'Liên hệ', 'mediora-clinic' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
