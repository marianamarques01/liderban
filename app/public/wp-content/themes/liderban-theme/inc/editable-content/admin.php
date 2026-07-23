<?php
/**
 * Interface admin para edição de conteúdo das páginas.
 *
 * @package Liderban_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Usa editor clássico nas páginas com conteúdo do tema.
 *
 * O editor de blocos esconde os meta boxes no rodapé, o que confunde o cliente.
 *
 * @param bool    $use_block_editor Se usa block editor.
 * @param WP_Post $post             Post atual.
 * @return bool
 */
function liderban_disable_block_editor_for_theme_pages( $use_block_editor, $post ) {
	if ( empty( $post->post_type ) || 'page' !== $post->post_type ) {
		return $use_block_editor;
	}

	if ( liderban_get_page_schema_key( $post->ID ) ) {
		return false;
	}

	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'liderban_disable_block_editor_for_theme_pages', 10, 2 );

/**
 * Remove o editor padrão de páginas gerenciadas pelo tema.
 */
function liderban_remove_default_page_editor() {
	global $post;

	if ( ! $post || 'page' !== $post->post_type ) {
		return;
	}

	if ( liderban_get_page_schema_key( $post->ID ) ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'add_meta_boxes', 'liderban_remove_default_page_editor', 99 );

/**
 * Aviso no topo da edição de páginas do tema.
 */
function liderban_editable_page_admin_notice() {
	$screen = get_current_screen();

	if ( ! $screen || 'page' !== $screen->id ) {
		return;
	}

	global $post;

	if ( ! $post || ! liderban_get_page_schema_key( $post->ID ) ) {
		return;
	}

	echo '<div class="notice notice-info"><p><strong>' . esc_html__( 'Como editar esta página:', 'liderban-theme' ) . '</strong> ';
	echo esc_html__( 'use o painel "Conteúdo da página (Liderban)" logo abaixo para alterar textos e imagens.', 'liderban-theme' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'liderban_editable_page_admin_notice' );

/**
 * Registra meta boxes nas páginas editáveis.
 */
function liderban_register_editable_meta_boxes() {
	add_meta_box(
		'liderban-page-content',
		__( 'Conteúdo da página (Liderban)', 'liderban-theme' ),
		'liderban_render_page_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'liderban_register_editable_meta_boxes' );

/**
 * Registra página de configurações globais.
 */
function liderban_register_global_settings_page() {
	add_options_page(
		__( 'Conteúdo Liderban', 'liderban-theme' ),
		__( 'Conteúdo Liderban', 'liderban-theme' ),
		'manage_options',
		'liderban-global-content',
		'liderban_render_global_settings_page'
	);
}
add_action( 'admin_menu', 'liderban_register_global_settings_page' );

/**
 * Enfileira assets do admin.
 *
 * @param string $hook_suffix Hook atual.
 */
function liderban_enqueue_editable_admin_assets( $hook_suffix ) {
	$is_page_edit = in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true );
	$is_global    = 'settings_page_liderban-global-content' === $hook_suffix;

	if ( ! $is_page_edit && ! $is_global ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_style(
		'liderban-editable-admin',
		get_template_directory_uri() . '/assets/css/admin-editable.css',
		array(),
		liderban_asset_version( get_template_directory() . '/assets/css/admin-editable.css' )
	);
	wp_enqueue_script(
		'liderban-editable-admin',
		get_template_directory_uri() . '/assets/js/admin-editable.js',
		array( 'jquery' ),
		liderban_asset_version( get_template_directory() . '/assets/js/admin-editable.js' ),
		true
	);
}
add_action( 'admin_enqueue_scripts', 'liderban_enqueue_editable_admin_assets' );

/**
 * Renderiza meta box de conteúdo da página.
 *
 * @param WP_Post $post Post atual.
 */
function liderban_render_page_meta_box( $post ) {
	$schema_key = liderban_get_page_schema_key( $post->ID );

	if ( ! $schema_key ) {
		echo '<p>' . esc_html__( 'Esta página não possui campos editáveis do tema. Use os templates Home, Serviços, Quem Somos, BanBan ou Blog.', 'liderban-theme' ) . '</p>';
		return;
	}

	$schemas = liderban_get_editable_schemas();
	$schema  = $schemas[ $schema_key ];

	wp_nonce_field( 'liderban_save_page_content', 'liderban_page_content_nonce' );

	echo '<div class="liderban-editable">';
	echo '<p class="liderban-editable__intro">' . esc_html__( 'Edite textos e imagens abaixo. Campos vazios usam o conteúdo padrão do tema.', 'liderban-theme' ) . '</p>';

	foreach ( $schema['sections'] as $section_id => $section ) {
		liderban_render_editable_section( $section, $post->ID, 'page' );
	}

	echo '</div>';
}

/**
 * Renderiza página de configurações globais.
 */
function liderban_render_global_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$schema = liderban_schema_global();

	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Conteúdo global — Liderban', 'liderban-theme' ); ?></h1>
		<p><?php esc_html_e( 'Configure textos do rodapé, WhatsApp e página 404.', 'liderban-theme' ); ?></p>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'liderban_global_content' );
			echo '<div class="liderban-editable">';
			foreach ( $schema['sections'] as $section ) {
				liderban_render_editable_section( $section, 0, 'global' );
			}
			echo '</div>';
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Registra opções globais.
 */
function liderban_register_global_settings() {
	register_setting(
		'liderban_global_content',
		'liderban_global_content',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'liderban_sanitize_global_content',
		)
	);
}
add_action( 'admin_init', 'liderban_register_global_settings' );

/**
 * Renderiza uma seção de campos.
 *
 * @param array  $section Seção do schema.
 * @param int    $post_id ID da página (0 para global).
 * @param string $context page|global.
 */
function liderban_render_editable_section( $section, $post_id, $context ) {
	echo '<details class="liderban-editable__section" open>';
	printf( '<summary class="liderban-editable__section-title">%s</summary>', esc_html( $section['title'] ) );
	echo '<div class="liderban-editable__section-body">';

	foreach ( $section['fields'] as $key => $field ) {
		liderban_render_editable_field( $key, $field, $post_id, $context );
	}

	echo '</div></details>';
}

/**
 * Renderiza um campo individual.
 *
 * @param string $key     Chave do campo.
 * @param array  $field   Definição do campo.
 * @param int    $post_id ID da página.
 * @param string $context page|global.
 */
function liderban_render_editable_field( $key, $field, $post_id, $context ) {
	$type    = $field['type'];
	$label   = $field['label'];
	$default = isset( $field['default'] ) ? $field['default'] : '';

	if ( 'global' === $context ) {
		$options = get_option( 'liderban_global_content', array() );
		$value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
		$name    = 'liderban_global_content[' . $key . ']';
		$id      = 'liderban_global_' . $key;
	} else {
		$value = get_post_meta( $post_id, '_liderban_' . $key, true );
		$name  = 'liderban_fields[' . $key . ']';
		$id    = 'liderban_' . $key;
	}

	echo '<div class="liderban-field liderban-field--' . esc_attr( $type ) . '">';

	switch ( $type ) {
		case 'text':
			printf(
				'<label for="%1$s">%2$s</label><input type="text" id="%1$s" name="%3$s" value="%4$s" class="widefat" placeholder="%5$s" />',
				esc_attr( $id ),
				esc_html( $label ),
				esc_attr( $name ),
				esc_attr( $value ),
				esc_attr( is_string( $default ) ? $default : '' )
			);
			break;

		case 'textarea':
			printf(
				'<label for="%1$s">%2$s</label><textarea id="%1$s" name="%3$s" rows="4" class="widefat" placeholder="%5$s">%4$s</textarea>',
				esc_attr( $id ),
				esc_html( $label ),
				esc_attr( $name ),
				esc_textarea( $value ),
				esc_attr( is_string( $default ) ? $default : '' )
			);
			break;

		case 'lines':
			printf(
				'<label for="%1$s">%2$s</label><textarea id="%1$s" name="%3$s" rows="5" class="widefat" placeholder="%5$s">%4$s</textarea>',
				esc_attr( $id ),
				esc_html( $label ),
				esc_attr( $name ),
				esc_textarea( $value ),
				esc_attr( is_string( $default ) ? $default : '' )
			);
			break;

		case 'image':
			$attachment_id = 'global' === $context ? 0 : (int) get_post_meta( $post_id, '_liderban_' . $key . '_id', true );
			$preview       = '';

			if ( $attachment_id ) {
				$preview = wp_get_attachment_image_url( $attachment_id, 'medium' );
			} elseif ( is_string( $default ) && $default ) {
				$preview = liderban_asset( 'images/' . $default );
			}

			$id_name = 'global' === $context ? $name : 'liderban_fields[' . $key . '_id]';

			echo '<label>' . esc_html( $label ) . '</label>';
			echo '<div class="liderban-image-field" data-default="' . esc_attr( is_string( $default ) ? $default : '' ) . '">';
			echo '<div class="liderban-image-field__preview">';
			if ( $preview ) {
				echo '<img src="' . esc_url( $preview ) . '" alt="" />';
			}
			echo '</div>';
			printf(
				'<input type="hidden" class="liderban-image-id" name="%1$s" value="%2$s" />',
				esc_attr( $id_name ),
				esc_attr( (string) $attachment_id )
			);
			echo '<p class="liderban-image-field__actions">';
			echo '<button type="button" class="button liderban-image-select">' . esc_html__( 'Selecionar imagem', 'liderban-theme' ) . '</button> ';
			echo '<button type="button" class="button-link-delete liderban-image-remove">' . esc_html__( 'Remover', 'liderban-theme' ) . '</button>';
			echo '</p></div>';
			break;

		case 'repeater':
			$stored = 'global' === $context ? $value : $value;
			$items  = array();

			if ( $stored ) {
				$decoded = json_decode( $stored, true );
				if ( is_array( $decoded ) ) {
					$items = $decoded;
				}
			}

			if ( empty( $items ) && ! empty( $field['default'] ) ) {
				$items = $field['default'];
			}

			echo '<div class="liderban-repeater" data-name="' . esc_attr( $name ) . '">';
			echo '<label class="liderban-repeater__label">' . esc_html( $label ) . '</label>';
			echo '<input type="hidden" class="liderban-repeater__input" name="' . esc_attr( $name ) . '" value="' . esc_attr( wp_json_encode( $items ) ) . '" />';
			echo '<div class="liderban-repeater__items">';

			foreach ( $items as $index => $item ) {
				liderban_render_repeater_row( $field['subfields'], $item, $index );
			}

			echo '</div>';
			echo '<button type="button" class="button liderban-repeater__add">' . esc_html__( 'Adicionar item', 'liderban-theme' ) . '</button>';
			echo '<template class="liderban-repeater__template">';
			liderban_render_repeater_row( $field['subfields'], array(), '__INDEX__' );
			echo '</template>';
			echo '</div>';
			break;
	}

	echo '</div>';
}

/**
 * Renderiza uma linha de repeater.
 *
 * @param array       $subfields Subcampos.
 * @param array       $item      Valores da linha.
 * @param int|string  $index     Índice.
 */
function liderban_render_repeater_row( $subfields, $item, $index ) {
	echo '<div class="liderban-repeater__row" data-index="' . esc_attr( (string) $index ) . '">';
	echo '<div class="liderban-repeater__row-header">';
	printf( '<strong>%s #%s</strong>', esc_html__( 'Item', 'liderban-theme' ), esc_html( (string) $index ) );
	echo '<button type="button" class="button-link-delete liderban-repeater__remove">' . esc_html__( 'Remover', 'liderban-theme' ) . '</button>';
	echo '</div>';

	foreach ( $subfields as $sub_key => $sub_label ) {
		$sub_value = isset( $item[ $sub_key ] ) ? $item[ $sub_key ] : '';
		$is_image  = in_array( $sub_key, array( 'image' ), true );
		$is_lines  = in_array( $sub_key, array( 'items' ), true );

		echo '<div class="liderban-repeater__field">';
		printf( '<label>%s</label>', esc_html( $sub_label ) );

		if ( $is_image ) {
			$preview = $sub_value ? liderban_asset( 'images/' . $sub_value ) : '';
			echo '<div class="liderban-repeater-image">';
			echo '<div class="liderban-repeater-image__preview">';
			if ( $preview && ! filter_var( $sub_value, FILTER_VALIDATE_URL ) ) {
				echo '<img src="' . esc_url( $preview ) . '" alt="" />';
			} elseif ( $sub_value && filter_var( $sub_value, FILTER_VALIDATE_URL ) ) {
				echo '<img src="' . esc_url( $sub_value ) . '" alt="" />';
			}
			echo '</div>';
			printf(
				'<input type="text" class="widefat liderban-repeater-image__url" data-key="%1$s" value="%2$s" placeholder="%3$s" />',
				esc_attr( $sub_key ),
				esc_attr( $sub_value ),
				esc_attr__( 'Nome do arquivo (ex: img.jpg) ou URL', 'liderban-theme' )
			);
			echo '<button type="button" class="button liderban-repeater-image__select">' . esc_html__( 'Biblioteca de mídia', 'liderban-theme' ) . '</button>';
			echo '</div>';
		} elseif ( $is_lines ) {
			printf(
				'<textarea class="widefat" data-key="%1$s" rows="4">%2$s</textarea>',
				esc_attr( $sub_key ),
				esc_textarea( $sub_value )
			);
		} else {
			printf(
				'<input type="text" class="widefat" data-key="%1$s" value="%2$s" />',
				esc_attr( $sub_key ),
				esc_attr( $sub_value )
			);
		}

		echo '</div>';
	}

	echo '</div>';
}

/**
 * Salva campos da página.
 *
 * @param int $post_id ID do post.
 */
function liderban_save_page_content( $post_id ) {
	if ( ! isset( $_POST['liderban_page_content_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['liderban_page_content_nonce'] ) ), 'liderban_save_page_content' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	$schema_key = liderban_get_page_schema_key( $post_id );

	if ( ! $schema_key ) {
		return;
	}

	$fields = liderban_get_schema_fields( $schema_key );
	$data   = isset( $_POST['liderban_fields'] ) ? wp_unslash( $_POST['liderban_fields'] ) : array();

	if ( ! is_array( $data ) ) {
		$data = array();
	}

	foreach ( $fields as $key => $field ) {
		$type = $field['type'];

		if ( 'image' === $type ) {
			$attachment_id = isset( $data[ $key . '_id' ] ) ? absint( $data[ $key . '_id' ] ) : 0;

			if ( $attachment_id ) {
				update_post_meta( $post_id, '_liderban_' . $key . '_id', $attachment_id );
				$url = wp_get_attachment_url( $attachment_id );
				update_post_meta( $post_id, '_liderban_' . $key, $url ? $url : '' );
			} else {
				delete_post_meta( $post_id, '_liderban_' . $key . '_id' );
				delete_post_meta( $post_id, '_liderban_' . $key );
			}
			continue;
		}

		if ( ! isset( $data[ $key ] ) ) {
			delete_post_meta( $post_id, '_liderban_' . $key );
			continue;
		}

		$value = $data[ $key ];

		if ( in_array( $type, array( 'repeater' ), true ) ) {
			$decoded = json_decode( $value, true );
			$value   = is_array( $decoded ) ? wp_json_encode( $decoded ) : '';
		} else {
			$value = 'textarea' === $type || 'lines' === $type
				? sanitize_textarea_field( $value )
				: sanitize_text_field( $value );
		}

		if ( '' === $value ) {
			delete_post_meta( $post_id, '_liderban_' . $key );
		} else {
			update_post_meta( $post_id, '_liderban_' . $key, $value );
		}
	}
}
add_action( 'save_post_page', 'liderban_save_page_content' );

/**
 * Sanitiza opções globais.
 *
 * @param array $input Valores enviados.
 * @return array
 */
function liderban_sanitize_global_content( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}

	$fields  = liderban_get_schema_fields( 'global' );
	$cleaned = array();

	foreach ( $fields as $key => $field ) {
		if ( ! isset( $input[ $key ] ) ) {
			continue;
		}

		$cleaned[ $key ] = in_array( $field['type'], array( 'textarea', 'lines' ), true )
			? sanitize_textarea_field( $input[ $key ] )
			: sanitize_text_field( $input[ $key ] );
	}

	return $cleaned;
}

/**
 * Retorna URL do WhatsApp com mensagem.
 *
 * @param string $message Mensagem.
 * @return string
 */
function liderban_whatsapp_url( $message = '' ) {
	$number = preg_replace( '/\D+/', '', liderban_option( 'whatsapp_number', '553125367500' ) );
	$url    = 'https://wa.me/' . $number;

	if ( $message ) {
		$url .= '?text=' . rawurlencode( $message );
	}

	return $url;
}

/**
 * Resolve imagem de repeater (URL ou asset do tema).
 *
 * @param string $value Valor salvo.
 * @return string
 */
function liderban_resolve_image_value( $value ) {
	if ( ! $value ) {
		return '';
	}

	if ( filter_var( $value, FILTER_VALIDATE_URL ) ) {
		return $value;
	}

	return liderban_asset( 'images/' . ltrim( $value, '/' ) );
}

/**
 * Converte campo items de repeater em array.
 *
 * @param string $value Texto com itens.
 * @return array
 */
function liderban_parse_repeater_items( $value ) {
	if ( ! $value ) {
		return array();
	}

	return array_values( array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $value ) ) ) ) );
}
