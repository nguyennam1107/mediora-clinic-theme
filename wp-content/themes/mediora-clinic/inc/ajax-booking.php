<?php
/**
 * Mediora Clinic AJAX Booking Handler & Lead Management
 *
 * Handles:
 * - Registration of 'lead_booking' Custom Post Type to ensure zero lead loss
 * - Admin columns and meta boxes for viewing consultation leads
 * - Secure AJAX booking submission with nonce, honeypot, and validation
 * - Beautiful HTML email notifications to clinic administration
 * - JSON responses for frontend feedback
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Register Custom Post Type: 'lead_booking'
 * Stores customer consultation requests safely in WordPress database.
 */
function mediora_register_lead_booking_cpt() {
	$labels = array(
		'name'                  => _x( 'Khách Tư Vấn', 'Post type general name', 'mediora-clinic' ),
		'singular_name'         => _x( 'Khách Tư Vấn', 'Post type singular name', 'mediora-clinic' ),
		'menu_name'             => _x( 'Khách Tư Vấn', 'Admin Menu text', 'mediora-clinic' ),
		'name_admin_bar'        => _x( 'Khách Tư Vấn', 'Add New on Toolbar', 'mediora-clinic' ),
		'add_new'               => __( 'Thêm Khách Mới', 'mediora-clinic' ),
		'add_new_item'          => __( 'Thêm Khách Tư Vấn Mới', 'mediora-clinic' ),
		'new_item'              => __( 'Khách Tư Vấn Mới', 'mediora-clinic' ),
		'edit_item'             => __( 'Chi Tiết Khách Tư Vấn', 'mediora-clinic' ),
		'view_item'             => __( 'Xem Thông Tin Khách', 'mediora-clinic' ),
		'all_items'             => __( 'Tất Cả Khách Tư Vấn', 'mediora-clinic' ),
		'search_items'          => __( 'Tìm Kiếm Khách', 'mediora-clinic' ),
		'not_found'             => __( 'Không tìm thấy khách đăng ký nào.', 'mediora-clinic' ),
		'not_found_in_trash'    => __( 'Không có khách nào trong thùng rác.', 'mediora-clinic' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 26,
		'menu_icon'          => 'dashicons-clipboard',
		'supports'           => array( 'title' ),
	);

	register_post_type( 'lead_booking', $args );
}
add_action( 'init', 'mediora_register_lead_booking_cpt' );

/**
 * 2. Custom Admin Columns for 'lead_booking' CPT
 */
function mediora_lead_booking_columns( $columns ) {
	$custom_columns = array(
		'cb'           => $columns['cb'],
		'title'        => __( 'Họ và tên', 'mediora-clinic' ),
		'lead_phone'   => __( 'Số điện thoại', 'mediora-clinic' ),
		'lead_service' => __( 'Dịch vụ quan tâm', 'mediora-clinic' ),
		'lead_time'    => __( 'Thời gian liên hệ', 'mediora-clinic' ),
		'lead_source'  => __( 'Nguồn', 'mediora-clinic' ),
		'lead_status'  => __( 'Trạng thái', 'mediora-clinic' ),
		'date'         => __( 'Thời gian đăng ký', 'mediora-clinic' ),
	);
	return $custom_columns;
}
add_filter( 'manage_lead_booking_posts_columns', 'mediora_lead_booking_columns' );

/**
 * Render custom column content
 */
function mediora_lead_booking_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'lead_phone':
			$phone = get_post_meta( $post_id, '_lead_phone', true );
			if ( ! empty( $phone ) ) {
				$clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
				echo '<a href="tel:' . esc_attr( $clean_phone ) . '" style="font-weight:600; color:#d4af37; text-decoration:none;">' . esc_html( $phone ) . '</a>';
			} else {
				echo '<span style="color:#888;">—</span>';
			}
			break;

		case 'lead_service':
			$service = get_post_meta( $post_id, '_lead_service', true );
			echo ! empty( $service ) ? '<span class="badge" style="background:#1d2939; color:#f4d068; padding:3px 8px; border-radius:4px; border:1px solid #d4af37;">' . esc_html( $service ) . '</span>' : '<span style="color:#888;">—</span>';
			break;

		case 'lead_time':
			$time = get_post_meta( $post_id, '_lead_time', true );
			echo ! empty( $time ) ? esc_html( $time ) : '<span style="color:#888;">Bất kỳ lúc nào</span>';
			break;

		case 'lead_source':
			$source = get_post_meta( $post_id, '_lead_source', true );
			echo ! empty( $source ) ? '<span style="color:#667085; font-size:12px;">' . esc_html( $source ) . '</span>' : '<span style="color:#888;">Landing Page</span>';
			break;

		case 'lead_status':
			$status = get_post_meta( $post_id, '_lead_status', true );
			if ( empty( $status ) ) {
				$status = 'new';
			}
			$status_labels = array(
				'new'       => array( 'Mới đăng ký', '#027a48', '#ecfdf3' ),
				'calling'   => array( 'Đang liên hệ', '#b54708', '#fffaeb' ),
				'consulted' => array( 'Đã tư vấn', '#026aa2', '#f0f9ff' ),
				'booked'    => array( 'Đã đặt lịch', '#5925dc', '#f4f3ff' ),
				'completed' => array( 'Thành công', '#12b76a', '#ecfdf3' ),
				'cancelled' => array( 'Hủy / Sai số', '#b42318', '#fef3f2' ),
			);
			$config = isset( $status_labels[ $status ] ) ? $status_labels[ $status ] : array( $status, '#344054', '#f2f4f7' );
			echo '<span style="display:inline-block; font-size:11px; font-weight:600; padding:3px 10px; border-radius:12px; color:' . esc_attr( $config[1] ) . '; background:' . esc_attr( $config[2] ) . ';">' . esc_html( $config[0] ) . '</span>';
			break;
	}
}
add_action( 'manage_lead_booking_posts_custom_column', 'mediora_lead_booking_column_content', 10, 2 );

