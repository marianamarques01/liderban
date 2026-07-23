<?php
/**
 * Card de post do blog.
 *
 * @package Liderban_Theme
 *
 * @var array $args {
 *     @type WP_Post $post Post a exibir. Default: post global.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post = isset( $args['post'] ) ? $args['post'] : null;

if ( ! $post instanceof WP_Post ) {
	global $post;
}

if ( ! $post instanceof WP_Post ) {
	return;
}

$post_id    = $post->ID;
$permalink  = get_permalink( $post_id );
$title      = get_the_title( $post_id );
$excerpt    = wp_trim_words( get_the_excerpt( $post_id ), 18, '…' );
$date_label = liderban_format_post_date( $post_id, 'card' );
$categories = get_the_category( $post_id );
$category   = ! empty( $categories ) ? $categories[0]->name : '';
$thumbnail  = get_the_post_thumbnail(
	$post_id,
	'medium_large',
	array(
		'class'   => 'blog-card__image',
		'alt'     => $title,
		'loading' => 'lazy',
	)
);
?>

<article class="blog-card">
	<a class="blog-card__media" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr( $title ); ?>">
		<?php if ( $thumbnail ) : ?>
			<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by WP. ?>
		<?php else : ?>
			<span class="blog-card__image blog-card__image--placeholder" aria-hidden="true"></span>
		<?php endif; ?>
	</a>

	<div class="blog-card__body">
		<div class="blog-card__meta">
			<?php if ( $date_label ) : ?>
				<time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>">
					<?php echo esc_html( $date_label ); ?>
				</time>
			<?php endif; ?>

			<?php if ( $category ) : ?>
				<?php if ( $date_label ) : ?>
					<span class="blog-card__separator" aria-hidden="true">•</span>
				<?php endif; ?>
				<span class="blog-card__category"><?php echo esc_html( $category ); ?></span>
			<?php endif; ?>
		</div>

		<h3 class="blog-card__title">
			<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
		</h3>

		<?php if ( $excerpt ) : ?>
			<p class="blog-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
		<?php endif; ?>

		<a class="blog-card__link" href="<?php echo esc_url( $permalink ); ?>">
			<?php esc_html_e( 'BLOG NEWS →', 'liderban-theme' ); ?>
		</a>
	</div>
</article>
