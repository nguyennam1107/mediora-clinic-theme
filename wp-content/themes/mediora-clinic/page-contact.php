<?php
/**
 * Template Name: Liên Hệ - Mediora
 *
 * The template for displaying the Contact and Clinic Location page.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri       = get_template_directory_uri();
$clinic_name     = mediora_get_option( 'clinic_name', 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA' );
$clinic_address  = mediora_get_option( 'clinic_address', '257 - 259 Nguyễn Đình Chiểu, Phường Bàn Cờ, Quận 3, TP. Hồ Chí Minh' );
$hotline         = mediora_get_option( 'hotline', '0945.334.832' );
$hotline_tel     = mediora_clean_phone( $hotline );
$zalo_url        = mediora_get_option( 'social_zalo', 'https://zalo.me/636737550228660397' );
$fb_url          = mediora_get_option( 'social_facebook', 'https://www.facebook.com/pkcktmmediora' );
$tiktok_url      = mediora_get_option( 'social_tiktok', 'https://www.tiktok.com/@phongkhammediora' );
$gmaps_embed_url = mediora_get_option( 'google_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4975619551465!2d106.6853637!3d10.7719712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f2324905155%3A0xe54ef99eb24a7cf5!2zMjU3IC0gMjU5IE5ndXnhu4VuIMSQw6xuaCBDaGnhu4N1LCBQaMaw4budbmcgNSwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2svn!4v1715000000000!5m2!1svi!2svn' );
?>

<div class="subpage-content contact-page-main">

	<!-- 1. Hero Subpage Banner -->
	<section class="subpage-banner" aria-label="<?php esc_attr_e( 'Liên hệ MEDIORA', 'mediora-clinic' ); ?>">
		<div class="wrap text-center">
			<?php mediora_breadcrumbs(); ?>
			<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Kết Nối Cùng MEDIORA', 'mediora-clinic' ); ?></span>
			<h1 class="subpage-banner__title gold-text"><?php esc_html_e( 'Liên Hệ & Đặt Lịch Thăm Khám', 'mediora-clinic' ); ?></h1>
			<p class="subpage-banner__desc">
				<?php esc_html_e( 'Đội ngũ chuyên viên y tế và bác sĩ chuyên khoa MEDIORA luôn sẵn sàng lắng nghe, tư vấn phác đồ và phục vụ quý khách chu đáo nhất.', 'mediora-clinic' ); ?>
			</p>
		</div>
	</section>

	<!-- 2. Two-Column Contact Information & Consultation Booking Form -->
	<section class="contact-content-section py-5">
		<div class="wrap">
			<div class="row g-5 align-items-stretch">

				<!-- Left Column: Clinic Contact Details (6 cols) -->
				<div class="col-12 col-lg-6">
					<div class="contact-detail-card d-flex flex-column justify-content-between">
						<div>
							<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Thông Tin Phòng Khám', 'mediora-clinic' ); ?></span>
							<h2 class="h3 gold-text mb-4" style="font-family:var(--font-serif);">
								<?php echo esc_html( $clinic_name ); ?>
							</h2>

							<!-- Address Item -->
							<div class="contact-info-block d-flex gap-3 mb-4">
								<div class="contact-icon-box" style="width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:20px; flex-shrink:0;">
									📍
								</div>
								<div>
									<strong class="text-white d-block mb-1 fs-6"><?php esc_html_e( 'Địa chỉ cơ sở:', 'mediora-clinic' ); ?></strong>
									<p class="text-muted mb-0" style="line-height:1.6;"><?php echo esc_html( $clinic_address ); ?></p>
									<span class="badge bg-dark border border-warning text-warning mt-1" style="font-size:11px;">
										<?php esc_html_e( 'Vị trí đắc địa trung tâm Quận 3', 'mediora-clinic' ); ?>
									</span>
								</div>
							</div>

							<!-- Hotline Item -->
							<div class="contact-info-block d-flex gap-3 mb-4">
								<div class="contact-icon-box" style="width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:20px; flex-shrink:0;">
									📞
								</div>
								<div>
									<strong class="text-white d-block mb-1 fs-6"><?php esc_html_e( 'Hotline tư vấn & CSKH 24/7:', 'mediora-clinic' ); ?></strong>
									<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="gold-text fs-5 fw-bold text-decoration-none">
										<?php echo esc_html( $hotline ); ?>
									</a>
									<p class="text-muted small mb-0"><?php esc_html_e( 'Hỗ trợ đặt lịch hẹn khám ưu tiên không phải chờ đợi', 'mediora-clinic' ); ?></p>
								</div>
							</div>

							<!-- Hours Item -->
							<div class="contact-info-block d-flex gap-3 mb-4">
								<div class="contact-icon-box" style="width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:20px; flex-shrink:0;">
									⏰
								</div>
								<div>
									<strong class="text-white d-block mb-1 fs-6"><?php esc_html_e( 'Giờ tiếp đón & thăm khám:', 'mediora-clinic' ); ?></strong>
									<p class="text-muted mb-0"><?php esc_html_e( '08:00 - 20:00 hằng ngày', 'mediora-clinic' ); ?></p>
									<span class="text-warning small"><?php esc_html_e( 'Làm việc tất cả các ngày trong tuần (Cả Thứ 7, Chủ Nhật & Lễ Tết)', 'mediora-clinic' ); ?></span>
								</div>
							</div>

							<!-- Parking Instructions -->
							<div class="contact-info-block d-flex gap-3 mb-4">
								<div class="contact-icon-box" style="width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:20px; flex-shrink:0;">
									🚗
								</div>
								<div>
									<strong class="text-white d-block mb-1 fs-6"><?php esc_html_e( 'Hướng dẫn bãi đỗ xe ô tô & xe máy:', 'mediora-clinic' ); ?></strong>
									<p class="text-muted small mb-0" style="line-height:1.6;">
										<?php esc_html_e( 'Có chỗ đỗ ô tô và xe máy rộng rãi ngay trước cửa phòng khám. Đội ngũ nhân viên bảo vệ chuyên nghiệp hướng dẫn và hỗ trợ đỗ xe an toàn 24/7.', 'mediora-clinic' ); ?>
									</p>
								</div>
							</div>
						</div>

						<!-- Social Quick Connect Links -->
						<div class="contact-social-bar pt-3 mt-3 border-top d-flex flex-wrap gap-2 align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
							<span class="text-muted small me-2"><?php esc_html_e( 'Kênh trực tuyến:', 'mediora-clinic' ); ?></span>
							<?php if ( ! empty( $zalo_url ) ) : ?>
								<a href="<?php echo esc_url( $zalo_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-warning rounded-pill px-3 py-1">
									Zalo OA
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $fb_url ) ) : ?>
								<a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
									Facebook
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $tiktok_url ) ) : ?>
								<a href="<?php echo esc_url( $tiktok_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1">
									TikTok
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- Right Column: Consultation Booking Form (6 cols) -->
				<div class="col-12 col-lg-6">
					<div class="mediora-card h-100 p-4 p-md-5">
						<?php
						get_template_part(
							'template-parts/booking-form',
							null,
							array(
								'source'         => 'page-contact',
								'show_title_img' => false,
								'title_text'     => esc_html__( 'Đăng Ký Khám & Nhận Ưu Đãi', 'mediora-clinic' ),
								'subtitle_text'  => esc_html__( 'Điền thông tin bên dưới, trợ lý bác sĩ sẽ liên hệ xác nhận lịch trong 15 phút.', 'mediora-clinic' ),
							)
						);
						?>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Optional content from page editor -->
	<?php
	while ( have_posts() ) :
		the_post();
		if ( get_the_content() ) :
			?>
			<section class="contact-custom-content py-4">
				<div class="wrap">
					<div class="mediora-card p-4 mediora-prose">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endwhile;
	?>

	<!-- 3. Full-width Responsive Google Maps Section -->
	<section class="contact-map-section py-5" aria-label="<?php esc_attr_e( 'Bản đồ vị trí phòng khám', 'mediora-clinic' ); ?>">
		<div class="wrap">
			<div class="text-center mb-4">
				<span class="mediora-badge-gold mb-2"><?php esc_html_e( 'Chỉ Đường Đến MEDIORA', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-2" style="font-family:var(--font-serif);"><?php esc_html_e( 'Vị Trí Bản Đồ Trực Quan', 'mediora-clinic' ); ?></h2>
				<p class="text-muted small"><?php echo esc_html( $clinic_address ); ?></p>
			</div>

			<div class="contact-map-wrapper" style="aspect-ratio:16/7; min-height:360px;">
				<iframe
					src="<?php echo esc_url( $gmaps_embed_url ); ?>"
					width="100%"
					height="100%"
					style="border:0; display:block;"
					allowfullscreen=""
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
					title="<?php esc_attr_e( 'Bản đồ chỉ đường tới MEDIORA', 'mediora-clinic' ); ?>">
				</iframe>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
