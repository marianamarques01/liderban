<?php
/**
 * CPT "Na mídia" — matérias de imprensa editáveis pelo cliente.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registra o post type de matérias de imprensa.
 */
function liderban_register_imprensa_post_type() {
	$labels = array(
		'name'               => __( 'Na mídia', 'liderban-theme' ),
		'singular_name'      => __( 'Matéria de imprensa', 'liderban-theme' ),
		'menu_name'          => __( 'Na mídia', 'liderban-theme' ),
		'add_new'            => __( 'Adicionar matéria', 'liderban-theme' ),
		'add_new_item'       => __( 'Adicionar matéria de imprensa', 'liderban-theme' ),
		'edit_item'          => __( 'Editar matéria', 'liderban-theme' ),
		'new_item'           => __( 'Nova matéria', 'liderban-theme' ),
		'view_item'          => __( 'Ver matéria', 'liderban-theme' ),
		'search_items'       => __( 'Buscar matérias', 'liderban-theme' ),
		'not_found'          => __( 'Nenhuma matéria encontrada.', 'liderban-theme' ),
		'not_found_in_trash' => __( 'Nenhuma matéria na lixeira.', 'liderban-theme' ),
		'all_items'          => __( 'Todas as matérias', 'liderban-theme' ),
	);

	register_post_type(
		'liderban_imprensa',
		array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-megaphone',
			'menu_position'       => 26,
			'has_archive'         => true,
			'rewrite'             => array(
				'slug'       => 'imprensa',
				'with_front' => false,
			),
			'supports'            => array( 'title', 'date' ),
			'show_in_rest'        => true,
			'capability_type'     => 'post',
		)
	);
}
add_action( 'init', 'liderban_register_imprensa_post_type' );

/**
 * Garante rewrite rules após registrar o CPT (uma vez).
 */
function liderban_imprensa_maybe_flush_rewrite_rules() {
	if ( get_option( 'liderban_imprensa_rewrite_flushed' ) ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'liderban_imprensa_rewrite_flushed', 1, false );
}
add_action( 'init', 'liderban_imprensa_maybe_flush_rewrite_rules', 20 );

/**
 * Atualiza regras de rewrite ao ativar o tema.
 */
function liderban_imprensa_flush_rewrite_rules() {
	liderban_register_imprensa_post_type();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'liderban_imprensa_flush_rewrite_rules' );

/**
 * Meta keys usados nas matérias de imprensa.
 */
function liderban_imprensa_meta_keys() {
	return array(
		'source'   => '_liderban_imprensa_source',
		'initials' => '_liderban_imprensa_initials',
		'url'      => '_liderban_imprensa_url',
	);
}

/**
 * Registra meta boxes da matéria de imprensa.
 */
