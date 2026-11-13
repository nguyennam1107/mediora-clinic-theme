<?php
/**
 * Custom Post Types & Taxonomies for Mediora Clinic Theme
 *
 * Registers:
 * - 'service' (Dịch vụ Thẩm mỹ) CPT & 'service_category' (Chuyên khoa) Taxonomy
 * - 'doctor' (Đội ngũ Bác sĩ) CPT with specialized medical credential meta boxes
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types and Taxonomies.
 */
function mediora_register_post_types() {

	// =========================================================
	// 1. Custom Post Type: Service (Dịch vụ Thẩm mỹ)
	// =========================================================
	$service_labels = array(
		'name'                  => _x( 'Dịch vụ Thẩm mỹ', 'Post type general name', 'mediora-clinic' ),
		'singular_name'         => _x( 'Dịch vụ', 'Post type singular name', 'mediora-clinic' ),
		'menu_name'             => _x( 'Dịch vụ Thẩm mỹ', 'Admin Menu text', 'mediora-clinic' ),
		'name_admin_bar'        => _x( 'Dịch vụ', 'Add New on Toolbar', 'mediora-clinic' ),
		'add_new'               => __( 'Thêm dịch vụ mới', 'mediora-clinic' ),
		'add_new_item'          => __( 'Thêm dịch vụ thẩm mỹ mới', 'mediora-clinic' ),
		'new_item'              => __( 'Dịch vụ mới', 'mediora-clinic' ),
		'edit_item'             => __( 'Chỉnh sửa dịch vụ', 'mediora-clinic' ),
		'view_item'             => __( 'Xem dịch vụ', 'mediora-clinic' ),
		'all_items'             => __( 'Tất cả dịch vụ', 'mediora-clinic' ),
		'search_items'          => __( 'Tìm kiếm dịch vụ', 'mediora-clinic' ),
		'parent_item_colon'     => __( 'Dịch vụ cha:', 'mediora-clinic' ),
		'not_found'             => __( 'Không tìm thấy dịch vụ nào.', 'mediora-clinic' ),
		'not_found_in_trash'    => __( 'Không có dịch vụ nào trong Thùng rác.', 'mediora-clinic' ),
		'featured_image'        => _x( 'Ảnh đại diện dịch vụ', 'Overrides the “Featured Image” phrase', 'mediora-clinic' ),
		'set_featured_image'    => _x( 'Đặt ảnh đại diện', 'Overrides the “Set featured image” phrase', 'mediora-clinic' ),
		'remove_featured_image' => _x( 'Xóa ảnh đại diện', 'Overrides the “Remove featured image” phrase', 'mediora-clinic' ),
		'use_featured_image'    => _x( 'Dùng làm ảnh đại diện', 'Overrides the “Use as featured image” phrase', 'mediora-clinic' ),
	);

	$service_args = array(
		'labels'             => $service_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'       => 'dich-vu',
			'with_front' => false,
		),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-shield',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'service', $service_args );

	// =========================================================
	// 2. Custom Taxonomy: Service Category (Chuyên khoa / Danh mục)
	// =========================================================
	$taxonomy_labels = array(
		'name'              => _x( 'Chuyên khoa / Danh mục', 'taxonomy general name', 'mediora-clinic' ),
		'singular_name'     => _x( 'Chuyên khoa', 'taxonomy singular name', 'mediora-clinic' ),
		'search_items'      => __( 'Tìm kiếm chuyên khoa', 'mediora-clinic' ),
		'all_items'         => __( 'Tất cả chuyên khoa', 'mediora-clinic' ),
		'parent_item'       => __( 'Chuyên khoa cha', 'mediora-clinic' ),
		'parent_item_colon' => __( 'Chuyên khoa cha:', 'mediora-clinic' ),
		'edit_item'         => __( 'Chỉnh sửa chuyên khoa', 'mediora-clinic' ),
		'update_item'       => __( 'Cập nhật chuyên khoa', 'mediora-clinic' ),
		'add_new_item'      => __( 'Thêm chuyên khoa mới', 'mediora-clinic' ),
		'new_item_name'     => __( 'Tên chuyên khoa mới', 'mediora-clinic' ),
		'menu_name'         => __( 'Chuyên khoa', 'mediora-clinic' ),
	);

	$taxonomy_args = array(
		'hierarchical'      => true,
		'labels'            => $taxonomy_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'         => 'chuyen-khoa',
			'with_front'   => false,
			'hierarchical' => true,
		),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'service_category', array( 'service' ), $taxonomy_args );

	// =========================================================
	// 3. Custom Post Type: Doctor (Đội ngũ Bác sĩ)
	// =========================================================
	$doctor_labels = array(
		'name'                  => _x( 'Đội ngũ Bác sĩ', 'Post type general name', 'mediora-clinic' ),
		'singular_name'         => _x( 'Bác sĩ', 'Post type singular name', 'mediora-clinic' ),
		'menu_name'             => _x( 'Đội ngũ Bác sĩ', 'Admin Menu text', 'mediora-clinic' ),
		'name_admin_bar'        => _x( 'Bác sĩ', 'Add New on Toolbar', 'mediora-clinic' ),
		'add_new'               => __( 'Thêm bác sĩ mới', 'mediora-clinic' ),
		'add_new_item'          => __( 'Thêm hồ sơ bác sĩ mới', 'mediora-clinic' ),
		'new_item'              => __( 'Bác sĩ mới', 'mediora-clinic' ),
		'edit_item'             => __( 'Chỉnh sửa thông tin bác sĩ', 'mediora-clinic' ),
		'view_item'             => __( 'Xem hồ sơ bác sĩ', 'mediora-clinic' ),
		'all_items'             => __( 'Tất cả bác sĩ', 'mediora-clinic' ),
		'search_items'          => __( 'Tìm kiếm bác sĩ', 'mediora-clinic' ),
		'parent_item_colon'     => __( 'Bác sĩ cấp trên:', 'mediora-clinic' ),
		'not_found'             => __( 'Không tìm thấy hồ sơ bác sĩ nào.', 'mediora-clinic' ),
		'not_found_in_trash'    => __( 'Không có hồ sơ bác sĩ nào trong Thùng rác.', 'mediora-clinic' ),
		'featured_image'        => _x( 'Ảnh chân dung bác sĩ', 'Overrides the “Featured Image” phrase', 'mediora-clinic' ),
		'set_featured_image'    => _x( 'Đặt ảnh chân dung', 'Overrides the “Set featured image” phrase', 'mediora-clinic' ),
		'remove_featured_image' => _x( 'Xóa ảnh chân dung', 'Overrides the “Remove featured image” phrase', 'mediora-clinic' ),
		'use_featured_image'    => _x( 'Dùng làm ảnh chân dung', 'Overrides the “Use as featured image” phrase', 'mediora-clinic' ),
	);

	$doctor_args = array(
		'labels'             => $doctor_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'       => 'bac-si',
			'with_front' => false,
		),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-businessman',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'doctor', $doctor_args );
}
add_action( 'init', 'mediora_register_post_types' );

