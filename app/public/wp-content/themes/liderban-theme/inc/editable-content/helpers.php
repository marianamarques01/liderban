<?php
/**
 * Funções auxiliares para conteúdo editável das páginas.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retorna o ID da página cujo conteúdo deve ser lido no front.
 *
 * @return int
 */
function liderban_get_editable_page_id() {
	if ( is_front_page() ) {
		return (int) get_option( 'page_on_front' );
	}

	if ( is_home() && ! is_front_page() ) {
		$blog_page_id = (int) get_option( 'page_for_posts' );

		if ( $blog_page_id ) {
			return $blog_page_id;
		}
	}

	$queried_id = get_queried_object_id();

	return $queried_id ? (int) $queried_id : 0;
}

/**
 * Retorna a chave do schema de campos para uma página.
 *
 * @param int $post_id ID da página.
 * @return string|null
 */
function liderban_get_page_schema_key( $post_id ) {
	$post_id = (int) $post_id;

	if ( ! $post_id ) {
		return null;
	}

	if ( (int) get_option( 'page_on_front' ) === $post_id ) {
		return 'home';
	}

	if ( (int) get_option( 'page_for_posts' ) === $post_id ) {
		return 'blog';
	}

	$template = get_post_meta( $post_id, '_wp_page_template', true );
	$map      = array(
		'page-solucoes.php'   => 'solucoes',
		'page-quem-somos.php' => 'quem-somos',
		'page-banban.php'     => 'banban',
		'page-blog.php'       => 'blog',
	);

	if ( isset( $map[ $template ] ) ) {
		return $map[ $template ];
	}

	$post = get_post( $post_id );

	if ( ! $post ) {
		return null;
	}

	$slug_map = array(
		'solucoes'   => 'solucoes',
		'quem-somos' => 'quem-somos',
		'banban'     => 'banban',
		'blog'       => 'blog',
		'home'       => 'home',
	);

	if ( isset( $slug_map[ $post->post_name ] ) ) {
		return $slug_map[ $post->post_name ];
	}

	return null;
}

/**
 * Retorna o valor salvo de um campo ou o default.
 *
 * @param string $key     Chave do campo.
 * @param mixed  $default Valor padrão.
 * @param int    $post_id ID da página (opcional).
 * @return mixed
 */
function liderban_field( $key, $default = '', $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : liderban_get_editable_page_id();

	if ( ! $post_id ) {
		return $default;
	}

	$value = get_post_meta( $post_id, '_liderban_' . $key, true );

	if ( '' === $value || null === $value ) {
		return $default;
	}

	return $value;
}

/**
 * Retorna URL de imagem (biblioteca de mídia ou asset do tema).
 *
 * @param string $key           Chave do campo de imagem.
 * @param string $default_asset Caminho relativo em assets/images/.
 * @param int    $post_id       ID da página (opcional).
 * @return string
 */
function liderban_image( $key, $default_asset = '', $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : liderban_get_editable_page_id();

	if ( $post_id ) {
		$attachment_id = (int) get_post_meta( $post_id, '_liderban_' . $key . '_id', true );

		if ( $attachment_id ) {
			$url = wp_get_attachment_image_url( $attachment_id, 'full' );

			if ( $url ) {
				return $url;
			}
		}
	}

	$custom_url = liderban_field( $key, '', $post_id );

	if ( $custom_url ) {
		return $custom_url;
	}

	if ( $default_asset ) {
		return liderban_asset( 'images/' . ltrim( $default_asset, '/' ) );
	}

	return '';
}

/**
 * Retorna itens de um repeater salvo como JSON.
 *
 * @param string $key      Chave do campo.
 * @param array  $defaults Itens padrão.
 * @param int    $post_id  ID da página (opcional).
 * @return array
 */
function liderban_repeater( $key, $defaults = array(), $post_id = 0 ) {
	$raw = liderban_field( $key, '', $post_id );

	if ( ! $raw ) {
		return $defaults;
	}

	$decoded = json_decode( $raw, true );

	if ( ! is_array( $decoded ) || empty( $decoded ) ) {
		return $defaults;
	}

	return $decoded;
}

/**
 * Converte textarea (um item por linha) em array.
 *
 * @param string $key      Chave do campo.
 * @param array  $defaults Itens padrão.
 * @param int    $post_id  ID da página (opcional).
 * @return array
 */
function liderban_lines( $key, $defaults = array(), $post_id = 0 ) {
	$raw = liderban_field( $key, '', $post_id );

	if ( ! $raw ) {
		return $defaults;
	}

	$lines = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $raw ) ) ) );

	return ! empty( $lines ) ? array_values( $lines ) : $defaults;
}

/**
 * Retorna valor de configuração global do tema.
 *
 * @param string $key     Chave.
 * @param mixed  $default Valor padrão.
 * @return mixed
 */
function liderban_option( $key, $default = '' ) {
	$options = get_option( 'liderban_global_content', array() );

	if ( ! is_array( $options ) ) {
		return $default;
	}

	return isset( $options[ $key ] ) && '' !== $options[ $key ] ? $options[ $key ] : $default;
}