function liderban_imprensa_register_meta_boxes() {
	add_meta_box(
		'liderban_imprensa_details',
		__( 'Detalhes da matéria', 'liderban-theme' ),
		'liderban_imprensa_render_meta_box',
		'liderban_imprensa',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'liderban_imprensa_register_meta_boxes' );

/**
 * Renderiza campos editáveis no admin.
 *
 * @param WP_Post $post Post atual.
 */
function liderban_imprensa_render_meta_box( $post ) {
	wp_nonce_field( 'liderban_imprensa_save', 'liderban_imprensa_nonce' );

	$meta = liderban_imprensa_meta_keys();

	$source   = get_post_meta( $post->ID, $meta['source'], true );
	$initials = get_post_meta( $post->ID, $meta['initials'], true );
	$url      = get_post_meta( $post->ID, $meta['url'], true );
	?>
	<p>
		<label for="liderban_imprensa_source"><strong><?php esc_html_e( 'Veículo / fonte', 'liderban-theme' ); ?></strong></label><br>
		<input type="text" id="liderban_imprensa_source" name="liderban_imprensa_source" value="<?php echo esc_attr( $source ); ?>" class="widefat" placeholder="<?php esc_attr_e( 'Ex.: Folha de S.Paulo', 'liderban-theme' ); ?>">
	</p>
	<p>
		<label for="liderban_imprensa_initials"><strong><?php esc_html_e( 'Sigla do veículo', 'liderban-theme' ); ?></strong></label><br>
		<input type="text" id="liderban_imprensa_initials" name="liderban_imprensa_initials" value="<?php echo esc_attr( $initials ); ?>" class="regular-text" maxlength="4" placeholder="<?php esc_attr_e( 'Ex.: FSP', 'liderban-theme' ); ?>">
		<br><span class="description"><?php esc_html_e( 'Aparece no ícone do card. Se vazio, será gerada automaticamente a partir da fonte.', 'liderban-theme' ); ?></span>
	</p>
	<p>
		<label for="liderban_imprensa_url"><strong><?php esc_html_e( 'Link da matéria', 'liderban-theme' ); ?></strong></label><br>
		<input type="url" id="liderban_imprensa_url" name="liderban_imprensa_url" value="<?php echo esc_attr( $url ); ?>" class="widefat" placeholder="https://">
	</p>
	<p class="description">
		<?php esc_html_e( 'Use o título acima como manchete e a data de publicação para ordenar/exibir no card.', 'liderban-theme' ); ?>
	</p>
	<?php
}

/**
 * Salva meta fields da matéria de imprensa.
 *
 * @param int $post_id ID do post.
 */
function liderban_imprensa_save_meta( $post_id ) {
	if ( ! isset( $_POST['liderban_imprensa_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['liderban_imprensa_nonce'] ) ), 'liderban_imprensa_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( 'liderban_imprensa' !== get_post_type( $post_id ) ) {
		return;
	}

	$meta = liderban_imprensa_meta_keys();

	$source = isset( $_POST['liderban_imprensa_source'] ) ? sanitize_text_field( wp_unslash( $_POST['liderban_imprensa_source'] ) ) : '';
	$initials = isset( $_POST['liderban_imprensa_initials'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_POST['liderban_imprensa_initials'] ) ) ) : '';
	$url = isset( $_POST['liderban_imprensa_url'] ) ? esc_url_raw( wp_unslash( $_POST['liderban_imprensa_url'] ) ) : '';

	update_post_meta( $post_id, $meta['source'], $source );
	update_post_meta( $post_id, $meta['initials'], $initials );
	update_post_meta( $post_id, $meta['url'], $url );
}
add_action( 'save_post_liderban_imprensa', 'liderban_imprensa_save_meta' );

/**
 * Gera sigla a partir do nome da fonte.
 *
 * @param string $source Nome do veículo.
 * @return string
 */
function liderban_imprensa_generate_initials( $source ) {
	$source = trim( wp_strip_all_tags( $source ) );

	if ( '' === $source ) {
		return '';
	}

	$words = preg_split( '/\s+/', $source );

	if ( empty( $words ) ) {
		return '';
	}

	if ( 1 === count( $words ) ) {
		return strtoupper( mb_substr( $words[0], 0, 2 ) );
	}

	$initials = '';

	foreach ( array_slice( $words, 0, 3 ) as $word ) {
		$initials .= mb_substr( $word, 0, 1 );
	}

	return strtoupper( $initials );
}

/**
 * Retorna matérias placeholder usadas quando não há conteúdo cadastrado.
 *
 * @return array<int, array{source: string, initials: string, headline: string, date: string, url: string}>
 */
function liderban_get_default_midia_items() {
	return array(
		array(
			'source'   => __( 'Folha de S.Paulo', 'liderban-theme' ),
			'initials' => 'FSP',
			'headline' => __( 'Liderban expande operações de saneamento móvel em obras de infraestrutura', 'liderban-theme' ),
			'date'     => '12 MAR 2025',
			'url'      => '#',
		),
		array(
			'source'   => __( 'Portal R7', 'liderban-theme' ),
			'initials' => 'R7',
			'headline' => __( 'Empresa mineira reforça atuação em eventos com soluções BanBan', 'liderban-theme' ),
			'date'     => '28 FEV 2025',
			'url'      => '#',
		),
		array(
			'source'   => __( 'Exame', 'liderban-theme' ),
			'initials' => 'EX',
			'headline' => __( 'Gestão de efluentes: como a Liderban atende exigências ambientais', 'liderban-theme' ),
			'date'     => '15 JAN 2025',
			'url'      => '#',
		),
		array(
			'source'   => 'G1',
			'initials' => 'G1',
			'headline' => __( 'Saneamento móvel ganha destaque em grandes obras no Sudeste', 'liderban-theme' ),
			'date'     => '03 DEZ 2024',
			'url'      => '#',
		),
	);
}

/**
 * Normaliza um post de imprensa para o formato usado nos cards.
 *
 * @param WP_Post $post Post de imprensa.
 * @return array{source: string, initials: string, headline: string, date: string, url: string}
 */
function liderban_imprensa_format_item( WP_Post $post ) {
	$meta     = liderban_imprensa_meta_keys();
	$source   = (string) get_post_meta( $post->ID, $meta['source'], true );
	$initials = (string) get_post_meta( $post->ID, $meta['initials'], true );
	$url      = (string) get_post_meta( $post->ID, $meta['url'], true );

	if ( '' === $initials ) {
		$initials = liderban_imprensa_generate_initials( $source );
	}

	if ( '' === $url ) {
		$url = '#';
	}

	return array(
		'source'   => $source,
		'initials' => $initials,
		'headline' => get_the_title( $post ),
		'date'     => liderban_format_post_date( $post->ID, 'card' ),
		'url'      => $url,
	);
}

/**
 * Retorna matérias de imprensa para exibição na seção do blog.
 *
 * @param int $limit Quantidade máxima de cards.
 * @return array<int, array{source: string, initials: string, headline: string, date: string, url: string}>
 */
function liderban_get_midia_items( $limit = 4 ) {
	$limit = max( 1, (int) $limit );

	$query = new WP_Query(
		array(
			'post_type'      => 'liderban_imprensa',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	if ( ! $query->have_posts() ) {
		return array_slice( liderban_get_default_midia_items(), 0, $limit );
	}

	$items = array();

	foreach ( $query->posts as $post ) {
		if ( ! $post instanceof WP_Post ) {
			continue;
		}

		$items[] = liderban_imprensa_format_item( $post );
	}

	return $items;
}

/**
 * URL do arquivo de matérias de imprensa.
 *
 * @return string
 */
function liderban_get_imprensa_archive_url() {
	$link = get_post_type_archive_link( 'liderban_imprensa' );

	return $link ? $link : home_url( '/imprensa/' );
}

/**
 * Cria matérias placeholder no admin quando o CPT ainda está vazio.
 */
function liderban_seed_imprensa_posts() {
	if ( ! is_admin() || ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	if ( get_option( 'liderban_imprensa_seeded' ) ) {
		return;
	}

	$existing = wp_count_posts( 'liderban_imprensa' );

	if ( $existing && (int) $existing->publish > 0 ) {
		update_option( 'liderban_imprensa_seeded', 1, false );
		return;
	}

	$defaults = array(
		array(
			'source'   => 'Folha de S.Paulo',
			'initials' => 'FSP',
			'headline' => 'Liderban expande operações de saneamento móvel em obras de infraestrutura',
			'date'     => '2025-03-12 10:00:00',
			'url'      => '#',
		),
		array(
			'source'   => 'Portal R7',
			'initials' => 'R7',
			'headline' => 'Empresa mineira reforça atuação em eventos com soluções BanBan',
			'date'     => '2025-02-28 10:00:00',
			'url'      => '#',
		),
		array(
			'source'   => 'Exame',
			'initials' => 'EX',
			'headline' => 'Gestão de efluentes: como a Liderban atende exigências ambientais',
			'date'     => '2025-01-15 10:00:00',
			'url'      => '#',
		),
		array(
			'source'   => 'G1',
			'initials' => 'G1',
			'headline' => 'Saneamento móvel ganha destaque em grandes obras no Sudeste',
			'date'     => '2024-12-03 10:00:00',
			'url'      => '#',
		),
	);

	$meta = liderban_imprensa_meta_keys();

	foreach ( $defaults as $item ) {
		$post_id = wp_insert_post(
			array(
				'post_type'    => 'liderban_imprensa',
				'post_status'  => 'publish',
				'post_title'   => $item['headline'],
				'post_date'    => $item['date'],
				'post_date_gmt'=> get_gmt_from_date( $item['date'] ),
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			continue;
		}

		update_post_meta( $post_id, $meta['source'], $item['source'] );
		update_post_meta( $post_id, $meta['initials'], $item['initials'] );
		update_post_meta( $post_id, $meta['url'], $item['url'] );
	}

	update_option( 'liderban_imprensa_seeded', 1, false );
}
add_action( 'admin_init', 'liderban_seed_imprensa_posts' );
