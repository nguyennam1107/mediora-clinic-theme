<?php
/**
 * Custom template tags, helper functions, and Schema.org markup for Mediora Clinic
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'mediora_get_option' ) ) {
	/**
	 * Retrieve a theme option / Customizer setting with smart fallback.
	 *
	 * Checks get_theme_mod first, then checks option aliases, then get_option,
	 * and finally returns the provided default value.
	 *
	 * @param string $key     Setting key.
	 * @param mixed  $default Default value if setting is empty.
	 * @return mixed
	 */
	function mediora_get_option( $key, $default = '' ) {
		// Aliases mapping for backward compatibility and unified settings
		$aliases = array(
			'address'          => 'clinic_address',
			'clinic_address'   => 'address',
			'intro_text'       => 'intro_philosophy',
			'intro_philosophy' => 'intro_text',
		);

		// 1. Try primary key from get_theme_mod
		$value = get_theme_mod( $key, null );

		// 2. If not found or empty string, check alias key if available
		if ( ( null === $value || '' === $value || false === $value ) && isset( $aliases[ $key ] ) ) {
			$value = get_theme_mod( $aliases[ $key ], null );
		}

		// 3. Fallback to get_option in case it was stored as standard option
		if ( null === $value || '' === $value || false === $value ) {
			$value = get_option( $key, null );
			if ( ( null === $value || '' === $value || false === $value ) && isset( $aliases[ $key ] ) ) {
				$value = get_option( $aliases[ $key ], null );
			}
		}

		// 4. Return default if still not found
		if ( null === $value || '' === $value || false === $value ) {
			return $default;
		}

		return $value;
	}
}

if ( ! function_exists( 'mediora_clean_phone' ) ) {
	/**
	 * Helper function to sanitize and clean phone numbers for clickable tel: links.
	 *
	 * Strips all spaces, dots, hyphens, and parenthesis, preserving only digits and leading plus.
	 *
	 * @param string $phone Phone number string.
	 * @return string
	 */
	function mediora_clean_phone( $phone ) {
		if ( empty( $phone ) ) {
			return '';
		}
		return preg_replace( '/[^0-9+]/', '', (string) $phone );
	}
}

if ( ! function_exists( 'mediora_get_doctor_meta' ) ) {
	/**
	 * Get structured doctor metadata by post ID.
	 *
	 * @param int|WP_Post|null $post_id Post ID or WP_Post object.
	 * @return array
	 */
	function mediora_get_doctor_meta( $post_id = null ) {
		$post_id = $post_id ? ( is_object( $post_id ) ? $post_id->ID : (int) $post_id ) : get_the_ID();
		if ( ! $post_id ) {
			return array(
				'title'      => '',
				'specialty'  => '',
				'experience' => '',
				'license'    => '',
			);
		}

		return array(
			'title'      => get_post_meta( $post_id, '_doctor_title', true ),
			'specialty'  => get_post_meta( $post_id, '_doctor_specialty', true ),
			'experience' => get_post_meta( $post_id, '_doctor_experience', true ),
			'license'    => get_post_meta( $post_id, '_doctor_license', true ),
		);
	}
}