/**
 * 3. Lead Details Meta Box in Post Edit Screen
 */
function mediora_add_lead_meta_boxes() {
	add_meta_box(
		'mediora_lead_details',
		__( 'Thông Tin Chi Tiết Khách Hàng Tư Vấn', 'mediora-clinic' ),
		'mediora_render_lead_meta_box',
		'lead_booking',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mediora_add_lead_meta_boxes' );

function mediora_render_lead_meta_box( $post ) {
	wp_nonce_field( 'mediora_lead_meta_box', 'mediora_lead_meta_box_nonce' );

	$fullname   = get_post_meta( $post->ID, '_lead_fullname', true );
	$phone      = get_post_meta( $post->ID, '_lead_phone', true );
	$service    = get_post_meta( $post->ID, '_lead_service', true );
	$time       = get_post_meta( $post->ID, '_lead_time', true );
	$note       = get_post_meta( $post->ID, '_lead_note', true );
	$source     = get_post_meta( $post->ID, '_lead_source', true );
	$page_url   = get_post_meta( $post->ID, '_lead_page_url', true );
	$ip         = get_post_meta( $post->ID, '_lead_ip', true );
	$status     = get_post_meta( $post->ID, '_lead_status', true );
	if ( empty( $status ) ) {
		$status = 'new';
	}
	?>
	<table class="form-table" style="max-width:800px;">
		<tr>
			<th scope="row" style="width:200px;"><label for="lead_fullname"><strong><?php esc_html_e( 'Họ và tên:', 'mediora-clinic' ); ?></strong></label></th>
			<td><input type="text" id="lead_fullname" name="lead_fullname" class="regular-text" value="<?php echo esc_attr( $fullname ); ?>"></td>
		</tr>
		<tr>
			<th scope="row"><label for="lead_phone"><strong><?php esc_html_e( 'Số điện thoại:', 'mediora-clinic' ); ?></strong></label></th>
			<td>
				<input type="text" id="lead_phone" name="lead_phone" class="regular-text" value="<?php echo esc_attr( $phone ); ?>">
				<?php if ( ! empty( $phone ) ) : ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="button button-secondary" style="margin-left:10px;">
						<?php esc_html_e( 'Gọi trực tiếp', 'mediora-clinic' ); ?>
					</a>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="lead_service"><strong><?php esc_html_e( 'Dịch vụ quan tâm:', 'mediora-clinic' ); ?></strong></label></th>
			<td><input type="text" id="lead_service" name="lead_service" class="regular-text" value="<?php echo esc_attr( $service ); ?>"></td>
		</tr>
		<tr>
			<th scope="row"><label for="lead_time"><strong><?php esc_html_e( 'Giờ liên hệ phù hợp:', 'mediora-clinic' ); ?></strong></label></th>
			<td><input type="text" id="lead_time" name="lead_time" class="regular-text" value="<?php echo esc_attr( $time ); ?>"></td>
		</tr>
		<tr>
			<th scope="row"><label for="lead_status"><strong><?php esc_html_e( 'Trạng thái tư vấn:', 'mediora-clinic' ); ?></strong></label></th>
			<td>
				<select name="lead_status" id="lead_status">
					<option value="new" <?php selected( $status, 'new' ); ?>><?php esc_html_e( 'Mới đăng ký (Chưa gọi)', 'mediora-clinic' ); ?></option>
					<option value="calling" <?php selected( $status, 'calling' ); ?>><?php esc_html_e( 'Đang liên hệ / Chưa nhấc máy', 'mediora-clinic' ); ?></option>
					<option value="consulted" <?php selected( $status, 'consulted' ); ?>><?php esc_html_e( 'Đã tư vấn chuyên sâu', 'mediora-clinic' ); ?></option>
					<option value="booked" <?php selected( $status, 'booked' ); ?>><?php esc_html_e( 'Đã đặt lịch hẹn tới phòng khám', 'mediora-clinic' ); ?></option>
					<option value="completed" <?php selected( $status, 'completed' ); ?>><?php esc_html_e( 'Khách đã thực hiện dịch vụ', 'mediora-clinic' ); ?></option>
					<option value="cancelled" <?php selected( $status, 'cancelled' ); ?>><?php esc_html_e( 'Hủy lịch / Sai số điện thoại', 'mediora-clinic' ); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="lead_note"><strong><?php esc_html_e( 'Ghi chú / Nhu cầu khách:', 'mediora-clinic' ); ?></strong></label></th>
			<td><textarea id="lead_note" name="lead_note" rows="4" class="large-text"><?php echo esc_textarea( $note ); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"><strong><?php esc_html_e( 'Nguồn đăng ký:', 'mediora-clinic' ); ?></strong></th>
			<td><code><?php echo esc_html( $source ?: 'Landing Page' ); ?></code></td>
		</tr>
		<?php if ( ! empty( $page_url ) ) : ?>
		<tr>
			<th scope="row"><strong><?php esc_html_e( 'Trang gửi:', 'mediora-clinic' ); ?></strong></th>
			<td><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $page_url ); ?></a></td>
		</tr>
		<?php endif; ?>
		<?php if ( ! empty( $ip ) ) : ?>
		<tr>
			<th scope="row"><strong><?php esc_html_e( 'Địa chỉ IP:', 'mediora-clinic' ); ?></strong></th>
			<td><code><?php echo esc_html( $ip ); ?></code></td>
		</tr>
		<?php endif; ?>
	</table>
	<?php
}

function mediora_save_lead_meta_box( $post_id ) {
	if ( ! isset( $_POST['mediora_lead_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['mediora_lead_meta_box_nonce'] ), 'mediora_lead_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['lead_fullname'] ) ) {
		update_post_meta( $post_id, '_lead_fullname', sanitize_text_field( wp_unslash( $_POST['lead_fullname'] ) ) );
	}
	if ( isset( $_POST['lead_phone'] ) ) {
		update_post_meta( $post_id, '_lead_phone', sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) );
	}
	if ( isset( $_POST['lead_service'] ) ) {
		update_post_meta( $post_id, '_lead_service', sanitize_text_field( wp_unslash( $_POST['lead_service'] ) ) );
	}
	if ( isset( $_POST['lead_time'] ) ) {
		update_post_meta( $post_id, '_lead_time', sanitize_text_field( wp_unslash( $_POST['lead_time'] ) ) );
	}
	if ( isset( $_POST['lead_status'] ) ) {
		update_post_meta( $post_id, '_lead_status', sanitize_text_field( wp_unslash( $_POST['lead_status'] ) ) );
	}
	if ( isset( $_POST['lead_note'] ) ) {
		update_post_meta( $post_id, '_lead_note', sanitize_textarea_field( wp_unslash( $_POST['lead_note'] ) ) );
	}
}
add_action( 'save_post_lead_booking', 'mediora_save_lead_meta_box' );

/**
 * 4. AJAX Booking Submission Handler
 *
 * Hooks:
 * - wp_ajax_nopriv_mediora_submit_booking
 * - wp_ajax_mediora_submit_booking
 * - wp_ajax_nopriv_mediora_booking (legacy compatibility)
 * - wp_ajax_mediora_booking (legacy compatibility)
 */
function mediora_ajax_submit_booking() {
	// A. Security Nonce Check
	$nonce = '';
	if ( ! empty( $_POST['mediora_booking_security'] ) ) {
		$nonce = sanitize_key( $_POST['mediora_booking_security'] );
	} elseif ( ! empty( $_POST['nonce'] ) ) {
		$nonce = sanitize_key( $_POST['nonce'] );
	} elseif ( ! empty( $_REQUEST['nonce'] ) ) {
		$nonce = sanitize_key( $_REQUEST['nonce'] );
	}

	if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'mediora_booking_nonce' ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Phiên làm việc đã hết hạn hoặc mã xác thực không hợp lệ. Vui lòng tải lại trang và thử lại.', 'mediora-clinic' ),
			)
		);
	}

	// B. Anti-spam Honeypot Check
	if ( ! empty( $_POST['website'] ) || ! empty( $_POST['extra_field'] ) ) {
		// Bot caught in honeypot -> return successful response quietly
		wp_send_json_success(
			array(
				'message' => esc_html__( 'Cảm ơn bạn! Bác sĩ chuyên khoa MEDIORA sẽ liên hệ tư vấn trong thời gian sớm nhất.', 'mediora-clinic' ),
			)
		);
	}

	// C. Sanitize & Validate Form Fields
	$fullname_raw = wp_unslash( $_POST['fullname'] ?? $_POST['name'] ?? $_POST['your-name'] ?? '' );
	$fullname     = sanitize_text_field( $fullname_raw );

	if ( empty( $fullname ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Vui lòng nhập họ và tên của bạn.', 'mediora-clinic' ),
				'field'   => 'fullname',
			)
		);
	}

	$phone_raw = wp_unslash( $_POST['phone'] ?? $_POST['your-phone'] ?? '' );
	$phone_raw = sanitize_text_field( $phone_raw );
	// Strip all spacing, dashes, dots, brackets
	$phone_clean = preg_replace( '/[^0-9+]/', '', $phone_raw );

	// Validate Vietnamese Phone Number Pattern:
	// Allowed prefixes: 03, 05, 07, 08, 09 followed by 8 digits (or starting with +84)
	$is_valid_phone = preg_match( '/^(0|\+84)(3[2-9]|5[2689]|7[06-9]|8[1-9]|9[0-9])[0-9]{7}$/', $phone_clean )
		|| preg_match( '/^(0|\+84)[0-9]{9}$/', $phone_clean );

	if ( ! $is_valid_phone ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Số điện thoại chưa hợp lệ. Vui lòng nhập số điện thoại Việt Nam gồm 10 chữ số (VD: 0945 334 832).', 'mediora-clinic' ),
				'field'   => 'phone',
			)
		);
	}

	$service_raw = wp_unslash( $_POST['service'] ?? '' );
	$service     = sanitize_text_field( $service_raw );
	if ( empty( $service ) ) {
		$service = esc_html__( 'Nâng cơ GMISS & Trẻ hóa đa tầng', 'mediora-clinic' );
	}

	$time_raw     = wp_unslash( $_POST['consult_time'] ?? $_POST['time'] ?? '' );
	$consult_time = sanitize_text_field( $time_raw );
	if ( empty( $consult_time ) ) {
		$consult_time = esc_html__( 'Bất kỳ lúc nào', 'mediora-clinic' );
	}

	$note_raw = wp_unslash( $_POST['note'] ?? $_POST['need'] ?? '' );
	$note     = sanitize_textarea_field( $note_raw );

	$source_raw = wp_unslash( $_POST['source'] ?? 'Landing Page' );
	$source     = sanitize_text_field( $source_raw );

	$page_url_raw = wp_unslash( $_POST['page_url'] ?? '' );
	$page_url     = esc_url_raw( $page_url_raw );

	$client_ip = '';
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$client_ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$client_ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
	} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$client_ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
	}

	// D. Persistent Storage in CPT 'lead_booking'
	$post_title = sprintf( '%s - %s', $fullname, $phone_clean );
	$lead_post  = array(
		'post_type'    => 'lead_booking',
		'post_title'   => $post_title,
		'post_content' => $note,
		'post_status'  => 'publish',
	);

	$lead_id = wp_insert_post( $lead_post );

	if ( ! is_wp_error( $lead_id ) && $lead_id > 0 ) {
		update_post_meta( $lead_id, '_lead_fullname', $fullname );
		update_post_meta( $lead_id, '_lead_phone', $phone_clean );
		update_post_meta( $lead_id, '_lead_service', $service );
		update_post_meta( $lead_id, '_lead_time', $consult_time );
		update_post_meta( $lead_id, '_lead_note', $note );
		update_post_meta( $lead_id, '_lead_source', $source );
		update_post_meta( $lead_id, '_lead_page_url', $page_url );
		update_post_meta( $lead_id, '_lead_ip', $client_ip );
		update_post_meta( $lead_id, '_lead_status', 'new' );
	}

	// Also backup latest 50 leads in WP options to guarantee lead safety
	$recent_leads = get_option( 'mediora_recent_leads', array() );
	if ( ! is_array( $recent_leads ) ) {
		$recent_leads = array();
	}
	array_unshift(
		$recent_leads,
		array(
			'id'       => $lead_id,
			'fullname' => $fullname,
			'phone'    => $phone_clean,
			'service'  => $service,
			'time'     => $consult_time,
			'note'     => $note,
			'source'   => $source,
			'created'  => current_time( 'mysql' ),
		)
	);
	if ( count( $recent_leads ) > 50 ) {
		$recent_leads = array_slice( $recent_leads, 0, 50 );
	}
	update_option( 'mediora_recent_leads', $recent_leads, false );

	// E. Send Luxury Email Notification to Administration
	mediora_send_booking_notification_email(
		array(
			'lead_id'      => $lead_id,
			'fullname'     => $fullname,
			'phone'        => $phone_clean,
			'service'      => $service,
			'consult_time' => $consult_time,
			'note'         => $note,
			'source'       => $source,
			'page_url'     => $page_url,
			'ip'           => $client_ip,
			'time'         => current_time( 'd/m/Y H:i:s' ),
		)
	);

	// F. Standardized JSON Success Response
	wp_send_json_success(
		array(
			'message' => esc_html__( 'Cảm ơn bạn! Bác sĩ chuyên khoa MEDIORA sẽ liên hệ tư vấn trong thời gian sớm nhất.', 'mediora-clinic' ),
			'lead_id' => $lead_id,
		)
	);
}

