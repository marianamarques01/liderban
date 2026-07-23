<?php
/**
 * Carrossel de clientes na home.
 *
 * @package Liderban_Theme
 */

$clientes_image = liderban_image( 'clientes_image', 'clients.png' );
?>
<section class="home-clientes-section" id="clientes">
	<div class="container">
		<h2 class="home-clientes-title"><?php echo esc_html( liderban_field( 'clientes_title', 'Nossos Clientes' ) ); ?></h2>
	</div>
	<div class="clientes-marquee" aria-label="<?php esc_attr_e( 'Logos de clientes', 'liderban-theme' ); ?>">
		<div class="clientes-marquee__track">
			<img src="<?php echo esc_url( $clientes_image ); ?>" alt="<?php esc_attr_e( 'Logos de clientes da Liderban', 'liderban-theme' ); ?>">
			<img src="<?php echo esc_url( $clientes_image ); ?>" alt="" aria-hidden="true">
		</div>
	</div>
</section>
