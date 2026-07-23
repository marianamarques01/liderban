<?php
/**
 * Schemas de campos editáveis por página.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retorna todos os schemas de campos editáveis.
 *
 * @return array
 */
function liderban_get_editable_schemas() {
	return array(
		'home'       => liderban_schema_home(),
		'solucoes'   => liderban_schema_solucoes(),
		'quem-somos' => liderban_schema_quem_somos(),
		'banban'     => liderban_schema_banban(),
		'blog'       => liderban_schema_blog(),
	);
}

/**
 * Schema da Home.
 *
 * @return array
 */
function liderban_schema_home() {
	return array(
		'title'    => __( 'Conteúdo da Home', 'liderban-theme' ),
		'sections' => array(
			'hero'      => array(
				'title'  => __( 'Banner principal', 'liderban-theme' ),
				'fields' => array(
					'hero_title'      => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Liderban.' ),
					'hero_subtitle_1' => array( 'type' => 'text', 'label' => __( 'Subtítulo linha 1', 'liderban-theme' ), 'default' => 'Sua parceira estratégica em' ),
					'hero_subtitle_2' => array( 'type' => 'text', 'label' => __( 'Subtítulo linha 2', 'liderban-theme' ), 'default' => 'soluções de saneamento móvel.' ),
					'hero_slide_1'    => array( 'type' => 'image', 'label' => __( 'Imagem do slide 1', 'liderban-theme' ), 'default' => 'bg1.jpg' ),
					'hero_slide_2'    => array( 'type' => 'image', 'label' => __( 'Imagem do slide 2', 'liderban-theme' ), 'default' => 'bg2.jpg' ),
					'hero_slide_3'    => array( 'type' => 'image', 'label' => __( 'Imagem do slide 3', 'liderban-theme' ), 'default' => 'bg3.jpg' ),
				),
			),
			'water'     => array(
				'title'  => __( 'Infraestrutura invisível', 'liderban-theme' ),
				'fields' => array(
					'water_title'   => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'A infraestrutura invisível que sustenta a dignidade e a produtividade.' ),
					'water_text_1'  => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 1', 'liderban-theme' ), 'default' => 'Em áreas remotas, grandes obras de mineração, siderurgia e agronegócio, a estrutura convencional muitas vezes não acompanha a velocidade e a complexidade das operações.' ),
					'water_text_2'  => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 2 (antes do destaque)', 'liderban-theme' ), 'default' => 'É exatamente onde a infraestrutura fixa não chega que a ' ),
					'water_brand'   => array( 'type' => 'text', 'label' => __( 'Destaque em negrito', 'liderban-theme' ), 'default' => 'Liderban atua.' ),
					'water_image'   => array( 'type' => 'image', 'label' => __( 'Ilustração', 'liderban-theme' ), 'default' => 'img.svg' ),
				),
			),
			'challenge' => array(
				'title'  => __( 'Cenário desafiador', 'liderban-theme' ),
				'fields' => array(
					'challenge_overline' => array( 'type' => 'text', 'label' => __( 'Rótulo superior', 'liderban-theme' ), 'default' => 'O CENÁRIO DESAFIADOR DO BRASIL' ),
					'challenge_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Um desafio estrutural que move o nosso propósito.' ),
					'challenge_stat'     => array( 'type' => 'text', 'label' => __( 'Número em destaque', 'liderban-theme' ), 'default' => '44%' ),
					'challenge_stat_txt' => array( 'type' => 'textarea', 'label' => __( 'Texto do número', 'liderban-theme' ), 'default' => 'da população brasileira ainda não possui acesso adequado ao esgotamento sanitário.' ),
					'challenge_content'  => array( 'type' => 'textarea', 'label' => __( 'Texto explicativo', 'liderban-theme' ), 'default' => 'Esse dado representa mais do que uma estatística: é uma lacuna de infraestrutura que impacta diretamente a saúde pública, a preservação ambiental e a continuidade de operações industriais em todo o país.' ),
					'challenge_pillar_1' => array( 'type' => 'text', 'label' => __( 'Pilar 1', 'liderban-theme' ), 'default' => 'Dignidade & Bem-estar' ),
					'challenge_pillar_2' => array( 'type' => 'text', 'label' => __( 'Pilar 2', 'liderban-theme' ), 'default' => 'Segurança Operacional' ),
					'challenge_pillar_3' => array( 'type' => 'text', 'label' => __( 'Pilar 3', 'liderban-theme' ), 'default' => 'Responsabilidade Socioambiental' ),
					'challenge_quote'    => array( 'type' => 'text', 'label' => __( 'Citação final', 'liderban-theme' ), 'default' => '"Cuidar das pessoas e do meio ambiente é o que nos move."' ),
				),
			),
			'atuacao'   => array(
				'title'  => __( 'Atuação da Liderban', 'liderban-theme' ),
				'fields' => array(
					'atuacao_overline'    => array( 'type' => 'text', 'label' => __( 'Rótulo superior', 'liderban-theme' ), 'default' => 'ATUAÇÃO DA LIDERBAN' ),
					'atuacao_title'       => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => '28 anos de referência em saneamento móvel e gestão de resíduos.' ),
					'atuacao_description' => array( 'type' => 'textarea', 'label' => __( 'Descrição', 'liderban-theme' ), 'default' => 'Oferecemos soluções seguras e certificadas para o transporte e tratamento de efluentes, garantindo conformidade técnica, dignidade humana e proteção ao meio ambiente.' ),
					'atuacao_cta'         => array( 'type' => 'text', 'label' => __( 'Texto do botão', 'liderban-theme' ), 'default' => 'FALE COM NOSSO TIME →' ),
					'atuacao_image'       => array( 'type' => 'image', 'label' => __( 'Imagem lateral', 'liderban-theme' ), 'default' => 'img.jpg' ),
					'atuacao_values'      => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards de valores', 'liderban-theme' ),
						'subfields' => array(
							'number' => __( 'Número', 'liderban-theme' ),
							'title'  => __( 'Título', 'liderban-theme' ),
							'text'   => __( 'Texto', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'number' => '01', 'title' => 'Lealdade', 'text' => 'Compromisso com equipe, clientes e parceiros.' ),
							array( 'number' => '02', 'title' => 'Integridade', 'text' => 'Ética e transparência em todas as ações.' ),
							array( 'number' => '03', 'title' => 'Dedicação', 'text' => 'Empenho total no alcance de resultados.' ),
							array( 'number' => '04', 'title' => 'Responsabilidade', 'text' => 'Cuidado com pessoas e meio ambiente.' ),
						),
					),
				),
			),
			'solucoes'  => array(
				'title'  => __( 'Nossas soluções (home)', 'liderban-theme' ),
				'fields' => array(
					'solucoes_overline'  => array( 'type' => 'text', 'label' => __( 'Rótulo superior', 'liderban-theme' ), 'default' => 'NOSSAS SOLUÇÕES' ),
					'solucoes_title'     => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Inteligência operacional & infraestrutura robusta.' ),
					'solucoes_subtitle'  => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'Soluções integradas para setores complexos como mineração, siderurgia, grandes obras e agronegócio — com máxima eficiência técnica.' ),
					'solucoes_filters'   => array( 'type' => 'lines', 'label' => __( 'Filtros (um por linha)', 'liderban-theme' ), 'default' => "MINERAÇÃO\nSIDERURGIA\nGRANDES OBRAS\nAGRONEGÓCIO\nEVENTOS\nINFRAESTRUTURA" ),
					'solucoes_cards'     => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards de soluções', 'liderban-theme' ),
						'subfields' => array(
							'title' => __( 'Título', 'liderban-theme' ),
							'desc'  => __( 'Descrição', 'liderban-theme' ),
							'items' => __( 'Itens (um por linha)', 'liderban-theme' ),
						),
						'default'   => array(
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
						),
					),
					'solucoes_image_1'   => array( 'type' => 'image', 'label' => __( 'Imagem esquerda', 'liderban-theme' ), 'default' => 'img2.jpg' ),
					'solucoes_image_2'   => array( 'type' => 'image', 'label' => __( 'Imagem direita', 'liderban-theme' ), 'default' => 'img1.jpg' ),
				),
			),
			'cta'       => array(
				'title'  => __( 'Chamada para ação', 'liderban-theme' ),
				'fields' => array(
					'cta_title_1'     => array( 'type' => 'text', 'label' => __( 'Título parte 1', 'liderban-theme' ), 'default' => 'Pronto para levar' ),
					'cta_highlight'   => array( 'type' => 'text', 'label' => __( 'Destaque do título', 'liderban-theme' ), 'default' => 'excelência' ),
					'cta_title_2'     => array( 'type' => 'text', 'label' => __( 'Título parte 2', 'liderban-theme' ), 'default' => 'ao seu projeto?' ),
					'cta_text'        => array( 'type' => 'textarea', 'label' => __( 'Texto', 'liderban-theme' ), 'default' => 'Nossa equipe técnica está pronta para desenhar a solução de saneamento ideal para sua obra ou evento.' ),
					'cta_button'      => array( 'type' => 'text', 'label' => __( 'Texto do botão', 'liderban-theme' ), 'default' => 'SOLICITAR ORÇAMENTO →' ),
					'cta_phone'       => array( 'type' => 'text', 'label' => __( 'Telefone exibido', 'liderban-theme' ), 'default' => '(31) 2536-7500' ),
				),
			),
			'clientes'  => array(
				'title'  => __( 'Nossos clientes', 'liderban-theme' ),
				'fields' => array(
					'clientes_title' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Nossos Clientes' ),
					'clientes_image' => array( 'type' => 'image', 'label' => __( 'Imagem com logos', 'liderban-theme' ), 'default' => 'clients.png' ),
				),
			),
		),
	);
}

