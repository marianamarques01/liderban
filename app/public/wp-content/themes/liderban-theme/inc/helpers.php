<?php
/**
 * Funções auxiliares do tema.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retorna a URL de um asset do tema.
 *
 * @param string $path Caminho relativo dentro de assets/ (ex: images/logo.png).
 * @return string
 */
function liderban_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Retorna o caminho absoluto de um asset do tema.
 *
 * @param string $path Caminho relativo dentro de assets/.
 * @return string
 */
function liderban_asset_path( $path ) {
	$resolved = realpath( get_template_directory() . '/assets/' . ltrim( $path, '/' ) );

	return $resolved ? $resolved : get_template_directory() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Retorna versão baseada no filemtime para cache bust.
 *
 * @param string $file_path Caminho absoluto do arquivo.
 * @return string
 */
function liderban_asset_version( $file_path ) {
	return file_exists( $file_path ) ? (string) filemtime( $file_path ) : wp_get_theme()->get( 'Version' );
}
