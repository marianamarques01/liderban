<?php
/**
 * Hero reutilizável para páginas internas.
 *
 * @package Liderban_Theme
 *
 * @var array $args {
 *     @type string $bg_image URL da imagem de fundo.
 *     @type string $alt      Texto alternativo da onda decorativa.
 * }
 */

$bg_image = isset( $args['bg_image'] ) ? $args['bg_image'] : '';
$alt      = isset( $args['alt'] ) ? $args['alt'] : __( 'Onda decorativa', 'liderban-theme' );
?>
<section class="solutions-hero">
	<div
		class="solutions-hero-bg"
		style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"
	></div>
	<div class="solutions-hero-overlay"></div>
	<div class="wave-bottom">
		<img src="<?php echo esc_url( liderban_asset( 'images/wave.png' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
	</div>
</section>
