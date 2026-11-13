<?php
/**
 * The template for displaying all single blog posts
 *
 * Designed for Medical & Aesthetic Knowledge articles with E-E-A-T compliance:
 * - Clear Medical Reviewer & Author Credentials Box
 * - Breadcrumb Navigation
 * - Featured Image
 * - Full Article Typography
 * - Related Posts Grid
 * - Bottom Consultation CTA Banner
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

	$categories = get_the_category();
	$category_name = ! empty( $categories ) ? $categories[0]->name : esc_html__( 'Kiến Thức Thẩm Mỹ', 'mediora-clinic' );
	?>

	<div class="subpage-content post-single-main">

		<!-- 1. Post Header & Banner -->
		<section class="subpage-banner" aria-label="<?php the_title_attribute(); ?>">
			<div class="wrap text-center">
				<?php mediora_breadcrumbs(); ?>
				<?php if ( ! empty( $categories ) ) : ?>
					<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="mediora-badge-gold mb-3 text-decoration-none">
						<?php echo esc_html( $category_name ); ?>
					</a>
				<?php endif; ?>
				<h1 class="subpage-banner__title gold-text"><?php the_title(); ?></h1>

				<!-- Post Meta Info -->
				<div class="post-meta-header d-flex flex-wrap justify-content-center align-items-center gap-3 text-muted" style="font-size:14px;">
					<span class="d-inline-flex align-items-center gap-1">
						<span>📅</span>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
					</span>
					<span class="text-gold">&bull;</span>
					<span class="d-inline-flex align-items-center gap-1">
						<span>👨‍⚕️</span>
						<span><?php esc_html_e( 'Cố vấn chuyên môn: BS. CK Thẩm mỹ MEDIORA', 'mediora-clinic' ); ?></span>
					</span>
					<span class="text-gold">&bull;</span>
					<span class="d-inline-flex align-items-center gap-1">
						<span>⏱️</span>
						<span><?php printf( esc_html__( '%d phút đọc', 'mediora-clinic' ), max( 1, round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) ) ); ?></span>
					</span>
				</div>
			</div>
		</section>

		<!-- 2. Post Body Article -->
		<section class="post-body-section pb-5">
			<div class="wrap">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8">

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'mediora-card p-4 p-md-5 mb-5' ); ?>>

							<!-- Featured Image -->
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-featured-hero mb-4" style="border-radius:12px; overflow:hidden; border:1px solid rgba(212,175,55,0.25);">
									<?php the_post_thumbnail( 'full', array( 'class' => 'w-100 h-auto object-fit-cover' ) ); ?>
								</div>
							<?php endif; ?>

							<!-- Content Body -->
							<div class="entry-content mediora-prose">
								<?php
								the_content();

								wp_link_pages(
									array(
										'before' => '<div class="page-links mt-4 pt-3 border-top">' . esc_html__( 'Trang:', 'mediora-clinic' ),
										'after'  => '</div>',
									)
								);
								?>
							</div>

							<!-- Tags List -->
							<?php
							$tags = get_the_tags();
							if ( ! empty( $tags ) ) :
								?>
								<div class="post-tags-list mt-4 pt-3 border-top d-flex flex-wrap align-items-center gap-2" style="border-color:rgba(255,255,255,0.08) !important;">
									<span class="text-muted small"><?php esc_html_e( 'Từ khóa:', 'mediora-clinic' ); ?></span>
									<?php foreach ( $tags as $tag ) : ?>
										<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="badge bg-secondary text-light text-decoration-none">
											#<?php echo esc_html( $tag->name ); ?>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<!-- Medical Reviewer / Author E-E-A-T Box -->
							<div class="medical-author-box">
								<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/doctor1.png' ); ?>"
									alt="<?php esc_attr_e( 'Hội đồng chuyên môn MEDIORA', 'mediora-clinic' ); ?>"
									class="medical-author-avatar">
								<div>
									<div class="d-flex align-items-center gap-2 mb-1">
										<strong class="text-white fs-6"><?php esc_html_e( 'Kiểm duyệt y khoa: Ban Cố Vấn Chuyên Môn MEDIORA', 'mediora-clinic' ); ?></strong>
										<span class="badge bg-success" style="font-size:11px;">✓ <?php esc_html_e( 'Đã duyệt', 'mediora-clinic' ); ?></span>
									</div>
									<p class="text-muted small mb-0" style="line-height:1.6;">
										<?php esc_html_e( 'Nội dung được thẩm định và xác thực chuyên môn bởi Bác sĩ Chuyên khoa Phẫu thuật Tạo hình MEDIORA nhằm mang lại thông tin chính xác, khách quan và an toàn nhất cho người đọc.', 'mediora-clinic' ); ?>
									</p>
								</div>
							</div>

						</article>

						<!-- Related Posts Section -->
						<?php
						$current_id    = get_the_ID();
						$cat_ids       = ! empty( $categories ) ? wp_list_pluck( $categories, 'term_id' ) : array();
						$related_args  = array(
							'post_type'      => 'post',
							'posts_per_page' => 3,
							'post__not_in'   => array( $current_id ),
							'category__in'   => $cat_ids,
							'orderby'        => 'date',
							'order'          => 'DESC',
						);
						$related_query = new WP_Query( $related_args );

						if ( $related_query->have_posts() ) :
							?>
							<div class="related-posts-block mb-5">
								<h2 class="h4 gold-text mb-4 text-center" style="font-family:var(--font-serif);">
									<?php esc_html_e( 'Bài Viết Cùng Chuyên Mục', 'mediora-clinic' ); ?>
								</h2>
								<div class="row g-4">
									<?php
									while ( $related_query->have_posts() ) :
										$related_query->the_post();
										?>
										<div class="col-12 col-md-4">
											<div class="mediora-card h-100 p-0 overflow-hidden d-flex flex-column">
												<div class="thumb" style="aspect-ratio:16/10; overflow:hidden;">
													<a href="<?php the_permalink(); ?>">
														<?php if ( has_post_thumbnail() ) : ?>
															<?php the_post_thumbnail( 'medium', array( 'class' => 'w-100 h-100 object-fit-cover' ) ); ?>
														<?php else : ?>
															<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/cover.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover">
														<?php endif; ?>
													</a>
												</div>
												<div class="p-3 d-flex flex-column flex-grow-1">
													<span class="text-muted small mb-1"><?php echo esc_html( get_the_date() ); ?></span>
													<h3 class="h6 mb-2">
														<a href="<?php the_permalink(); ?>" class="text-white text-decoration-none" style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
															<?php the_title(); ?>
														</a>
													</h3>
													<a href="<?php the_permalink(); ?>" class="mt-auto small text-gold text-decoration-none font-weight-bold">
														<?php esc_html_e( 'Xem tiếp &rarr;', 'mediora-clinic' ); ?>
													</a>
												</div>
											</div>
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
									?>
								</div>
							</div>
						<?php endif; ?>

						<!-- Consultation CTA Banner -->
						<div class="consultation-cta-banner">
							<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Tư Vấn Chuyên Sâu', 'mediora-clinic' ); ?></span>
							<h2 class="gold-text mb-3" style="font-family:var(--font-serif); font-size:clamp(1.5rem, 2.5vw, 2.2rem);">
								<?php esc_html_e( 'Cần Giải Đáp Thắc Mắc Về Liệu Trình Làm Đẹp?', 'mediora-clinic' ); ?>
							</h2>
							<p class="text-muted mb-4" style="max-width:580px; margin:0 auto; font-size:1rem;">
								<?php esc_html_e( 'Bác sĩ chuyên khoa MEDIORA sẵn sàng giải đáp chi tiết tình trạng lão hóa và đưa ra lời khuyên y khoa chuẩn xác nhất.', 'mediora-clinic' ); ?>
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
				</div>
			</div>
		</section>

	</div>

	<?php
endwhile;

get_footer();