/**
 * Schema da página Serviços.
 *
 * @return array
 */
function liderban_schema_solucoes() {
	return array(
		'title'    => __( 'Conteúdo de Serviços', 'liderban-theme' ),
		'sections' => array(
			'hero'      => array(
				'title'  => __( 'Banner', 'liderban-theme' ),
				'fields' => array(
					'hero_bg' => array( 'type' => 'image', 'label' => __( 'Imagem de fundo', 'liderban-theme' ), 'default' => 'solutions_bg.jpg' ),
				),
			),
			'intro'     => array(
				'title'  => __( 'Introdução', 'liderban-theme' ),
				'fields' => array(
					'intro_title' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Soluções Estratégicas em Saneamento Móvel' ),
					'intro_lead'  => array( 'type' => 'textarea', 'label' => __( 'Texto de abertura', 'liderban-theme' ), 'default' => 'Infraestrutura robusta que garante acesso, segurança operacional e cuidado com o meio ambiente onde a estrutura convencional não chega' ),
					'intro_text'  => array( 'type' => 'textarea', 'label' => __( 'Texto completo (aceita HTML básico)', 'liderban-theme' ), 'default' => '<strong>Inteligência Operacional a Serviço do Desenvolvimento</strong> onde a velocidade das operações ou a complexidade do território exige agilidade, a Liderban atua. Nossas soluções são desenhadas para transformar desafios logísticos em <strong>continuidade operacional e bem-estar humano.</strong> Atendemos setores de alta exigência técnica, como <strong>Mineração, Siderurgia, Grandes Obras e Agronegócio</strong>, garantindo que cada projeto tenha o suporte necessário para prosperar com <strong>segurança, dignidade e sustentabilidade.</strong>' ),
				),
			),
			'cards'     => array(
				'title'  => __( 'Cards de serviços', 'liderban-theme' ),
				'fields' => array(
					'service_cards' => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards', 'liderban-theme' ),
						'subfields' => array(
							'modal' => __( 'ID do modal (não alterar)', 'liderban-theme' ),
							'image' => __( 'Imagem', 'liderban-theme' ),
							'alt'   => __( 'Texto alternativo', 'liderban-theme' ),
							'title' => __( 'Título', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'modal' => 'modal-banheiros', 'image' => 'solutions_img1.png', 'alt' => 'Banheiros Móveis', 'title' => 'Banheiros Móveis' ),
							array( 'modal' => 'modal-estruturas', 'image' => 'solutions_img2.png', 'alt' => 'Estruturas Modulares', 'title' => 'Estruturas Modulares' ),
							array( 'modal' => 'modal-transporte', 'image' => 'solutions_img3.png', 'alt' => 'Transporte', 'title' => 'Transporte' ),
							array( 'modal' => 'modal-saneamento', 'image' => 'solutions_img4.png', 'alt' => 'Saneamento', 'title' => 'Saneamento' ),
						),
					),
				),
			),
			'stats'     => array(
				'title'  => __( 'Números', 'liderban-theme' ),
				'fields' => array(
					'stats_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Nossa Solidez em Números' ),
					'stats_subtitle' => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'A confiança depositada por grandes players do mercado é sustentada por uma capacidade de entrega comprovada.' ),
					'stats_items'    => array(
						'type'      => 'repeater',
						'label'     => __( 'Estatísticas', 'liderban-theme' ),
						'subfields' => array(
							'highlight' => __( 'Destaque', 'liderban-theme' ),
							'text'      => __( 'Texto complementar', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'highlight' => '+ de 30.000 ordens de serviço por mês', 'text' => ' atestando nossa eficiência e compromisso com a qualidade.' ),
							array( 'highlight' => 'Sistema de gestão automatizado:', 'text' => ' Rastreabilidade simplificada de cada serviço prestado e dashboards atualizados em tempo real.' ),
							array( 'highlight' => 'Frota de + de 120 veículos ativos', 'text' => ', garantindo agilidade, cobertura operacional e pronta resposta aos nossos clientes.' ),
						),
					),
				),
			),
			'expertise' => array(
				'title'  => __( 'Especialistas', 'liderban-theme' ),
				'fields' => array(
					'expertise_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Especialistas em Desafios Complexos' ),
					'expertise_subtitle' => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'Nossa inteligência operacional é voltada para setores que exigem previsibilidade e segurança técnica:' ),
					'expertise_sectors'  => array( 'type' => 'lines', 'label' => __( 'Setores (um por linha)', 'liderban-theme' ), 'default' => "Mineração: Nosso principal cluster estratégico\nSiderurgia e Energia\nGrandes Obras de Infraestrutura\nAgronegócio e Operações Logísticas\nEventos de Grande Porte através da Banban, empresa do grupo especializada em eventos." ),
					'expertise_cta_text' => array( 'type' => 'text', 'label' => __( 'Texto do CTA', 'liderban-theme' ), 'default' => 'Leve o padrão Liderban para sua operação.' ),
					'expertise_cta_btn'  => array( 'type' => 'text', 'label' => __( 'Botão do CTA', 'liderban-theme' ), 'default' => 'FALAR COM UM CONSULTOR ESTRATÉGICO' ),
				),
			),
			'modals'    => array(
				'title'  => __( 'Modais (detalhes dos serviços)', 'liderban-theme' ),
				'fields' => array(
					'modals_data' => array(
						'type'      => 'repeater',
						'label'     => __( 'Modais', 'liderban-theme' ),
						'subfields' => array(
							'id'       => __( 'ID (não alterar)', 'liderban-theme' ),
							'image'    => __( 'Imagem', 'liderban-theme' ),
							'alt'      => __( 'Texto alternativo', 'liderban-theme' ),
							'icon'     => __( 'Ícone (nome do arquivo)', 'liderban-theme' ),
							'title'    => __( 'Título', 'liderban-theme' ),
							'subtitle' => __( 'Subtítulo', 'liderban-theme' ),
							'items'    => __( 'Itens (um por linha)', 'liderban-theme' ),
							'whatsapp' => __( 'Mensagem do WhatsApp', 'liderban-theme' ),
						),
						'default'   => array(
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
						),
					),
				),
			),
		),
	);
}