if ( ! function_exists( 'mediora_render_schema' ) ) {
	/**
	 * Output MedicalClinic / MedicalBusiness Schema.org JSON-LD structured data.
	 *
	 * Follows Google Search Central and Schema.org medical guidelines for aesthetic clinics.
	 *
	 * @return void
	 */
	function mediora_render_schema() {
		$clinic_name    = mediora_get_option( 'clinic_name', 'Phòng khám Chuyên khoa Thẩm mỹ MEDIORA' );
		$hotline        = mediora_get_option( 'hotline', '0945.334.832' );
		$clean_phone    = mediora_clean_phone( $hotline );
		$raw_address    = mediora_get_option( 'clinic_address', '257 - 259 Nguyễn Đình Chiểu, Phường Bàn Cờ, TP. HCM' );
		$clean_address  = trim( preg_replace( '/\s+/', ' ', str_replace( array( "\r", "\n" ), ' ', $raw_address ) ) );
		$home_url       = home_url( '/' );

		// Logo URL
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$logo_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			$logo_url = ! empty( $logo_src[0] ) ? $logo_src[0] : get_template_directory_uri() . '/assets/imgs/Logo.svg';
		} else {
			$logo_url = get_template_directory_uri() . '/assets/imgs/Logo.svg';
		}

		// Social URLs
		$same_as = array_filter(
			array(
				mediora_get_option( 'social_facebook', 'https://www.facebook.com/pkcktmmediora' ),
				mediora_get_option( 'social_tiktok', 'https://www.tiktok.com/@phongkhammediora' ),
				mediora_get_option( 'social_youtube', '' ),
				mediora_get_option( 'social_zalo', 'https://zalo.me/636737550228660397' ),
				mediora_get_option( 'social_messenger', 'https://m.me/pkcktmmediora' ),
			)
		);

		// Base MedicalClinic Schema
		$schema = array(
			'@context'                  => 'https://schema.org',
			'@type'                     => array( 'MedicalClinic', 'MedicalBusiness' ),
			'@id'                       => esc_url( $home_url . '#medicalclinic' ),
			'name'                      => $clinic_name,
			'legalName'                 => 'Công ty TNHH Y khoa Mediora',
			'url'                       => esc_url( $home_url ),
			'logo'                      => esc_url( $logo_url ),
			'image'                     => esc_url( get_template_directory_uri() . '/assets/imgs/cover.jpg' ),
			'telephone'                 => $clean_phone ? ( 0 === strpos( $clean_phone, '+' ) ? $clean_phone : '+84' . ltrim( $clean_phone, '0' ) ) : '+84945334832',
			'priceRange'                => '$$$$',
			'currenciesAccepted'        => 'VND',
			'paymentAccepted'           => 'Cash, Credit Card, Bank Transfer',
			'medicalSpecialty'          => array(
				'PlasticSurgery',
				'Dermatology',
			),
			'availableService'          => array(
				array(
					'@type'       => 'MedicalProcedure',
					'name'        => 'Nâng cơ trẻ hóa bằng sợi sinh học GMISS',
					'procedureType' => 'NonSurgicalProcedure',
				),
				array(
					'@type'       => 'MedicalProcedure',
					'name'        => 'Phẫu thuật thẩm mỹ tạo hình chuyên sâu',
					'procedureType' => 'SurgicalProcedure',
				),
				array(
					'@type'       => 'MedicalProcedure',
					'name'        => 'Trẻ hóa da tầng sâu công nghệ cao',
					'procedureType' => 'NonSurgicalProcedure',
				),
			),
			'address'                   => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $clean_address,
				'addressLocality' => 'Quận 3',
				'addressRegion'   => 'Hồ Chí Minh',
				'postalCode'      => '700000',
				'addressCountry'  => 'VN',
			),
			'geo'                       => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => 10.771971,
				'longitude' => 106.685364,
			),
			'openingHoursSpecification' => array(
				array(
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => array(
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday',
					),
					'opens'     => '08:00',
					'closes'    => '20:00',
				),
			),
		);

		if ( ! empty( $same_as ) ) {
			$schema['sameAs'] = array_values( array_map( 'esc_url_raw', $same_as ) );
		}

		// Contextual Schema enhancements for Doctor / Service singles
		if ( is_singular( 'doctor' ) ) {
			$doc_meta = mediora_get_doctor_meta( get_the_ID() );
			$doctor_schema = array(
				'@context'        => 'https://schema.org',
				'@type'           => 'Physician',
				'@id'             => esc_url( get_permalink() . '#physician' ),
				'name'            => get_the_title(),
				'url'             => esc_url( get_permalink() ),
				'jobTitle'        => ! empty( $doc_meta['title'] ) ? $doc_meta['title'] : 'Bác sĩ chuyên khoa Thẩm mỹ',
				'medicalSpecialty'=> ! empty( $doc_meta['specialty'] ) ? $doc_meta['specialty'] : 'Phẫu thuật Tạo hình Thẩm mỹ',
				'worksFor'        => array(
					'@type' => 'MedicalClinic',
					'name'  => $clinic_name,
					'url'   => esc_url( $home_url ),
				),
			);

			if ( has_post_thumbnail() ) {
				$doctor_schema['image'] = esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );
			}

			// Render both clinic and physician schemas
			$full_schema = array( $schema, $doctor_schema );
		} elseif ( is_singular( 'service' ) ) {
			$service_schema = array(
				'@context'        => 'https://schema.org',
				'@type'           => 'MedicalProcedure',
				'@id'             => esc_url( get_permalink() . '#procedure' ),
				'name'            => get_the_title(),
				'url'             => esc_url( get_permalink() ),
				'description'     => wp_strip_all_tags( get_the_excerpt() ),
				'howPerformed'    => 'Thực hiện trực tiếp bởi Bác sĩ Chuyên khoa tại phòng vô trùng tiêu chuẩn Bộ Y Tế',
				'provider'        => array(
					'@type' => 'MedicalClinic',
					'name'  => $clinic_name,
					'url'   => esc_url( $home_url ),
				),
			);

			if ( has_post_thumbnail() ) {
				$service_schema['image'] = esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );
			}

			$full_schema = array( $schema, $service_schema );
		} else {
			$full_schema = $schema;
		}

		echo "\n" . '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $full_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
		echo "\n" . '</script>' . "\n";
	}
}

