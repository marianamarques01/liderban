<?php
/**
 * Cards de serviços na home.
 *
 * @package Liderban_Theme
 */

$servicos = array(
	array(
		'icon'  => 'water-vector.png',
		'alt'   => __( 'Ícone Saneamento', 'liderban-theme' ),
		'title' => __( 'Serviço de Saneamento', 'liderban-theme' ),
		'text'  => __( 'Higienização de banheiros, desobstrução de redes hidráulicas e conservação de espaço', 'liderban-theme' ),
	),
	array(
		'icon'  => 'transport-vector.png',
		'alt'   => __( 'Ícone Transporte', 'liderban-theme' ),
		'title' => __( 'Transporte', 'liderban-theme' ),
		'text'  => __( 'Agendamento descomplicado, operação segura e destinação certificada', 'liderban-theme' ),
	),
	array(
		'icon'  => 'bath-vector.png',
		'alt'   => __( 'Ícone Banheiros', 'liderban-theme' ),
		'title' => __( 'Banheiros Móveis', 'liderban-theme' ),
		'text'  => __( 'Solução rápida e bem-estar com as linhas polietileno e modular', 'liderban-theme' ),
	),
	array(
		'icon'  => 'house-vector.png',
		'alt'   => __( 'Ícone Estruturas', 'liderban-theme' ),
		'title' => __( 'Estruturas Modulares', 'liderban-theme' ),
		'text'  => __( 'Design customizado e produção tecnológica de espaços humanizados', 'liderban-theme' ),
	),
);
?>
<section class="servicos-section">
	<div class="container">
		<div class="servicos-grid">
			<?php foreach ( $servicos as $servico ) : ?>
				<div class="servico-card">
					<div class="servico-icon">
						<img src="<?php echo esc_url( liderban_asset( 'images/' . $servico['icon'] ) ); ?>" alt="<?php echo esc_attr( $servico['alt'] ); ?>">
					</div>
					<div class="servico-content">
						<h3><?php echo esc_html( $servico['title'] ); ?></h3>
						<p><?php echo esc_html( $servico['text'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="cta-button-container">
			<button class="cta-button" id="solicite-mais" type="button"><?php esc_html_e( 'Saiba mais', 'liderban-theme' ); ?></button>
		</div>
	</div>
</section>
