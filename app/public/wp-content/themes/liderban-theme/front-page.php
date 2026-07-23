<?php
/**
 * Template da página inicial.
 *
 * @package Liderban_Theme
 */

get_header();
?>

<main id="primary" class="site-main site-main--home">
	<?php
	get_template_part( 'template-parts/home/hero-carousel' );
	get_template_part( 'template-parts/home/water-section' );
	get_template_part( 'template-parts/home/challenge-section' );
	get_template_part( 'template-parts/home/atuacao-section' );
	get_template_part( 'template-parts/home/solucoes-preview' );
	get_template_part( 'template-parts/home/cta-section' );
	get_template_part( 'template-parts/home/clientes-carousel' );
	?>
</main>

<?php
get_footer();
