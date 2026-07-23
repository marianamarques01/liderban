<?php
/**
 * Resultados de busca (posts do blog).
 *
 * @package Liderban_Theme
 */

get_header();

$search_query = get_search_query();
$hero_bg      = file_exists( liderban_asset_path( 'images/blog_bg.png' ) )
	? 'blog_bg.png'
	: 'clientes_bg.jpg';
?>

<main id="primary" class="site-main site-main--blog site-main--search">
	<?php
	get_template_part(
		'template-parts/hero/hero-page',
		null,
		array(
			'bg_image' => $hero_bg,
		)
	);
	?>

	<section class="blog-listing blog-search">
		<div class="container">
			<header class="blog-listing__header blog-search__header">
				<h1 class="blog-listing__title">
					<?php
					if ( $search_query ) {
						printf(
							/* translators: %s: search query */
							esc_html__( 'Resultados para "%s"', 'liderban-theme' ),
							esc_html( $search_query )
						);
					} else {
						esc_html_e( 'Pesquisar no blog', 'liderban-theme' );
					}
					?>
				</h1>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="blog-listing__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part(
							'template-parts/blog/post-card',
							null,
							array(
								'post' => get_post(),
							)
						);
					endwhile;
					?>
				</div>

				<?php if ( $GLOBALS['wp_query']->max_num_pages > 1 ) : ?>
					<nav class="blog-pagination" aria-label="<?php esc_attr_e( 'Paginação da busca', 'liderban-theme' ); ?>">
						<?php
						echo wp_kses_post(
							paginate_links(
								array(
									'total'     => $GLOBALS['wp_query']->max_num_pages,
									'current'   => max( 1, get_query_var( 'paged' ) ),
									'mid_size'  => 2,
									'prev_text' => '&larr;',
									'next_text' => '&rarr;',
									'type'      => 'list',
								)
							)
						);
						?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<p class="blog-listing__empty">
					<?php esc_html_e( 'Nenhum post encontrado para esta busca.', 'liderban-theme' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
