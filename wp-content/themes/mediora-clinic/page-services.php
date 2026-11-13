<?php
/**
 * Template Name: Danh Mục Dịch Vụ - Mediora
 *
 * The template for displaying the Services Directory / Catalog page.
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
?>

<div class="subpage-content services-page-main">

	<!-- 1. Hero Subpage Banner -->
	<section class="subpage-banner" aria-label="<?php esc_attr_e( 'Dịch vụ thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>">
		<div class="wrap text-center">
			<?php mediora_breadcrumbs(); ?>
			<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Danh Mục Dịch Vụ Đỉnh Cao', 'mediora-clinic' ); ?></span>
			<h1 class="subpage-banner__title gold-text"><?php esc_html_e( 'Giải Pháp Thẩm Mỹ Chuẩn Y Khoa Toàn Diện', 'mediora-clinic' ); ?></h1>
			<p class="subpage-banner__desc">
				<?php esc_html_e( 'Khám phá các dịch vụ nâng cơ, trẻ hóa da công nghệ cao và phẫu thuật tạo hình vi phẫu được cá nhân hóa bởi đội ngũ bác sĩ chuyên khoa MEDIORA.', 'mediora-clinic' ); ?>
			</p>
		</div>
	</section>

	<!-- 2. Services Grid Section -->
	<section class="services-list-section py-5">
		<div class="wrap">
			<?php
			// Query all services from CPT service
			$service_query = new WP_Query(
				array(
					'post_type'      => 'service',
					'posts_per_page' => 12,
					'post_status'    => 'publish',
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
				)
			);

			if ( $service_query->have_posts() ) :
				?>
				<div class="row g-4">
					<?php
					while ( $service_query->have_posts() ) :
						$service_query->the_post();
						$terms = get_the_terms( get_the_ID(), 'service_category' );
						$cat_name = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->name : esc_html__( 'Thẩm Mỹ Chuyên Sâu', 'mediora-clinic' );
						?>
						<div class="col-12 col-md-6 col-lg-4">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'mediora-card h-100 d-flex flex-column p-0 overflow-hidden' ); ?>>
								<div class="service-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-100 h-100 object-fit-cover' ) ); ?>
										<?php else : ?>
											<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/cover.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
										<?php endif; ?>
									</a>
									<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
										<?php echo esc_html( $cat_name ); ?>
									</span>
								</div>

								<div class="service-card__body p-4 d-flex flex-column flex-grow-1">
									<h2 class="h5 mb-2">
										<a href="<?php the_permalink(); ?>" class="text-white text-decoration-none">
											<?php the_title(); ?>
										</a>
									</h2>
									<div class="service-card__excerpt text-muted mb-4" style="font-size:14px; line-height:1.6; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
										<?php the_excerpt(); ?>
									</div>
									<div class="service-card__actions mt-auto pt-3 border-top d-flex gap-2 justify-content-between align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
										<a href="<?php the_permalink(); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:14px; text-transform:uppercase;">
											<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
										</a>
										<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult" style="font-size:12px; padding:6px 16px;">
											<?php esc_html_e( 'Đăng ký', 'mediora-clinic' ); ?>
										</a>
									</div>
								</div>
							</article>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php else : ?>
				<!-- Showcase curated services grid fallback -->
				<div class="row g-4">
					<!-- Service 1: GMISS -->
					<div class="col-12 col-md-6 col-lg-3">
						<article class="mediora-card h-100 d-flex flex-column p-0 overflow-hidden">
							<div class="service-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
								<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/21.png' ); ?>" alt="<?php esc_attr_e( 'Nâng cơ trẻ hóa GMISS', 'mediora-clinic' ); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
								<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
									<?php esc_html_e( 'Độc Quyền MEDIORA', 'mediora-clinic' ); ?>
								</span>
							</div>
							<div class="service-card__body p-4 d-flex flex-column flex-grow-1">
								<h2 class="h5 mb-2 text-white"><?php esc_html_e( 'Nâng Cơ Trẻ Hóa GMISS', 'mediora-clinic' ); ?></h2>
								<p class="text-muted mb-4" style="font-size:14px; line-height:1.6;">
									<?php esc_html_e( 'Công nghệ nâng cơ bằng sợi sinh học đa tầng độc quyền, kéo căng vùng da chùng nhão, kiến tạo đường viền hàm sắc nét không phẫu thuật.', 'mediora-clinic' ); ?>
								</p>
								<div class="mt-auto pt-3 border-top d-flex gap-2 justify-content-between align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
									<a href="<?php echo esc_url( home_url( '/#dich-vu' ) ); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:13px; text-transform:uppercase;">
										<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
									</a>
									<a href="#lien-he" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult" style="font-size:12px; padding:6px 14px;">
										<?php esc_html_e( 'Đăng ký', 'mediora-clinic' ); ?>
									</a>
								</div>
							</div>
						</article>
					</div>

					<!-- Service 2: Phẫu Thuật Tạo Hình -->
					<div class="col-12 col-md-6 col-lg-3">
						<article class="mediora-card h-100 d-flex flex-column p-0 overflow-hidden">
							<div class="service-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
								<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/cover.jpg' ); ?>" alt="<?php esc_attr_e( 'Phẫu thuật tạo hình thẩm mỹ', 'mediora-clinic' ); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
								<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
									<?php esc_html_e( 'Tạo Hình Thẩm Mỹ', 'mediora-clinic' ); ?>
								</span>
							</div>
							<div class="service-card__body p-4 d-flex flex-column flex-grow-1">
								<h2 class="h5 mb-2 text-white"><?php esc_html_e( 'Phẫu Thuật Tạo Hình Vi Phẫu', 'mediora-clinic' ); ?></h2>
								<p class="text-muted mb-4" style="font-size:14px; line-height:1.6;">
									<?php esc_html_e( 'Tạo hình mắt hai mí tự nhiên, nâng mũi cấu trúc sụn sinh học, thu gọn cánh mũi và định hình khuôn mặt V-Line thanh tú.', 'mediora-clinic' ); ?>
								</p>
								<div class="mt-auto pt-3 border-top d-flex gap-2 justify-content-between align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
									<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:13px; text-transform:uppercase;">
										<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
									</a>
									<a href="#lien-he" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult" style="font-size:12px; padding:6px 14px;">
										<?php esc_html_e( 'Đăng ký', 'mediora-clinic' ); ?>
									</a>
								</div>
							</div>
						</article>
					</div>

					<!-- Service 3: Thẩm Mỹ Nội Khoa -->
					<div class="col-12 col-md-6 col-lg-3">
						<article class="mediora-card h-100 d-flex flex-column p-0 overflow-hidden">
							<div class="service-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
								<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/bg_video.png' ); ?>" alt="<?php esc_attr_e( 'Thẩm mỹ nội khoa công nghệ cao', 'mediora-clinic' ); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
								<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
									<?php esc_html_e( 'Nội Khoa Công Nghệ Cao', 'mediora-clinic' ); ?>
								</span>
							</div>
							<div class="service-card__body p-4 d-flex flex-column flex-grow-1">
								<h2 class="h5 mb-2 text-white"><?php esc_html_e( 'Trẻ Hóa Da Tầng Sâu', 'mediora-clinic' ); ?></h2>
								<p class="text-muted mb-4" style="font-size:14px; line-height:1.6;">
									<?php esc_html_e( 'Cấy vi điểm tinh chất sinh học, xóa nhăn rãnh cười, phục hồi thể tích thái dương và làm đầy má hóp an toàn chuẩn y tế.', 'mediora-clinic' ); ?>
								</p>
								<div class="mt-auto pt-3 border-top d-flex gap-2 justify-content-between align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
									<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:13px; text-transform:uppercase;">
										<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
									</a>
									<a href="#lien-he" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult" style="font-size:12px; padding:6px 14px;">
										<?php esc_html_e( 'Đăng ký', 'mediora-clinic' ); ?>
									</a>
								</div>
							</div>
						</article>
					</div>

					<!-- Service 4: Chăm Sóc Da Chuyên Sâu -->
					<div class="col-12 col-md-6 col-lg-3">
						<article class="mediora-card h-100 d-flex flex-column p-0 overflow-hidden">
							<div class="service-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
								<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-3-1.png' ); ?>" alt="<?php esc_attr_e( 'Trị liệu phục hồi da chuyên sâu', 'mediora-clinic' ); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
								<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
									<?php esc_html_e( 'Phục Hồi Chuyên Sâu', 'mediora-clinic' ); ?>
								</span>
							</div>
							<div class="service-card__body p-4 d-flex flex-column flex-grow-1">
								<h2 class="h5 mb-2 text-white"><?php esc_html_e( 'Tái Sinh Cấu Trúc Da', 'mediora-clinic' ); ?></h2>
								<p class="text-muted mb-4" style="font-size:14px; line-height:1.6;">
									<?php esc_html_e( 'Liệu pháp phục hồi màng bảo vệ da, điều trị nám tàn nhang đa tầng, trẻ hóa sáng bóng căng mọng chuẩn làn da thủy tinh.', 'mediora-clinic' ); ?>
								</p>
								<div class="mt-auto pt-3 border-top d-flex gap-2 justify-content-between align-items-center" style="border-color:rgba(255,255,255,0.08) !important;">
									<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:13px; text-transform:uppercase;">
										<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
									</a>
									<a href="#lien-he" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult" style="font-size:12px; padding:6px 14px;">
										<?php esc_html_e( 'Đăng ký', 'mediora-clinic' ); ?>
									</a>
								</div>
							</div>
						</article>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 3. Safety Commitment & Transparent Pricing Section -->
	<section class="services-commitment-section py-5" style="background:var(--bg-secondary); border-top:1px solid rgba(212,175,55,0.15);">
		<div class="wrap">
			<div class="text-center mb-5">
				<span class="mediora-badge-gold mb-2"><?php esc_html_e( 'Cam Kết Vàng', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif);"><?php esc_html_e( 'An Toàn Y Khoa & Chi Phí Minh Bạch', 'mediora-clinic' ); ?></h2>
				<p class="text-muted" style="max-width:700px; margin:0 auto;">
					<?php esc_html_e( 'MEDIORA thiết lập tiêu chuẩn minh bạch cao nhất, tôn trọng quyền lợi và đảm bảo trải nghiệm an tâm trọn vẹn cho từng quý khách hàng.', 'mediora-clinic' ); ?>
				</p>
			</div>

			<div class="row g-4">
				<div class="col-12 col-md-6 col-lg-3">
					<div class="mediora-card h-100 p-4 text-center">
						<div class="fs-1 mb-3 text-warning">🛡️</div>
						<h3 class="h5 text-white mb-2"><?php esc_html_e( 'Vật Liệu Chính Hãng', 'mediora-clinic' ); ?></h3>
						<p class="text-muted small mb-0" style="line-height:1.7;">
							<?php esc_html_e( '100% sợi sinh học và tinh chất được cấp phép bởi Bộ Y Tế. Khách hàng được trực tiếp kiểm tra tem niêm phong và mã vạch trước khi thực hiện.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-3">
					<div class="mediora-card h-100 p-4 text-center">
						<div class="fs-1 mb-3 text-warning">🏷️</div>
						<h3 class="h5 text-white mb-2"><?php esc_html_e( 'Bảng Giá Niêm Yết', 'mediora-clinic' ); ?></h3>
						<p class="text-muted small mb-0" style="line-height:1.7;">
							<?php esc_html_e( 'Chi phí trọn gói minh bạch, thông báo rõ ràng trước thủ thuật. Cam kết không phát sinh bất kỳ khoản phí phụ thu nào trong suốt liệu trình.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-3">
					<div class="mediora-card h-100 p-4 text-center">
						<div class="fs-1 mb-3 text-warning">👨‍⚕️</div>
						<h3 class="h5 text-white mb-2"><?php esc_html_e( 'Bác Sĩ Trực Tiếp Làm', 'mediora-clinic' ); ?></h3>
						<p class="text-muted small mb-0" style="line-height:1.7;">
							<?php esc_html_e( 'Thăm khám, đo vẽ tỷ lệ và trực tiếp tiến hành thủ thuật bởi Bác sĩ Chuyên khoa có chứng chỉ hành nghề, không giao cho kỹ thuật viên.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-3">
					<div class="mediora-card h-100 p-4 text-center">
						<div class="fs-1 mb-3 text-warning">📋</div>
						<h3 class="h5 text-white mb-2"><?php esc_html_e( 'Bảo Hành & Đồng Hành', 'mediora-clinic' ); ?></h3>
						<p class="text-muted small mb-0" style="line-height:1.7;">
							<?php esc_html_e( 'Chế độ tái khám và bảo hành kết quả chu đáo. Đội ngũ y tế chăm sóc theo dõi tiến trình hồi phục 1:1 qua hotline và tái khám định kỳ.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Optional content from editor -->
	<?php
	while ( have_posts() ) :
		the_post();
		if ( get_the_content() ) :
			?>
			<section class="services-custom-content py-5">
				<div class="wrap">
					<div class="mediora-card p-4 p-md-5 mediora-prose">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endwhile;
	?>

	<!-- 4. Consultation CTA Banner -->
	<section class="services-cta-section py-5">
		<div class="wrap">
			<div class="consultation-cta-banner">
				<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Tư Vấn Miễn Phí', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif); font-size:clamp(1.75rem, 3vw, 2.5rem);">
					<?php esc_html_e( 'Bạn Chưa Rõ Phương Pháp Nào Phù Hợp Với Mình?', 'mediora-clinic' ); ?>
				</h2>
				<p class="text-muted mb-4" style="max-width:650px; margin:0 auto; font-size:1.05rem;">
					<?php esc_html_e( 'Hãy để đội ngũ bác sĩ chuyên khoa MEDIORA soi da và tư vấn phác đồ thẩm mỹ tối ưu nhất dành riêng cho bạn.', 'mediora-clinic' ); ?>
				</p>
				<div class="d-flex flex-wrap justify-content-center gap-3">
					<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="btn btn-gold-outline">
						📞 <?php echo esc_html( $hotline ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult">
						<?php esc_html_e( 'Đăng Ký Tư Vấn Ngay', 'mediora-clinic' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
