<?php
/**
 * Seção "O cenário desafiador do Brasil".
 *
 * @package Liderban_Theme
 */

$pillars = array(
	array(
		'label' => liderban_field( 'challenge_pillar_1', 'Dignidade & Bem-estar' ),
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M16 26s-8-5.2-8-11.5C8 11.5 10.5 9 13.5 9c1.8 0 3.4.9 4.5 2.3C19.1 9.9 20.7 9 22.5 9 25.5 9 28 11.5 28 14.5 28 20.8 16 26 16 26z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M10 22c-2-1.5-3-3.5-3-5.5M22 22c2-1.5 3-3.5 3-5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	),
	array(
		'label' => liderban_field( 'challenge_pillar_2', 'Segurança Operacional' ),
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M16 4L6 8v8c0 6.1 4.3 11.8 10 13 5.7-1.2 10-6.9 10-13V8L16 4z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M12 16l2.5 2.5L20 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	),
	array(
		'label' => liderban_field( 'challenge_pillar_3', 'Responsabilidade Socioambiental' ),
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M16 28c-6-4-10-8.5-10-14.5C6 9.5 10.5 5 16 5s10 4.5 10 8.5c0 6-4 10.5-10 14.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M16 5v23M11 12c2 1 5 1 10 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	),
);
?>
<section class="challenge-section">
	<div class="container">
		<header class="challenge-header">
			<p class="challenge-overline"><?php echo esc_html( liderban_field( 'challenge_overline', 'O CENÁRIO DESAFIADOR DO BRASIL' ) ); ?></p>
			<h2 class="challenge-title"><?php echo esc_html( liderban_field( 'challenge_title', 'Um desafio estrutural que move o nosso propósito.' ) ); ?></h2>
		</header>

		<div class="challenge-card">
			<div class="challenge-card__grid">
				<div class="challenge-stat">
					<span class="challenge-stat__number"><?php echo esc_html( liderban_field( 'challenge_stat', '44%' ) ); ?></span>
					<p class="challenge-stat__text"><?php echo esc_html( liderban_field( 'challenge_stat_txt', 'da população brasileira ainda não possui acesso adequado ao esgotamento sanitário.' ) ); ?></p>
				</div>
				<div class="challenge-content">
					<p class="challenge-content__text">
						<?php echo esc_html( liderban_field( 'challenge_content', 'Esse dado representa mais do que uma estatística: é uma lacuna de infraestrutura que impacta diretamente a saúde pública, a preservação ambiental e a continuidade de operações industriais em todo o país.' ) ); ?>
					</p>
					<div class="challenge-pillars">
						<?php foreach ( $pillars as $pillar ) : ?>
							<div class="challenge-pillar">
								<span class="challenge-pillar__icon"><?php echo $pillar['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG markup. ?></span>
								<span class="challenge-pillar__label"><?php echo esc_html( $pillar['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<p class="challenge-quote"><?php echo esc_html( liderban_field( 'challenge_quote', '"Cuidar das pessoas e do meio ambiente é o que nos move."' ) ); ?></p>
	</div>
</section>
