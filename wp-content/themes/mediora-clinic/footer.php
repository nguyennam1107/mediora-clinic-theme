<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #primary and #page div and all content after.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hotline       = mediora_get_option( 'hotline', '0945.334.832' );
$hotline_tel   = mediora_clean_phone( $hotline );
$footer_city   = mediora_get_option( 'footer_city', 'Hồ Chí Minh:' );
$address       = mediora_get_option( 'address', "257 - 259 Nguyễn Đình Chiểu,\nPhường Bàn Cờ, TP. HCM" );
$license_title = mediora_get_option( 'license_title', 'Giấy cấp phép MEDIORA TP. Hồ Chí Minh' );
$license_p1    = mediora_get_option(
	'license_p1',
	"Phòng khám Chuyên khoa thẩm mỹ MEDIORA<br>Trực thuộc Công ty TNHH Y khoa Mediora<br>MST: 0319600033/ HCM-GPHĐ do SỞ Y TẾ THÀNH PHỐ HỒ CHÍ MINH cấp."
);
$license_p2    = mediora_get_option(
	'license_p2',
	"Bác sĩ phụ trách chuyên môn Lê Quốc Anh<br>Số GPHN: 044323/BYT- CCHN"
);
$license_p3    = mediora_get_option(
	'license_p3',
	"Bác sĩ phụ trách chuyên môn Hoàng Thanh Tùng<br>Số GPHN: 002879/ĐNAI- GPHN"
);