// Hook all registration actions
add_action( 'wp_ajax_mediora_submit_booking', 'mediora_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_mediora_submit_booking', 'mediora_ajax_submit_booking' );
add_action( 'wp_ajax_mediora_booking', 'mediora_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_mediora_booking', 'mediora_ajax_submit_booking' );

/**
 * 5. Send Luxury HTML Email Notification
 */
function mediora_send_booking_notification_email( $data ) {
	$admin_email = get_option( 'admin_email' );
	if ( empty( $admin_email ) ) {
		return false;
	}

	$site_name = get_bloginfo( 'name' );
	$subject   = sprintf( '[%s] Đăng ký tư vấn mới: %s - %s', $site_name, $data['fullname'], $data['phone'] );

	$edit_link = '';
	if ( ! empty( $data['lead_id'] ) && is_numeric( $data['lead_id'] ) ) {
		$edit_link = admin_url( 'post.php?post=' . intval( $data['lead_id'] ) . '&action=edit' );
	}

	$body = '
	<!DOCTYPE html>
	<html lang="vi">
	<head>
		<meta charset="UTF-8">
		<title>' . esc_html( $subject ) . '</title>
	</head>
	<body style="margin:0; padding:20px; background-color:#0d1117; font-family:\'Montserrat\', Arial, sans-serif; color:#e6edf3;">
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px; margin:0 auto; background-color:#161b22; border-radius:12px; border:1px solid #d4af37; overflow:hidden;">
			<!-- Header -->
			<tr>
				<td style="padding:28px 24px; text-align:center; background:linear-gradient(135deg, #1f1b13 0%, #0d1117 100%); border-bottom:1px solid rgba(212,175,55,0.3);">
					<h1 style="margin:0 0 6px 0; font-size:22px; font-weight:700; color:#d4af37; letter-spacing:1px; text-transform:uppercase;">Phòng Khám Thẩm Mỹ MEDIORA</h1>
					<p style="margin:0; font-size:13px; color:#8c9ba5;">Thông Báo Có Khách Hàng Đăng Ký Tư Vấn Mới</p>
				</td>
			</tr>
			<!-- Content Table -->
			<tr>
				<td style="padding:24px;">
					<p style="margin:0 0 16px 0; font-size:14px; color:#c9d1d9;">Bác sĩ và đội ngũ CSKH nhận được thông tin liên hệ mới từ website:</p>
					<table role="presentation" width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse; font-size:14px; background:#0d1117; border-radius:8px; overflow:hidden;">
						<tr style="border-bottom:1px solid #21262d;">
							<td style="width:35%; color:#8c9ba5; font-weight:600;">Họ và tên:</td>
							<td style="color:#ffffff; font-weight:700; font-size:16px;">' . esc_html( $data['fullname'] ) . '</td>
						</tr>
						<tr style="border-bottom:1px solid #21262d;">
							<td style="color:#8c9ba5; font-weight:600;">Số điện thoại:</td>
							<td><a href="tel:' . esc_attr( $data['phone'] ) . '" style="color:#f4d068; font-weight:700; text-decoration:none; font-size:16px;">' . esc_html( $data['phone'] ) . '</a></td>
						</tr>
						<tr style="border-bottom:1px solid #21262d;">
							<td style="color:#8c9ba5; font-weight:600;">Dịch vụ quan tâm:</td>
							<td style="color:#d4af37; font-weight:600;">' . esc_html( $data['service'] ) . '</td>
						</tr>
						<tr style="border-bottom:1px solid #21262d;">
							<td style="color:#8c9ba5; font-weight:600;">Giờ tiện liên hệ:</td>
							<td style="color:#e6edf3;">' . esc_html( $data['consult_time'] ) . '</td>
						</tr>
						<tr style="border-bottom:1px solid #21262d;">
							<td style="color:#8c9ba5; font-weight:600;">Nhu cầu / Tình trạng:</td>
							<td style="color:#e6edf3;">' . ( ! empty( $data['note'] ) ? nl2br( esc_html( $data['note'] ) ) : '<em>(Không ghi chú)</em>' ) . '</td>
						</tr>
						<tr style="border-bottom:1px solid #21262d;">
							<td style="color:#8c9ba5; font-weight:600;">Nguồn gửi:</td>
							<td style="color:#8c9ba5;">' . esc_html( $data['source'] ) . '</td>
						</tr>
						<tr>
							<td style="color:#8c9ba5; font-weight:600;">Thời gian đăng ký:</td>
							<td style="color:#8c9ba5;">' . esc_html( $data['time'] ) . '</td>
						</tr>
					</table>';

	if ( ! empty( $edit_link ) ) {
		$body .= '
					<div style="text-align:center; margin-top:24px;">
						<a href="' . esc_url( $edit_link ) . '" style="display:inline-block; padding:12px 28px; background:linear-gradient(135deg, #d4af37 0%, #aa820a 100%); color:#0d1117; font-weight:700; font-size:13px; text-decoration:none; border-radius:30px; text-transform:uppercase; letter-spacing:0.5px;">Xem Chi Tiết Khách Hàng Trong Admin &rarr;</a>
					</div>';
	}

	$body .= '
				</td>
			</tr>
			<!-- Footer -->
			<tr>
				<td style="padding:16px 24px; text-align:center; background-color:#0d1117; border-top:1px solid #21262d; font-size:12px; color:#6e7681;">
					Email này được gửi tự động từ hệ thống website ' . esc_html( $site_name ) . '.
				</td>
			</tr>
		</table>
	</body>
	</html>';

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . $site_name . ' <no-reply@' . wp_parse_url( home_url(), PHP_URL_HOST ) . '>',
	);

	return wp_mail( $admin_email, $subject, $body, $headers );
}
