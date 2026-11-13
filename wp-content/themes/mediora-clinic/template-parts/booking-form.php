<?php
/**
 * Template part for displaying the Consultation Booking Form
 *
 * Supports:
 * - External shortcodes (Contact Form 7, WPForms, etc.) configured in Customizer
 * - Built-in secure AJAX consultation booking form
 * - Embeddable in Front Page register block, Floating modals, and sidebars
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Check Customizer Shortcode
$custom_shortcode = function_exists( 'mediora_get_option' ) ? mediora_get_option( 'booking_shortcode', '' ) : '';
if ( ! empty( $custom_shortcode ) ) {
	echo '<div class="mediora-booking-form-custom wp-form-luxury-wrap">';
	echo do_shortcode( wp_kses_post( $custom_shortcode ) );
	echo '</div>';
	return;
}

// 2. Form configuration parameters
$theme_uri        = get_template_directory_uri();
$form_source      = ! empty( $args['source'] ) ? esc_attr( $args['source'] ) : 'landing-register';
$show_title_img   = isset( $args['show_title_img'] ) ? (bool) $args['show_title_img'] : true;
$title_text       = ! empty( $args['title_text'] ) ? $args['title_text'] : '';
$subtitle_text    = ! empty( $args['subtitle_text'] ) ? $args['subtitle_text'] : '';
$unique_id        = 'form-' . esc_attr( $form_source ) . '-' . wp_rand( 100, 999 );
?>

<form class="mediora-booking-form js-mediora-booking-form consult-form needs-validation <?php echo $show_title_img ? 'has-title' : ''; ?>"
	id="<?php echo esc_attr( $unique_id ); ?>"
	method="post"
	action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
	novalidate>

	<?php if ( $show_title_img ) : ?>
		<div class="consult-form__title text-center">
			<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/dang-ky-nhan-uu-dai.png' ); ?>"
				alt="<?php esc_attr_e( 'Đăng ký nhận ưu đãi tư vấn thẩm mỹ MEDIORA', 'mediora-clinic' ); ?>"
				width="204"
				height="110"
				loading="lazy">
		</div>
	<?php elseif ( ! empty( $title_text ) ) : ?>
		<div class="consult-form__title text-center">
			<h3 class="gold-text m-0"><?php echo esc_html( $title_text ); ?></h3>
			<?php if ( ! empty( $subtitle_text ) ) : ?>
				<p class="text-muted mt-2"><?php echo esc_html( $subtitle_text ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="consult-form__fields">
		<!-- Full Name -->
		<div class="field">
			<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>-name">
				<?php esc_html_e( 'Họ và tên của bạn', 'mediora-clinic' ); ?>
			</label>
			<input type="text"
				class="form-control"
				id="<?php echo esc_attr( $unique_id ); ?>-name"
				name="fullname"
				placeholder="<?php esc_attr_e( 'Họ và tên của bạn *', 'mediora-clinic' ); ?>"
				required
				autocomplete="name"
				maxlength="80">
			<div class="invalid-feedback">
				<?php esc_html_e( 'Vui lòng nhập họ và tên của bạn.', 'mediora-clinic' ); ?>
			</div>
		</div>

		<!-- Phone Number -->
		<div class="field">
			<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>-phone">
				<?php esc_html_e( 'Số điện thoại', 'mediora-clinic' ); ?>
			</label>
			<input type="tel"
				class="form-control"
				id="<?php echo esc_attr( $unique_id ); ?>-phone"
				name="phone"
				placeholder="<?php esc_attr_e( 'Số điện thoại liên hệ *', 'mediora-clinic' ); ?>"
				required
				pattern="^(0|\+84)[0-9]{9,11}$"
				inputmode="tel"
				autocomplete="tel"
				maxlength="15">
			<div class="invalid-feedback">
				<?php esc_html_e( 'Số điện thoại chưa đúng (VD: 0945 334 832).', 'mediora-clinic' ); ?>
			</div>
		</div>

		<!-- Service of Interest Dropdown -->
		<div class="field">
			<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>-service">
				<?php esc_html_e( 'Dịch vụ quan tâm', 'mediora-clinic' ); ?>
			</label>
			<select class="form-control form-select select-luxury" id="<?php echo esc_attr( $unique_id ); ?>-service" name="service">
				<option value="" disabled selected><?php esc_html_e( 'Chọn dịch vụ quan tâm...', 'mediora-clinic' ); ?></option>
				<option value="<?php esc_attr_e( 'Nâng cơ trẻ hóa sợi sinh học GMISS (Độc quyền)', 'mediora-clinic' ); ?>">
					<?php esc_html_e( 'Nâng cơ trẻ hóa sợi sinh học GMISS (Độc quyền)', 'mediora-clinic' ); ?>
				</option>
				<option value="<?php esc_attr_e( 'Trẻ hóa da công nghệ cao AI Fractional', 'mediora-clinic' ); ?>">
					<?php esc_html_e( 'Trẻ hóa da công nghệ cao AI Fractional', 'mediora-clinic' ); ?>
				</option>
				<option value="<?php esc_attr_e( 'Căng chỉ sinh học vùng mặt & cổ toàn diện', 'mediora-clinic' ); ?>">
					<?php esc_html_e( 'Căng chỉ sinh học vùng mặt & cổ toàn diện', 'mediora-clinic' ); ?>
				</option>
				<option value="<?php esc_attr_e( 'Tạo hình khuôn mặt & thon gọn viền hàm', 'mediora-clinic' ); ?>">
					<?php esc_html_e( 'Tạo hình khuôn mặt & thon gọn viền hàm', 'mediora-clinic' ); ?>
				</option>
				<option value="<?php esc_attr_e( 'Dịch vụ thẩm mỹ chuyên sâu khác', 'mediora-clinic' ); ?>">
					<?php esc_html_e( 'Dịch vụ thẩm mỹ chuyên sâu khác', 'mediora-clinic' ); ?>
				</option>
			</select>
		</div>

		<!-- Contact Time Preference Dropdown -->
		<div class="field">
			<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>-time">
				<?php esc_html_e( 'Thời gian tiện nghe máy', 'mediora-clinic' ); ?>
			</label>
			<select class="form-control form-select select-luxury" id="<?php echo esc_attr( $unique_id ); ?>-time" name="consult_time">
				<option value="Bất kỳ lúc nào" selected><?php esc_html_e( 'Thời gian tư vấn: Bất kỳ lúc nào', 'mediora-clinic' ); ?></option>
				<option value="Sáng (08:30 - 12:00)"><?php esc_html_e( 'Buổi Sáng (08:30 - 12:00)', 'mediora-clinic' ); ?></option>
				<option value="Chiều (13:30 - 17:30)"><?php esc_html_e( 'Buổi Chiều (13:30 - 17:30)', 'mediora-clinic' ); ?></option>
				<option value="Tối (18:00 - 20:30)"><?php esc_html_e( 'Buổi Tối (18:00 - 20:30)', 'mediora-clinic' ); ?></option>
			</select>
		</div>

		<!-- Note / Detailed Needs -->
		<div class="field">
			<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>-note">
				<?php esc_html_e( 'Nhu cầu hoặc tình trạng cần tư vấn', 'mediora-clinic' ); ?>
			</label>
			<textarea class="form-control form-textarea"
				id="<?php echo esc_attr( $unique_id ); ?>-note"
				name="note"
				rows="3"
				placeholder="<?php esc_attr_e( 'Tình trạng lão hóa hoặc nhu cầu cần bác sĩ tư vấn chi tiết...', 'mediora-clinic' ); ?>"
				maxlength="500"></textarea>
		</div>
	</div>

	<!-- Anti-spam Honeypot fields (hidden from human visitors) -->
	<div class="cf-hp" aria-hidden="true" style="position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden;">
		<label for="<?php echo esc_attr( $unique_id ); ?>-hp-web"><?php esc_html_e( 'Website', 'mediora-clinic' ); ?></label>
		<input type="text" id="<?php echo esc_attr( $unique_id ); ?>-hp-web" name="website" tabindex="-1" autocomplete="off">
		<input type="text" name="extra_field" tabindex="-1" autocomplete="off">
	</div>

	<!-- Hidden Tracking & Nonce Fields -->
	<?php wp_nonce_field( 'mediora_booking_nonce', 'mediora_booking_security' ); ?>
	<input type="hidden" name="action" value="mediora_submit_booking">
	<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'mediora_booking_nonce' ) ); ?>">
	<input type="hidden" name="source" value="<?php echo esc_attr( $form_source ); ?>">

	<!-- Submit Button with Luxury Gold Gradient & Loading Indicator -->
	<button type="submit" class="btn btn-receive btn-gold-pill w-100">
		<span class="btn-receive__text text-linear"><?php esc_html_e( 'Nhận tư vấn ngay', 'mediora-clinic' ); ?></span>
		<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
	</button>

	<!-- Feedback status message box -->
	<div class="form-msg" role="status" aria-live="polite"></div>
</form>
