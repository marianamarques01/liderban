<?php
/**
 * Template Name: Quem Somos
 * Template Post Type: page
 *
 * @package Liderban_Theme
 */

get_header();

$valores = liderban_repeater(
	'valores_items',
	array(
		array( 'title' => 'Lealdade', 'text' => 'Compromisso e respeito com nossa equipe, clientes e parceiros.' ),
		array( 'title' => 'Integridade', 'text' => 'Ética e transparência absoluta em todas as ações.' ),
		array( 'title' => 'Comprometimento', 'text' => 'Empenho total no alcance de resultados com qualidade superior.' ),
		array( 'title' => 'Dedicação', 'text' => 'Busca incessante pelo aprimoramento de processos e serviços.' ),
		array( 'title' => 'Responsabilidade social e ambiental', 'text' => 'Atuação sustentável, cuidando das pessoas e preservando o meio ambiente.' ),
		array( 'title' => 'Espírito de equipe', 'text' => 'Colaboração mútua para superar os desafios mais complexos.' ),
		array( 'title' => 'Segurança', 'text' => 'Garantia da integridade física e do bem-estar em cada operação.' ),
		array( 'title' => 'Excelência', 'text' => 'Busca constante pela superação de expectativas e qualidade superior em cada entrega.' ),
	)
);

$timeline = liderban_repeater(
	'timeline_items',
	array(
		array( 'year' => '1997', 'text' => 'Início das atividades atendendo eventos e grandes produções.', 'align' => 'top' ),
		array( 'year' => '2004', 'text' => 'Entrada no setor de mineração eleva o nível de exigência operacional e logística.', 'align' => 'bottom' ),
		array( 'year' => '2012', 'text' => 'Expansão nacional com o primeiro ponto de apoio fora de Minas Gerais.', 'align' => 'top' ),
		array( 'year' => '2014', 'text' => 'Transição da marca Loc-ban para Liderban.', 'align' => 'bottom' ),
		array( 'year' => '2019', 'text' => 'Crescimento de 70% impulsionado por novos contratos e planejamento estratégico.', 'align' => 'top' ),
		array( 'year' => '2021', 'text' => 'Consolidação da gestão com inteligência, tecnologia e foco em produtividade.', 'align' => 'bottom' ),
		array( 'year' => '2024', 'text' => 'Reestruturação organizacional e novos pontos de apoio.', 'align' => 'top' ),
	)
);
?>

