<?php
/**
 * Página 404.
 *
 * @package Liderban_Theme
 */

get_header();
?>

<main id="primary" class="site-main site-main--404">
	<section class="page-content-section">
		<div class="container">
			<h1 class="section-title solutions-title"><?php echo esc_html( liderban_option( 'error_title', 'Página não encontrada' ) ); ?></h1>
			<p class="blog-listing__empty">
				<?php echo esc_html( liderban_option( 'error_text', 'O endereço que você acessou não existe ou foi movido.' ) ); ?>
			</p>
			<p>
				<a class="blog-featured__button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo esc_html( liderban_option( 'error_btn', 'VOLTAR PARA A HOME →' ) ); ?>
				</a>
			</p>
			<nav class="site-404__links" aria-label="<?php esc_attr_e( 'Páginas principais', 'liderban-theme' ); ?>">
				<a href="<?php echo esc_url( home_url( '/solucoes/' ) ); ?>"><?php esc_html_e( 'Serviços', 'liderban-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/quem-somos/' ) ); ?>"><?php esc_html_e( 'Quem Somos', 'liderban-theme' ); ?></a>
				<a href="<?php echo esc_url( liderban_get_blog_url() ); ?>"><?php esc_html_e( 'Blog', 'liderban-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/banban/' ) ); ?>"><?php esc_html_e( 'BanBan', 'liderban-theme' ); ?></a>
			</nav>
		</div>
	</section>
</main>

<?php
get_footer();
