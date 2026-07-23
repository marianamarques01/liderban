<?php
/**
 * Configurações do plugin Instagram Feed.
 *
 * @package Liderban_Instagram_Feed
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Liderban_Instagram_Settings {

	const OPTION_KEY = 'liderban_instagram_settings';

	/**
	 * Inicializa hooks de administração.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
	}

	/**
	 * Registra página no menu Configurações.
	 */
	public static function register_menu() {
		add_options_page(
			__( 'Instagram Liderban', 'liderban-instagram-feed' ),
			__( 'Instagram Liderban', 'liderban-instagram-feed' ),
			'manage_options',
			'liderban-instagram-feed',
			array( __CLASS__, 'render_page' )
		);
	}

	/**
	 * Registra opções e campos.
	 */
	public static function register_settings() {
		register_setting(
			'liderban_instagram_settings_group',
			self::OPTION_KEY,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( __CLASS__, 'sanitize_settings' ),
				'default'           => self::get_defaults(),
			)
		);

		add_settings_section(
			'liderban_instagram_main',
			__( 'Conexão com Instagram', 'liderban-instagram-feed' ),
			array( __CLASS__, 'render_section' ),
			'liderban-instagram-feed'
		);

		self::add_field( 'username', __( 'Usuário do Instagram', 'liderban-instagram-feed' ), 'text' );
		self::add_field( 'user_id', __( 'ID da conta (Instagram Business)', 'liderban-instagram-feed' ), 'text' );
		self::add_field( 'access_token', __( 'Access Token', 'liderban-instagram-feed' ), 'password' );
		self::add_field( 'cache_ttl', __( 'Cache (segundos)', 'liderban-instagram-feed' ), 'number' );
	}

	/**
	 * Adiciona um campo de configuração.
	 *
	 * @param string $key   Chave da opção.
	 * @param string $label Rótulo exibido no admin.
	 * @param string $type  Tipo HTML do input.
	 */
	private static function add_field( $key, $label, $type ) {
		add_settings_field(
			'liderban_instagram_' . $key,
			$label,
			array( __CLASS__, 'render_field' ),
			'liderban-instagram-feed',
			'liderban_instagram_main',
			array(
				'key'  => $key,
				'type' => $type,
			)
		);
	}

	/**
	 * Valores padrão das configurações.
	 *
	 * @return array<string, mixed>
	 */
	public static function get_defaults() {
		return array(
			'username'     => 'liderban',
			'user_id'      => '',
			'access_token' => '',
			'cache_ttl'    => 3600,
		);
	}

	/**
	 * Retorna todas as configurações mescladas com defaults.
	 *
	 * @return array<string, mixed>
	 */
	public static function get_all() {
		$stored = get_option( self::OPTION_KEY, array() );

		if ( ! is_array( $stored ) ) {
			$stored = array();
		}

		return wp_parse_args( $stored, self::get_defaults() );
	}

	/**
	 * Retorna o username configurado.
	 *
	 * @return string
	 */
	public static function get_username() {
		$settings = self::get_all();

		return sanitize_text_field( $settings['username'] );
	}

	/**
	 * Sanitiza os dados enviados pelo formulário.
	 *
	 * @param mixed $input Dados brutos.
	 * @return array<string, mixed>
	 */
	public static function sanitize_settings( $input ) {
		$defaults = self::get_defaults();
		$current  = self::get_all();
		$input    = is_array( $input ) ? $input : array();

		$sanitized = array(
			'username'  => sanitize_text_field( $input['username'] ?? $defaults['username'] ),
			'user_id'   => sanitize_text_field( $input['user_id'] ?? '' ),
			'cache_ttl' => absint( $input['cache_ttl'] ?? $defaults['cache_ttl'] ),
		);

		$new_token = isset( $input['access_token'] ) ? trim( (string) $input['access_token'] ) : '';

		if ( '' !== $new_token ) {
			$sanitized['access_token'] = sanitize_text_field( $new_token );
		} else {
			$sanitized['access_token'] = $current['access_token'];
		}

		if ( $sanitized['cache_ttl'] < 300 ) {
			$sanitized['cache_ttl'] = 300;
		}

		delete_transient( Liderban_Instagram_API::TRANSIENT_KEY );

		return $sanitized;
	}

	/**
	 * Descrição da seção de configurações.
	 */
	public static function render_section() {
		echo '<p>';
		esc_html_e(
			'Configure a Instagram Graph API para exibir as postagens da conta @liderban no site. É necessário uma conta Instagram Business/Creator vinculada a uma Página do Facebook.',
			'liderban-instagram-feed'
		);
		echo '</p>';
	}

	/**
	 * Renderiza um campo de configuração.
	 *
	 * @param array<string, string> $args Argumentos do campo.
	 */
	public static function render_field( $args ) {
		$key      = $args['key'];
		$type     = $args['type'];
		$settings = self::get_all();
		$value    = $settings[ $key ] ?? '';

		if ( 'password' === $type && '' !== $value ) {
			$value = '';
		}

		printf(
			'<input type="%1$s" id="liderban_instagram_%2$s" name="%3$s[%2$s]" value="%4$s" class="regular-text"%5$s />',
			esc_attr( $type ),
			esc_attr( $key ),
			esc_attr( self::OPTION_KEY ),
			esc_attr( (string) $value ),
			'password' === $type && '' !== ( $settings[ $key ] ?? '' ) ? ' placeholder="' . esc_attr__( 'Token já configurado — deixe em branco para manter', 'liderban-instagram-feed' ) . '"' : ''
		);

		if ( 'user_id' === $key ) {
			echo '<p class="description">' . esc_html__( 'ID numérico da conta Instagram Business (não é o @usuario).', 'liderban-instagram-feed' ) . '</p>';
		}

		if ( 'access_token' === $key ) {
			echo '<p class="description">' . esc_html__( 'Token de longa duração gerado no Meta for Developers.', 'liderban-instagram-feed' ) . '</p>';
		}
	}

	/**
	 * Renderiza a página de configurações.
	 */
	public static function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$settings = self::get_all();
		$posts    = liderban_instagram_get_posts( 4 );
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Instagram Liderban', 'liderban-instagram-feed' ); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'liderban_instagram_settings_group' );
				do_settings_sections( 'liderban-instagram-feed' );
				submit_button();
				?>
			</form>

			<hr>

			<h2><?php esc_html_e( 'Status da conexão', 'liderban-instagram-feed' ); ?></h2>
			<?php if ( empty( $settings['access_token'] ) || empty( $settings['user_id'] ) ) : ?>
				<p><?php esc_html_e( 'Configure o Access Token e o ID da conta para ativar o feed.', 'liderban-instagram-feed' ); ?></p>
			<?php elseif ( empty( $posts ) ) : ?>
				<p><?php esc_html_e( 'Credenciais configuradas, mas nenhuma postagem foi retornada. Verifique o token e o ID da conta.', 'liderban-instagram-feed' ); ?></p>
			<?php else : ?>
				<p>
					<?php
					printf(
						/* translators: %d: number of posts */
						esc_html__( 'Conexão OK — %d postagens disponíveis no cache.', 'liderban-instagram-feed' ),
						count( $posts )
					);
					?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}