/**
 * Schema da página Quem Somos.
 *
 * @return array
 */
function liderban_schema_quem_somos() {
	return array(
		'title'    => __( 'Conteúdo de Quem Somos', 'liderban-theme' ),
		'sections' => array(
			'hero'      => array(
				'title'  => __( 'Banner', 'liderban-theme' ),
				'fields' => array(
					'hero_bg' => array( 'type' => 'image', 'label' => __( 'Imagem de fundo', 'liderban-theme' ), 'default' => 'quemsomos_bg.jpg' ),
				),
			),
			'intro'     => array(
				'title'  => __( 'Introdução', 'liderban-theme' ),
				'fields' => array(
					'intro_label'   => array( 'type' => 'text', 'label' => __( 'Rótulo', 'liderban-theme' ), 'default' => 'Quem Somos' ),
					'intro_heading' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Liderança, Propósito e Infraestrutura Essencial' ),
					'intro_text_1'  => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 1', 'liderban-theme' ), 'default' => 'A Liderban nasceu do propósito de fazer diferente, levando dignidade, cuidado e respeito a cada ambiente onde atua. Somos uma empresa líder em saneamento móvel, com expertise consolidada em ambientes de alta criticidade, onde a estrutura convencional não chega ou não acompanha a velocidade das operações.' ),
					'intro_text_2'  => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 2', 'liderban-theme' ), 'default' => 'Acreditamos que o nosso trabalho transforma realidades e que cada ação conta para o bem comum.' ),
					'pillar_1_title' => array( 'type' => 'text', 'label' => __( 'Pilar laranja — título', 'liderban-theme' ), 'default' => 'O que nos move' ),
					'pillar_1_text'  => array( 'type' => 'textarea', 'label' => __( 'Pilar laranja — texto', 'liderban-theme' ), 'default' => 'Atuamos no território da infraestrutura essencial, impactando pessoas, cidades e a produtividade de diferentes setores. Nosso papel é conectar acesso à higiene, saúde e proteção ambiental, garantindo a continuidade operacional de nossos parceiros através de inteligência estratégica e visão sistêmica.' ),
					'pillar_2_title' => array( 'type' => 'text', 'label' => __( 'Pilar azul — título', 'liderban-theme' ), 'default' => 'Nossa Solidez Operacional' ),
					'pillar_2_text'  => array( 'type' => 'textarea', 'label' => __( 'Pilar azul — texto', 'liderban-theme' ), 'default' => 'Com quase três décadas de história, e um crescimento médio consolidado de 15% ao ano, transformamos desafios complexos em resultados mensuráveis.' ),
					'intro_image'    => array( 'type' => 'image', 'label' => __( 'Imagem lateral', 'liderban-theme' ), 'default' => 'quemsomos_img.jpg' ),
				),
			),
			'estrategia' => array(
				'title'  => __( 'Estratégia', 'liderban-theme' ),
				'fields' => array(
					'estrategia_title'  => array( 'type' => 'text', 'label' => __( 'Título da seção', 'liderban-theme' ), 'default' => 'Nossa Estratégia de Futuro' ),
					'missao_tag'        => array( 'type' => 'text', 'label' => __( 'Tag missão', 'liderban-theme' ), 'default' => 'Missão' ),
					'missao_text'       => array( 'type' => 'textarea', 'label' => __( 'Texto missão', 'liderban-theme' ), 'default' => 'Ser uma empresa sólida e saudável, capaz de gerar valor de longo prazo para a comunidade, colaboradores e sócios.' ),
					'visao_tag'         => array( 'type' => 'text', 'label' => __( 'Tag visão', 'liderban-theme' ), 'default' => 'Visão 2028' ),
					'visao_text'        => array( 'type' => 'textarea', 'label' => __( 'Texto visão', 'liderban-theme' ), 'default' => 'Ser a maior empresa de saneamento móvel do país, tornando-se a referência máxima em qualidade, confiança e sustentabilidade' ),
				),
			),
			'valores'   => array(
				'title'  => __( 'Valores', 'liderban-theme' ),
				'fields' => array(
					'valores_title' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Nossos Valores' ),
					'valores_items' => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards de valores', 'liderban-theme' ),
						'subfields' => array(
							'title' => __( 'Título', 'liderban-theme' ),
							'text'  => __( 'Texto', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'title' => 'Lealdade', 'text' => 'Compromisso e respeito com nossa equipe, clientes e parceiros.' ),
							array( 'title' => 'Integridade', 'text' => 'Ética e transparência absoluta em todas as ações.' ),
							array( 'title' => 'Comprometimento', 'text' => 'Empenho total no alcance de resultados com qualidade superior.' ),
							array( 'title' => 'Dedicação', 'text' => 'Busca incessante pelo aprimoramento de processos e serviços.' ),
							array( 'title' => 'Responsabilidade social e ambiental', 'text' => 'Atuação sustentável, cuidando das pessoas e preservando o meio ambiente.' ),
							array( 'title' => 'Espírito de equipe', 'text' => 'Colaboração mútua para superar os desafios mais complexos.' ),
							array( 'title' => 'Segurança', 'text' => 'Garantia da integridade física e do bem-estar em cada operação.' ),
							array( 'title' => 'Excelência', 'text' => 'Busca constante pela superação de expectativas e qualidade superior em cada entrega.' ),
						),
					),
				),
			),
			'timeline'  => array(
				'title'  => __( 'Linha do tempo', 'liderban-theme' ),
				'fields' => array(
					'timeline_title' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Grandes marcos da nossa história' ),
					'timeline_items' => array(
						'type'      => 'repeater',
						'label'     => __( 'Marcos', 'liderban-theme' ),
						'subfields' => array(
							'year'  => __( 'Ano', 'liderban-theme' ),
							'text'  => __( 'Descrição', 'liderban-theme' ),
							'align' => __( 'Posição (top ou bottom)', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'year' => '1997', 'text' => 'Início das atividades atendendo eventos e grandes produções.', 'align' => 'top' ),
							array( 'year' => '2004', 'text' => 'Entrada no setor de mineração eleva o nível de exigência operacional e logística.', 'align' => 'bottom' ),
							array( 'year' => '2012', 'text' => 'Expansão nacional com o primeiro ponto de apoio fora de Minas Gerais.', 'align' => 'top' ),
							array( 'year' => '2014', 'text' => 'Transição da marca Loc-ban para Liderban.', 'align' => 'bottom' ),
							array( 'year' => '2019', 'text' => 'Crescimento de 70% impulsionado por novos contratos e planejamento estratégico.', 'align' => 'top' ),
							array( 'year' => '2021', 'text' => 'Consolidação da gestão com inteligência, tecnologia e foco em produtividade.', 'align' => 'bottom' ),
							array( 'year' => '2024', 'text' => 'Reestruturação organizacional e novos pontos de apoio.', 'align' => 'top' ),
						),
					),
				),
			),
			'statement' => array(
				'title'  => __( 'Declaração final', 'liderban-theme' ),
				'fields' => array(
					'statement_1' => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 1', 'liderban-theme' ), 'default' => 'Nem toda infraestrutura é visível, mas é ela que sustenta a produtividade e a segurança de milhares de pessoas todos os dias.' ),
					'statement_2' => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 2', 'liderban-theme' ), 'default' => 'Nosso compromisso é promover condições de trabalho humanizadas e a preservação dos recursos naturais, gerando qualidade de vida e bem-estar para a sociedade.' ),
					'statement_3' => array( 'type' => 'text', 'label' => __( 'Frase de destaque', 'liderban-theme' ), 'default' => 'Liderban. Cuidar das pessoas e do meio ambiente é o que nos move.' ),
				),
			),
		),
	);
}

