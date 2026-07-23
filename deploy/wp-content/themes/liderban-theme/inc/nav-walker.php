<?php
/**
 * Walker de menu sem listas (paridade com HTML).
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renderiza itens de menu como links diretos, sem ul/li.
 */
class Liderban_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Início de submenu — ignorado (menu flat).
	 *
	 * @param string $output Saída HTML.
	 * @param int    $depth  Profundidade.
	 * @param object $args   Argumentos do menu.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Fim de submenu — ignorado.
	 *
	 * @param string $output Saída HTML.
	 * @param int    $depth  Profundidade.
	 * @param object $args   Argumentos do menu.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Item do menu como link.
	 *
	 * @param string $output Saída HTML.
	 * @param object $item   Item do menu.
	 * @param int    $depth  Profundidade.
	 * @param object $args   Argumentos do menu.
	 * @param int    $id     ID do item.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$atts = array(
			'href' => ! empty( $item->url ) ? $item->url : '',
		);

		if ( ! empty( $item->target ) ) {
			$atts['target'] = $item->target;
		}

		if ( ! empty( $item->xfn ) ) {
			$atts['rel'] = $item->xfn;
		}

		$attributes = '';

		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
			}
		}

		$output .= '<a' . $attributes . '>' . esc_html( $item->title ) . '</a>';
	}

	/**
	 * Fim do item — ignorado.
	 *
	 * @param string $output Saída HTML.
	 * @param object $item   Item do menu.
	 * @param int    $depth  Profundidade.
	 * @param object $args   Argumentos do menu.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
