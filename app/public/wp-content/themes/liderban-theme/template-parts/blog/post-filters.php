<?php
/**
 * Filtros da listagem do blog (categoria e ordenação).
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$filters     = liderban_get_blog_filter_params();
$categories  = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);
$current_cat = $filters['cat'];

$category_label = __( 'CATEGORIA', 'liderban-theme' );

if ( $current_cat ) {
	foreach ( $categories as $category ) {
		if ( $category->slug === $current_cat ) {
			$category_label = $category->name;
			break;
		}
	}
}

$order_options = array(
	'date'  => __( 'Mais recentes', 'liderban-theme' ),
	'title' => __( 'A-Z', 'liderban-theme' ),
);

$current_orderby = $filters['orderby'];
$order_label     = isset( $order_options[ $current_orderby ] )
	? $order_options[ $current_orderby ]
	: $order_options['date'];
?>

<nav class="blog-filters" aria-label="<?php esc_attr_e( 'Filtrar posts', 'liderban-theme' ); ?>">
	<details class="blog-filter" id="blog-filter-category">
		<summary
			class="blog-filter__toggle"
			aria-expanded="false"
			aria-controls="blog-filter-category-menu"
			aria-haspopup="listbox"
		>
			<span class="blog-filter__label"><?php echo esc_html( $category_label ); ?></span>
			<span class="blog-filter__chevron" aria-hidden="true">▼</span>
		</summary>
		<ul class="blog-filter__menu" id="blog-filter-category-menu" role="listbox" aria-label="<?php esc_attr_e( 'Categorias', 'liderban-theme' ); ?>">
			<li role="none">
				<a
					class="blog-filter__option<?php echo '' === $current_cat ? ' is-active' : ''; ?>"
					href="<?php echo esc_url( liderban_blog_filter_url( array( 'cat' => '', 'paged' => 1 ) ) ); ?>"
					role="option"
					<?php echo '' === $current_cat ? 'aria-selected="true"' : 'aria-selected="false"'; ?>
				>
					<?php esc_html_e( 'Todas', 'liderban-theme' ); ?>
				</a>
			</li>
			<?php foreach ( $categories as $category ) : ?>
				<li role="none">
					<a
						class="blog-filter__option<?php echo $current_cat === $category->slug ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( liderban_blog_filter_url( array( 'cat' => $category->slug, 'paged' => 1 ) ) ); ?>"
						role="option"
						<?php echo $current_cat === $category->slug ? 'aria-selected="true"' : 'aria-selected="false"'; ?>
					>
						<?php echo esc_html( $category->name ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</details>

	<details class="blog-filter" id="blog-filter-order">
		<summary
			class="blog-filter__toggle"
			aria-expanded="false"
			aria-controls="blog-filter-order-menu"
			aria-haspopup="listbox"
		>
			<span class="blog-filter__label"><?php echo esc_html( $order_label ); ?></span>
			<span class="blog-filter__chevron" aria-hidden="true">▼</span>
		</summary>
		<ul class="blog-filter__menu" id="blog-filter-order-menu" role="listbox" aria-label="<?php esc_attr_e( 'Ordenar por', 'liderban-theme' ); ?>">
			<?php foreach ( $order_options as $orderby => $label ) : ?>
				<li role="none">
					<a
						class="blog-filter__option<?php echo $current_orderby === $orderby ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( liderban_blog_filter_url( array( 'orderby' => $orderby, 'paged' => 1 ) ) ); ?>"
						role="option"
						<?php echo $current_orderby === $orderby ? 'aria-selected="true"' : 'aria-selected="false"'; ?>
					>
						<?php echo esc_html( $label ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</details>
</nav>
