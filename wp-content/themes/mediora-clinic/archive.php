<?php
/**
 * The template for displaying archive pages
 *
 * Used for categories, tags, author, date archives, and taxonomy archives.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri = get_template_directory_uri();
?>

<div class="subpage-content archive-main">

	<!-- 1. Archive Hero Subpage Banner -->
	<section class="subpage-banner" aria-label="<?php esc_attr_e( 'Tiêu đề lưu trữ', 'mediora-clinic' ); ?>">
		<div class="wrap text-center">
			<?php mediora_breadcrumbs(); ?>
			<span class="mediora-badge-gold mb-3"><?php esc_html_e( 'Chuyên Mục & Tin Tức', 'mediora-clinic' ); ?></span>
			<?php the_archive_title( '<h1 class="subpage-banner__title gold-text">', '</h1>' ); ?>
			<?php
			$description = get_the_archive_description();
			if ( ! empty( $description ) ) :
				?>
				<div class="subpage-banner__desc">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			<?php else : ?>
				<p class="subpage-banner__desc">
					<?php esc_html_e( 'Cập nhật kiến thức thẩm mỹ chuẩn y khoa, tin tức công nghệ trẻ hóa và câu chuyện khách hàng thực tế từ MEDIORA.', 'mediora-clinic' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</section>

	<!-- 2. Archive Posts Grid Section -->
	<section class="archive-posts-section pb-5">
		<div class="wrap">
			<?php if ( have_posts() ) : ?>
				<div class="row g-4">
					<?php
					while ( have_posts() ) :
						the_post();
						$categories = get_the_category();
						?>
						<div class="col-12 col-md-6 col-lg-4">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'mediora-card h-100 d-flex flex-column p-0 overflow-hidden' ); ?>>
								<!-- Post Thumbnail -->
								<div class="post-card__thumb position-relative" style="aspect-ratio:16/10; overflow:hidden;">
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-100 h-100 object-fit-cover' ) ); ?>
										<?php else : ?>
											<img src="<?php echo esc_url( $theme_uri . '/assets/imgs/cover.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
										<?php endif; ?>
									</a>
									<?php if ( ! empty( $categories ) ) : ?>
										<span class="position-absolute top-0 start-0 m-3 mediora-badge-gold" style="backdrop-filter:blur(6px); background:rgba(18,24,32,0.85);">
											<?php echo esc_html( $categories[0]->name ); ?>
										</span>
									<?php endif; ?>
								</div>

								<!-- Post Content Body -->
								<div class="post-card__body p-4 d-flex flex-column flex-grow-1">
									<div class="post-card__meta mb-2 text-muted" style="font-size:13px;">
										<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
											📅 <?php echo esc_html( get_the_date() ); ?>
										</time>
									</div>

									<h2 class="h5 mb-2">
										<a href="<?php the_permalink(); ?>" class="text-white text-decoration-none" style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.4;">
											<?php the_title(); ?>
										</a>
									</h2>

									<div class="post-card__excerpt text-muted mb-4" style="font-size:14px; line-height:1.6; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
										<?php the_excerpt(); ?>
									</div>

									<div class="post-card__footer mt-auto pt-3 border-top" style="border-color:rgba(255,255,255,0.08) !important;">
										<a href="<?php the_permalink(); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.04em;">
											<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
										</a>
									</div>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>

				<!-- Luxury Pagination -->
				<nav class="pagination-wrapper mt-5 pt-3 d-flex justify-content-center" aria-label="<?php esc_attr_e( 'Phân trang lưu trữ', 'mediora-clinic' ); ?>">
					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => esc_html__( '&larr; Trước', 'mediora-clinic' ),
							'next_text'          => esc_html__( 'Sau &rarr;', 'mediora-clinic' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Trang', 'mediora-clinic' ) . ' </span>',
						)
					);
					?>
				</nav>

			<?php else : ?>
				<!-- Empty Results State -->
				<div class="no-results text-center py-5" style="max-width:540px; margin:0 auto;">
					<div class="fs-1 mb-3">📰</div>
					<h2 class="gold-text mb-3"><?php esc_html_e( 'Chưa Có Bài Viết', 'mediora-clinic' ); ?></h2>
					<p class="text-muted mb-4"><?php esc_html_e( 'Rất tiếc, hiện tại chưa có bài viết nào được xuất bản trong chuyên mục này.', 'mediora-clinic' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-consult btn-gold-pill">
						<?php esc_html_e( 'Quay Về Trang Chủ', 'mediora-clinic' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</section>

</div>

<?php
get_footer();