/**
 * Schema da página BanBan.
 *
 * @return array
 */
function liderban_schema_banban() {
	return array(
		'title'    => __( 'Conteúdo do BanBan', 'liderban-theme' ),
		'sections' => array(
			'hero'    => array(
				'title'  => __( 'Banner', 'liderban-theme' ),
				'fields' => array(
					'hero_bg' => array( 'type' => 'image', 'label' => __( 'Imagem de fundo', 'liderban-theme' ), 'default' => 'banban_bg.png' ),
				),
			),
			'intro'   => array(
				'title'  => __( 'Introdução', 'liderban-theme' ),
				'fields' => array(
					'intro_title'      => array( 'type' => 'text', 'label' => __( 'Título parte 1', 'liderban-theme' ), 'default' => 'BanBan:' ),
					'intro_title_span' => array( 'type' => 'text', 'label' => __( 'Título parte 2 (destaque)', 'liderban-theme' ), 'default' => 'Estrutura que faz acontecer.' ),
					'intro_text_1'     => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 1', 'liderban-theme' ), 'default' => 'Com uma personalidade moderna e resolutiva, a BanBan é a empresa do grupo especializada em eventos, com foco em viabilizar bem-estar ao usuário e o funcionamento de grandes eventos e áreas urbanas.' ),
					'intro_text_2'     => array( 'type' => 'textarea', 'label' => __( 'Parágrafo 2 (antes do negrito)', 'liderban-theme' ), 'default' => 'Somos a infraestrutura invisível que garante' ),
					'intro_highlight'  => array( 'type' => 'text', 'label' => __( 'Destaque em negrito', 'liderban-theme' ), 'default' => 'segurança, conforto e eficiência.' ),
					'intro_logo'       => array( 'type' => 'image', 'label' => __( 'Logo BanBan', 'liderban-theme' ), 'default' => 'banban.png' ),
				),
			),
			'servicos' => array(
				'title'  => __( 'O que fazemos', 'liderban-theme' ),
				'fields' => array(
					'servicos_label'    => array( 'type' => 'text', 'label' => __( 'Rótulo', 'liderban-theme' ), 'default' => 'Nossas soluções' ),
					'servicos_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'O que fazemos' ),
					'servicos_subtitle' => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'Entregamos agilidade e soluções completas que vão além do básico.' ),
					'servicos_items'    => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards de serviços', 'liderban-theme' ),
						'subfields' => array(
							'icon'  => __( 'Ícone (calendar, building ou emergency)', 'liderban-theme' ),
							'title' => __( 'Título', 'liderban-theme' ),
							'text'  => __( 'Texto', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'icon' => 'calendar', 'title' => 'Eventos e Festivais', 'text' => 'Gestão integral de banheiros móveis, logística e higienização para shows e arenas esportivas, bem como lavagem de pátios e vias.' ),
							array( 'icon' => 'building', 'title' => 'Infraestrutura Urbana', 'text' => 'Atendimento a condomínios e centros comerciais com serviços de manutenção sanitária e limpeza de fossas.' ),
							array( 'icon' => 'emergency', 'title' => 'Soluções de Emergência', 'text' => 'Abastecimento ágil com caminhão-pipa e tratamento especializado de resíduos.' ),
						),
					),
				),
			),
			'eventos' => array(
				'title'  => __( 'Eventos', 'liderban-theme' ),
				'fields' => array(
					'eventos_label'    => array( 'type' => 'text', 'label' => __( 'Rótulo', 'liderban-theme' ), 'default' => 'Onde a BanBan já esteve' ),
					'eventos_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Eventos que confiam na gente' ),
					'eventos_text'     => array( 'type' => 'textarea', 'label' => __( 'Texto introdutório', 'liderban-theme' ), 'default' => 'A realização de um grande evento exige planejamento, sincronia e atenção aos detalhes. A BanBan entrega equipamentos de qualidade e soluções completas para uma experiência funcional e confortável.' ),
					'eventos_items'    => array(
						'type'      => 'repeater',
						'label'     => __( 'Cards de eventos', 'liderban-theme' ),
						'subfields' => array(
							'image' => __( 'Imagem', 'liderban-theme' ),
							'label' => __( 'Categoria', 'liderban-theme' ),
							'title' => __( 'Nome do evento', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'image' => 'banban1.png', 'label' => 'Festival de rua', 'title' => 'Carnaval de BH' ),
							array( 'image' => 'banban2.png', 'label' => 'Eventos esportivos', 'title' => 'Jogos no Mineirão' ),
							array( 'image' => 'banban3.png', 'label' => 'Festa popular', 'title' => 'Arraiá do Belô' ),
							array( 'image' => 'banban4.png', 'label' => 'Show nacional', 'title' => 'Festival Sertanejo' ),
							array( 'image' => 'banban5.png', 'label' => 'Show internacional', 'title' => 'Imagine Dragons' ),
						),
					),
				),
			),
			'cta'     => array(
				'title'  => __( 'Chamada para ação', 'liderban-theme' ),
				'fields' => array(
					'cta_title_1' => array( 'type' => 'text', 'label' => __( 'Título parte 1', 'liderban-theme' ), 'default' => 'Solicite uma' ),
					'cta_title_2' => array( 'type' => 'text', 'label' => __( 'Título parte 2 (destaque)', 'liderban-theme' ), 'default' => 'solução completa' ),
					'cta_text'    => array( 'type' => 'textarea', 'label' => __( 'Texto', 'liderban-theme' ), 'default' => 'Fale com nossos consultores e garanta uma solução customizada de acordo com a sua necessidade.' ),
					'cta_button'  => array( 'type' => 'text', 'label' => __( 'Texto do botão', 'liderban-theme' ), 'default' => 'SOLICITAR UMA SOLUÇÃO COMPLETA →' ),
				),
			),
		),
	);
}

