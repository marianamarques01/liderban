<?php
/**
 * Hero carousel da home.
 *
 * @package Liderban_Theme
 */

$slides = array(
	liderban_image( 'hero_slide_1', 'bg1.jpg' ),
	liderban_image( 'hero_slide_2', 'bg2.jpg' ),
	liderban_image( 'hero_slide_3', 'bg3.jpg' ),
);
?>
<section class="hero">
	<div class="hero-carousel">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<div
				class="hero-slide<?php echo 0 === $index ? ' active' : ''; ?>"
				style="background-image: url('<?php echo esc_url( $slide ); ?>');"
			></div>
		<?php endforeach; ?>
	</div>
	<div class="hero-overlay"></div>
	<div class="hero-content">
		<h1 class="hero-title"><?php echo esc_html( liderban_field( 'hero_title', 'Liderban.' ) ); ?></h1>
		<p class="hero-subtitle"><?php echo esc_html( liderban_field( 'hero_subtitle_1', 'Sua parceira estratégica em' ) ); ?></p>
		<p class="hero-subtitle"><?php echo esc_html( liderban_field( 'hero_subtitle_2', 'soluções de saneamento móvel.' ) ); ?></p>
	</div>
	<div class="hero-indicators">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<span class="indicator<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( (string) $index ); ?>"></span>
		<?php endforeach; ?>
	</div>
	<div class="wave-bottom">
		<img src="<?php echo esc_url( liderban_asset( 'images/wave.png' ) ); ?>" alt="<?php esc_attr_e( 'Onda decorativa', 'liderban-theme' ); ?>">
	</div>
</section>
