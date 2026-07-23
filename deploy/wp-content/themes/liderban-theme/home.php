<?php
/**
 * Listagem do blog (página de posts configurada em Leitura).
 *
 * @package Liderban_Theme
 */

get_header();

$default_bg = file_exists( liderban_asset_path( 'images/blog_bg.png' ) ) ? 'blog_bg.png' : 'clientes_bg.jpg';
$hero_bg    = liderban_image( 'hero_bg', $default_bg );
?>

<main id="primary" class="site-main site-main--blog">
	<?php
	get_template_part(
		'template-parts/hero/hero-page',
		null,
		array(
			'bg_image' => $hero_bg,
		)
	);

	get_template_part( 'template-parts/blog/listing' );
	get_template_part( 'template-parts/blog/midia-section' );
	get_template_part( 'template-parts/blog/conformidades-section' );
	get_template_part( 'template-parts/banban/instagram-section' );
	?>
</main>

<?php
get_footer();
