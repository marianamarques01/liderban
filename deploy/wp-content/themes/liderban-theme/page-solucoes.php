<?php
/**
 * Template Name: Serviços
 * Template Post Type: page
 *
 * @package Liderban_Theme
 */

get_header();

$cards = liderban_repeater(
	'service_cards',
	array(
		array( 'modal' => 'modal-banheiros', 'image' => 'solutions_img1.png', 'alt' => 'Banheiros Móveis', 'title' => 'Banheiros Móveis' ),
		array( 'modal' => 'modal-estruturas', 'image' => 'solutions_img2.png', 'alt' => 'Estruturas Modulares', 'title' => 'Estruturas Modulares' ),
		array( 'modal' => 'modal-transporte', 'image' => 'solutions_img3.png', 'alt' => 'Transporte', 'title' => 'Transporte' ),
		array( 'modal' => 'modal-saneamento', 'image' => 'solutions_img4.png', 'alt' => 'Saneamento', 'title' => 'Saneamento' ),
	)
);
?>

<main id="primary" class="site-main">
	<?php
	get_template_part(
		'template-parts/hero/hero-page',
		null,
		array(
			'bg_image' => liderban_image( 'hero_bg', 'solutions_bg.jpg' ),
		)
	);
	?>

	<section class="solutions-cards-section">
		<div class="container">
			<?php get_template_part( 'template-parts/solucoes/intro-section' ); ?>
			<div class="solutions-cards-grid">
				<?php foreach ( $cards as $card ) : ?>
					<div class="solution-card" data-modal="<?php echo esc_attr( $card['modal'] ?? '' ); ?>">
						<img src="<?php echo esc_url( liderban_resolve_image_value( $card['image'] ?? '' ) ); ?>" alt="<?php echo esc_attr( $card['alt'] ?? '' ); ?>">
						<div class="solution-card-overlay"></div>
						<h3 class="solution-card-title"><?php echo esc_html( $card['title'] ?? '' ); ?></h3>
						<span class="solution-card-hover"><?php esc_html_e( 'Saiba mais', 'liderban-theme' ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	get_template_part( 'template-parts/solucoes/stats-section' );
	get_template_part( 'template-parts/solucoes/expertise-section' );
	get_template_part( 'template-parts/solucoes/modals' );
	?>
</main>

<?php
get_footer();