// =========================================================
// 4. Doctor Meta Box: Credentials & Clinical Information
// =========================================================

/**
 * Register meta box for Doctor post type.
 */
function mediora_doctor_meta_boxes() {
	add_meta_box(
		'mediora_doctor_details',
		__( 'Thông tin Chuyên môn & Chứng chỉ Bác sĩ (MEDIORA Clinical Info)', 'mediora-clinic' ),
		'mediora_render_doctor_meta_box',
		'doctor',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mediora_doctor_meta_boxes' );

/**
 * Render Doctor Meta Box markup.
 *
 * @param WP_Post $post Current post object.
 */
function mediora_render_doctor_meta_box( $post ) {
	wp_nonce_field( 'mediora_save_doctor_meta', 'mediora_doctor_meta_nonce' );

	$title      = get_post_meta( $post->ID, '_doctor_title', true );
	$specialty  = get_post_meta( $post->ID, '_doctor_specialty', true );
	$experience = get_post_meta( $post->ID, '_doctor_experience', true );
	$license    = get_post_meta( $post->ID, '_doctor_license', true );
	?>
	<style>
		.mediora-meta-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
		.mediora-meta-table th { width: 220px; text-align: left; padding: 12px 10px; vertical-align: top; font-weight: 600; color: #1d2327; }
		.mediora-meta-table td { padding: 10px; }
		.mediora-meta-table input[type="text"] { width: 100%; max-width: 580px; padding: 7px 10px; font-size: 14px; }
		.mediora-meta-desc { font-size: 12px; color: #646970; margin-top: 4px; display: block; }
	</style>

	<table class="mediora-meta-table">
		<tr>
			<th><label for="doctor_title"><?php esc_html_e( 'Chức danh / Học vị:', 'mediora-clinic' ); ?></label></th>
			<td>
				<input type="text" id="doctor_title" name="doctor_title" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php esc_attr_e( 'VD: Thạc sĩ - Bác sĩ Chuyên khoa II', 'mediora-clinic' ); ?>">
				<span class="mediora-meta-desc"><?php esc_html_e( 'Học vị chuyên môn cao nhất được Bộ Y Tế công nhận.', 'mediora-clinic' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="doctor_specialty"><?php esc_html_e( 'Chuyên khoa chính:', 'mediora-clinic' ); ?></label></th>
			<td>
				<input type="text" id="doctor_specialty" name="doctor_specialty" value="<?php echo esc_attr( $specialty ); ?>" placeholder="<?php esc_attr_e( 'VD: Phẫu thuật Tạo hình & Trẻ hóa vi phẫu GMISS', 'mediora-clinic' ); ?>">
				<span class="mediora-meta-desc"><?php esc_html_e( 'Lĩnh vực lâm sàng phụ trách chính tại phòng khám.', 'mediora-clinic' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="doctor_experience"><?php esc_html_e( 'Số năm kinh nghiệm:', 'mediora-clinic' ); ?></label></th>
			<td>
				<input type="text" id="doctor_experience" name="doctor_experience" value="<?php echo esc_attr( $experience ); ?>" placeholder="<?php esc_attr_e( 'VD: 15+ năm kinh nghiệm', 'mediora-clinic' ); ?>">
				<span class="mediora-meta-desc"><?php esc_html_e( 'Thời gian công tác thực tế trong ngành y khoa thẩm mỹ.', 'mediora-clinic' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="doctor_license"><?php esc_html_e( 'Số chứng chỉ hành nghề (CCHN):', 'mediora-clinic' ); ?></label></th>
			<td>
				<input type="text" id="doctor_license" name="doctor_license" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php esc_attr_e( 'VD: 044323/BYT- CCHN', 'mediora-clinic' ); ?>">
				<span class="mediora-meta-desc"><?php esc_html_e( 'Số chứng chỉ hành nghề y tế theo quy định công khai y tế.', 'mediora-clinic' ); ?></span>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Doctor Meta Box fields securely.
 *
 * @param int $post_id Current post ID.
 */
function mediora_save_doctor_meta_box( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['mediora_doctor_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mediora_doctor_meta_nonce'] ) ), 'mediora_save_doctor_meta' ) ) {
		return;
	}

	// Prevent autosave overwrites
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check post type and user permissions
	if ( ! isset( $_POST['post_type'] ) || 'doctor' !== $_POST['post_type'] ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Update meta fields
	$fields = array(
		'doctor_title'      => '_doctor_title',
		'doctor_specialty'  => '_doctor_specialty',
		'doctor_experience' => '_doctor_experience',
		'doctor_license'    => '_doctor_license',
	);

	foreach ( $fields as $param => $meta_key ) {
		if ( isset( $_POST[ $param ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $param ] ) );
			if ( '' !== $value ) {
				update_post_meta( $post_id, $meta_key, $value );
			} else {
				delete_post_meta( $post_id, $meta_key );
			}
		}
	}
}
add_action( 'save_post_doctor', 'mediora_save_doctor_meta_box' );

// =========================================================
// 5. Admin Columns for Doctor & Service Post Types
// =========================================================

/**
 * Register custom columns for Doctor post list in WP Admin.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function mediora_doctor_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']                = $columns['cb'];
	$new_columns['doctor_thumb']      = __( 'Ảnh', 'mediora-clinic' );
	$new_columns['title']             = __( 'Họ và tên Bác sĩ', 'mediora-clinic' );
	$new_columns['doctor_title']      = __( 'Học vị / Chức danh', 'mediora-clinic' );
	$new_columns['doctor_specialty']  = __( 'Chuyên khoa', 'mediora-clinic' );
	$new_columns['doctor_experience'] = __( 'Kinh nghiệm', 'mediora-clinic' );
	$new_columns['doctor_license']    = __( 'Số CCHN', 'mediora-clinic' );
	$new_columns['date']              = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_doctor_posts_columns', 'mediora_doctor_admin_columns' );

/**
 * Render custom column content for Doctor post list.
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function mediora_doctor_admin_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'doctor_thumb':
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'width:44px; height:44px; object-fit:cover; border-radius:50%; border:1px solid #d4af37;' ) );
			} else {
				echo '<span style="display:inline-block; width:44px; height:44px; border-radius:50%; background:#f0f0f1; text-align:center; line-height:44px; font-size:20px; color:#8c8f94;">👤</span>';
			}
			break;

		case 'doctor_title':
			$title = get_post_meta( $post_id, '_doctor_title', true );
			echo ! empty( $title ) ? '<strong>' . esc_html( $title ) . '</strong>' : '<span style="color:#a7aaad;">&mdash;</span>';
			break;

		case 'doctor_specialty':
			$specialty = get_post_meta( $post_id, '_doctor_specialty', true );
			echo ! empty( $specialty ) ? '<span style="color:#135e96;">' . esc_html( $specialty ) . '</span>' : '<span style="color:#a7aaad;">&mdash;</span>';
			break;

		case 'doctor_experience':
			$experience = get_post_meta( $post_id, '_doctor_experience', true );
			echo ! empty( $experience ) ? '<span style="background:#f0f6fc; color:#0969da; padding:2px 8px; border-radius:12px; font-size:12px; font-weight:500;">' . esc_html( $experience ) . '</span>' : '<span style="color:#a7aaad;">&mdash;</span>';
			break;

		case 'doctor_license':
			$license = get_post_meta( $post_id, '_doctor_license', true );
			echo ! empty( $license ) ? '<code style="font-size:12px; background:#f6f7f7; padding:2px 6px; border:1px solid #c3c4c7; border-radius:3px;">' . esc_html( $license ) . '</code>' : '<span style="color:#a7aaad;">&mdash;</span>';
			break;
	}
}
add_action( 'manage_doctor_posts_custom_column', 'mediora_doctor_admin_columns_content', 10, 2 );

/**
 * Register custom columns for Service post list in WP Admin.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function mediora_service_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']            = $columns['cb'];
	$new_columns['service_thumb'] = __( 'Ảnh', 'mediora-clinic' );
	$new_columns['title']         = $columns['title'];
	if ( isset( $columns['taxonomy-service_category'] ) ) {
		$new_columns['taxonomy-service_category'] = $columns['taxonomy-service_category'];
	}
	$new_columns['date']          = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_service_posts_columns', 'mediora_service_admin_columns' );

/**
 * Render custom column content for Service post list.
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function mediora_service_admin_columns_content( $column, $post_id ) {
	if ( 'service_thumb' === $column ) {
		if ( has_post_thumbnail( $post_id ) ) {
			echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'width:50px; height:35px; object-fit:cover; border-radius:4px; border:1px solid #d4af37;' ) );
		} else {
			echo '<span style="color:#a7aaad;">&mdash;</span>';
		}
	}
}
add_action( 'manage_service_posts_custom_column', 'mediora_service_admin_columns_content', 10, 2 );
