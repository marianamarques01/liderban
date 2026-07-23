<?php
/**
 * Detalhe do post do blog.
 *
 * @package Liderban_Theme
 */

get_header();
?>

<main id="primary" class="site-main site-main--blog-single">
	<?php
	while ( have_posts() ) :
		the_post();

		$post_id   = get_the_ID();
		$hero_bg   = get_the_post_thumbnail_url( $post_id, 'full' );
		$fallback  = file_exists( liderban_asset_path( 'images/blog_bg.png' ) )
			? liderban_asset( 'images/blog_bg.png' )
			: liderban_asset( 'images/clientes_bg.jpg' );
		$hero_bg   = $hero_bg ? $hero_bg : $fallback;
		$excerpt   = get_the_excerpt();
		$date      = liderban_format_post_date( $post_id, 'full' );
		$categories = get_the_category( $post_id );
		$category  = ! empty( $categories ) ? $categories[0]->name : '';
		$permalink = get_permalink( $post_id );
		$title     = get_the_title();
		?>

		<section class="blog-single-hero solutions-hero">
			<div
				class="solutions-hero-bg blog-single-hero__bg"
				style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');"
				role="img"
				aria-label="<?php echo esc_attr( $title ); ?>"
			></div>
			<div class="solutions-hero-overlay"></div>
			<div class="wave-bottom">
				<img src="<?php echo esc_url( liderban_asset( 'images/wave.png' ) ); ?>" alt="<?php esc_attr_e( 'Onda decorativa', 'liderban-theme' ); ?>">
			</div>
		</section>

		<article <?php post_class( 'blog-single' ); ?>>
			<div class="container blog-single__container">
				<header class="blog-single__header">
					<h1 class="blog-single__title"><?php echo esc_html( $title ); ?></h1>

					<?php if ( $excerpt ) : ?>
						<p class="blog-single__subtitle"><?php echo esc_html( $excerpt ); ?></p>
					<?php endif; ?>

					<div class="blog-single__meta">
						<?php if ( $date ) : ?>
							<span class="blog-single__meta-item">
								<?php
								printf(
									/* translators: %s: formatted post date */
									esc_html__( 'Postado em: %s', 'liderban-theme' ),
									esc_html( $date )
								);
								?>
							</span>
						<?php endif; ?>

						<?php if ( $category ) : ?>
							<span class="blog-single__meta-item blog-single__meta-item--category">
								<?php echo esc_html( $category ); ?>
							</span>
						<?php endif; ?>

						<button
							type="button"
							class="blog-single__share"
							aria-label="<?php esc_attr_e( 'Compartilhar', 'liderban-theme' ); ?>"
							data-share-url="<?php echo esc_url( $permalink ); ?>"
							data-share-title="<?php echo esc_attr( $title ); ?>"
						>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
								<path d="M4 12v7a1 1 0 001 1h14a1 1 0 001-1v-7M16 6l-4-4-4 4M12 2v13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
				</header>

				<div class="blog-single__content entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article>

		<?php
		$related_posts = liderban_get_related_posts( $post_id, 3 );

		if ( ! empty( $related_posts ) ) :
			?>
			<section class="blog-single-related">
				<div class="container">
					<h2 class="blog-single-related__title"><?php esc_html_e( 'VEJA MAIS MATÉRIAS', 'liderban-theme' ); ?></h2>
					<div class="blog-single-related__grid">
						<?php
						foreach ( $related_posts as $related_post ) :
							get_template_part(
								'template-parts/blog/post-card',
								null,
								array(
									'post' => $related_post,
								)
							);
						endforeach;
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	<?php endwhile; ?>
</main>

<?php
get_footer();
