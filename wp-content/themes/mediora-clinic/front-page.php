<?php
/**
 * The template for displaying the front page / landing page
 *
 * Recreates the complete Mediora Clinic luxury landing page experience:
 * - Hero Banner Slider (Swiper)
 * - Philosophy / Aesthetic Introduction (sec-intro)
 * - GMISS Bio-Thread Lifting 6-Step Medical Procedure & Video Demo (sec-gmiss)
 * - 5-Star Luxury Medical Facilities with Golden Frame & Lazy-load Video (sec-facility)
 * - Specialist Medical Doctors & Surgeons Banner (sec-doctor)
 * - Real Customer Case Studies & Celebrities Swiper Slider (sec-result)
 * - Special Consultation Registration & Appointment Booking Block (sec-register)
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri           = get_template_directory_uri();
$facility_video_url  = mediora_get_option( 'facility_video_url', 'https://d1b6kbmv97kzjg.cloudfront.net/wp-content/uploads/2026/11/CSVC.mp4' );
$gmiss_video_url     = mediora_get_option( 'gmiss_video_url', 'https://d1b6kbmv97kzjg.cloudfront.net/wp-content/uploads/2026/11/tvc.mp4' );
$intro_text_default  = 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA định hướng phát triển theo tiêu chuẩn thẩm mỹ chuyên nghiệp, kết hợp nền tảng chuyên môn, công nghệ hiện đại và chiến lược cá nhân hóa trong từng chỉ định. Điểm khác biệt của MEDIORA nằm ở tư duy thẩm mỹ tổng thể, quy trình thực hiện chuẩn hóa và sự theo sát xuyên suốt hành trình khách hàng, hướng đến kết quả hài hòa, tự nhiên và phù hợp với đặc điểm riêng của mỗi người.';
$intro_text          = mediora_get_option( 'intro_text', $intro_text_default );
?>

<!-- 1. Hero Banner Slider -->
<section class="sec-hero hero" aria-label="<?php esc_attr_e( 'Banner MEDIORA', 'mediora-clinic' ); ?>">
	<div class="swiper hero-slider">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<picture>
					<source media="(max-width: 767.98px)" srcset="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-1-1.png' ); ?>">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-1-1.png' ); ?>" alt="<?php esc_attr_e( 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA - Định chuẩn vẻ đẹp thanh xuân', 'mediora-clinic' ); ?>" width="1920" height="800" fetchpriority="high">
				</picture>
			</div>
			<div class="swiper-slide">
				<picture>
					<source media="(max-width: 767.98px)" srcset="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-2-1.png' ); ?>">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-2-1.png' ); ?>" alt="<?php esc_attr_e( 'Công nghệ nâng cơ trẻ hóa bằng sợi sinh học GMISS độc quyền', 'mediora-clinic' ); ?>" width="1920" height="800" loading="lazy">
				</picture>
			</div>
			<div class="swiper-slide">
				<picture>
					<source media="(max-width: 767.98px)" srcset="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-3-1.png' ); ?>">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-3-1.png' ); ?>" alt="<?php esc_attr_e( 'Không gian phòng khám thẩm mỹ 5 sao chuẩn y khoa', 'mediora-clinic' ); ?>" width="1920" height="800" loading="lazy">
				</picture>
			</div>
			<div class="swiper-slide">
				<picture>
					<source media="(max-width: 767.98px)" srcset="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-4-1.png' ); ?>">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/m1-4-1.png' ); ?>" alt="<?php esc_attr_e( 'Đội ngũ bác sĩ chuyên khoa phẫu thuật tạo hình thẩm mỹ', 'mediora-clinic' ); ?>" width="1920" height="800" loading="lazy">
				</picture>
			</div>
		</div>
		<!-- Hero Slider Pagination Indicators -->
		<div class="hero-pagination swiper-pagination"></div>
	</div>
</section>

<!-- 2. Hero / Triết Lý Thẩm Mỹ (sec-intro) -->
<section class="sec-intro" id="gioi-thieu" aria-label="<?php esc_attr_e( 'Triết lý thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>">
	<div class="container-fluid wrap">
		<h2 class="visually-hidden"><?php esc_html_e( 'Giới thiệu Triết lý Thẩm mỹ MEDIORA', 'mediora-clinic' ); ?></h2>
		<div class="row justify-content-center">
			<div class="col-12">
				<p class="intro-text">
					<?php echo esc_html( $intro_text ); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- 3. Dịch Vụ Chủ Đạo GMISS (sec-gmiss) -->
<section class="sec-gmiss" id="dich-vu" aria-label="<?php esc_attr_e( 'Dịch vụ nâng cơ GMISS', 'mediora-clinic' ); ?>">
	<div class="container-fluid wrap">
		<div class="row gx-4 gx-xl-5 gy-4 d-flex rowsec4 align-items-end mflex-column">
			<!-- Cột trái: Tiêu đề nghệ thuật + 6 bước quy trình y khoa -->
			<div class="col-xl-6">
				<h2 class="gmiss-title m-0">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/21.png' ); ?>" alt="<?php esc_attr_e( 'Nâng cơ trẻ hóa bằng sợi sinh học GMISS – Kỷ nguyên nâng cơ trẻ hóa bằng sợi sinh học – Định hình đường nét, tôn vinh vẻ đẹp thanh xuân', 'mediora-clinic' ); ?>" width="805" height="282" loading="lazy">
				</h2>

				<ol class="row row-cols-1 row-cols-sm-2 g-3 steps list-unstyled m-0">
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step21.png' ); ?>" alt="<?php esc_attr_e( 'Bước 1: Thăm khám cùng bác sĩ – thăm khám chuyên sâu cùng bác sĩ chuyên khoa tạo hình thẩm mỹ', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step22.png' ); ?>" alt="<?php esc_attr_e( 'Bước 2: Quét chỉ số AI Factional – soi da các lớp, xác định mức độ lão hóa, đưa ra phác đồ cá nhân hóa', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step23.png' ); ?>" alt="<?php esc_attr_e( 'Bước 3: Đo vẽ, xác định vùng can thiệp', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step24.png' ); ?>" alt="<?php esc_attr_e( 'Bước 4: Sát khuẩn bằng Povidine', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step25.png' ); ?>" alt="<?php esc_attr_e( 'Bước 5: Sử dụng sợi GMISS nâng kéo toàn bộ vùng cơ, mỡ ở tầng SMAS', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
					<li class="col">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/step26.png' ); ?>" alt="<?php esc_attr_e( 'Bước 6: Dặn dò sau điều trị', 'mediora-clinic' ); ?>" width="408" height="265" loading="lazy">
					</li>
				</ol>
			</div>

			<!-- Cột phải: Video demo visual trực quan -->
			<div class="col-xl-6">
				<div class="gmiss-video-wrapper">
					<video class="w-100 gmiss-video" controls autoplay muted playsinline loop poster="<?php echo esc_url( $theme_uri . '/assets/imgs/bg_video.png' ); ?>" preload="none">
						<source src="<?php echo esc_url( $gmiss_video_url ); ?>" type="video/mp4">
						<?php esc_html_e( 'Trình duyệt của bạn không hỗ trợ phát thẻ video.', 'mediora-clinic' ); ?>
					</video>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- 4. Cơ Sở Vật Chất 5 Sao (sec-facility) -->
<section class="sec-facility" id="co-so-vat-chat" aria-label="<?php esc_attr_e( 'Cơ sở vật chất 5 sao', 'mediora-clinic' ); ?>">
	<div class="container-fluid wrap">
		<h2 class="visually-hidden"><?php esc_html_e( 'Cơ Sở Vật Chất 5 Sao MEDIORA', 'mediora-clinic' ); ?></h2>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="facility-frame">
					<video class="facility-video js-facility-video"
						muted loop playsinline
						preload="none"
						data-src-pc="<?php echo esc_url( $facility_video_url ); ?>"
						data-src-mb="<?php echo esc_url( $facility_video_url ); ?>">
						<?php esc_html_e( 'Trình duyệt của bạn không hỗ trợ phát thẻ video.', 'mediora-clinic' ); ?>
					</video>
					<img class="facility-frame__line" src="<?php echo esc_url( $theme_uri . '/assets/imgs/Frameline.png' ); ?>" alt="<?php esc_attr_e( 'Khung mạ vàng 5 sao cơ sở vật chất MEDIORA', 'mediora-clinic' ); ?>" width="1732" height="997" aria-hidden="true" loading="lazy">
				</div>
			</div>
		</div>
	</div>
</section>

<!-- 5. Đội Ngũ Bác Sĩ Chuyên Khoa (sec-doctor) -->
<section class="sec-doctor" id="bac-si" aria-label="<?php esc_attr_e( 'Đội ngũ bác sĩ chuyên khoa', 'mediora-clinic' ); ?>">
	<div class="container-fluid wrap">
		<h2 class="visually-hidden"><?php esc_html_e( 'Đội ngũ Bác sĩ Chuyên khoa Phẫu thuật Tạo hình Thẩm mỹ MEDIORA', 'mediora-clinic' ); ?></h2>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="ph ratio-doctor" data-ph="<?php esc_attr_e( 'BÁC SĨ · 1583×762', 'mediora-clinic' ); ?>">
					<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/doctor1.png' ); ?>" alt="<?php esc_attr_e( 'Đội ngũ bác sĩ chuyên khoa phẫu thuật tạo hình thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>" width="1583" height="762" loading="lazy">
				</div>
			</div>
		</div>
	</div>
</section>

<!-- 6. Hiệu Quả Khách Hàng & Người Nổi Tiếng (sec-result) -->
<section class="sec-result" id="cau-chuyen" aria-label="<?php esc_attr_e( 'Hiệu quả khách hàng & Người nổi tiếng', 'mediora-clinic' ); ?>">
	<div class="container-fluid wrap-wide">
		<h2 class="visually-hidden"><?php esc_html_e( 'Khách hàng thực tế và Người nổi tiếng tại MEDIORA', 'mediora-clinic' ); ?></h2>
		<div class="swiper result-slider">
			<div class="swiper-wrapper">
				<!-- Case 1: Nghệ sĩ Ngân Quỳnh -->
				<div class="swiper-slide">
					<div class="ph ratio-result" data-ph="<?php esc_attr_e( 'Diễn viên Ngân Quỳnh · 1846×966', 'mediora-clinic' ); ?>">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-ngan-quynh.png' ); ?>" alt="<?php esc_attr_e( 'Hiệu quả khách hàng – Nghệ sĩ Ngân Quỳnh trẻ hóa toàn diện tại MEDIORA', 'mediora-clinic' ); ?>" width="1846" height="966" loading="lazy">
					</div>
				</div>

				<!-- Case 2: Chị Hiền Phạm -->
				<div class="swiper-slide">
					<div class="ph ratio-result" data-ph="<?php esc_attr_e( 'Khách hàng Hiền Phạm · 1846×966', 'mediora-clinic' ); ?>">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-hien-pham.png' ); ?>" alt="<?php esc_attr_e( 'Hiệu quả khách hàng – Chị Hiền Phạm tìm lại nét thanh xuân cùng MEDIORA', 'mediora-clinic' ); ?>" width="1846" height="966" loading="lazy">
					</div>
				</div>

				<!-- Case 3: Chị Vi Tường -->
				<div class="swiper-slide">
					<div class="ph ratio-result" data-ph="<?php esc_attr_e( 'Khách hàng Vi Tường 36 tuổi · 1846×966', 'mediora-clinic' ); ?>">
						<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/kh-vi-tuong.png' ); ?>" alt="<?php esc_attr_e( 'Hiệu quả khách hàng – Chị Vi Tường 36 tuổi nâng cơ trẻ hóa GMISS', 'mediora-clinic' ); ?>" width="1846" height="966" loading="lazy">
					</div>
				</div>
			</div>

			<!-- Nút điều hướng prev / next -->
			<button class="arrow-btn prev-btn arrow-prev result-prev" type="button" aria-label="<?php esc_attr_e( 'Khách hàng trước', 'mediora-clinic' ); ?>">
				<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/arrow.png' ); ?>" alt="" width="24" height="24" aria-hidden="true">
			</button>
			<button class="arrow-btn next-btn arrow-next result-next" type="button" aria-label="<?php esc_attr_e( 'Khách hàng tiếp theo', 'mediora-clinic' ); ?>">
				<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/arrow.png' ); ?>" alt="" width="24" height="24" aria-hidden="true">
			</button>

			<!-- Bullet Pagination Indicators -->
			<div class="result-pagination swiper-pagination"></div>
		</div>
	</div>
</section>

<!-- 7. Khối Đăng Ký Tư Vấn & Nhận Ưu Đãi (sec-register) -->
<section class="sec-register" id="lien-he" aria-label="<?php esc_attr_e( 'Đăng ký nhận ưu đãi tư vấn', 'mediora-clinic' ); ?>">
	<div class="row g-0">
		<!-- Cột trái: Ảnh bìa cover.jpg -->
		<div class="col-12 col-lg-8">
			<div class="ph register-cover" data-ph="<?php esc_attr_e( 'Bìa tư vấn MEDIORA · 1287×724', 'mediora-clinic' ); ?>">
				<?php
				$register_cover = mediora_get_option( 'register_cover_image', $theme_uri . '/assets/imgs/cover.jpg' );
				if ( empty( $register_cover ) ) {
					$register_cover = $theme_uri . '/assets/imgs/cover.jpg';
				}
				?>
				<img src="<?php echo esc_url( $register_cover ); ?>" alt="<?php esc_attr_e( 'Phòng khám Thẩm mỹ MEDIORA – Tư vấn nâng cơ trẻ hóa chuyên sâu', 'mediora-clinic' ); ?>" width="1287" height="724" loading="lazy">
			</div>
		</div>

		<!-- Cột phải: Tiêu đề nghệ thuật & Form tư vấn trực tuyến -->
		<div class="col-12 col-lg-4 register-side d-flex align-items-center justify-content-center">
			<?php
			get_template_part(
				'template-parts/booking-form',
				null,
				array(
					'source'         => 'landing-register',
					'show_title_img' => true,
				)
			);
			?>
		</div>
	</div>
</section>

<?php
get_footer();
