<?php
/**
 * Grid de cards "Liderban na mídia".
 *
 * @package Liderban_Theme
 *
 * @var array $args {
 *     @type array $items Matérias formatadas para exibição.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = isset( $args['items'] ) && is_array( $args['items'] ) ? $args['items'] : array();

if ( empty( $items ) ) {
	return;
}
?>

<div class="blog-midia__grid">
	<?php foreach ( $items as $item ) : ?>
		<article class="blog-midia-card">
			<a class="blog-midia-card__link" href="<?php echo esc_url( $item['url'] ); ?>"<?php echo '#' !== $item['url'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
				<div class="blog-midia-card__source">
					<span class="blog-midia-card__icon" aria-hidden="true">
						<?php echo esc_html( $item['initials'] ); ?>
					</span>
					<span class="blog-midia-card__source-name"><?php echo esc_html( $item['source'] ); ?></span>
				</div>
				<h3 class="blog-midia-card__headline"><?php echo esc_html( $item['headline'] ); ?></h3>
				<time class="blog-midia-card__date" datetime="<?php echo esc_attr( $item['date'] ); ?>">
					<?php echo esc_html( $item['date'] ); ?>
				</time>
			</a>
		</article>
	<?php endforeach; ?>
</div>
