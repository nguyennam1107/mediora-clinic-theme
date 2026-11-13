<?php
/**
 * The template for displaying all single pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="subpage-content subpage-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<!-- Subpage Banner -->
		<section class="subpage-banner" aria-label="<?php the_title_attribute(); ?>">
			<div class="wrap text-center">
				<?php mediora_breadcrumbs(); ?>
				<h1 class="subpage-banner__title gold-text"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="subpage-banner__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</section>

		<!-- Page Content Container -->
		<section class="page-content-section pb-5">
			<div class="wrap">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-9">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'mediora-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="page-featured-media mb-4" style="border-radius:12px; overflow:hidden;">
									<?php the_post_thumbnail( 'full', array( 'class' => 'w-100 h-auto object-fit-cover' ) ); ?>
								</div>
							<?php endif; ?>

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
						</article>
					</div>
				</div>
			</div>
		</section>

		<?php
	endwhile;
	?>
</div>

<?php
get_footer();