/**
 * Schema da página Blog.
 *
 * @return array
 */
function liderban_schema_blog() {
	return array(
		'title'    => __( 'Conteúdo do Blog', 'liderban-theme' ),
		'sections' => array(
			'hero'          => array(
				'title'  => __( 'Banner', 'liderban-theme' ),
				'fields' => array(
					'hero_bg' => array( 'type' => 'image', 'label' => __( 'Imagem de fundo', 'liderban-theme' ), 'default' => 'clientes_bg.jpg' ),
				),
			),
			'midia'         => array(
				'title'  => __( 'Seção Na mídia', 'liderban-theme' ),
				'fields' => array(
					'midia_label'    => array( 'type' => 'text', 'label' => __( 'Rótulo', 'liderban-theme' ), 'default' => 'Imprensa' ),
					'midia_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Liderban na mídia' ),
					'midia_subtitle' => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'Confira matérias e reportagens sobre nossa atuação em saneamento, eventos e infraestrutura.' ),
				),
			),
			'conformidades' => array(
				'title'  => __( 'Conformidades técnicas', 'liderban-theme' ),
				'fields' => array(
					'conf_label'    => array( 'type' => 'text', 'label' => __( 'Rótulo', 'liderban-theme' ), 'default' => 'Normas e certificações' ),
					'conf_title'    => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Conformidades técnicas e normas' ),
					'conf_subtitle' => array( 'type' => 'textarea', 'label' => __( 'Subtítulo', 'liderban-theme' ), 'default' => 'Nossas soluções seguem rigorosamente as normas regulamentadoras e padrões técnicos do setor.' ),
					'conf_items'    => array(
						'type'      => 'repeater',
						'label'     => __( 'Normas', 'liderban-theme' ),
						'subfields' => array(
							'tag'         => __( 'Sigla', 'liderban-theme' ),
							'title'       => __( 'Título', 'liderban-theme' ),
							'description' => __( 'Descrição', 'liderban-theme' ),
							'icon'        => __( 'Ícone (construction, sanitary, accessibility ou environment)', 'liderban-theme' ),
						),
						'default'   => array(
							array( 'tag' => 'NR 18', 'title' => 'Condições e Meio Ambiente de Trabalho na Indústria da Construção', 'description' => 'Equipamentos e instalações sanitárias móveis em conformidade com exigências de canteiros de obras e infraestrutura.', 'icon' => 'construction' ),
							array( 'tag' => 'NR 24', 'title' => 'Condições Sanitárias e de Conforto nos Locais de Trabalho', 'description' => 'Banheiros químicos, lavatórios e vestiários dimensionados para garantir higiene e bem-estar operacional.', 'icon' => 'sanitary' ),
							array( 'tag' => 'NBR 9050', 'title' => 'Acessibilidade a Edificações, Mobiliário e Espaços Urbanos', 'description' => 'Soluções adaptadas para garantir acesso digno e inclusivo em eventos, obras e áreas de apoio.', 'icon' => 'accessibility' ),
							array( 'tag' => 'ISO 14001', 'title' => 'Sistema de Gestão Ambiental', 'description' => 'Processos de coleta, transporte e destinação de efluentes alinhados a práticas de gestão ambiental.', 'icon' => 'environment' ),
						),
					),
					'conf_cta_title' => array( 'type' => 'text', 'label' => __( 'CTA — título', 'liderban-theme' ), 'default' => 'Precisa de documentação técnica?' ),
					'conf_cta_text'  => array( 'type' => 'textarea', 'label' => __( 'CTA — texto', 'liderban-theme' ), 'default' => 'Solicite fichas técnicas, laudos e certificados de conformidade para o seu projeto ou obra.' ),
					'conf_cta_btn'   => array( 'type' => 'text', 'label' => __( 'CTA — botão', 'liderban-theme' ), 'default' => 'SOLICITAR DOCUMENTOS →' ),
				),
			),
		),
	);
}

