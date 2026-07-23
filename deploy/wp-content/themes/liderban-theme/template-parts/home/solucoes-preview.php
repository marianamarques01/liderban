<?php
/**
 * Seção de Soluções na home.
 *
 * @package Liderban_Theme
 */

$filters = liderban_lines(
	'solucoes_filters',
	array( 'MINERAÇÃO', 'SIDERURGIA', 'GRANDES OBRAS', 'AGRONEGÓCIO', 'EVENTOS', 'INFRAESTRUTURA' )
);

$solutions = liderban_repeater(
	'solucoes_cards',
	array(
		array(
			'title' => 'Saneamento Móvel & Bem-estar',
			'desc'  => 'Banheiros químicos, vestiários e estruturas modulares para canteiros de obras, eventos e áreas remotas.',
			'items' => "Banheiros móveis\nEstruturas modulares\nHigienização contínua",
		),
		array(
			'title' => 'Gestão de Resíduos & Efluentes',
			'desc'  => 'Coleta, transporte e destinação certificada de efluentes com rastreabilidade e conformidade técnica.',
			'items' => "Transporte estratégico\nDestinação certificada\nTratamento especializado",
		),
		array(
			'title' => 'Serviços Técnicos de Saneamento',
			'desc'  => 'Manutenção e preservação para garantir a segurança hídrica e ambiental das suas operações.',
			'items' => "Higienização e conservação\nDesobstrução de redes\nManutenção de equipamentos",
		),
	)
);

$icons = array(
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21c-4-4.5-7-8-7-12a7 7 0 0114 0c0 4-3 7.5-7 12z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12a8 8 0 0113.5-5.5M20 12a8 8 0 01-13.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M17 6.5H19.5V4M7 17.5H4.5V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
);

$solucoes_url = home_url( '/solucoes/' );
?>
<section class="solucoes-section" id="servicos">
	<div class="container">
		<header class="solucoes-header">
			<p class="solucoes-overline"><?php echo esc_html( liderban_field( 'solucoes_overline', 'NOSSAS SOLUÇÕES' ) ); ?></p>
			<h2 class="solucoes-title"><?php echo esc_html( liderban_field( 'solucoes_title', 'Inteligência operacional & infraestrutura robusta.' ) ); ?></h2>
			<p class="solucoes-subtitle">
				<?php echo esc_html( liderban_field( 'solucoes_subtitle', 'Soluções integradas para setores complexos como mineração, siderurgia, grandes obras e agronegócio — com máxima eficiência técnica.' ) ); ?>
			</p>
		</header>

		<div class="solucoes-filters" role="list">
			<?php foreach ( $filters as $index => $filter ) : ?>
				<span class="solucoes-filter<?php echo 0 === $index ? ' is-active' : ''; ?>" role="listitem"><?php echo esc_html( $filter ); ?></span>
			<?php endforeach; ?>
		</div>

		<div class="solucoes-cards">
			<?php foreach ( $solutions as $index => $solution ) : ?>
				<article class="solucao-card">
					<span class="solucao-card__icon"><?php echo $icons[ $index ] ?? $icons[0]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG markup. ?></span>
					<h3 class="solucao-card__title"><?php echo esc_html( $solution['title'] ?? '' ); ?></h3>
					<p class="solucao-card__desc"><?php echo esc_html( $solution['desc'] ?? '' ); ?></p>
					<ul class="solucao-card__list">
						<?php foreach ( liderban_parse_repeater_items( $solution['items'] ?? '' ) as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="solucao-card__link" href="<?php echo esc_url( $solucoes_url ); ?>">
						<?php esc_html_e( 'SAIBA MAIS →', 'liderban-theme' ); ?>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="solucoes-images">
			<div class="solucoes-grid">
				<div class="solucoes-coluna-esquerda">
					<div class="solucoes-image">
						<img src="<?php echo esc_url( liderban_image( 'solucoes_image_1', 'img2.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Globo de vidro com natureza', 'liderban-theme' ); ?>">
					</div>
				</div>
				<div class="solucoes-coluna-direita">
					<div class="solucoes-image">
						<img src="<?php echo esc_url( liderban_image( 'solucoes_image_2', 'img1.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Mãos com água', 'liderban-theme' ); ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
