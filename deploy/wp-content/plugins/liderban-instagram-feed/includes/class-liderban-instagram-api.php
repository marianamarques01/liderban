<?php
/**
 * Cliente da Instagram Graph API.
 *
 * @package Liderban_Instagram_Feed
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Liderban_Instagram_API {

	const TRANSIENT_KEY = 'liderban_instagram_posts';
	const API_BASE      = 'https://graph.instagram.com';

	/**
	 * Inicializa hooks.
	 */
	public static function init() {
		add_action( 'wp_ajax_liderban_instagram_refresh', array( __CLASS__, 'ajax_refresh_cache' ) );
	}

	/**
	 * Retorna postagens formatadas para o tema.
	 *
	 * @param int $limit Quantidade máxima de postagens.
	 * @return array<int, array{image: string, alt: string, link: string, type: string}>
	 */
	public static function get_posts( $limit = 12 ) {
		$limit = max( 1, min( 25, absint( $limit ) ) );
		$posts = self::get_cached_posts();

		if ( empty( $posts ) ) {
			$posts = self::fetch_posts( $limit );

			if ( ! empty( $posts ) ) {
				self::set_cached_posts( $posts );
			}
		}

		return array_slice( $posts, 0, $limit );
	}

	/**
	 * Busca postagens na API do Instagram.
	 *
	 * @param int $limit Quantidade máxima de postagens.
	 * @return array<int, array{image: string, alt: string, link: string, type: string}>
	 */
	private static function fetch_posts( $limit ) {
		$settings = Liderban_Instagram_Settings::get_all();

		if ( empty( $settings['access_token'] ) || empty( $settings['user_id'] ) ) {
			return array();
		}

		$url = add_query_arg(
			array(
				'fields'       => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp',
				'access_token' => $settings['access_token'],
				'limit'        => $limit,
			),
			self::API_BASE . '/' . rawurlencode( (string) $settings['user_id'] ) . '/media'
		);

		$response = wp_remote_get(
			$url,
			array(
				'timeout' => 15,
			)
		);

		if ( is_wp_error( $response ) ) {
			return array();
		}

		$status = wp_remote_retrieve_response_code( $response );

		if ( 200 !== $status ) {
			return array();
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( empty( $body['data'] ) || ! is_array( $body['data'] ) ) {
			return array();
		}

		$posts = array();

		foreach ( $body['data'] as $item ) {
			$formatted = self::format_media_item( $item );

			if ( null !== $formatted ) {
				$posts[] = $formatted;
			}
		}

		return $posts;
	}

	/**
	 * Normaliza um item retornado pela API.
	 *
	 * @param array<string, mixed> $item Item bruto da API.
	 * @return array{image: string, alt: string, link: string, type: string}|null
	 */
	private static function format_media_item( $item ) {
		$media_type = isset( $item['media_type'] ) ? (string) $item['media_type'] : '';
		$permalink  = isset( $item['permalink'] ) ? esc_url_raw( (string) $item['permalink'] ) : '';
		$caption    = isset( $item['caption'] ) ? wp_strip_all_tags( (string) $item['caption'] ) : '';
		$image      = '';

		if ( 'VIDEO' === $media_type ) {
			$image = isset( $item['thumbnail_url'] ) ? esc_url_raw( (string) $item['thumbnail_url'] ) : '';
		} else {
			$image = isset( $item['media_url'] ) ? esc_url_raw( (string) $item['media_url'] ) : '';
		}

		if ( '' === $image || '' === $permalink ) {
			return null;
		}

		return array(
			'image' => $image,
			'alt'   => $caption ? $caption : __( 'Postagem do Instagram @liderban', 'liderban-instagram-feed' ),
			'link'  => $permalink,
			'type'  => strtolower( $media_type ),
		);
	}

	/**
	 * Retorna postagens em cache.
	 *
	 * @return array<int, array{image: string, alt: string, link: string, type: string}>
	 */
	private static function get_cached_posts() {
		$cached = get_transient( self::TRANSIENT_KEY );

		return is_array( $cached ) ? $cached : array();
	}

	/**
	 * Salva postagens em cache.
	 *
	 * @param array<int, array{image: string, alt: string, link: string, type: string}> $posts Postagens.
	 */
	private static function set_cached_posts( $posts ) {
		$settings = Liderban_Instagram_Settings::get_all();
		$ttl      = max( 300, absint( $settings['cache_ttl'] ) );

		set_transient( self::TRANSIENT_KEY, $posts, $ttl );
	}

	/**
	 * Limpa o cache via AJAX (admin).
	 */
	public static function ajax_refresh_cache() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => 'forbidden' ), 403 );
		}

		check_ajax_referer( 'liderban_instagram_refresh', 'nonce' );

		delete_transient( self::TRANSIENT_KEY );
		$posts = self::fetch_posts( 12 );

		if ( ! empty( $posts ) ) {
			self::set_cached_posts( $posts );
		}

		wp_send_json_success(
			array(
				'count' => count( $posts ),
			)
		);
	}
}