<main id="primary" class="site-main">
	<?php
	get_template_part(
		'template-parts/hero/hero-page',
		null,
		array(
			'bg_image' => liderban_image( 'hero_bg', 'quemsomos_bg.jpg' ),
		)
	);
	?>

	<section class="quemsomos-section">
		<div class="container">
			<div class="quemsomos-grid">
				<div class="quemsomos-content">
					<p class="quemsomos-label"><?php echo esc_html( liderban_field( 'intro_label', 'Quem Somos' ) ); ?></p>
					<h2 class="quemsomos-heading"><?php echo esc_html( liderban_field( 'intro_heading', 'Liderança, Propósito e Infraestrutura Essencial' ) ); ?></h2>
					<p><?php echo esc_html( liderban_field( 'intro_text_1', 'A Liderban nasceu do propósito de fazer diferente, levando dignidade, cuidado e respeito a cada ambiente onde atua. Somos uma empresa líder em saneamento móvel, com expertise consolidada em ambientes de alta criticidade, onde a estrutura convencional não chega ou não acompanha a velocidade das operações.' ) ); ?></p>
					<p><?php echo esc_html( liderban_field( 'intro_text_2', 'Acreditamos que o nosso trabalho transforma realidades e que cada ação conta para o bem comum.' ) ); ?></p>

					<div class="quemsomos-pillars">
						<div class="quemsomos-pillar quemsomos-pillar--orange">
							<h3><?php echo esc_html( liderban_field( 'pillar_1_title', 'O que nos move' ) ); ?></h3>
							<p><?php echo esc_html( liderban_field( 'pillar_1_text', 'Atuamos no território da infraestrutura essencial, impactando pessoas, cidades e a produtividade de diferentes setores. Nosso papel é conectar acesso à higiene, saúde e proteção ambiental, garantindo a continuidade operacional de nossos parceiros através de inteligência estratégica e visão sistêmica.' ) ); ?></p>
						</div>
						<div class="quemsomos-pillar quemsomos-pillar--blue">
							<h3><?php echo esc_html( liderban_field( 'pillar_2_title', 'Nossa Solidez Operacional' ) ); ?></h3>
							<p><?php echo esc_html( liderban_field( 'pillar_2_text', 'Com quase três décadas de história, e um crescimento médio consolidado de 15% ao ano, transformamos desafios complexos em resultados mensuráveis.' ) ); ?></p>
						</div>
					</div>
				</div>

				<div class="quemsomos-image-wrap">
					<img
						src="<?php echo esc_url( liderban_image( 'intro_image', 'quemsomos_img.jpg' ) ); ?>"
						alt="<?php esc_attr_e( 'Equipamentos Liderban', 'liderban-theme' ); ?>"
						loading="lazy"
					>
				</div>
			</div>
		</div>
	</section>

	<section class="estrategia-section">
		<div class="container">
			<h2 class="estrategia-title"><?php echo esc_html( liderban_field( 'estrategia_title', 'Nossa Estratégia de Futuro' ) ); ?></h2>
			<div class="estrategia-cards">
				<div class="estrategia-card estrategia-card--missao">
					<span class="estrategia-card-tag"><?php echo esc_html( liderban_field( 'missao_tag', 'Missão' ) ); ?></span>
					<p><?php echo esc_html( liderban_field( 'missao_text', 'Ser uma empresa sólida e saudável, capaz de gerar valor de longo prazo para a comunidade, colaboradores e sócios.' ) ); ?></p>
				</div>
				<div class="estrategia-card estrategia-card--visao">
					<span class="estrategia-card-tag"><?php echo esc_html( liderban_field( 'visao_tag', 'Visão 2028' ) ); ?></span>
					<p><?php echo esc_html( liderban_field( 'visao_text', 'Ser a maior empresa de saneamento móvel do país, tornando-se a referência máxima em qualidade, confiança e sustentabilidade' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="valores-section">
		<div class="container">
			<h2 class="valores-title"><?php echo esc_html( liderban_field( 'valores_title', 'Nossos Valores' ) ); ?></h2>
			<div class="valores-cards-grid">
				<?php foreach ( $valores as $valor ) : ?>
					<div class="valor-card">
						<h3><?php echo esc_html( $valor['title'] ?? '' ); ?></h3>
						<p><?php echo esc_html( $valor['text'] ?? '' ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="timeline-horizontal-section">
		<div class="container">
			<h2 class="timeline-horizontal-title"><?php echo esc_html( liderban_field( 'timeline_title', 'Grandes marcos da nossa história' ) ); ?></h2>
			<div class="timeline-horizontal">
				<?php foreach ( $timeline as $entry ) : ?>
					<?php $align = in_array( $entry['align'] ?? '', array( 'top', 'bottom' ), true ) ? $entry['align'] : 'top'; ?>
					<div class="timeline-horizontal-item timeline-horizontal-item--<?php echo esc_attr( $align ); ?>">
						<?php if ( 'top' === $align ) : ?>
							<div class="timeline-horizontal-content">
								<span class="timeline-horizontal-year"><?php echo esc_html( $entry['year'] ?? '' ); ?></span>
								<p><?php echo esc_html( $entry['text'] ?? '' ); ?></p>
							</div>
							<span class="timeline-horizontal-dot" aria-hidden="true"></span>
							<div class="timeline-horizontal-spacer" aria-hidden="true"></div>
						<?php else : ?>
							<div class="timeline-horizontal-spacer" aria-hidden="true"></div>
							<span class="timeline-horizontal-dot" aria-hidden="true"></span>
							<div class="timeline-horizontal-content">
								<span class="timeline-horizontal-year"><?php echo esc_html( $entry['year'] ?? '' ); ?></span>
								<p><?php echo esc_html( $entry['text'] ?? '' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="quemsomos-statement">
		<div class="container">
			<div class="quemsomos-statement-box">
				<p><?php echo esc_html( liderban_field( 'statement_1', 'Nem toda infraestrutura é visível, mas é ela que sustenta a produtividade e a segurança de milhares de pessoas todos os dias.' ) ); ?></p>
				<p><?php echo esc_html( liderban_field( 'statement_2', 'Nosso compromisso é promover condições de trabalho humanizadas e a preservação dos recursos naturais, gerando qualidade de vida e bem-estar para a sociedade.' ) ); ?></p>
				<div class="quemsomos-statement-bar">
					<p><?php echo esc_html( liderban_field( 'statement_3', 'Liderban. Cuidar das pessoas e do meio ambiente é o que nos move.' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
