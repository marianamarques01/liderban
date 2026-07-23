<?php
/**
 * Seção "Especialistas em Desafios Complexos" — página Serviços.
 *
 * @package Liderban_Theme
 */

$sectors = liderban_lines(
	'expertise_sectors',
	array(
		'Mineração: Nosso principal cluster estratégico',
		'Siderurgia e Energia',
		'Grandes Obras de Infraestrutura',
		'Agronegócio e Operações Logísticas',
		'Eventos de Grande Porte através da Banban, empresa do grupo especializada em eventos.',
	)
);

$whatsapp_url = liderban_whatsapp_url( 'Olá! Gostaria de falar com um consultor estratégico da Liderban.' );
?>
<section class="solutions-expertise-section">
	<div class="container">
		<header class="solutions-expertise-header">
			<h2 class="solutions-expertise-title"><?php echo esc_html( liderban_field( 'expertise_title', 'Especialistas em Desafios Complexos' ) ); ?></h2>
			<p class="solutions-expertise-subtitle">
				<?php echo esc_html( liderban_field( 'expertise_subtitle', 'Nossa inteligência operacional é voltada para setores que exigem previsibilidade e segurança técnica:' ) ); ?>
			</p>
		</header>
		<ul class="solutions-expertise-list">
			<?php foreach ( $sectors as $sector ) : ?>
				<li><?php echo esc_html( $sector ); ?></li>
			<?php endforeach; ?>
		</ul>
		<div class="solutions-expertise-cta">
			<p class="solutions-expertise-cta-text"><?php echo esc_html( liderban_field( 'expertise_cta_text', 'Leve o padrão Liderban para sua operação.' ) ); ?></p>
			<a class="solutions-expertise-btn" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php echo esc_html( liderban_field( 'expertise_cta_btn', 'FALAR COM UM CONSULTOR ESTRATÉGICO' ) ); ?>
			</a>
		</div>
	</div>
</section>
