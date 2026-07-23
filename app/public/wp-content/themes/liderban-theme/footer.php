<?php
/**
 * Rodape do tema.
 *
 * @package Liderban_Theme
 */

get_template_part( 'template-parts/floating/whatsapp' );
?>

<footer class="footer solutions-footer" id="contato">
	<div class="container">
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'footer',
				'container'       => 'nav',
				'container_class' => 'footer-nav',
				'items_wrap'      => '%3$s',
				'depth'           => 1,
				'fallback_cb'     => 'liderban_footer_menu_fallback',
				'walker'          => new Liderban_Nav_Walker(),
			)
		);
		?>

		<p class="footer-brand">LIDERBAN.</p>

		<div class="footer-contact">
			<p class="footer-contact-title"><?php echo esc_html( liderban_option( 'footer_contact_title', 'Fale conosco' ) ); ?></p>
			<p class="footer-contact-info"><?php echo esc_html( liderban_option( 'footer_contact_info', '(31) 2536-7500 | Seg - Sex: 7h - 17h' ) ); ?></p>
		</div>

		<p class="copyright">
			<?php
			printf(
				/* translators: %s: current year */
				esc_html__( '© %s Copyright, todos os direitos reservados.', 'liderban-theme' ),
				esc_html( gmdate( 'Y' ) )
			);
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
