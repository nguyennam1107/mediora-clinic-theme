<?php
/**
 * Mediora Clinic Theme Customizer Options
 *
 * Registers the Customizer panel, sections, settings, and controls for:
 * - General Clinic & Legal Licensing info
 * - Media & Facility Videos
 * - Social Media Channels & Messaging
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mediora_customize_register( $wp_customize ) {

	// -------------------------------------------------------------
	// 1. Main Theme Panel: MEDIORA Luxury Clinic
	// -------------------------------------------------------------
	$wp_customize->add_panel(
		'mediora_theme_options',
		array(
			'title'       => __( 'Cấu hình MEDIORA Luxury Clinic', 'mediora-clinic' ),
			'description' => __( 'Quản lý toàn bộ thông tin phòng khám, giấy phép pháp lý, video cơ sở vật chất và kênh liên hệ.', 'mediora-clinic' ),
			'priority'    => 30,
			'capability'  => 'edit_theme_options',
		)
	);

	// -------------------------------------------------------------
	// 2. Section: General Information & Medical Licensing
	// -------------------------------------------------------------
	$wp_customize->add_section(
		'mediora_general_info',
		array(
			'title'       => __( 'Thông tin phòng khám & Pháp lý', 'mediora-clinic' ),
			'description' => __( 'Tên cơ sở, hotline, địa chỉ và thông tin giấy phép hành nghề Sở Y Tế.', 'mediora-clinic' ),
			'panel'       => 'mediora_theme_options',
			'priority'    => 10,
		)
	);

	// Clinic Name
	$wp_customize->add_setting(
		'clinic_name',
		array(
			'default'           => 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'clinic_name',
		array(
			'label'       => __( 'Tên phòng khám / Thương hiệu', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'text',
		)
	);

	// Hotline
	$wp_customize->add_setting(
		'hotline',
		array(
			'default'           => '0945.334.832',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hotline',
		array(
			'label'       => __( 'Hotline tư vấn hiển thị', 'mediora-clinic' ),
			'description' => __( 'Số điện thoại hiển thị trên header, footer và nút gọi nhanh.', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'text',
		)
	);

	// Clinic Address
	$wp_customize->add_setting(
		'clinic_address',
		array(
			'default'           => "257 - 259 Nguyễn Đình Chiểu,\nPhường Bàn Cờ, TP. HCM",
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'clinic_address',
		array(
			'label'       => __( 'Địa chỉ trụ sở phòng khám', 'mediora-clinic' ),
			'description' => __( 'Hỗ trợ xuống dòng để căn chỉnh hiển thị đẹp trên chân trang.', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'textarea',
		)
	);

	// Footer City / Branch Title
	$wp_customize->add_setting(
		'footer_city',
		array(
			'default'           => 'Hồ Chí Minh:',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'footer_city',
		array(
			'label'       => __( 'Tiêu đề chi nhánh / Thành phố (Footer)', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'text',
		)
	);

	// License Title
	$wp_customize->add_setting(
		'license_title',
		array(
			'default'           => 'Giấy cấp phép MEDIORA TP. Hồ Chí Minh',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'license_title',
		array(
			'label'       => __( 'Tiêu đề khối giấy phép pháp lý', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'text',
		)
	);

	// General Medical License Summary
	$wp_customize->add_setting(
		'medical_license',
		array(
			'default'           => 'Giấy phép hoạt động khám bệnh, chữa bệnh chuyên khoa thẩm mỹ số 0319600033/HCM-GPHĐ do Sở Y Tế TP.HCM cấp',
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'medical_license',
		array(
			'label'       => __( 'Thông tin giấy phép y tế tổng quát', 'mediora-clinic' ),
			'description' => __( 'Sử dụng cho cấu trúc dữ liệu Schema và thông báo pháp lý.', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'textarea',
		)
	);

	// License Detail Paragraph 1 (Facility & Company info)
	$wp_customize->add_setting(
		'license_p1',
		array(
			'default'           => "Phòng khám Chuyên khoa thẩm mỹ MEDIORA<br>Trực thuộc Công ty TNHH Y khoa Mediora<br>MST: 0319600033/ HCM-GPHĐ do SỞ Y TẾ THÀNH PHỐ HỒ CHÍ MINH cấp.",
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'license_p1',
		array(
			'label'       => __( 'Chi tiết giấy phép 1 (Cơ sở & Sở Y Tế)', 'mediora-clinic' ),
			'description' => __( 'Cho phép thẻ &lt;br&gt; để ngắt dòng.', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'textarea',
		)
	);

	// License Detail Paragraph 2 (Doctor in charge 1)
	$wp_customize->add_setting(
		'license_p2',
		array(
			'default'           => "Bác sĩ phụ trách chuyên môn Lê Quốc Anh<br>Số GPHN: 044323/BYT- CCHN",
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'license_p2',
		array(
			'label'       => __( 'Chi tiết giấy phép 2 (Bác sĩ chuyên môn)', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'textarea',
		)
	);

	// License Detail Paragraph 3 (Doctor in charge 2)
	$wp_customize->add_setting(
		'license_p3',
		array(
			'default'           => "Bác sĩ phụ trách chuyên môn Hoàng Thanh Tùng<br>Số GPHN: 002879/ĐNAI- GPHN",
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'license_p3',
		array(
			'label'       => __( 'Chi tiết giấy phép 3 (Bác sĩ chuyên môn)', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'textarea',
		)
	);

	// External Booking Shortcode
	$wp_customize->add_setting(
		'booking_shortcode',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'booking_shortcode',
		array(
			'label'       => __( 'Shortcode Form đặt lịch ngoài', 'mediora-clinic' ),
			'description' => __( 'Nhập shortcode Contact Form 7 hoặc WPForms (ví dụ: [contact-form-7 id="123"]). Để trống để dùng Built-in Luxury Ajax Form.', 'mediora-clinic' ),
			'section'     => 'mediora_general_info',
			'type'        => 'text',
		)
	);

	// -------------------------------------------------------------
	// 3. Section: Media & Video Settings
	// -------------------------------------------------------------
	$wp_customize->add_section(
		'mediora_media_settings',
		array(
			'title'       => __( 'Video & Media', 'mediora-clinic' ),
			'description' => __( 'Cấu hình video giới thiệu cơ sở vật chất, video quy trình và hình ảnh đại diện.', 'mediora-clinic' ),
			'panel'       => 'mediora_theme_options',
			'priority'    => 20,
		)
	);

	// Facility Video URL
	$wp_customize->add_setting(
		'facility_video_url',
		array(
			'default'           => 'https://d1b6kbmv97kzjg.cloudfront.net/wp-content/uploads/2026/11/CSVC.mp4',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'facility_video_url',
		array(
			'label'       => __( 'URL Video Cơ sở vật chất (MP4)', 'mediora-clinic' ),
			'description' => __( 'Video phát trong khung viền mạ vàng 5 sao tại trang chủ.', 'mediora-clinic' ),
			'section'     => 'mediora_media_settings',
			'type'        => 'url',
		)
	);

	// GMISS Procedure Video URL
	$wp_customize->add_setting(
		'gmiss_video_url',
		array(
			'default'           => 'https://d1b6kbmv97kzjg.cloudfront.net/wp-content/uploads/2026/11/tvc.mp4',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'gmiss_video_url',
		array(
			'label'       => __( 'URL Video Quy trình Nâng cơ GMISS (MP4)', 'mediora-clinic' ),
			'description' => __( 'Video quy trình trực quan cạnh 6 bước y khoa.', 'mediora-clinic' ),
			'section'     => 'mediora_media_settings',
			'type'        => 'url',
		)
	);

	// Intro Philosophy Paragraph
	$wp_customize->add_setting(
		'intro_philosophy',
		array(
			'default'           => 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA định hướng phát triển theo tiêu chuẩn thẩm mỹ chuyên nghiệp, kết hợp nền tảng chuyên môn, công nghệ hiện đại và chiến lược cá nhân hóa trong từng chỉ định. Điểm khác biệt của MEDIORA nằm ở tư duy thẩm mỹ tổng thể, quy trình thực hiện chuẩn hóa và sự theo sát xuyên suốt hành trình khách hàng, hướng đến kết quả hài hòa, tự nhiên và phù hợp với đặc điểm riêng của mỗi người.',
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'intro_philosophy',
		array(
			'label'       => __( 'Đoạn văn triết lý điều trị (Giới thiệu)', 'mediora-clinic' ),
			'description' => __( 'Văn bản hiển thị nổi bật dưới banner trang chủ.', 'mediora-clinic' ),
			'section'     => 'mediora_media_settings',
			'type'        => 'textarea',
		)
	);

	// Register Section Cover Image
	$wp_customize->add_setting(
		'register_cover_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'register_cover_image',
			array(
				'label'       => __( 'Ảnh bìa bên cạnh form tư vấn', 'mediora-clinic' ),
				'description' => __( 'Ảnh lớn (kích thước đề xuất: 1287x724px) hiển thị cạnh form đặt lịch.', 'mediora-clinic' ),
				'section'     => 'mediora_media_settings',
			)
		)
	);

	// -------------------------------------------------------------
	// 4. Section: Social Channels & Messaging Links
	// -------------------------------------------------------------
	$wp_customize->add_section(
		'mediora_social_links',
		array(
			'title'       => __( 'Kênh truyền thông & Mạng xã hội', 'mediora-clinic' ),
			'description' => __( 'Liên kết các kênh mạng xã hội, nút chat nhanh nổi trên màn hình và chân trang.', 'mediora-clinic' ),
			'panel'       => 'mediora_theme_options',
			'priority'    => 30,
		)
	);

	// Facebook URL
	$wp_customize->add_setting(
		'social_facebook',
		array(
			'default'           => 'https://www.facebook.com/pkcktmmediora',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'social_facebook',
		array(
			'label'       => __( 'Facebook Fanpage URL', 'mediora-clinic' ),
			'section'     => 'mediora_social_links',
			'type'        => 'url',
		)
	);

	// TikTok URL
	$wp_customize->add_setting(
		'social_tiktok',
		array(
			'default'           => 'https://www.tiktok.com/@phongkhammediora',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'social_tiktok',
		array(
			'label'       => __( 'Kênh TikTok URL', 'mediora-clinic' ),
			'section'     => 'mediora_social_links',
			'type'        => 'url',
		)
	);

	// YouTube URL
	$wp_customize->add_setting(
		'social_youtube',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'social_youtube',
		array(
			'label'       => __( 'Kênh YouTube URL', 'mediora-clinic' ),
			'section'     => 'mediora_social_links',
			'type'        => 'url',
		)
	);

	// Zalo Link
	$wp_customize->add_setting(
		'social_zalo',
		array(
			'default'           => 'https://zalo.me/636737550228660397',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'social_zalo',
		array(
			'label'       => __( 'Link Zalo OA / Chat Zalo', 'mediora-clinic' ),
			'description' => __( 'Ví dụ: https://zalo.me/...', 'mediora-clinic' ),
			'section'     => 'mediora_social_links',
			'type'        => 'url',
		)
	);

	// Messenger Link
	$wp_customize->add_setting(
		'social_messenger',
		array(
			'default'           => 'https://m.me/pkcktmmediora',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'social_messenger',
		array(
			'label'       => __( 'Link Facebook Messenger', 'mediora-clinic' ),
			'description' => __( 'Ví dụ: https://m.me/...', 'mediora-clinic' ),
			'section'     => 'mediora_social_links',
			'type'        => 'url',
		)
	);

	// Selective refresh bindings
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'clinic_name',
			array(
				'selector'        => '.site-title, .logo span',
				'render_callback' => function() {
					return esc_html( mediora_get_option( 'clinic_name' ) );
				},
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'hotline',
			array(
				'selector'        => '.header-cta .hotline span, .footer-phone',
				'render_callback' => function() {
					return esc_html( mediora_get_option( 'hotline' ) );
				},
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'intro_philosophy',
			array(
				'selector'        => '.sec-intro .intro-text',
				'render_callback' => function() {
					return esc_html( mediora_get_option( 'intro_philosophy' ) );
				},
			)
		);
	}
}
add_action( 'customize_register', 'mediora_customize_register' );
