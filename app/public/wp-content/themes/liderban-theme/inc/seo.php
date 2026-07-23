<?php
/**
 * SEO — meta tags, Open Graph, Twitter Cards e JSON-LD.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retorna metadados SEO da página atual.
 *
 * @return array {
 *     @type string $title       Título social.
 *     @type string $description Meta description.
 *     @type string $url         URL canônica.
 *     @type string $type        og:type.
 *     @type string $image       URL da imagem social.
 * }
 */
function liderban_get_seo_meta() {
	$site_name = get_bloginfo( 'name' );
	$defaults  = array(
		'title'       => $site_name,
		'description' => __( 'Liderban - Soluções de saneamento móvel e gestão de resíduos. Banheiros móveis, estruturas modulares, transporte e higienização. Mais de 28 anos de experiência.', 'liderban-theme' ),
		'url'         => liderban_get_canonical_url(),
		'type'        => 'website',
		'image'       => liderban_asset( 'images/logo.png' ),
	);

	if ( is_front_page() ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Liderban - Soluções Ambientais e Saneamento', 'liderban-theme' ),
				'description' => $defaults['description'],
				'image'       => liderban_asset( 'images/bg1.jpg' ),
			)
		);
	}

	if ( is_page( 'solucoes' ) ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Serviços - Liderban', 'liderban-theme' ),
				'description' => __( 'Banheiros móveis, estruturas modulares, transporte de efluentes e saneamento. Conheça as soluções completas da Liderban para obras, eventos e indústria.', 'liderban-theme' ),
				'image'       => liderban_asset( 'images/solutions_bg.jpg' ),
			)
		);
	}

	if ( is_page( 'quem-somos' ) ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Quem Somos - Liderban', 'liderban-theme' ),
				'description' => __( 'Conheça a Liderban: mais de 28 anos de experiência em saneamento móvel, gestão de resíduos e soluções ambientais em Minas Gerais e todo o Brasil.', 'liderban-theme' ),
				'image'       => liderban_asset( 'images/quemsomos_bg.jpg' ),
			)
		);
	}

	if ( is_page( 'banban' ) ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'BanBan - Liderban', 'liderban-theme' ),
				'description' => __( 'BanBan by Liderban: banheiros móveis e soluções sanitárias para eventos, festivais, obras e emergências. Higienização, logística e atendimento especializado.', 'liderban-theme' ),
				'image'       => liderban_asset( 'images/banban_bg.png' ),
			)
		);
	}

	if ( is_home() || is_page( 'blog' ) ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Blog - Liderban', 'liderban-theme' ),
				'description' => __( 'Notícias, novidades e conteúdos sobre saneamento móvel, eventos, obras e sustentabilidade. Acompanhe o blog da Liderban.', 'liderban-theme' ),
				'image'       => liderban_asset( 'images/clientes_bg.jpg' ),
			)
		);
	}

	if ( is_post_type_archive( 'liderban_imprensa' ) ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Liderban na mídia', 'liderban-theme' ),
				'description' => __( 'Matérias de imprensa e cobertura jornalística sobre a Liderban: saneamento móvel, eventos, obras e soluções ambientais.', 'liderban-theme' ),
				'image'       => liderban_asset( 'images/clientes_bg.jpg' ),
			)
		);
	}

	if ( is_search() ) {
		$query = get_search_query();

		return array_merge(
			$defaults,
			array(
				'title'       => $query
					? sprintf(
						/* translators: %s: search query */
						__( 'Busca: %s - Liderban', 'liderban-theme' ),
						$query
					)
					: __( 'Busca - Liderban', 'liderban-theme' ),
				'description' => $query
					? sprintf(
						/* translators: %s: search query */
						__( 'Resultados da busca por "%s" no blog da Liderban.', 'liderban-theme' ),
						$query
					)
					: __( 'Pesquisar notícias e conteúdos no blog da Liderban.', 'liderban-theme' ),
			)
		);
	}

	if ( is_singular( 'post' ) ) {
		$post_id     = get_the_ID();
		$description = has_excerpt( $post_id )
			? wp_strip_all_tags( get_the_excerpt( $post_id ) )
			: wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 28, '…' );
		$image       = get_the_post_thumbnail_url( $post_id, 'large' );

		return array_merge(
			$defaults,
			array(
				'title'       => get_the_title( $post_id ) . ' - ' . $site_name,
				'description' => $description ? $description : $defaults['description'],
				'type'        => 'article',
				'image'       => $image ? $image : liderban_asset( 'images/clientes_bg.jpg' ),
			)
		);
	}

	if ( is_singular() ) {
		$post_id     = get_the_ID();
		$description = has_excerpt( $post_id )
			? wp_strip_all_tags( get_the_excerpt( $post_id ) )
			: wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 28, '…' );

		return array_merge(
			$defaults,
			array(
				'title'       => get_the_title( $post_id ) . ' - ' . $site_name,
				'description' => $description ? $description : $defaults['description'],
			)
		);
	}

	if ( is_404() ) {
		return array_merge(
			$defaults,
			array(
				'title'       => __( 'Página não encontrada - Liderban', 'liderban-theme' ),
				'description' => __( 'A página que você procura não foi encontrada. Volte para a home da Liderban.', 'liderban-theme' ),
			)
		);
	}

	return $defaults;
}

