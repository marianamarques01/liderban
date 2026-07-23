<?php
/**
 * Template da página Blog (slug blog).
 *
 * Usado quando /blog/ ainda não está configurada como página de posts.
 *
 * @package Liderban_Theme
 */

get_header();

$hero_bg = liderban_image( 'hero_bg', file_exists( liderban_asset_path( 'images/blog_bg.png' ) ) ? 'blog_bg.png' : 'clientes_bg.jpg' );
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
