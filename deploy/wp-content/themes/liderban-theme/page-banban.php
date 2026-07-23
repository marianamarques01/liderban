<?php
/**
 * Template Name: BanBan
 * Template Post Type: page
 *
 * @package Liderban_Theme
 */

get_header();

$servicos = liderban_repeater(
	'servicos_items',
	array(
		array( 'icon' => 'calendar', 'title' => 'Eventos e Festivais', 'text' => 'Gestão integral de banheiros móveis, logística e higienização para shows e arenas esportivas, bem como lavagem de pátios e vias.' ),
		array( 'icon' => 'building', 'title' => 'Infraestrutura Urbana', 'text' => 'Atendimento a condomínios e centros comerciais com serviços de manutenção sanitária e limpeza de fossas.' ),
		array( 'icon' => 'emergency', 'title' => 'Soluções de Emergência', 'text' => 'Abastecimento ágil com caminhão-pipa e tratamento especializado de resíduos.' ),
	)
);

$eventos = liderban_repeater(
	'eventos_items',
	array(
		array( 'image' => 'banban1.png', 'label' => 'Festival de rua', 'title' => 'Carnaval de BH' ),
		array( 'image' => 'banban2.png', 'label' => 'Eventos esportivos', 'title' => 'Jogos no Mineirão' ),
		array( 'image' => 'banban3.png', 'label' => 'Festa popular', 'title' => 'Arraiá do Belô' ),
		array( 'image' => 'banban4.png', 'label' => 'Show nacional', 'title' => 'Festival Sertanejo' ),
		array( 'image' => 'banban5.png', 'label' => 'Show internacional', 'title' => 'Imagine Dragons' ),
	)
);
?>

<main id="primary" class="site-main site-main--banban">
	<section class="banban-hero">
		<div
			class="banban-hero__bg"
			style="background-image: url('<?php echo esc_url( liderban_image( 'hero_bg', 'banban_bg.png' ) ); ?>');"
		></div>
		<div class="banban-hero__overlay"></div>
		<div class="wave-bottom">
			<img src="<?php echo esc_url( liderban_asset( 'images/wave.png' ) ); ?>" alt="<?php esc_attr_e( 'Onda decorativa', 'liderban-theme' ); ?>">
		</div>
	</section>

	<section class="banban-intro">
		<div class="container">
			<div class="banban-intro__grid">
				<div class="banban-intro__content">
					<h1 class="banban-intro__title">
						<?php echo esc_html( liderban_field( 'intro_title', 'BanBan:' ) ); ?>
						<span><?php echo esc_html( liderban_field( 'intro_title_span', 'Estrutura que faz acontecer.' ) ); ?></span>
					</h1>
					<p><?php echo esc_html( liderban_field( 'intro_text_1', 'Com uma personalidade moderna e resolutiva, a BanBan é a empresa do grupo especializada em eventos, com foco em viabilizar bem-estar ao usuário e o funcionamento de grandes eventos e áreas urbanas.' ) ); ?></p>
					<p>
						<?php echo esc_html( liderban_field( 'intro_text_2', 'Somos a infraestrutura invisível que garante' ) ); ?>
						<strong><?php echo esc_html( liderban_field( 'intro_highlight', 'segurança, conforto e eficiência.' ) ); ?></strong>
					</p>
				</div>
				<div class="banban-intro__logo-card">
					<img src="<?php echo esc_url( liderban_image( 'intro_logo', 'banban.png' ) ); ?>" alt="<?php esc_attr_e( 'Logo BanBan', 'liderban-theme' ); ?>" loading="lazy">
				</div>
			</div>
		</div>
	</section>

	<section class="banban-solucoes">
		<div class="container">
			<div class="banban-solucoes__header">
				<p class="banban-section-label"><?php echo esc_html( liderban_field( 'servicos_label', 'Nossas soluções' ) ); ?></p>
				<h2 class="banban-solucoes__title"><?php echo esc_html( liderban_field( 'servicos_title', 'O que fazemos' ) ); ?></h2>
				<p class="banban-solucoes__subtitle"><?php echo esc_html( liderban_field( 'servicos_subtitle', 'Entregamos agilidade e soluções completas que vão além do básico.' ) ); ?></p>
			</div>
			<div class="banban-solucoes__grid">
				<?php foreach ( $servicos as $servico ) : ?>
					<article class="banban-solucoes-card">
						<div class="banban-solucoes-card__icon banban-solucoes-card__icon--<?php echo esc_attr( $servico['icon'] ?? 'calendar' ); ?>" aria-hidden="true"></div>
						<h3><?php echo esc_html( $servico['title'] ?? '' ); ?></h3>
						<p><?php echo esc_html( $servico['text'] ?? '' ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="banban-eventos">
		<div class="container">
			<div class="banban-eventos__header">
				<p class="banban-section-label banban-section-label--white"><?php echo esc_html( liderban_field( 'eventos_label', 'Onde a BanBan já esteve' ) ); ?></p>
				<h2 class="banban-eventos__title"><?php echo esc_html( liderban_field( 'eventos_title', 'Eventos que confiam na gente' ) ); ?></h2>
				<p class="banban-eventos__text">
					<?php echo esc_html( liderban_field( 'eventos_text', 'A realização de um grande evento exige planejamento, sincronia e atenção aos detalhes. A BanBan entrega equipamentos de qualidade e soluções completas para uma experiência funcional e confortável.' ) ); ?>
				</p>
			</div>
			<div class="banban-eventos__grid">
				<?php foreach ( $eventos as $evento ) : ?>
					<article class="banban-evento-card">
						<div class="banban-evento-card__visual">
							<img src="<?php echo esc_url( liderban_resolve_image_value( $evento['image'] ?? '' ) ); ?>" alt="<?php echo esc_attr( $evento['title'] ?? '' ); ?>" loading="lazy">
						</div>
						<div class="banban-evento-card__body">
							<span class="banban-evento-card__label"><?php echo esc_html( $evento['label'] ?? '' ); ?></span>
							<h3><?php echo esc_html( $evento['title'] ?? '' ); ?></h3>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="banban-cta">
		<div class="container">
			<div class="banban-cta-card">
				<div class="banban-cta-card__content">
					<h2 class="banban-cta-card__title">
						<?php echo esc_html( liderban_field( 'cta_title_1', 'Solicite uma' ) ); ?>
						<span><?php echo esc_html( liderban_field( 'cta_title_2', 'solução completa' ) ); ?></span>
					</h2>
					<p class="banban-cta-card__text">
						<?php echo esc_html( liderban_field( 'cta_text', 'Fale com nossos consultores e garanta uma solução customizada de acordo com a sua necessidade.' ) ); ?>
					</p>
					<a class="banban-cta-card__button" href="<?php echo esc_url( liderban_whatsapp_url( 'Olá! Gostaria de solicitar uma solução completa BanBan.' ) ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( liderban_field( 'cta_button', 'SOLICITAR UMA SOLUÇÃO COMPLETA →' ) ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/banban/instagram-section' ); ?>
</main>

<?php
get_footer();
