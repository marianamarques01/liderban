<?php
/**
 * Card CTA da home.
 *
 * @package Liderban_Theme
 */

$phone_display = liderban_field( 'cta_phone', '(31) 2536-7500' );
$phone_digits  = preg_replace( '/\D+/', '', $phone_display );
?>
<section class="home-cta-section">
	<div class="container">
		<div class="home-cta-card">
			<div class="home-cta-card__content">
				<h2 class="home-cta-title">
					<?php echo esc_html( liderban_field( 'cta_title_1', 'Pronto para levar' ) ); ?>
					<span class="home-cta-highlight"><?php echo esc_html( liderban_field( 'cta_highlight', 'excelência' ) ); ?></span>
					<?php echo esc_html( liderban_field( 'cta_title_2', 'ao seu projeto?' ) ); ?>
				</h2>
				<p class="home-cta-text">
					<?php echo esc_html( liderban_field( 'cta_text', 'Nossa equipe técnica está pronta para desenhar a solução de saneamento ideal para sua obra ou evento.' ) ); ?>
				</p>
			</div>
			<div class="home-cta-card__actions">
				<a class="home-cta-button" href="<?php echo esc_url( liderban_whatsapp_url( 'Olá! Gostaria de solicitar um orçamento.' ) ); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html( liderban_field( 'cta_button', 'SOLICITAR ORÇAMENTO →' ) ); ?>
				</a>
				<a class="home-cta-phone" href="tel:+<?php echo esc_attr( $phone_digits ); ?>">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
						<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php echo esc_html( $phone_display ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
