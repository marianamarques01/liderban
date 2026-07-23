<?php
/**
 * Plugin Name: Liderban Instagram Feed
 * Description: Busca as últimas postagens da conta @liderban via Instagram Graph API.
 * Version: 1.0.0
 * Author: Liderban
 * Text Domain: liderban-instagram-feed
 *
 * @package Liderban_Instagram_Feed
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LIDERBAN_INSTAGRAM_VERSION', '1.0.0' );
define( 'LIDERBAN_INSTAGRAM_PLUGIN_FILE', __FILE__ );
define( 'LIDERBAN_INSTAGRAM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once LIDERBAN_INSTAGRAM_PLUGIN_DIR . 'includes/class-liderban-instagram-api.php';
require_once LIDERBAN_INSTAGRAM_PLUGIN_DIR . 'includes/class-liderban-instagram-settings.php';

Liderban_Instagram_Settings::init();
Liderban_Instagram_API::init();

/**
 * Retorna as postagens do Instagram da conta configurada.
 *
 * @param int $limit Quantidade máxima de postagens.
 * @return array<int, array{image: string, alt: string, link: string, type: string}>
 */
function liderban_instagram_get_posts( $limit = 12 ) {
	return Liderban_Instagram_API::get_posts( $limit );
}

/**
 * Retorna a URL do perfil configurado no Instagram.
 *
 * @return string
 */
function liderban_instagram_get_profile_url() {
	$username = Liderban_Instagram_Settings::get_username();

	return 'https://www.instagram.com/' . rawurlencode( $username ) . '/';
}
