<?php
/**
 * Template Name: Về Chúng Tôi - Mediora
 *
 * The template for displaying the About Us / Brand Story page.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri          = get_template_directory_uri();
$hotline            = mediora_get_option( 'hotline', '0945.334.832' );
$hotline_tel        = mediora_clean_phone( $hotline );
$facility_video_url = mediora_get_option( 'facility_video_url', 'https://d1b6kbmv97kzjg.cloudfront.net/wp-content/uploads/2026/11/CSVC.mp4' );
?>

<div class="subpage-content about-page-main">

	<!-- 1. Hero Subpage Banner -->
	<section class="subpage-banner" aria-label="<?php esc_attr_e( 'Giới thiệu MEDIORA', 'mediora-clinic' ); ?>">
		<div class="wrap text-center">
			<?php mediora_breadcrumbs(); ?>
			<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Câu Chuyện Thương Hiệu', 'mediora-clinic' ); ?></span>
			<h1 class="subpage-banner__title gold-text"><?php esc_html_e( 'Về Phòng Khám Chuyên Khoa Thẩm Mỹ MEDIORA', 'mediora-clinic' ); ?></h1>
			<p class="subpage-banner__desc">
				<?php esc_html_e( 'Định chuẩn vẻ đẹp thanh xuân thông qua sự giao thoa hoàn hảo giữa nền tảng y khoa chuyên sâu, công nghệ đỉnh cao và tư duy thẩm mỹ cá nhân hóa.', 'mediora-clinic' ); ?>
			</p>
		</div>
	</section>

	<!-- 2. Brand Story & Aesthetic Philosophy -->
	<section class="about-story-section py-5">
		<div class="wrap">
			<div class="row align-items-center g-5">
				<div class="col-12 col-lg-6">
					<div class="story-image-wrap position-relative">
						<div class="mediora-card p-2 overflow-hidden">
							<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/cover.jpg' ); ?>"
								alt="<?php esc_attr_e( 'Không gian viện thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>"
								class="w-100 h-auto rounded"
								style="border-radius:12px; object-fit:cover;"
								loading="lazy">
						</div>
						<div class="story-floating-badge p-3" style="position:absolute; bottom:-18px; right:20px; background:var(--gold-gradient); color:#1b130c; border-radius:12px; font-weight:700; font-family:var(--font-head); box-shadow:0 8px 24px rgba(0,0,0,0.4);">
							<span style="font-size:24px; display:block; line-height:1;">10+</span>
							<span style="font-size:12px; text-transform:uppercase; letter-spacing:0.05em;"><?php esc_html_e( 'Năm Tiên Phong Trẻ Hóa', 'mediora-clinic' ); ?></span>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<div class="story-text-content ps-lg-4">
						<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Triết Lý Y Khoa & Thẩm Mỹ', 'mediora-clinic' ); ?></span>
						<h2 class="h2 text-white mb-4" style="font-family:var(--font-serif); font-size:clamp(1.75rem, 2.5vw, 2.4rem);">
							<?php esc_html_e( 'Vẻ Đẹp Thanh Xuân Hài Hòa, An Toàn & Vững Bền Cùng Thời Gian', 'mediora-clinic' ); ?>
						</h2>
						<p class="text-muted" style="line-height:1.85; font-size:1.05rem;">
							<?php esc_html_e( 'Tại MEDIORA, chúng tôi tin rằng cái đẹp đích thực không phải là sự sao chép rập khuôn mà là sự thức tỉnh nét duyên dáng vốn có của mỗi cá nhân. Mọi liệu trình thẩm mỹ đều được xây dựng dựa trên sự thấu hiểu sâu sắc cấu trúc giải phẫu học khuôn mặt, tình trạng mô cơ và mong ước riêng biệt của từng khách hàng.', 'mediora-clinic' ); ?>
						</p>
						<blockquote class="my-4 p-3" style="border-left:3px solid var(--gold-primary); background:rgba(212,175,55,0.06); border-radius:0 8px 8px 0; font-family:var(--font-serif); font-style:italic; color:var(--gold-light);">
							"<?php esc_html_e( 'Y đức là gốc rễ, tay nghề là cốt lõi, và công nghệ hiện đại là đôi cánh kiến tạo nên vẻ đẹp tự nhiên, an tâm tuyệt đối.', 'mediora-clinic' ); ?>"
						</blockquote>
						<p class="text-muted" style="line-height:1.85;">
							<?php esc_html_e( 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA tuân thủ nghiêm ngặt các tiêu chuẩn kiểm định khắt khe của Bộ Y Tế, từ quy trình vô trùng khép kín đến quy chuẩn chăm sóc hậu phẫu 1:1 tận tâm.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. Three Core Values -->
	<section class="about-values-section py-5" style="background:var(--bg-secondary); border-top:1px solid rgba(212,175,55,0.15); border-bottom:1px solid rgba(212,175,55,0.15);">
		<div class="wrap">
			<div class="text-center mb-5">
				<span class="mediora-badge-gold mb-2"><?php esc_html_e( 'Kim Chỉ Nam Hoạt Động', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif);"><?php esc_html_e( '3 Giá Trị Cốt Lõi Tại MEDIORA', 'mediora-clinic' ); ?></h2>
				<p class="text-muted" style="max-width:680px; margin:0 auto;">
					<?php esc_html_e( 'Ba trụ cột vững chắc định hình mọi tiêu chuẩn dịch vụ, mang lại sự tin cậy tuyệt đối cho hàng nghìn khách hàng.', 'mediora-clinic' ); ?>
				</p>
			</div>

			<div class="row g-4">
				<!-- Value 1 -->
				<div class="col-12 col-md-4">
					<div class="mediora-card h-100 d-flex flex-column text-center p-4">
						<div class="value-icon mb-4 mx-auto" style="width:68px; height:68px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:26px;">
							🩺
						</div>
						<h3 class="h4 text-white mb-3"><?php esc_html_e( 'Y Đức & Chuyên Môn', 'mediora-clinic' ); ?></h3>
						<p class="text-muted flex-grow-1" style="font-size:14px; line-height:1.75;">
							<?php esc_html_e( '100% bác sĩ có Chứng chỉ Hành nghề chính quy từ Bộ Y Tế, liên tục tu nghiệp tại các trung tâm thẩm mỹ hàng đầu tại Hàn Quốc, Hoa Kỳ và Châu Âu. Thăm khám và trực tiếp thực hiện mọi ca can thiệp.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>

				<!-- Value 2 -->
				<div class="col-12 col-md-4">
					<div class="mediora-card h-100 d-flex flex-column text-center p-4">
						<div class="value-icon mb-4 mx-auto" style="width:68px; height:68px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:26px;">
							⚡
						</div>
						<h3 class="h4 text-white mb-3"><?php esc_html_e( 'Công Nghệ Đỉnh Cao', 'mediora-clinic' ); ?></h3>
						<p class="text-muted flex-grow-1" style="font-size:14px; line-height:1.75;">
							<?php esc_html_e( 'Sở hữu độc quyền công nghệ nâng cơ trẻ hóa bằng sợi sinh học GMISS và hệ thống trang thiết bị nhập khẩu chính hãng từ FDA Hoa Kỳ và CE Châu Âu, mang lại hiệu quả tối ưu và hạn chế tối đa xâm lấn.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>

				<!-- Value 3 -->
				<div class="col-12 col-md-4">
					<div class="mediora-card h-100 d-flex flex-column text-center p-4">
						<div class="value-icon mb-4 mx-auto" style="width:68px; height:68px; border-radius:50%; background:rgba(212,175,55,0.15); border:1px solid var(--gold-primary); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:26px;">
							💎
						</div>
						<h3 class="h4 text-white mb-3"><?php esc_html_e( 'Cá Nhân Hóa Phác Đồ', 'mediora-clinic' ); ?></h3>
						<p class="text-muted flex-grow-1" style="font-size:14px; line-height:1.75;">
							<?php esc_html_e( 'Mỗi phác đồ là một tác phẩm độc bản. Bác sĩ phân tích tỉ mỉ từng đường nét, độ chùng nhão da và cơ xương để thiết kế giải pháp tôn vinh nét hài hòa tự nhiên, không biến đổi nét nhận diện.', 'mediora-clinic' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 4. Medical Doctors & Specialists Team -->
	<section class="about-doctor-section py-5">
		<div class="wrap">
			<div class="text-center mb-5">
				<span class="mediora-badge-gold mb-2"><?php esc_html_e( 'Đội Ngũ Chuyên Gia', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif);"><?php esc_html_e( 'Bác Sĩ Chuyên Khoa Phẫu Thuật & Tạo Hình Thẩm Mỹ', 'mediora-clinic' ); ?></h2>
				<p class="text-muted" style="max-width:700px; margin:0 auto;">
					<?php esc_html_e( 'Hội tụ các chuyên gia đầu ngành giàu kinh nghiệm lâm sàng, tận tâm đồng hành trên hành trình gìn giữ thanh xuân của khách hàng.', 'mediora-clinic' ); ?>
				</p>
			</div>

			<?php
			$doctor_query = new WP_Query(
				array(
					'post_type'      => 'doctor',
					'posts_per_page' => 6,
					'post_status'    => 'publish',
				)
			);

			if ( $doctor_query->have_posts() ) :
				?>
				<div class="row g-4 justify-content-center">
					<?php
					while ( $doctor_query->have_posts() ) :
						$doctor_query->the_post();
						$doc_meta = mediora_get_doctor_meta( get_the_ID() );
						?>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="mediora-card h-100 d-flex flex-column text-center p-4">
								<div class="doctor-photo mb-3 mx-auto" style="width:140px; height:140px; border-radius:50%; overflow:hidden; border:2px solid var(--gold-primary); box-shadow:0 0 16px rgba(212,175,55,0.35);">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium', array( 'class' => 'w-100 h-100 object-fit-cover' ) ); ?>
									<?php else : ?>
										<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/doctor1.png' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover">
									<?php endif; ?>
								</div>

								<h3 class="h5 text-white mb-1"><?php the_title(); ?></h3>
								<?php if ( ! empty( $doc_meta['title'] ) ) : ?>
									<div class="text-gold mb-2" style="font-size:13px; font-weight:600;"><?php echo esc_html( $doc_meta['title'] ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $doc_meta['specialty'] ) ) : ?>
									<p class="text-muted mb-2" style="font-size:14px;"><?php echo esc_html( $doc_meta['specialty'] ); ?></p>
								<?php endif; ?>

								<div class="mt-auto pt-3 border-top" style="border-color:rgba(255,255,255,0.08) !important;">
									<?php if ( ! empty( $doc_meta['experience'] ) ) : ?>
										<span class="badge bg-dark border border-warning text-warning me-1 mb-1" style="font-size:11px;">
											<?php echo esc_html( $doc_meta['experience'] ); ?>
										</span>
									<?php endif; ?>
									<?php if ( ! empty( $doc_meta['license'] ) ) : ?>
										<span class="badge bg-secondary text-light mb-1" style="font-size:11px;">
											CCHN: <?php echo esc_html( $doc_meta['license'] ); ?>
										</span>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php else : ?>
				<!-- Showcase banner fallback when no Doctor posts yet -->
				<div class="row justify-content-center">
					<div class="col-12 col-xl-10">
						<div class="mediora-card p-3 p-md-4 text-center">
							<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/doctor1.png' ); ?>"
								alt="<?php esc_attr_e( 'Đội ngũ bác sĩ chuyên khoa thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>"
								class="w-100 h-auto rounded"
								style="border-radius:12px;"
								loading="lazy">
							<div class="row mt-4 pt-3 border-top g-3" style="border-color:rgba(255,255,255,0.08) !important;">
								<div class="col-12 col-md-4">
									<strong class="gold-text d-block fs-5">100% Bác Sĩ</strong>
									<span class="text-muted small"><?php esc_html_e( 'Có Chứng chỉ Hành nghề Bộ Y Tế', 'mediora-clinic' ); ?></span>
								</div>
								<div class="col-12 col-md-4">
									<strong class="gold-text d-block fs-5">15+ Năm</strong>
									<span class="text-muted small"><?php esc_html_e( 'Kinh nghiệm phẫu thuật & tạo hình', 'mediora-clinic' ); ?></span>
								</div>
								<div class="col-12 col-md-4">
									<strong class="gold-text d-block fs-5">10.000+</strong>
									<span class="text-muted small"><?php esc_html_e( 'Khách hàng trẻ hóa thành công', 'mediora-clinic' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 5. 5-Star Luxury Facilities & Medical Environment -->
	<section class="about-facility-section py-5" style="background:var(--bg-secondary); border-top:1px solid rgba(212,175,55,0.15);">
		<div class="wrap">
			<div class="text-center mb-5">
				<span class="mediora-badge-gold mb-2"><?php esc_html_e( 'Không Gian & Trang Thiết Bị', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif);"><?php esc_html_e( 'Tiêu Chuẩn Cơ Sở Vật Chất 5 Sao Chuẩn Y Khoa', 'mediora-clinic' ); ?></h2>
				<p class="text-muted" style="max-width:720px; margin:0 auto;">
					<?php esc_html_e( 'Tọa lạc tại vị trí đắc địa trung tâm Quận 3 TP.HCM, MEDIORA sở hữu khuôn viên hiện đại với phòng thủ thuật vô trùng áp lực dương một chiều và phòng nghỉ dưỡng VIP biệt lập.', 'mediora-clinic' ); ?>
				</p>
			</div>

			<div class="row justify-content-center mb-5">
				<div class="col-12 col-xl-11">
					<div class="facility-frame position-relative">
						<video class="facility-video js-facility-video w-100"
							muted loop playsinline
							preload="none"
							data-src-pc="<?php echo esc_url( $facility_video_url ); ?>"
							data-src-mb="<?php echo esc_url( $facility_video_url ); ?>"
							style="border-radius:16px;">
							<source src="<?php echo esc_url( $facility_video_url ); ?>" type="video/mp4">
						</video>
						<img class="facility-frame__line d-none d-md-block"
							src="<?php echo esc_url( $theme_uri . '/assets/imgs/Frameline.png' ); ?>"
							alt="<?php esc_attr_e( 'Khung mạ vàng cơ sở vật chất MEDIORA', 'mediora-clinic' ); ?>"
							width="1732" height="997" aria-hidden="true" loading="lazy">
					</div>
				</div>
			</div>

			<div class="row g-4">
				<div class="col-12 col-md-3">
					<div class="mediora-card p-3 text-center">
						<div class="fs-2 mb-2">🏥</div>
						<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Phòng Vô Trùng Y Tế', 'mediora-clinic' ); ?></h3>
						<span class="text-muted small"><?php esc_html_e( 'Kiểm soát nhiễm khuẩn tuyệt đối', 'mediora-clinic' ); ?></span>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="mediora-card p-3 text-center">
						<div class="fs-2 mb-2">🛋️</div>
						<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Phòng VIP Nghỉ Dưỡng', 'mediora-clinic' ); ?></h3>
						<span class="text-muted small"><?php esc_html_e( 'Riêng tư, tiện nghi đẳng cấp', 'mediora-clinic' ); ?></span>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="mediora-card p-3 text-center">
						<div class="fs-2 mb-2">🔬</div>
						<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Thiết Bị Nhập Khẩu', 'mediora-clinic' ); ?></h3>
						<span class="text-muted small"><?php esc_html_e( 'Chứng nhận FDA & CE Châu Âu', 'mediora-clinic' ); ?></span>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="mediora-card p-3 text-center">
						<div class="fs-2 mb-2">🅿️</div>
						<h3 class="h6 text-white mb-1"><?php esc_html_e( 'Bãi Đỗ Xe Tiện Lợi', 'mediora-clinic' ); ?></h3>
						<span class="text-muted small"><?php esc_html_e( 'Chỗ đỗ ô tô rộng rãi, bảo vệ 24/7', 'mediora-clinic' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Optional WP Content block if user added custom text in editor -->
	<?php
	while ( have_posts() ) :
		the_post();
		if ( get_the_content() ) :
			?>
			<section class="about-custom-content py-5">
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

	<!-- 6. Bottom Consultation CTA Banner -->
	<section class="about-cta-section py-5">
		<div class="wrap">
			<div class="consultation-cta-banner">
				<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Đặc Quyền Khách Hàng', 'mediora-clinic' ); ?></span>
				<h2 class="gold-text mb-3" style="font-family:var(--font-serif); font-size:clamp(1.75rem, 3vw, 2.5rem);">
					<?php esc_html_e( 'Trải Nghiệm Thăm Khám 1:1 Cùng Bác Sĩ Chuyên Khoa', 'mediora-clinic' ); ?>
				</h2>
				<p class="text-muted mb-4" style="max-width:650px; margin:0 auto; font-size:1.05rem;">
					<?php esc_html_e( 'Đăng ký ngay hôm nay để nhận phác đồ trẻ hóa cá nhân hóa độc bản từ các chuyên gia hàng đầu tại MEDIORA.', 'mediora-clinic' ); ?>
				</p>
				<div class="d-flex flex-wrap justify-content-center gap-3">
					<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="btn btn-gold-outline">
						📞 <?php echo esc_html( $hotline ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="btn btn-consult btn-gold-pill" data-bs-toggle="modal" data-bs-target="#popupConsult">
						<?php esc_html_e( 'Đặt Lịch Hẹn Ngay', 'mediora-clinic' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
