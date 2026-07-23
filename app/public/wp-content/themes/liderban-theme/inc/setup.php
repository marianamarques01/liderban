<?php
/**
 * Configuração do tema.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registra suportes e menus do tema.
 */
function liderban_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'liderban-theme' ),
			'footer'  => __( 'Menu do rodapé', 'liderban-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'liderban_theme_setup' );

/**
 * Fallback do menu principal (espelha o HTML).
 */
function liderban_primary_menu_fallback() {
	$items = array(
		__( 'Serviços', 'liderban-theme' )    => home_url( '/solucoes/' ),
		__( 'Quem Somos', 'liderban-theme' )  => home_url( '/quem-somos/' ),
		__( 'Blog', 'liderban-theme' )        => liderban_get_blog_url(),
		__( 'BanBan', 'liderban-theme' )      => home_url( '/banban/' ),
	);

	echo '<nav class="nav">';

	foreach ( $items as $label => $url ) {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $url ),
			esc_html( $label )
		);
	}

	echo '</nav>';
}

/**
 * Remove Clientes dos menus principal e do rodapé.
 *
 * @param array    $items Itens do menu.
 * @param stdClass $args  Argumentos do wp_nav_menu.
 * @return array
 */
function liderban_menu_exclude_clientes( $items, $args ) {
	if ( empty( $args->theme_location ) || ! in_array( $args->theme_location, array( 'primary', 'footer' ), true ) ) {
		return $items;
	}

	foreach ( $items as $key => $item ) {
		$url_match   = false !== strpos( $item->url, '/clientes' ) || false !== strpos( $item->url, '/#clientes' );
		$title_match = in_array( $item->title, array( 'Clientes', 'clientes' ), true );

		if ( $url_match || $title_match ) {
			unset( $items[ $key ] );
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'liderban_menu_exclude_clientes', 10, 2 );

/**
 * Fallback do menu do rodapé.
 */
function liderban_footer_menu_fallback() {
	$items = array(
		__( 'Home', 'liderban-theme' )        => home_url( '/' ),
		__( 'Serviços', 'liderban-theme' )    => home_url( '/solucoes/' ),
		__( 'Quem somos', 'liderban-theme' )  => home_url( '/quem-somos/' ),
		__( 'Blog', 'liderban-theme' )        => liderban_get_blog_url(),
		__( 'BanBan', 'liderban-theme' )      => home_url( '/banban/' ),
	);

	echo '<nav class="footer-nav">';

	foreach ( $items as $label => $url ) {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $url ),
			esc_html( $label )
		);
	}

	echo '</nav>';
}

/**
 * Classe do header conforme o contexto da página.
 *
 * Páginas com hero interno usam header transparente sobre a imagem
 * (mesmo padrão de solucoes/quem-somos). O JS adiciona .scrolled ao rolar.
 *
 * @return string
 */
function liderban_get_header_class() {
	if ( is_front_page() ) {
		return 'header';
	}

	if ( is_404() ) {
		return 'header header--solid';
	}

	return 'header';
}

/**
 * URL da seção de clientes na home.
 *
 * @return string
 */
function liderban_get_clientes_url() {
	return home_url( '/#clientes' );
}

/**
 * Redireciona /clientes/ para a seção de clientes na home.
 */
function liderban_redirect_clientes_to_home_section() {
	if ( is_admin() ) {
		return;
	}

	$request_path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );

	if ( 'clientes' === $request_path ) {
		wp_safe_redirect( liderban_get_clientes_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'liderban_redirect_clientes_to_home_section' );

/**
 * Garante páginas obrigatórias do tema no admin.
 */
function liderban_ensure_required_pages() {
	if ( ! is_admin() || ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	$pages = array(
		array(
			'title'    => 'Home',
			'slug'     => 'home',
			'template' => '',
		),
		array(
			'title'    => 'Serviços',
			'slug'     => 'solucoes',
			'template' => 'page-solucoes.php',
		),
		array(
			'title'    => 'Quem Somos',
			'slug'     => 'quem-somos',
			'template' => 'page-quem-somos.php',
		),
		array(
			'title'    => 'BanBan',
			'slug'     => 'banban',
			'template' => 'page-banban.php',
		),
		array(
			'title'    => 'Blog',
			'slug'     => 'blog',
			'template' => 'page-blog.php',
		),
	);

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );

		if ( $existing ) {
			if ( $page['template'] && get_post_meta( $existing->ID, '_wp_page_template', true ) !== $page['template'] ) {
				update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
			}
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'  => $page['title'],
				'post_name'   => $page['slug'],
				'post_status' => 'publish',
				'post_type'   => 'page',
			),
			true
		);

		if ( ! is_wp_error( $page_id ) && $page['template'] ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
		}
	}
}
add_action( 'admin_init', 'liderban_ensure_required_pages' );

/**
 * Configura a página Blog como página de posts (Leitura).
 */
function liderban_setup_blog_reading_settings() {
	$blog_page = get_page_by_path( 'blog' );

	if ( ! $blog_page ) {
		return;
	}

	$page_on_front = (int) get_option( 'page_on_front' );

	if ( ! $page_on_front ) {
		$home_page = get_page_by_path( 'home' );

		if ( $home_page ) {
			update_option( 'page_on_front', $home_page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	$page_for_posts = (int) get_option( 'page_for_posts' );

	if ( ! $page_for_posts ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}
}
add_action( 'admin_init', 'liderban_setup_blog_reading_settings' );
add_action( 'after_setup_theme', 'liderban_setup_blog_reading_settings' );
