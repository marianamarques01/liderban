<?php
/**
 * Arquivo de matérias de imprensa.
 *
 * @package Liderban_Theme
 */

get_header();

$blog_page_id = (int) get_option( 'page_for_posts' );
$default_bg   = file_exists( liderban_asset_path( 'images/blog_bg.png' ) ) ? 'blog_bg.png' : 'clientes_bg.jpg';
$hero_bg      = liderban_image( 'hero_bg', $default_bg, $blog_page_id );
?>

<main id="primary" class="site-main site-main--blog site-main--imprensa">
	<?php
	get_template_part(
		'template-parts/hero/hero-page',
		null,
		array(
			'bg_image' => $hero_bg,
		)
	);
	?>

	<section class="blog-midia blog-midia--archive">
		<div class="container">
			<header class="blog-midia__header">
				<div class="blog-midia__heading">
					<p class="blog-section-label"><?php echo esc_html( liderban_field( 'midia_label', 'Imprensa', $blog_page_id ) ); ?></p>
					<h1 class="blog-midia__title"><?php echo esc_html( liderban_field( 'midia_title', 'Liderban na mídia', $blog_page_id ) ); ?></h1>
					<p class="blog-midia__subtitle">
						<?php echo esc_html( liderban_field( 'midia_subtitle', 'Confira matérias e reportagens sobre nossa atuação em saneamento, eventos e infraestrutura.', $blog_page_id ) ); ?>
					</p>
				</div>
				<a class="blog-midia__view-all" href="<?php echo esc_url( liderban_get_blog_url() ); ?>">
					<?php esc_html_e( '← VOLTAR AO BLOG', 'liderban-theme' ); ?>
				</a>
			</header>

			<?php if ( have_posts() ) : ?>
				<?php
				$items = array();

				while ( have_posts() ) {
					the_post();
					$items[] = liderban_imprensa_format_item( get_post() );
				}

				get_template_part(
					'template-parts/blog/midia-grid',
					null,
					array(
						'items' => $items,
					)
				);
				?>
			<?php else : ?>
				<p><?php esc_html_e( 'Nenhuma matéria publicada no momento.', 'liderban-theme' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
