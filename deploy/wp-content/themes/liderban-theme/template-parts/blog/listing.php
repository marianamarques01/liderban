<?php
/**
 * Conteúdo da listagem do blog (destaque + grid + paginação).
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$filters    = liderban_get_blog_filter_params();
$blog_query = liderban_get_blog_posts(
	array(
		'cat'     => $filters['cat'],
		'orderby' => $filters['orderby'],
		'paged'   => $filters['paged'],
	)
);
?>

<?php get_template_part( 'template-parts/blog/featured-post' ); ?>

<section class="blog-listing">
	<div class="container">
		<header class="blog-listing__header">
			<h2 class="blog-listing__title"><?php esc_html_e( 'POSTS RECENTES', 'liderban-theme' ); ?></h2>
			<?php get_template_part( 'template-parts/blog/post-filters' ); ?>
		</header>

		<?php if ( $blog_query->have_posts() ) : ?>
			<div class="blog-listing__grid">
				<?php
				while ( $blog_query->have_posts() ) :
					$blog_query->the_post();
					get_template_part(
						'template-parts/blog/post-card',
						null,
						array(
							'post' => get_post(),
						)
					);
				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<?php if ( $blog_query->max_num_pages > 1 ) : ?>
				<nav class="blog-pagination" aria-label="<?php esc_attr_e( 'Paginação do blog', 'liderban-theme' ); ?>">
					<?php
					$pagination_args = array();

					if ( ! empty( $filters['cat'] ) ) {
						$pagination_args['cat'] = $filters['cat'];
					}

					if ( ! empty( $filters['orderby'] ) && 'date' !== $filters['orderby'] ) {
						$pagination_args['orderby'] = $filters['orderby'];
					}

					echo wp_kses_post(
						paginate_links(
							array(
								'total'     => $blog_query->max_num_pages,
								'current'   => $filters['paged'],
								'mid_size'  => 2,
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'add_args'  => $pagination_args,
								'type'      => 'list',
							)
						)
					);
					?>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<p class="blog-listing__empty">
				<?php
				if ( ! empty( $filters['cat'] ) ) {
					esc_html_e( 'Nenhum post encontrado nesta categoria.', 'liderban-theme' );
				} elseif ( liderban_get_featured_post() instanceof WP_Post ) {
					esc_html_e( 'Nenhum outro post disponível no momento.', 'liderban-theme' );
				} else {
					esc_html_e( 'Nenhum post publicado ainda.', 'liderban-theme' );
				}
				?>
			</p>
		<?php endif; ?>
	</div>
</section>
