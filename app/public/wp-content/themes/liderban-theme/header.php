<?php
/**
 * Cabecalho do tema.
 *
 * @package Liderban_Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="<?php echo esc_attr( liderban_get_header_class() ); ?>" id="header">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">LIDERBAN.</a>

		<button class="menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Abrir menu', 'liderban-theme' ); ?>">
			<span></span>
			<span></span>
			<span></span>
		</button>

		<div class="header__right">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'container_class' => 'nav',
					'items_wrap'      => '%3$s',
					'depth'           => 1,
					'fallback_cb'     => 'liderban_primary_menu_fallback',
					'walker'          => new Liderban_Nav_Walker(),
				)
			);

			get_template_part( 'template-parts/header/actions' );
			?>
		</div>
	</div>
</header>