if ( ! function_exists( 'mediora_breadcrumbs' ) ) {
	/**
	 * Output luxury breadcrumbs with Schema.org BreadcrumbList markup.
	 *
	 * Supports SEO plugins (Rank Math, Yoast) fallback or native Mediora luxury markup.
	 *
	 * @return void
	 */
	function mediora_breadcrumbs() {
		if ( is_front_page() ) {
			return;
		}

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			echo '<nav class="mediora-breadcrumbs" aria-label="' . esc_attr__( 'Điều hướng', 'mediora-clinic' ) . '">';
			yoast_breadcrumb( '<div class="yoast-breadcrumbs-inner">', '</div>' );
			echo '</nav>';
			return;
		}

		if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			echo '<nav class="mediora-breadcrumbs" aria-label="' . esc_attr__( 'Điều hướng', 'mediora-clinic' ) . '">';
			rank_math_the_breadcrumbs();
			echo '</nav>';
			return;
		}

		$home_url   = home_url( '/' );
		$home_title = esc_html__( 'Trang chủ', 'mediora-clinic' );
		$sep        = '<span class="breadcrumb-sep" aria-hidden="true">&bull;</span>';
		$position   = 1;

		echo '<nav class="mediora-breadcrumbs" aria-label="' . esc_attr__( 'Điều hướng', 'mediora-clinic' ) . '">';
		echo '<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';

		// Home item
		echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo '<a itemprop="item" href="' . esc_url( $home_url ) . '"><span itemprop="name">' . $home_title . '</span></a>';
		echo '<meta itemprop="position" content="' . $position++ . '">';
		echo '</li>';

		if ( is_singular( 'service' ) ) {
			echo $sep;
			$services_page = get_page_by_path( 'dich-vu' );
			$services_url  = $services_page ? get_permalink( $services_page->ID ) : get_post_type_archive_link( 'service' );
			if ( ! $services_url ) {
				$services_url = home_url( '/dich-vu/' );
			}
			echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( $services_url ) . '"><span itemprop="name">' . esc_html__( 'Dịch vụ', 'mediora-clinic' ) . '</span></a>';
			echo '<meta itemprop="position" content="' . $position++ . '">';
			echo '</li>';

			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_singular( 'doctor' ) ) {
			echo $sep;
			$about_page = get_page_by_path( 've-chung-toi' );
			$about_url  = $about_page ? get_permalink( $about_page->ID ) : home_url( '/#bac-si' );
			echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( $about_url ) . '"><span itemprop="name">' . esc_html__( 'Bác sĩ', 'mediora-clinic' ) . '</span></a>';
			echo '<meta itemprop="position" content="' . $position++ . '">';
			echo '</li>';

			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_single() ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo $sep;
				echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				echo '<a itemprop="item" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span itemprop="name">' . esc_html( $categories[0]->name ) . '</span></a>';
				echo '<meta itemprop="position" content="' . $position++ . '">';
				echo '</li>';
			}
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( wp_trim_words( get_the_title(), 8, '...' ) ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_page() ) {
			global $post;
			if ( $post && $post->post_parent ) {
				$anc = array_reverse( get_post_ancestors( $post->ID ) );
				foreach ( $anc as $ancestor ) {
					echo $sep;
					echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
					echo '<a itemprop="item" href="' . esc_url( get_permalink( $ancestor ) ) . '"><span itemprop="name">' . esc_html( get_the_title( $ancestor ) ) . '</span></a>';
					echo '<meta itemprop="position" content="' . $position++ . '">';
					echo '</li>';
				}
			}
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_category() ) {
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( single_cat_title( '', false ) ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_tax( 'service_category' ) ) {
			echo $sep;
			$services_page = get_page_by_path( 'dich-vu' );
			$services_url  = $services_page ? get_permalink( $services_page->ID ) : home_url( '/dich-vu/' );
			echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( $services_url ) . '"><span itemprop="name">' . esc_html__( 'Dịch vụ', 'mediora-clinic' ) . '</span></a>';
			echo '<meta itemprop="position" content="' . $position++ . '">';
			echo '</li>';

			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( single_term_title( '', false ) ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_post_type_archive( 'service' ) ) {
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html__( 'Dịch vụ thẩm mỹ', 'mediora-clinic' ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_archive() ) {
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . esc_html( get_the_archive_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		} elseif ( is_search() ) {
			echo $sep;
			echo '<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<span itemprop="name">' . sprintf( esc_html__( 'Tìm kiếm: "%s"', 'mediora-clinic' ), get_search_query() ) . '</span>';
			echo '<meta itemprop="position" content="' . $position . '">';
			echo '</li>';
		}

		echo '</ol>';
		echo '</nav>';
	}
}
