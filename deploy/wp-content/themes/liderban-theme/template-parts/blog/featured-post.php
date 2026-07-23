<?php
/**
 * Post em destaque da listagem do blog.
 *
 * @package Liderban_Theme
 *
 * @var array $args {
 *     @type WP_Post|null $post Post em destaque. Default: liderban_get_featured_post().
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post = isset( $args['post'] ) ? $args['post'] : liderban_get_featured_post();

if ( ! $post instanceof WP_Post ) {
	return;
}

$post_id    = $post->ID;
$permalink  = get_permalink( $post_id );
$title      = get_the_title( $post_id );
$excerpt    = wp_trim_words( get_the_excerpt( $post_id ), 32, '…' );
$date_label = liderban_format_post_date( $post_id, 'full' );
$categories = get_the_category( $post_id );
$category   = ! empty( $categories ) ? $categories[0]->name : '';
$thumbnail  = get_the_post_thumbnail(
	$post_id,
	'large',
	array(
		'class'   => 'blog-featured__image',
		'alt'     => $title,
		'loading' => 'eager',
	)
);
?>

<section class="blog-featured">
	<div class="container">
		<article class="blog-featured__grid">
			<a class="blog-featured__media" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr( $title ); ?>">
				<?php if ( $thumbnail ) : ?>
					<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by WP. ?>
				<?php else : ?>
					<span class="blog-featured__image blog-featured__image--placeholder" aria-hidden="true"></span>
				<?php endif; ?>
			</a>

			<div class="blog-featured__content">
				<h2 class="blog-featured__title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
				</h2>

				<?php if ( $excerpt ) : ?>
					<p class="blog-featured__excerpt"><?php echo esc_html( $excerpt ); ?></p>
				<?php endif; ?>

				<div class="blog-featured__meta">
					<?php if ( $date_label ) : ?>
						<span class="blog-featured__meta-item">
							<?php
							printf(
								/* translators: %s: formatted post date */
								esc_html__( 'Postado em: %s', 'liderban-theme' ),
								esc_html( $date_label )
							);
							?>
						</span>
					<?php endif; ?>

					<?php if ( $category ) : ?>
						<span class="blog-featured__meta-item blog-featured__meta-item--category">
							<?php echo esc_html( $category ); ?>
						</span>
					<?php endif; ?>
				</div>

				<div class="blog-featured__actions">
					<a class="blog-featured__button" href="<?php echo esc_url( $permalink ); ?>">
						<?php esc_html_e( 'LER MAIS →', 'liderban-theme' ); ?>
					</a>

					<button
						type="button"
						class="blog-featured__share"
						aria-label="<?php esc_attr_e( 'Compartilhar', 'liderban-theme' ); ?>"
						data-share-url="<?php echo esc_url( $permalink ); ?>"
						data-share-title="<?php echo esc_attr( $title ); ?>"
					>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
							<path d="M4 12v7a1 1 0 001 1h14a1 1 0 001-1v-7M16 6l-4-4-4 4M12 2v13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</div>
		</article>
	</div>
</section>
