<?php
/**
 * Seção "Conformidades técnicas e normas" da listagem do blog.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$normas = liderban_repeater(
	'conf_items',
	array(
		array( 'tag' => 'NR 18', 'title' => 'Condições e Meio Ambiente de Trabalho na Indústria da Construção', 'description' => 'Equipamentos e instalações sanitárias móveis em conformidade com exigências de canteiros de obras e infraestrutura.', 'icon' => 'construction' ),
		array( 'tag' => 'NR 24', 'title' => 'Condições Sanitárias e de Conforto nos Locais de Trabalho', 'description' => 'Banheiros químicos, lavatórios e vestiários dimensionados para garantir higiene e bem-estar operacional.', 'icon' => 'sanitary' ),
		array( 'tag' => 'NBR 9050', 'title' => 'Acessibilidade a Edificações, Mobiliário e Espaços Urbanos', 'description' => 'Soluções adaptadas para garantir acesso digno e inclusivo em eventos, obras e áreas de apoio.', 'icon' => 'accessibility' ),
		array( 'tag' => 'ISO 14001', 'title' => 'Sistema de Gestão Ambiental', 'description' => 'Processos de coleta, transporte e destinação de efluentes alinhados a práticas de gestão ambiental.', 'icon' => 'environment' ),
	)
);

$whatsapp_docs_url = liderban_whatsapp_url( 'Olá! Gostaria de solicitar documentação técnica da Liderban.' );
?>

<section class="blog-conformidades">
	<div class="container">
		<header class="blog-conformidades__header">
			<p class="blog-section-label"><?php echo esc_html( liderban_field( 'conf_label', 'Normas e certificações' ) ); ?></p>
			<h2 class="blog-conformidades__title"><?php echo esc_html( liderban_field( 'conf_title', 'Conformidades técnicas e normas' ) ); ?></h2>
			<p class="blog-conformidades__subtitle">
				<?php echo esc_html( liderban_field( 'conf_subtitle', 'Nossas soluções seguem rigorosamente as normas regulamentadoras e padrões técnicos do setor.' ) ); ?>
			</p>
		</header>

		<div class="blog-conformidades__grid">
			<?php foreach ( $normas as $norma ) : ?>
				<article class="blog-conformidades-card">
					<div class="blog-conformidades-card__icon blog-conformidades-card__icon--<?php echo esc_attr( $norma['icon'] ?? 'construction' ); ?>" aria-hidden="true"></div>
					<span class="blog-conformidades-card__tag"><?php echo esc_html( $norma['tag'] ?? '' ); ?></span>
					<h3 class="blog-conformidades-card__title"><?php echo esc_html( $norma['title'] ?? '' ); ?></h3>
					<p class="blog-conformidades-card__description"><?php echo esc_html( $norma['description'] ?? '' ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="blog-cta-banner">
			<div class="blog-cta-banner__content">
				<h3 class="blog-cta-banner__title"><?php echo esc_html( liderban_field( 'conf_cta_title', 'Precisa de documentação técnica?' ) ); ?></h3>
				<p class="blog-cta-banner__text">
					<?php echo esc_html( liderban_field( 'conf_cta_text', 'Solicite fichas técnicas, laudos e certificados de conformidade para o seu projeto ou obra.' ) ); ?>
				</p>
			</div>
			<a class="blog-cta-banner__button" href="<?php echo esc_url( $whatsapp_docs_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php echo esc_html( liderban_field( 'conf_cta_btn', 'SOLICITAR DOCUMENTOS →' ) ); ?>
			</a>
		</div>
	</div>
</section>
