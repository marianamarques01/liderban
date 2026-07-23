<?php
/**
 * Introdução textual da página Serviços.
 *
 * @package Liderban_Theme
 */
?>
<div class="solutions-intro">
	<h2 class="solutions-intro__title"><?php echo esc_html( liderban_field( 'intro_title', 'Soluções Estratégicas em Saneamento Móvel' ) ); ?></h2>
	<p class="solutions-intro__lead">
		<?php echo esc_html( liderban_field( 'intro_lead', 'Infraestrutura robusta que garante acesso, segurança operacional e cuidado com o meio ambiente onde a estrutura convencional não chega' ) ); ?>
	</p>
	<p class="solutions-intro__text">
		<?php
		echo wp_kses_post(
			liderban_field(
				'intro_text',
				'<strong>Inteligência Operacional a Serviço do Desenvolvimento</strong> onde a velocidade das operações ou a complexidade do território exige agilidade, a Liderban atua. Nossas soluções são desenhadas para transformar desafios logísticos em <strong>continuidade operacional e bem-estar humano.</strong> Atendemos setores de alta exigência técnica, como <strong>Mineração, Siderurgia, Grandes Obras e Agronegócio</strong>, garantindo que cada projeto tenha o suporte necessário para prosperar com <strong>segurança, dignidade e sustentabilidade.</strong>'
			)
		);
		?>
	</p>
</div>
