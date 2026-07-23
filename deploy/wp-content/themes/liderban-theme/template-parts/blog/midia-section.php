<?php
/**
 * Seção "Liderban na mídia" da listagem do blog.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$midia_items = liderban_get_midia_items( 4 );
?>

<section class="blog-midia">
	<div class="container">
		<header class="blog-midia__header">
			<div class="blog-midia__heading">
				<p class="blog-section-label"><?php echo esc_html( liderban_field( 'midia_label', 'Imprensa' ) ); ?></p>
				<h2 class="blog-midia__title"><?php echo esc_html( liderban_field( 'midia_title', 'Liderban na mídia' ) ); ?></h2>
				<p class="blog-midia__subtitle">
					<?php echo esc_html( liderban_field( 'midia_subtitle', 'Confira matérias e reportagens sobre nossa atuação em saneamento, eventos e infraestrutura.' ) ); ?>
				</p>
			</div>
			<a class="blog-midia__view-all" href="<?php echo esc_url( liderban_get_imprensa_archive_url() ); ?>">
				<?php esc_html_e( 'VER TODAS →', 'liderban-theme' ); ?>
			</a>
		</header>

		<?php get_template_part( 'template-parts/blog/midia-grid', null, array( 'items' => $midia_items ) ); ?>
	</div>
</section>