/**
 * URL canônica da requisição atual.
 *
 * @return string
 */
function liderban_get_canonical_url() {
	if ( is_singular() ) {
		return get_permalink();
	}

	if ( is_front_page() ) {
		return home_url( '/' );
	}

	if ( is_home() ) {
		return liderban_get_blog_url();
	}

	if ( is_search() ) {
		return get_search_link( get_search_query( false ) );
	}

	if ( is_page() ) {
		return get_permalink( get_queried_object_id() );
	}

	if ( is_post_type_archive( 'liderban_imprensa' ) ) {
		return liderban_get_imprensa_archive_url();
	}

	return home_url( '/' );
}

/**
 * Imprime meta tags básicas, Open Graph e Twitter Cards.
 */
function liderban_output_seo_meta_tags() {
	$meta = liderban_get_seo_meta();

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $meta['url'] ) );

	printf( '<meta property="og:locale" content="pt_BR">' . "\n" );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $meta['type'] ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $meta['title'] ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $meta['url'] ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $meta['image'] ) );

	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $meta['title'] ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $meta['image'] ) );
}
add_action( 'wp_head', 'liderban_output_seo_meta_tags', 1 );

/**
 * Imprime JSON-LD (Organization + Article quando aplicável).
 */
function liderban_output_schema_json_ld() {
	$meta  = liderban_get_seo_meta();
	$graph = array(
		array(
			'@type'           => 'Organization',
			'@id'             => home_url( '/#organization' ),
			'name'            => 'Liderban',
			'url'             => home_url( '/' ),
			'logo'            => liderban_asset( 'images/logo.png' ),
			'telephone'       => '+55-31-2536-7500',
			'contactPoint'    => array(
				'@type'       => 'ContactPoint',
				'telephone'   => '+55-31-2536-7500',
				'contactType' => 'customer service',
				'areaServed'  => 'BR',
				'availableLanguage' => 'Portuguese',
			),
			'sameAs'          => array(
				'https://www.instagram.com/liderban/',
			),
		),
		array(
			'@type'           => 'WebSite',
			'@id'             => home_url( '/#website' ),
			'url'             => home_url( '/' ),
			'name'            => get_bloginfo( 'name' ),
			'publisher'       => array( '@id' => home_url( '/#organization' ) ),
			'inLanguage'      => 'pt-BR',
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => home_url( '/?s={search_term_string}' ),
				'query-input' => 'required name=search_term_string',
			),
		),
	);

	if ( is_singular( 'post' ) ) {
		$post_id = get_the_ID();
		$graph[] = array(
			'@type'            => 'Article',
			'@id'              => get_permalink( $post_id ) . '#article',
			'headline'         => get_the_title( $post_id ),
			'description'      => $meta['description'],
			'datePublished'    => get_the_date( 'c', $post_id ),
			'dateModified'     => get_the_modified_date( 'c', $post_id ),
			'mainEntityOfPage' => get_permalink( $post_id ),
			'image'            => $meta['image'],
			'author'           => array(
				'@type' => 'Organization',
				'name'  => 'Liderban',
			),
			'publisher'        => array( '@id' => home_url( '/#organization' ) ),
			'inLanguage'       => 'pt-BR',
		);
	}

	$payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'liderban_output_schema_json_ld', 20 );

/**
 * Ajusta o título do documento em páginas estáticas do tema.
 *
 * @param array $parts Partes do título.
 * @return array
 */
function liderban_document_title_parts( $parts ) {
	$meta = liderban_get_seo_meta();

	if ( ! empty( $meta['title'] ) ) {
		$parts['title'] = $meta['title'];
		unset( $parts['tagline'], $parts['site'] );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'liderban_document_title_parts' );
