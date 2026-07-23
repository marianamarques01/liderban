<?php
/**
 * Helpers do blog.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retorna o post em destaque (sticky mais recente, senão o post publicado mais recente).
 *
 * @return WP_Post|null
 */
function liderban_get_featured_post() {
	$sticky_ids = get_option( 'sticky_posts', array() );

	if ( ! empty( $sticky_ids ) ) {
		$query = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'post__in'            => $sticky_ids,
				'posts_per_page'      => 1,
				'ignore_sticky_posts' => 1,
				'orderby'             => 'date',
				'order'               => 'DESC',
			)
		);

		if ( $query->have_posts() ) {
			return $query->posts[0];
		}
	}

	$query = new WP_Query(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	if ( $query->have_posts() ) {
		return $query->posts[0];
	}

	return null;
}

/**
 * Retorna posts para o grid da listagem, excluindo o destaque.
 *
 * @param array $args {
 *     @type int    $posts_per_page Quantidade por página. Default: get_option( 'posts_per_page' ).
 *     @type int    $paged          Página atual. Default: get_query_var( 'paged' ).
 *     @type string $cat            Slug da categoria.
 *     @type string $orderby        Campo de ordenação (date, title). Default: date.
 *     @type string $order          ASC ou DESC. Default: DESC.
 * }
 * @return WP_Query
 */
function liderban_get_blog_posts( $args = array() ) {
	$featured = liderban_get_featured_post();

	$defaults = array(
		'posts_per_page' => (int) get_option( 'posts_per_page', 10 ),
		'paged'          => max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) ),
		'cat'            => '',
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( 'title' === $args['orderby'] ) {
		$args['order'] = 'ASC';
	} else {
		$args['orderby'] = 'date';
		$args['order']   = 'DESC';
	}

	$query_args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $args['posts_per_page'],
		'paged'               => $args['paged'],
		'orderby'             => $args['orderby'],
		'order'               => $args['order'],
		'ignore_sticky_posts' => 1,
	);

	if ( $featured instanceof WP_Post ) {
		$query_args['post__not_in'] = array( $featured->ID );
	}

	if ( ! empty( $args['cat'] ) ) {
		$query_args['category_name'] = sanitize_title( $args['cat'] );
	}

	return new WP_Query( $query_args );
}

/**
 * Retorna posts relacionados (mesma categoria), excluindo o post atual.
 *
 * @param int $post_id ID do post.
 * @param int $limit   Quantidade máxima.
 * @return WP_Post[]
 */
function liderban_get_related_posts( $post_id, $limit = 3 ) {
	$post_id = (int) $post_id;
	$limit   = max( 1, (int) $limit );

	if ( ! $post_id ) {
		return array();
	}

	$categories = wp_get_post_categories( $post_id );

	$query_args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => 1,
		'orderby'             => 'date',
		'order'               => 'DESC',
	);

	if ( ! empty( $categories ) ) {
		$query_args['category__in'] = $categories;
	}

	$query = new WP_Query( $query_args );

	if ( $query->have_posts() ) {
		return $query->posts;
	}

	$fallback = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $limit,
			'post__not_in'        => array( $post_id ),
			'ignore_sticky_posts' => 1,
			'orderby'             => 'date',
			'order'               => 'DESC',
		)
	);

	return $fallback->have_posts() ? $fallback->posts : array();
}

/**
 * Formata a data de um post conforme o contexto do design.
 *
 * @param int|null $post_id ID do post. Default: post atual.
 * @param string   $format  'card' (04 OUT 2024) ou 'full' (25/03/2024).
 * @return string
 */
function liderban_format_post_date( $post_id = null, $format = 'full' ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();

	if ( ! $post_id ) {
		return '';
	}

	$timestamp = get_post_timestamp( $post_id );

	if ( ! $timestamp ) {
		return '';
	}

	if ( 'card' === $format ) {
		$months = array(
			1  => 'JAN',
			2  => 'FEV',
			3  => 'MAR',
			4  => 'ABR',
			5  => 'MAI',
			6  => 'JUN',
			7  => 'JUL',
			8  => 'AGO',
			9  => 'SET',
			10 => 'OUT',
			11 => 'NOV',
			12 => 'DEZ',
		);

		$day   = wp_date( 'd', $timestamp );
		$month = (int) wp_date( 'n', $timestamp );
		$year  = wp_date( 'Y', $timestamp );

		return sprintf( '%s %s %s', $day, $months[ $month ], $year );
	}

	return wp_date( 'd/m/Y', $timestamp );
}

/**
 * Retorna a URL da listagem do blog.
 *
 * @return string
 */
function liderban_get_blog_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );

	if ( $posts_page_id ) {
		return get_permalink( $posts_page_id );
	}

	$page = get_page_by_path( 'blog' );

	if ( $page ) {
		return get_permalink( $page );
	}

	return home_url( '/blog/' );
}

/**
 * Retorna parâmetros de filtro da listagem a partir da query string.
 *
 * @return array {
 *     @type string $cat     Slug da categoria ou vazio.
 *     @type string $orderby date|title.
 *     @type int    $paged   Página atual.
 * }
 */
function liderban_get_blog_filter_params() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtros públicos via GET.
	$cat = isset( $_GET['cat'] ) ? sanitize_title( wp_unslash( $_GET['cat'] ) ) : '';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- filtros públicos via GET.
	$orderby = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( $_GET['orderby'] ) ) : 'date';

	if ( ! in_array( $orderby, array( 'date', 'title' ), true ) ) {
		$orderby = 'date';
	}

	return array(
		'cat'     => $cat,
		'orderby' => $orderby,
		'paged'   => max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) ),
	);
}

/**
 * Monta URL da listagem preservando filtros ativos.
 *
 * @param array $params Parâmetros a sobrescrever (cat, orderby, paged).
 * @return string
 */
function liderban_blog_filter_url( $params = array() ) {
	$current = liderban_get_blog_filter_params();
	$merged  = wp_parse_args( $params, $current );

	$args = array();

	if ( ! empty( $merged['cat'] ) ) {
		$args['cat'] = sanitize_title( $merged['cat'] );
	}

	if ( ! empty( $merged['orderby'] ) && 'date' !== $merged['orderby'] ) {
		$args['orderby'] = sanitize_key( $merged['orderby'] );
	}

	if ( ! empty( $merged['paged'] ) && (int) $merged['paged'] > 1 ) {
		$args['paged'] = (int) $merged['paged'];
	}

	$base = liderban_get_blog_url();

	if ( empty( $args ) ) {
		return $base;
	}

	return add_query_arg( $args, $base );
}

/**
 * Indica se a requisição atual é listagem ou detalhe do blog.
 *
 * @return bool
 */
function liderban_is_blog_context() {
	return is_home() || is_single() || is_page( 'blog' ) || is_search();
}

/**
 * Restringe a busca do site a posts publicados.
 *
 * @param WP_Query $query Query principal.
 */
function liderban_search_only_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$query->set( 'post_type', 'post' );
}
add_action( 'pre_get_posts', 'liderban_search_only_posts' );
