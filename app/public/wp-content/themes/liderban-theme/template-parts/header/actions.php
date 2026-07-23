<?php
/**
 * Ações do header: CTA e pesquisa.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp_orcamento_url = 'https://wa.me/553125367500?text=' . rawurlencode(
	__( 'Olá! Gostaria de solicitar um orçamento.', 'liderban-theme' )
);
?>

<div class="header-actions">
	<a
		class="header-actions__cta"
		href="<?php echo esc_url( $whatsapp_orcamento_url ); ?>"
		target="_blank"
		rel="noopener noreferrer"
	>
		<?php esc_html_e( 'Solicite um orçamento', 'liderban-theme' ); ?>
	</a>

	<?php get_template_part( 'template-parts/header/search-panel' ); ?>
</div>
