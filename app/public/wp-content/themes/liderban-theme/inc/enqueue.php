<?php
/**
 * Enfileiramento de assets.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enfileira estilos e scripts do tema.
 */
function liderban_enqueue_assets() {
	$main_css_path = liderban_asset_path( 'css/main.css' );
	$main_js_path  = liderban_asset_path( 'js/main.js' );

	wp_enqueue_style(
		'liderban-google-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'liderban-main',
		liderban_asset( 'css/main.css' ),
		array( 'liderban-google-fonts' ),
		liderban_asset_version( $main_css_path )
	);

	wp_enqueue_script(
		'liderban-main',
		liderban_asset( 'js/main.js' ),
		array(),
		liderban_asset_version( $main_js_path ),
		true
	);

	if ( liderban_is_blog_context() ) {
		$blog_js_path = liderban_asset_path( 'js/blog.js' );

		wp_enqueue_script(
			'liderban-blog',
			liderban_asset( 'js/blog.js' ),
			array(),
			liderban_asset_version( $blog_js_path ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'liderban_enqueue_assets' );

/**
 * Adiciona favicon do tema.
 */
function liderban_favicon() {
	$favicon = liderban_asset( 'images/logo.png' );
	printf(
		'<link rel="icon" type="image/png" href="%s">',
		esc_url( $favicon )
	);
}
add_action( 'wp_head', 'liderban_favicon', 5 );