$social_fb     = mediora_get_option( 'social_facebook', 'https://www.facebook.com/pkcktmmediora' );
$social_zalo   = mediora_get_option( 'social_zalo', 'https://zalo.me/636737550228660397' );
$social_tiktok = mediora_get_option( 'social_tiktok', 'https://www.tiktok.com/@phongkhammediora' );
$social_mess   = mediora_get_option( 'social_messenger', 'https://m.me/pkcktmmediora' );
?>

	</main><!-- #primary -->

	<!-- Site Footer -->
	<footer id="colophon" class="site-footer">
		<div class="container-fluid footer-wrap">
			<!-- Footer Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo" rel="home">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/logof.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="461" height="104" loading="lazy">
			</a>

			<div class="row footer-row gy-4">
				<!-- Column 1: Address & Hotline -->
				<div class="col-12 col-md-6 col-xl footer-col footer-col--addr">
					<h3 class="footer-city text-linear m-0">
						<span class="footer-gps">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/gps.png' ); ?>" alt="GPS" width="28" height="40" loading="lazy">
						</span>
						<span><?php echo esc_html( $footer_city ); ?></span>
					</h3>
					<p class="footer-text footer-address">
						<?php echo nl2br( esc_html( $address ) ); ?>
					</p>
					<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="footer-phone" aria-label="<?php echo esc_attr( sprintf( __( 'Gọi hotline %s', 'mediora-clinic' ), $hotline ) ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/fsdt.png' ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Hotline %s', 'mediora-clinic' ), $hotline ) ); ?>" width="253" height="42" loading="lazy">
					</a>
				</div>

				<!-- Column 2: Medical Licensing & Accreditation -->
				<div class="col-12 col-md-6 col-xl-auto footer-col footer-col--license">
					<h3 class="footer-title text-linear m-0">
						<?php echo esc_html( $license_title ); ?>
					</h3>
					<div class="footer-text">
						<p><?php echo wp_kses_post( $license_p1 ); ?></p>
						<p><?php echo wp_kses_post( $license_p2 ); ?></p>
						<p><?php echo wp_kses_post( $license_p3 ); ?></p>
					</div>
				</div>

				<!-- Column 3: Social Channels & Contact -->
				<div class="col-12 col-xl-auto footer-col footer-col--social">
					<ul class="footer-social list-unstyled m-0">
						<?php if ( ! empty( $social_zalo ) ) : ?>
							<li>
								<a class="footer-social__item" href="<?php echo esc_url( $social_zalo ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Zalo Mediora', 'mediora-clinic' ); ?>">
									<img class="footer-social__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-zalo-footer.png' ); ?>" alt="Zalo" width="48" height="48" loading="lazy">
									<span class="footer-social__text text-linear"><?php esc_html_e( 'Phòng Khám Mediora', 'mediora-clinic' ); ?></span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( ! empty( $social_fb ) ) : ?>
							<li>
								<a class="footer-social__item" href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook Mediora', 'mediora-clinic' ); ?>">
									<img class="footer-social__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-fb.png' ); ?>" alt="Facebook" width="48" height="48" loading="lazy">
									<span class="footer-social__text text-linear"><?php esc_html_e( 'Phòng Khám Chuyên Khoa Thẩm Mỹ Mediora', 'mediora-clinic' ); ?></span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( ! empty( $social_tiktok ) ) : ?>
							<li>
								<a class="footer-social__item" href="<?php echo esc_url( $social_tiktok ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'TikTok Mediora', 'mediora-clinic' ); ?>">
									<img class="footer-social__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-tiktok.png' ); ?>" alt="TikTok" width="48" height="48" loading="lazy">
									<span class="footer-social__text text-linear"><?php esc_html_e( 'Bác Sĩ Hoàng Tùng - Trẻ Hoá', 'mediora-clinic' ); ?></span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( ! empty( $social_mess ) ) : ?>
							<li>
								<a class="footer-social__item" href="<?php echo esc_url( $social_mess ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Messenger Mediora', 'mediora-clinic' ); ?>">
									<img class="footer-social__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-mess.png' ); ?>" alt="Messenger" width="48" height="48" loading="lazy">
									<span class="footer-social__text text-linear"><?php esc_html_e( 'Messenger Tư Vấn 24/7', 'mediora-clinic' ); ?></span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>

			<!-- Footer Bottom Copyright -->
			<div class="footer-bottom">
				<p class="m-0">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Bảo lưu mọi quyền.', 'mediora-clinic' ); ?>
				</p>
				<p class="m-0">
					<?php esc_html_e( 'Tiêu chuẩn Y khoa Thẩm mỹ Luxury & An toàn.', 'mediora-clinic' ); ?>
				</p>
			</div>
		</div>
	</footer><!-- #colophon -->

	<!-- Floating Quick Contact Widget -->
	<aside class="float-contact" aria-label="<?php esc_attr_e( 'Liên hệ nhanh', 'mediora-clinic' ); ?>">
		<?php if ( ! empty( $social_zalo ) ) : ?>
			<a href="<?php echo esc_url( $social_zalo ); ?>" target="_blank" rel="noopener noreferrer" class="fc-item" aria-label="<?php esc_attr_e( 'Chat Zalo', 'mediora-clinic' ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-zalo.png' ); ?>" alt="Zalo" width="39" height="39">
			</a>
		<?php endif; ?>

		<a href="#popupConsult" class="fc-item" data-bs-toggle="modal" data-bs-target="#popupConsult" aria-label="<?php esc_attr_e( 'Đặt lịch tư vấn', 'mediora-clinic' ); ?>">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-calendar.png' ); ?>" alt="<?php esc_attr_e( 'Lịch', 'mediora-clinic' ); ?>" width="39" height="39">
		</a>

		<span class="fc-divider" aria-hidden="true"></span>

		<a href="<?php echo esc_url( 'tel:' . $hotline_tel ); ?>" class="fc-item" aria-label="<?php esc_attr_e( 'Gọi hotline', 'mediora-clinic' ); ?>">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/ic-phone.png' ); ?>" alt="<?php esc_attr_e( 'Hotline', 'mediora-clinic' ); ?>" width="39" height="39">
		</a>
	</aside>

	<!-- Global Consultation Booking Modal -->
	<div class="modal fade" id="popupConsult" tabindex="-1" aria-labelledby="popupConsultLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content modal-booking-dialog position-relative">
				<button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="<?php esc_attr_e( 'Đóng', 'mediora-clinic' ); ?>"></button>
				
				<?php
				get_template_part(
					'template-parts/booking-form',
					null,
					array(
						'source'         => 'modal-popup',
						'show_title_img' => false,
						'title_text'     => __( 'Đăng Ký Tư Vấn Cùng Bác Sĩ', 'mediora-clinic' ),
						'subtitle_text'  => __( 'Để lại thông tin, bác sĩ chuyên khoa MEDIORA sẽ liên hệ bảo mật trong 15 phút.', 'mediora-clinic' ),
					)
				);
				?>
			</div>
		</div>
	</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