/**
 * Schema de configurações globais.
 *
 * @return array
 */
function liderban_schema_global() {
	return array(
		'title'    => __( 'Conteúdo global do site', 'liderban-theme' ),
		'sections' => array(
			'contato' => array(
				'title'  => __( 'Contato e rodapé', 'liderban-theme' ),
				'fields' => array(
					'footer_contact_title' => array( 'type' => 'text', 'label' => __( 'Título "Fale conosco"', 'liderban-theme' ), 'default' => 'Fale conosco' ),
					'footer_contact_info'  => array( 'type' => 'text', 'label' => __( 'Telefone e horário', 'liderban-theme' ), 'default' => '(31) 2536-7500 | Seg - Sex: 7h - 17h' ),
					'whatsapp_number'      => array( 'type' => 'text', 'label' => __( 'WhatsApp (apenas números)', 'liderban-theme' ), 'default' => '553125367500' ),
				),
			),
			'erro404' => array(
				'title'  => __( 'Página 404', 'liderban-theme' ),
				'fields' => array(
					'error_title' => array( 'type' => 'text', 'label' => __( 'Título', 'liderban-theme' ), 'default' => 'Página não encontrada' ),
					'error_text'  => array( 'type' => 'textarea', 'label' => __( 'Mensagem', 'liderban-theme' ), 'default' => 'O endereço que você acessou não existe ou foi movido.' ),
					'error_btn'   => array( 'type' => 'text', 'label' => __( 'Botão voltar', 'liderban-theme' ), 'default' => 'VOLTAR PARA A HOME →' ),
				),
			),
		),
	);
}

/**
 * Retorna todos os campos de um schema achatados.
 *
 * @param string $schema_key Chave do schema.
 * @return array
 */
function liderban_get_schema_fields( $schema_key ) {
	if ( 'global' === $schema_key ) {
		$schema = liderban_schema_global();
	} else {
		$schemas = liderban_get_editable_schemas();
		$schema  = isset( $schemas[ $schema_key ] ) ? $schemas[ $schema_key ] : array();
	}

	$fields = array();

	if ( empty( $schema['sections'] ) ) {
		return $fields;
	}

	foreach ( $schema['sections'] as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			$fields[ $key ] = $field;
		}
	}

	return $fields;
}
