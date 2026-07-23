<?php
/**
 * Busca inline do header (expande ao lado do ícone).
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$search_query = get_search_query();
?>

<div class="header-search" id="header-search" aria-hidden="true">
	<form
		role="search"
		method="get"
		class="header-search__form"
		action="<?php echo esc_url( home_url( '/' ) ); ?>"
	>
		<div class="header-search__field">
			<label class="screen-reader-text" for="header-search-input">
				<?php esc_html_e( 'Pesquisar', 'liderban-theme' ); ?>
			</label>
			<input
				type="search"
				id="header-search-input"
				class="header-search__input"
				name="s"
				value="<?php echo esc_attr( $search_query ); ?>"
				placeholder="<?php esc_attr_e( 'Pesquisar no blog…', 'liderban-theme' ); ?>"
				autocomplete="off"
				tabindex="-1"
			/>
			<button type="submit" class="header-search__submit" tabindex="-1">
				<?php esc_html_e( 'Buscar', 'liderban-theme' ); ?>
			</button>
		</div>
	</form>

	<button
		type="button"
		class="header-actions__search"
		id="header-search-toggle"
		aria-label="<?php esc_attr_e( 'Pesquisar', 'liderban-theme' ); ?>"
		aria-expanded="false"
		aria-controls="header-search"
	>
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
			<circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
			<path d="M20 20l-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
	</button>
</div>
