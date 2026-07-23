<?php
/**
 * Seção "Nossa Solidez em Números" — página Serviços.
 *
 * @package Liderban_Theme
 */

$stats = liderban_repeater(
	'stats_items',
	array(
		array( 'highlight' => '+ de 30.000 ordens de serviço por mês', 'text' => ' atestando nossa eficiência e compromisso com a qualidade.' ),
		array( 'highlight' => 'Sistema de gestão automatizado:', 'text' => ' Rastreabilidade simplificada de cada serviço prestado e dashboards atualizados em tempo real.' ),
		array( 'highlight' => 'Frota de + de 120 veículos ativos', 'text' => ', garantindo agilidade, cobertura operacional e pronta resposta aos nossos clientes.' ),
	)
);
?>
<section class="solutions-stats-section">
	<div class="container">
		<header class="solutions-stats-header">
			<h2 class="solutions-stats-title"><?php echo esc_html( liderban_field( 'stats_title', 'Nossa Solidez em Números' ) ); ?></h2>
			<p class="solutions-stats-subtitle">
				<?php echo esc_html( liderban_field( 'stats_subtitle', 'A confiança depositada por grandes players do mercado é sustentada por uma capacidade de entrega comprovada.' ) ); ?>
			</p>
		</header>
		<div class="solutions-stats-grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="solutions-stat-card">
					<p>
						<strong><?php echo esc_html( $stat['highlight'] ?? '' ); ?></strong><?php echo esc_html( $stat['text'] ?? '' ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
