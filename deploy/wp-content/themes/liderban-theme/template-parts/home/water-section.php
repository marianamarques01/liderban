<?php
/**
 * Seção de infraestrutura invisível (home).
 *
 * @package Liderban_Theme
 */
?>
<section class="water-section">
	<div class="container">
		<div class="water-grid">
			<div class="water-illustration">
				<img src="<?php echo esc_url( liderban_image( 'water_image', 'img.svg' ) ); ?>" alt="<?php esc_attr_e( "Gota d'água com cidade e natureza", 'liderban-theme' ); ?>">
			</div>
			<div class="water-content">
				<h2 class="section-title"><?php echo esc_html( liderban_field( 'water_title', 'A infraestrutura invisível que sustenta a dignidade e a produtividade.' ) ); ?></h2>
				<div class="water-text">
					<p><?php echo esc_html( liderban_field( 'water_text_1', 'Em áreas remotas, grandes obras de mineração, siderurgia e agronegócio, a estrutura convencional muitas vezes não acompanha a velocidade e a complexidade das operações.' ) ); ?></p>
					<p>
						<?php echo esc_html( liderban_field( 'water_text_2', 'É exatamente onde a infraestrutura fixa não chega que a ' ) ); ?>
						<strong class="water-brand"><?php echo esc_html( liderban_field( 'water_brand', 'Liderban atua.' ) ); ?></strong>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
