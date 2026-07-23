<?php
/**
 * Modais da página Serviços.
 *
 * @package Liderban_Theme
 */

$modals = liderban_repeater(
	'modals_data',
	array(
		array(
			'id' => 'modal-banheiros', 'image' => 'solutions_img1.png', 'alt' => 'Banheiros Móveis', 'icon' => 'bath-vector.png',
			'title' => 'Banheiros Móveis', 'subtitle' => 'Modelos individuais, duplos ou coletivos',
			'items' => "Serviços de transporte, higienização, gestão de resíduos e assistência técnica.\nEquipe para mapeamento de áreas e programação de instalações.\nDocumentação técnica de segurança e inspeções de qualidade.\nCanal do cliente para a conferência do trabalho executado em campo.",
			'whatsapp' => 'Olá! Gostaria de contratar o serviço de Banheiros Móveis.',
		),
		array(
			'id' => 'modal-estruturas', 'image' => 'solutions_img2.png', 'alt' => 'Estruturas Modulares', 'icon' => 'house-vector.png',
			'title' => 'Estruturas Modulares', 'subtitle' => 'Escritório, espaço de conveniência, posto de venda, cabine de comando e o que mais sua empresa precisar',
			'items' => "Material de qualidade, transporte seguro e eficiência nos serviços de assistência.\nProjetos customizados.\nMobiliário ergonômico, moderno e resistente.",
			'whatsapp' => 'Olá! Gostaria de contratar o serviço de Estruturas Modulares.',
		),
		array(
			'id' => 'modal-transporte', 'image' => 'solutions_img3.png', 'alt' => 'Transporte', 'icon' => 'transport-vector.png',
			'title' => 'Transporte', 'subtitle' => 'Coleta de efluentes, fornecimento de água potável, carga e descarga',
			'items' => "Agendamento descomplicado.\nFrota licenciada e equipe mobilizada.\nDescarte certificado e gestão resíduos.\nCondições especiais no fechamento de pacotes de atendimentos pré-programados.",
			'whatsapp' => 'Olá! Gostaria de contratar o serviço de Transporte.',
		),
		array(
			'id' => 'modal-saneamento', 'image' => 'solutions_img4.png', 'alt' => 'Saneamento', 'icon' => 'water-vector.png',
			'title' => 'Saneamento', 'subtitle' => 'Compromisso com a qualidade para oferecer o melhor serviço de higienização do país',
			'items' => "Rotas diárias.\nEficiência operacional no atendimento a emergências de desobstrução de redes hidráulicas.\nAtendimento em mineração, condomínios, centros urbanos e pátios logísticos.\nCanal do cliente para medição simplificada das ordens de serviços.",
			'whatsapp' => 'Olá! Gostaria de contratar o serviço de Saneamento.',
		),
	)
);

foreach ( $modals as $modal ) :
	$whatsapp_url = liderban_whatsapp_url( $modal['whatsapp'] ?? '' );
	$icon_value   = $modal['icon'] ?? '';
	$icon_url     = filter_var( $icon_value, FILTER_VALIDATE_URL ) ? $icon_value : liderban_asset( 'images/' . ltrim( $icon_value, '/' ) );
	?>
	<div class="solucao-modal-overlay" id="<?php echo esc_attr( $modal['id'] ?? '' ); ?>">
		<div class="solucao-modal">
			<button class="solucao-modal-close" type="button">&times;</button>
			<div class="solucao-modal-img">
				<img src="<?php echo esc_url( liderban_resolve_image_value( $modal['image'] ?? '' ) ); ?>" alt="<?php echo esc_attr( $modal['alt'] ?? '' ); ?>">
			</div>
			<div class="solucao-modal-content">
				<div class="solucao-modal-header">
					<img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php esc_attr_e( 'Ícone', 'liderban-theme' ); ?>" class="solucao-modal-icon">
					<h2><?php echo esc_html( $modal['title'] ?? '' ); ?></h2>
				</div>
				<p class="solucao-modal-subtitle"><strong><?php echo esc_html( $modal['subtitle'] ?? '' ); ?></strong></p>
				<ul class="solucao-modal-list">
					<?php foreach ( liderban_parse_repeater_items( $modal['items'] ?? '' ) as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="solucao-modal-cta">
					<a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="solucao-modal-btn"><?php esc_html_e( 'Contratar', 'liderban-theme' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
endforeach;
