<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="site-archive-page py-5">
	<div class="wrap">
		<!-- Page Header Banner -->
		<header class="archive-header text-center mb-5 pb-3">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<h1 class="page-title gold-text mb-3"><?php single_post_title(); ?></h1>
				<p class="text-muted"><?php esc_html_e( 'Cập nhật tin tức, kiến thức chuyên môn và câu chuyện làm đẹp mới nhất từ MEDIORA.', 'mediora-clinic' ); ?></p>
			<?php elseif ( is_archive() ) : ?>
				<?php the_archive_title( '<h1 class="page-title gold-text mb-3">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description text-muted">', '</div>' ); ?>
			<?php elseif ( is_search() ) : ?>
				<h1 class="page-title gold-text mb-3">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Kết quả tìm kiếm cho: %s', 'mediora-clinic' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			<?php else : ?>
				<h1 class="page-title gold-text mb-3"><?php esc_html_e( 'Kiến Thức & Tin Tức Thẩm Mỹ', 'mediora-clinic' ); ?></h1>
				<p class="text-muted"><?php esc_html_e( 'Thông tin chuyên sâu từ đội ngũ bác sĩ chuyên khoa thẩm mỹ MEDIORA.', 'mediora-clinic' ); ?></p>
			<?php endif; ?>
		</header>

		<!-- Posts Grid -->
		<?php if ( have_posts() ) : ?>
			<div class="row g-4">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 col-md-6 col-lg-4' ); ?>>
						<div class="post-card h-100 d-flex flex-column" style="background:#131a23; border:1px solid rgba(212,175,55,0.25); border-radius:16px; overflow:hidden; transition:transform 0.3s ease, border-color 0.3s ease;">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-card__thumb" style="aspect-ratio:16/9; overflow:hidden;">
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-100 h-100 object-fit-cover' ) ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="post-card__thumb" style="aspect-ratio:16/9; overflow:hidden;">
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/imgs/cover.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
									</a>
								</div>
							<?php endif; ?>

							<div class="post-card__body p-4 d-flex flex-column flex-grow-1">
								<div class="post-card__meta mb-2 text-muted" style="font-size:13px;">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo esc_html( get_the_date() ); ?>
									</time>
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) :
										?>
										<span class="mx-2">&bull;</span>
										<span class="text-gold"><?php echo esc_html( $categories[0]->name ); ?></span>
									<?php endif; ?>
								</div>

								<h2 class="post-card__title h5 mb-3">
									<a href="<?php the_permalink(); ?>" class="text-white text-decoration-none" style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.4;">
										<?php the_title(); ?>
									</a>
								</h2>

								<div class="post-card__excerpt text-muted mb-4" style="font-size:14px; line-height:1.6; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
									<?php the_excerpt(); ?>
								</div>

								<div class="post-card__footer mt-auto pt-3" style="border-top:1px solid rgba(255,255,255,0.08);">
									<a href="<?php the_permalink(); ?>" class="btn-read-more" style="color:var(--gold-primary); font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.04em;">
										<?php esc_html_e( 'Xem chi tiết &rarr;', 'mediora-clinic' ); ?>
									</a>
								</div>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<nav class="pagination-wrapper mt-5 pt-3 d-flex justify-content-center" aria-label="<?php esc_attr_e( 'Phân trang bài viết', 'mediora-clinic' ); ?>">
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
			<div class="no-results text-center py-5" style="max-width:540px; margin:0 auto;">
				<h2 class="gold-text mb-3"><?php esc_html_e( 'Chưa có nội dung', 'mediora-clinic' ); ?></h2>
				<p class="text-muted mb-4"><?php esc_html_e( 'Rất tiếc, hiện tại chưa có bài viết nào được tìm thấy trong mục này.', 'mediora-clinic' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-consult btn-gold-pill">
					<?php esc_html_e( 'Quay lại Trang Chủ', 'mediora-clinic' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
