<?php
/**
 * The template for displaying all single Service CPT posts
 *
 * Provides a specialized 2-column luxury layout:
 * - Left/Main Column: Overview, Target Indications, Step-by-Step Clinical Procedure,
 *   Actual Patient Results, Full Post Content, and Medical FAQs.
 * - Right/Sticky Column: Quick Service Info Card, Priority Hotline, and
 *   Consultation Booking Form integration.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri   = get_template_directory_uri();
$hotline     = mediora_get_option( 'hotline', '0945.334.832' );
$hotline_tel = mediora_clean_phone( $hotline );

while ( have_posts() ) :
	the_post();

	$terms = get_the_terms( get_the_ID(), 'service_category' );
	$cat_name = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->name : esc_html__( 'Thẩm Mỹ Chuyên Sâu', 'mediora-clinic' );
	?>

	<div class="subpage-content service-single-main">

		<!-- 1. Hero Subpage Banner -->
		<section class="subpage-banner" aria-label="<?php the_title_attribute(); ?>">
			<div class="wrap text-center">
				<?php mediora_breadcrumbs(); ?>
				<span class="mediora-badge-gold mb-3"><?php echo esc_html( $cat_name ); ?></span>
				<h1 class="subpage-banner__title gold-text"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="subpage-banner__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php else : ?>
					<p class="subpage-banner__desc">
						<?php esc_html_e( 'Quy trình thực hiện trực tiếp bởi Bác sĩ Chuyên khoa tại phòng vô trùng tiêu chuẩn Bộ Y Tế.', 'mediora-clinic' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</section>

		<!-- 2. Two-Column Main Content & Sticky Sidebar -->
		<div class="service-detail-container pb-5">
			<div class="wrap">
				<div class="row g-5">

					<!-- Left Main Column (8 cols) -->
					<div class="col-12 col-lg-8">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'service-main-content' ); ?>>

							<!-- Featured Image Banner -->
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="service-hero-media mb-4" style="border-radius:16px; overflow:hidden; border:1px solid rgba(212,175,55,0.25); box-shadow:0 12px 30px rgba(0,0,0,0.4);">
									<?php the_post_thumbnail( 'full', array( 'class' => 'w-100 h-auto object-fit-cover' ) ); ?>
								</div>
							<?php endif; ?>

							<!-- Overview & Highlights -->
							<div class="mediora-card mb-4">
								<h2 class="h4 gold-text mb-3" style="font-family:var(--font-serif);">
									<?php esc_html_e( 'Tổng Quan Về Liệu Trình', 'mediora-clinic' ); ?>
								</h2>
								<div class="mediora-prose">
									<?php the_content(); ?>
								</div>
							</div>

							<!-- Target Candidates / Indications -->
							<div class="mediora-card mb-4">
								<div class="d-flex align-items-center gap-2 mb-3">
									<span class="fs-4">🎯</span>
									<h2 class="h4 gold-text m-0" style="font-family:var(--font-serif);">
										<?php esc_html_e( 'Đối Tượng Chỉ Định Phù Hợp', 'mediora-clinic' ); ?>
									</h2>
								</div>
								<p class="text-muted mb-3">
									<?php esc_html_e( 'Phương pháp được bác sĩ chỉ định tối ưu cho các trường hợp khách hàng sau:', 'mediora-clinic' ); ?>
								</p>
								<div class="row g-3">
									<div class="col-12 col-md-6">
										<div class="p-3 rounded" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);">
											<div class="d-flex gap-2">
												<span class="text-warning">✓</span>
												<span class="text-light small"><?php esc_html_e( 'Da mặt chùng nhão, chảy xệ ở vùng má, viền hàm và rãnh cười sâu.', 'mediora-clinic' ); ?></span>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="p-3 rounded" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);">
											<div class="d-flex gap-2">
												<span class="text-warning">✓</span>
												<span class="text-light small"><?php esc_html_e( 'Khách hàng từ 28 - 65 tuổi mong muốn trẻ hóa mà không can thiệp đại phẫu.', 'mediora-clinic' ); ?></span>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="p-3 rounded" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);">
											<div class="d-flex gap-2">
												<span class="text-warning">✓</span>
												<span class="text-light small"><?php esc_html_e( 'Đường viền hàm kém thon gọn, xuất hiện nọng cằm và da cổ nhăn.', 'mediora-clinic' ); ?></span>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="p-3 rounded" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);">
											<div class="d-flex gap-2">
												<span class="text-warning">✓</span>
												<span class="text-light small"><?php esc_html_e( 'Người bận rộn cần giải pháp phục hồi nhanh, không mất thời gian nghỉ dưỡng dài ngày.', 'mediora-clinic' ); ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Step-by-Step Medical Procedure -->
							<div class="mediora-card mb-4">
								<div class="d-flex align-items-center gap-2 mb-4">
									<span class="fs-4">🔬</span>
									<h2 class="h4 gold-text m-0" style="font-family:var(--font-serif);">
										<?php esc_html_e( 'Quy Trình Chuẩn Y Tế Bộ Y Tế', 'mediora-clinic' ); ?>
									</h2>
								</div>

								<div class="service-step-card">
									<div class="service-step-num">01</div>
									<div class="service-step-content">
										<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Thăm Khám & Đo Vẽ Tỷ Lệ Vàng 1:1', 'mediora-clinic' ); ?></h3>
										<p class="text-muted small m-0"><?php esc_html_e( 'Bác sĩ chuyên khoa trực tiếp soi da, đánh giá độ chùng nhão cơ và phác thảo vector nâng cơ riêng biệt.', 'mediora-clinic' ); ?></p>
									</div>
								</div>

								<div class="service-step-card">
									<div class="service-step-num">02</div>
									<div class="service-step-content">
										<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Vệ Sinh Khử Khuẩn & Ủ Tê Chuyên Sâu', 'mediora-clinic' ); ?></h3>
										<p class="text-muted small m-0"><?php esc_html_e( 'Sát khuẩn vùng mặt 3 bước theo quy chuẩn phòng phẫu thuật y khoa và gây tê cục bộ êm ái, nhẹ nhàng.', 'mediora-clinic' ); ?></p>
									</div>
								</div>

								<div class="service-step-card">
									<div class="service-step-num">03</div>
									<div class="service-step-content">
										<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Tiến Hành Thủ Thuật Trong Phòng Vô Trùng', 'mediora-clinic' ); ?></h3>
										<p class="text-muted small m-0"><?php esc_html_e( 'Bác sĩ thực hiện kỹ thuật luồn sợi hoặc tạo hình vi phẫu chính xác theo từng lớp mạc nông SMAS.', 'mediora-clinic' ); ?></p>
									</div>
								</div>

								<div class="service-step-card">
									<div class="service-step-num">04</div>
									<div class="service-step-content">
										<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Kiểm Tra Kết Quả Trực Tiếp Cùng Khách Hàng', 'mediora-clinic' ); ?></h3>
										<p class="text-muted small m-0"><?php esc_html_e( 'Khách hàng soi gương đối chiếu sự thay đổi trước - sau ngay tại phòng phẫu thuật.', 'mediora-clinic' ); ?></p>
									</div>
								</div>

								<div class="service-step-card mb-0">
									<div class="service-step-num">05</div>
									<div class="service-step-content">
										<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Chăm Sóc Hậu Phẫu & Cấp Phiếu Bảo Hành', 'mediora-clinic' ); ?></h3>
										<p class="text-muted small m-0"><?php esc_html_e( 'Nghỉ dưỡng tại phòng VIP, hướng dẫn chăm sóc tại nhà và hẹn lịch tái khám định kỳ chu đáo.', 'mediora-clinic' ); ?></p>
									</div>
								</div>
							</div>

							<!-- Actual Results & Case Studies -->
							<div class="mediora-card mb-4">
								<div class="d-flex align-items-center gap-2 mb-4">
									<span class="fs-4">✨</span>
									<h2 class="h4 gold-text m-0" style="font-family:var(--font-serif);">
										<?php esc_html_e( 'Hình Ảnh Khách Hàng Thực Tế', 'mediora-clinic' ); ?>
									</h2>
								</div>
								<div class="row g-3">
									<div class="col-12 col-md-4">
										<div class="result-thumb text-center">
											<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-ngan-quynh.png' ); ?>"
												alt="<?php esc_attr_e( 'Nghệ sĩ Ngân Quỳnh', 'mediora-clinic' ); ?>"
												class="w-100 rounded mb-2"
												style="border-radius:10px; border:1px solid rgba(212,175,55,0.25);"
												loading="lazy">
											<span class="text-white small fw-bold d-block"><?php esc_html_e( 'Nghệ sĩ Ngân Quỳnh', 'mediora-clinic' ); ?></span>
											<span class="text-muted" style="font-size:12px;"><?php esc_html_e( 'Nâng cơ trẻ hóa toàn mặt', 'mediora-clinic' ); ?></span>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="result-thumb text-center">
											<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-vi-tuong.png' ); ?>"
												alt="<?php esc_attr_e( 'Doanh nhân Vĩ Tường', 'mediora-clinic' ); ?>"
												class="w-100 rounded mb-2"
												style="border-radius:10px; border:1px solid rgba(212,175,55,0.25);"
												loading="lazy">
											<span class="text-white small fw-bold d-block"><?php esc_html_e( 'Doanh nhân Vĩ Tường', 'mediora-clinic' ); ?></span>
											<span class="text-muted" style="font-size:12px;"><?php esc_html_e( 'Định hình đường viền hàm', 'mediora-clinic' ); ?></span>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="result-thumb text-center">
											<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-hien-pham.png' ); ?>"
												alt="<?php esc_attr_e( 'Khách hàng Hiền Phạm', 'mediora-clinic' ); ?>"
												class="w-100 rounded mb-2"
												style="border-radius:10px; border:1px solid rgba(212,175,55,0.25);"
												loading="lazy">
											<span class="text-white small fw-bold d-block"><?php esc_html_e( 'Khách hàng Hiền Phạm', 'mediora-clinic' ); ?></span>
											<span class="text-muted" style="font-size:12px;"><?php esc_html_e( 'Xóa nhăn rãnh cười & căng da', 'mediora-clinic' ); ?></span>
										</div>
									</div>
								</div>
							</div>

							<!-- Frequently Asked Questions (FAQ) -->
							<div class="mediora-card mb-4">
								<div class="d-flex align-items-center gap-2 mb-4">
									<span class="fs-4">❓</span>
									<h2 class="h4 gold-text m-0" style="font-family:var(--font-serif);">
										<?php esc_html_e( 'Câu Hỏi Thường Gặp (FAQ)', 'mediora-clinic' ); ?>
									</h2>
								</div>

								<div class="mediora-faq-card">
									<h3 class="mediora-faq-q">
										<span>Q:</span> <?php esc_html_e( 'Liệu trình có gây đau hoặc sưng bầm nhiều không?', 'mediora-clinic' ); ?>
									</h3>
									<p class="mediora-faq-a">
										<?php esc_html_e( 'Tại MEDIORA, toàn bộ quy trình được thực hiện với kỹ thuật vi phẫu ít xâm lấn và công nghệ ủ tê chuyên sâu. Khách hàng cảm thấy hoàn toàn thư giãn, có thể đi làm và sinh hoạt bình thường ngay sau 1 - 2 ngày.', 'mediora-clinic' ); ?>
									</p>
								</div>

								<div class="mediora-faq-card">
									<h3 class="mediora-faq-q">
										<span>Q:</span> <?php esc_html_e( 'Hiệu quả duy trì được trong thời gian bao lâu?', 'mediora-clinic' ); ?>
									</h3>
									<p class="mediora-faq-a">
										<?php esc_html_e( 'Hiệu quả nâng đỡ và săn chắc thấy ngay tức thì sau thủ thuật. Tiếp sau đó, mạng lưới sinh học kích thích sản sinh collagen tự nhiên liên tục, giúp duy trì nét thanh xuân tươi trẻ bền vững từ 3 - 5 năm tùy cơ địa.', 'mediora-clinic' ); ?>
									</p>
								</div>

								<div class="mediora-faq-card mb-0">
									<h3 class="mediora-faq-q">
										<span>Q:</span> <?php esc_html_e( 'Có cần kiểm tra sức khỏe trước khi thực hiện không?', 'mediora-clinic' ); ?>
									</h3>
									<p class="mediora-faq-a">
										<?php esc_html_e( 'Bác sĩ MEDIORA sẽ thăm khám tiền sử bệnh lý, đo huyết áp và chỉ định kiểm tra y khoa cần thiết để bảo đảm 100% điều kiện an toàn y tế trước khi tiến hành.', 'mediora-clinic' ); ?>
									</p>
								</div>
							</div>

						</article>
					</div>

					<!-- Right Sticky Sidebar (4 cols) -->
					<div class="col-12 col-lg-4">
						<aside class="service-sticky-sidebar">

							<!-- Service Summary Card -->
							<div class="service-summary-box mb-4">
								<h3 class="h5 gold-text mb-3" style="font-family:var(--font-serif);">
									<?php esc_html_e( 'Thông Tin Liệu Trình', 'mediora-clinic' ); ?>
								</h3>

								<div class="service-meta-item">
									<div class="service-meta-icon">⏱️</div>
									<div>
										<span class="text-muted small d-block"><?php esc_html_e( 'Thời gian thực hiện', 'mediora-clinic' ); ?></span>
										<strong class="text-white"><?php esc_html_e( '45 - 60 phút', 'mediora-clinic' ); ?></strong>
									</div>
								</div>

								<div class="service-meta-item">
									<div class="service-meta-icon">🛌</div>
									<div>
										<span class="text-muted small d-block"><?php esc_html_e( 'Thời gian nghỉ dưỡng', 'mediora-clinic' ); ?></span>
										<strong class="text-white"><?php esc_html_e( 'Không cần nghỉ dưỡng', 'mediora-clinic' ); ?></strong>
									</div>
								</div>

								<div class="service-meta-item">
									<div class="service-meta-icon">👨‍⚕️</div>
									<div>
										<span class="text-muted small d-block"><?php esc_html_e( 'Bác sĩ phụ trách', 'mediora-clinic' ); ?></span>
										<strong class="text-white"><?php esc_html_e( 'Bác sĩ CKI - CKII Thẩm mỹ', 'mediora-clinic' ); ?></strong>
									</div>
								</div>

								<div class="service-meta-item">
									<div class="service-meta-icon">🛡️</div>
									<div>
										<span class="text-muted small d-block"><?php esc_html_e( 'Bảo hành & Cam kết', 'mediora-clinic' ); ?></span>
										<strong class="text-white"><?php esc_html_e( 'Cam kết bằng văn bản y khoa', 'mediora-clinic' ); ?></strong>
									</div>
								</div>

								<div class="mt-4 pt-3 border-top" style="border-color:rgba(255,255,255,0.08) !important;">
									<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="btn btn-gold-outline w-100 py-2 d-flex align-items-center justify-content-center gap-2">
										<span>📞</span>
										<span><?php echo esc_html( $hotline ); ?></span>
									</a>
								</div>
							</div>

							<!-- Embedded Fast Booking Form -->
							<div class="service-booking-form-box mediora-card p-3 p-xl-4">
								<?php
								get_template_part(
									'template-parts/booking-form',
									null,
									array(
										'source'         => 'service-single-sidebar',
										'show_title_img' => false,
										'title_text'     => esc_html__( 'Đặt Lịch Khám 1:1', 'mediora-clinic' ),
										'subtitle_text'  => esc_html__( 'Bác sĩ chuyên khoa liên hệ tư vấn miễn phí', 'mediora-clinic' ),
									)
								);
								?>
							</div>

						</aside>
					</div>

				</div>
			</div>
		</div>

	</div>

	<?php
endwhile;

get_footer();
