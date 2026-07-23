<?php
/**
 * Seção "Atuação da Liderban".
 *
 * @package Liderban_Theme
 */

$values = liderban_repeater(
	'atuacao_values',
	array(
		array( 'number' => '01', 'title' => 'Lealdade', 'text' => 'Compromisso com equipe, clientes e parceiros.' ),
		array( 'number' => '02', 'title' => 'Integridade', 'text' => 'Ética e transparência em todas as ações.' ),
		array( 'number' => '03', 'title' => 'Dedicação', 'text' => 'Empenho total no alcance de resultados.' ),
		array( 'number' => '04', 'title' => 'Responsabilidade', 'text' => 'Cuidado com pessoas e meio ambiente.' ),
	)
);
?>
<section class="atuacao-section" id="clientes">
	<div class="wave-background">
		<img src="<?php echo esc_url( liderban_asset( 'images/wave2.svg' ) ); ?>" alt="<?php esc_attr_e( 'Onda decorativa', 'liderban-theme' ); ?>">
	</div>
	<div class="container">
		<div class="atuacao-image">
			<img src="<?php echo esc_url( liderban_image( 'atuacao_image', 'img.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Rio e floresta amazônica', 'liderban-theme' ); ?>">
		</div>
		<div class="atuacao-grid">
			<div class="atuacao-intro">
				<p class="atuacao-overline"><?php echo esc_html( liderban_field( 'atuacao_overline', 'ATUAÇÃO DA LIDERBAN' ) ); ?></p>
				<h2 class="atuacao-title"><?php echo esc_html( liderban_field( 'atuacao_title', '28 anos de referência em saneamento móvel e gestão de resíduos.' ) ); ?></h2>
				<p class="atuacao-description">
					<?php echo esc_html( liderban_field( 'atuacao_description', 'Oferecemos soluções seguras e certificadas para o transporte e tratamento de efluentes, garantindo conformidade técnica, dignidade humana e proteção ao meio ambiente.' ) ); ?>
				</p>
				<a class="atuacao-cta" href="<?php echo esc_url( liderban_whatsapp_url( 'Olá! Gostaria de falar com o time da Liderban.' ) ); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html( liderban_field( 'atuacao_cta', 'FALE COM NOSSO TIME →' ) ); ?>
				</a>
			</div>
			<div class="atuacao-values">
				<?php foreach ( $values as $value ) : ?>
					<div class="atuacao-value-card">
						<span class="atuacao-value-number"><?php echo esc_html( $value['number'] ?? '' ); ?></span>
						<h3 class="atuacao-value-title"><?php echo esc_html( $value['title'] ?? '' ); ?></h3>
						<p class="atuacao-value-text"><?php echo esc_html( $value['text'] ?? '' ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
