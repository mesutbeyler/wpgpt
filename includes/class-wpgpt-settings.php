<?php

class WPGPT_Settings {

	private string $title;
	private string $menu_title;
	private string $description;
	private array $sections;
	private array $settings;
	private array $default_section_args       = array(
		'id'          => '',
		'title'       => '',
		'description' => '',
	);
	private array $default_setting_args       = array(
		'section'           => '',
		'name'              => '',
		'label'             => '',
		'description'       => '',
		'type'              => 'string',
		'control_type'      => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'show_in_rest'      => false,
		'default'           => '',
		'required'          => false,
		'args'              => array(),
	);
	private array $default_range_setting_args = array(
		'min'  => 0,
		'max'  => 10,
		'step' => 1,
	);
	private array $kses_page_description      = array(
		'strong' => true,
		'em'     => true,
		'span'   => true,
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
		),
	);
	private array $kses_section_description   = array(
		'strong' => true,
		'em'     => true,
		'span'   => true,
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
		),
	);
	private array $kses_setting_description   = array(
		'strong' => true,
		'em'     => true,
		'span'   => true,
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
		),
	);
	private array $kses_admin_notice          = array(
		'strong' => true,
		'em'     => true,
		'span'   => true,
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
		),
	);

	public function __construct() {
		$this->title       = __( 'WPGPT Settings', 'wpgpt' );
		$this->menu_title  = __( 'WPGPT', 'wpgpt' );
		$this->description = __( 'This is the settings page description.', 'wpgpt' );
		$this->sections    = array(
			array(
				'id'          => 'wpgpt_openai_api',
				'title'       => __( 'OpenAI API', 'wpgpt' ),
				'description' => __( 'Configure the <a href="https://www.openai.com" target="_blank" rel="noopener noreferrer">OpenAI</a> API.', 'wpgpt' ),
			),
			array(
				'id'          => 'wpgpt_defaults',
				'title'       => __( 'Defaults', 'wpgpt' ),
				'description' => __( 'Configure various default values.', 'wpgpt' ),
			),
		);
		$this->settings    = array(
			array(
				'section'           => 'wpgpt_openai_api',
				'name'              => 'wpgpt_openai_api_key',
				'label'             => __( 'API Key', 'wpgpt' ),
				'description'       => __( 'Enter an <a href="https://platform.openai.com/account/api-keys/" target="_blank" rel="noopener noreferrer">OpenAI API key</a>. This will be passed with your requests and will be used to <a href="https://platform.openai.com/account/usage/" target="_blank" rel="noopener noreferrer">track usage</a>.', 'wpgpt' ),
				'type'              => 'string',
				'control_type'      => 'password',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
				'required'          => true,
			),
			array(
				'section'           => 'wpgpt_defaults',
				'name'              => 'wpgpt_default_max_tokens',
				'label'             => __( 'Maximum Tokens', 'wpgpt' ),
				'description'       => __( 'Select a value between <em>50</em> and <em>4000</em> to be used as the <a href="https://platform.openai.com/docs/api-reference/chat/create#chat/create-max_tokens" target="_blank" rel="noopener noreferrer">maximum tokens</a> for responses. Tokens can be thought of as pieces of words. <a href="https://help.openai.com/en/articles/4936856-what-are-tokens-and-how-to-count-them" target="_blank" rel="noopener noreferrer">Learn more about how to count tokens</a>', 'wpgpt' ),
				'type'              => 'number',
				'control_type'      => 'number',
				'sanitize_callback' => 'intval',
				'default'           => 3000,
				'args'              => array(
					'min'  => 100,
					'max'  => 3000,
					'step' => 1,
				),
			),
			array(
				'section'           => 'wpgpt_defaults',
				'name'              => 'wpgpt_default_temperature',
				'label'             => __( 'Temperature', 'wpgpt' ),
				'description'       => __( 'Select a value between <em>0</em> and <em>1</em> to be used as the <a href="https://platform.openai.com/docs/api-reference/chat/create#chat/create-temperature" target="_blank" rel="noopener noreferrer">temperature</a> for prompts. Higher values like <em>0.8</em> will make the output more random, while lower values like <em>0.2</em> will make it more focused and deterministic.', 'wpgpt' ),
				'type'              => 'number',
				'control_type'      => 'range',
				'sanitize_callback' => 'floatval',
				'default'           => 0.5,
				'args'              => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				),
			),
			array(
				'section'           => 'wpgpt_defaults',
				'name'              => 'wpgpt_default_presence_penalty',
				'label'             => __( 'Presence Penalty', 'wpgpt' ),
				'description'       => __( 'Select a value between <em>-2</em> and <em>2</em> to be used as the <a href="https://platform.openai.com/docs/api-reference/chat/create#chat/create-presence_penalty" target="_blank" rel="noopener noreferrer">presence penalty</a> for responses. Positive values penalize new tokens based on whether they appear in the text so far, increasing the model\'s likelihood to talk about new topics. <a href="https://platform.openai.com/docs/api-reference/parameter-details" target="_blank" rel="noopener noreferrer">Learn more about presence penalties</a>', 'wpgpt' ),
				'type'              => 'number',
				'control_type'      => 'range',
				'sanitize_callback' => 'floatval',
				'default'           => 0,
				'args'              => array(
					'min'  => -2,
					'max'  => 2,
					'step' => 0.1,
				),
			),
			array(
				'section'           => 'wpgpt_defaults',
				'name'              => 'wpgpt_default_frequency_penalty',
				'label'             => __( 'Frequency Penalty', 'wpgpt' ),
				'description'       => __( 'Select a value between <em>-2</em> and <em>2</em> to be used as the <a href="https://platform.openai.com/docs/api-reference/chat/create#chat/create-frequency_penalty" target="_blank" rel="noopener noreferrer">frequency penalty</a> for responses. Positive values penalize new tokens based on their existing frequency in the text so far, decreasing the model\'s likelihood to repeat the same line verbatim. <a href="https://platform.openai.com/docs/api-reference/parameter-details" target="_blank" rel="noopener noreferrer">Learn more about frequency penalties</a>', 'wpgpt' ),
				'type'              => 'number',
				'control_type'      => 'range',
				'sanitize_callback' => 'floatval',
				'default'           => 0,
				'args'              => array(
					'min'  => -2,
					'max'  => 2,
					'step' => 0.1,
				),
			),
		);
	}

	public function init() {
		add_action( 'admin_notices', array( $this, 'print_admin_notices' ), 10 );
		add_action( 'admin_menu', array( $this, 'register_page' ), 10 );
		add_action( 'admin_init', array( $this, 'register_sections' ), 10 );
		add_action( 'admin_init', array( $this, 'register_settings' ), 10 );
		add_action( 'admin_print_styles-settings_page_wpgpt', array( $this, 'print_styles' ) );
		add_action( 'admin_print_footer_scripts-settings_page_wpgpt', array( $this, 'print_scripts' ) );
	}

	public function print_admin_notices() {
		$settings = $this->get_settings();
		foreach ( $settings as $setting ) {
			$value = get_option( $setting['name'] );
			if ( $setting['required'] && empty( $value ) ) {
				$this->print_admin_notice(
					sprintf(
						/* translators: 1: setting label, 2: setting name. */
						__( 'A value for <strong>%1$s</strong> (<em>%2$s</em>) is required.', 'wpgpt' ),
						$setting['label'],
						$setting['name']
					),
					'error'
				);
			}
		}
	}

	public function print_admin_notice( $text, $variant = 'info', $is_dismissible = false ) {
		$message = sprintf(
			/* translators: 1: notice message. */
			__( '[WPGPT] %1$s', 'wpgpt' ),
			$text
		);
		$class_map = array(
			'notice'         => true,
			'notice-error'   => ( $variant === 'error' ),
			'notice-warning' => ( $variant === 'warning' ),
			'notice-success' => ( $variant === 'success' ),
			'notice-info'    => ( $variant === 'info' ),
			'is-dismissible' => $is_dismissible,
		);
		$classes   = array();
		foreach ( $class_map as $class => $is_valid ) {
			if ( $is_valid ) {
				$classes[] = sanitize_html_class( $class );
			}
		} ?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<p><?php echo wp_kses( $message, $this->kses_admin_notice ); ?></p>
		</div>
	<?php }

	public function get_sections(): array {
		$sections = array();
		foreach ( $this->sections as $section ) {
			$sections[] = wp_parse_args( $section, $this->default_section_args );
		}
		return $sections;
	}

	public function get_settings(): array {
		$settings = array();
		foreach ( $this->settings as $setting ) {
			$settings[] = wp_parse_args( $setting, $this->default_setting_args );
		}
		return $settings;
	}

	public function register_page() {
		add_options_page(
			$this->title,
			$this->menu_title,
			'manage_options',
			'wpgpt',
			array( $this, 'render_page' )
		);
	}

	public function register_sections() {
		$sections = $this->get_sections();
		foreach ( $sections as $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				array( $this, 'render_section' ),
				'wpgpt',
				array(
					'description' => $section['description'],
				)
			);
		}
	}

	public function register_settings() {
		$settings = $this->get_settings();
		foreach ( $settings as $setting ) {
			$label = sprintf( '%1$s%2$s', $setting['label'], $setting['required'] ? ' *' : '' );
			$class = sprintf( 'wpgpt-setting wpgpt-setting--type-%1$s', $setting['control_type'] );
			register_setting(
				'wpgpt',
				$setting['name'],
				array(
					'type'              => $setting['type'],
					'description'       => $setting['description'],
					'sanizize_callback' => $setting['sanitize_callback'],
					'default'           => $setting['default'],
					'show_in_rest'      => $setting['show_in_rest'],
				)
			);
			add_settings_field(
				$setting['name'],
				$label,
				array( $this, 'render_setting' ),
				'wpgpt',
				$setting['section'],
				array(
					'class'     => $class,
					'label_for' => $setting['name'],
					'setting'   => $setting,
				),
			);
		}
	}

	public function render_setting( array $args ) {
		switch ( $args['setting']['control_type'] ) {
			case 'range':
				$this->render_range_control( $args['setting'] );
				break;
			default:
				$this->render_text_control( $args['setting'] );
				break;
		}
		if ( ! empty( $args['setting']['description'] ) ) { ?>
			<p class="description">
				<?php echo wp_kses( $args['setting']['description'], $this->kses_setting_description ); ?>
			</p>
		<?php }
	}

	public function render_text_control( array $setting ) {
		$value = get_option( $setting['name'] ); ?>
		<input
		id="<?php echo esc_attr( $setting['name'] ); ?>"
		name="<?php echo esc_attr( $setting['name'] ); ?>"
		type="<?php echo esc_attr( $setting['control_type'] ); ?>"
		value="<?php echo esc_attr( $value ); ?>"
		class="regular-text"
		autocomplete="<?php echo ( $setting['control_type'] === 'password' ? 'new-password' : 'off' ); ?>"
		<?php echo $setting['required'] ? 'required' : '' ?> />
	<?php }

	public function render_range_control( array $setting ) {
		$value      = get_option( $setting['name'] );
		$args       = wp_parse_args( $setting['args'], $this->default_range_setting_args );
		$preview_id = sprintf( '%1$s-preview', $setting['name'] ); ?>
		<input
		id="<?php echo esc_attr( $setting['name'] ); ?>"
		name="<?php echo esc_attr( $setting['name'] ); ?>"
		type="range"
		value="<?php echo esc_attr( $value ); ?>"
		autocomplete="off"
		min="<?php echo floatval( $args['min'] ); ?>"
		max="<?php echo floatval( $args['max'] ); ?>"
		step="<?php echo floatval( $args['step'] ); ?>"
		data-preview-id="<?php echo esc_attr( $preview_id ); ?>"
		style="vertical-align:middle;"
		<?php echo $setting['required'] ? 'required' : '' ?>
		oninput="document.getElementById(this.dataset.previewId).innerHTML = this.value;" />
		<span
		id="<?php echo esc_attr( $preview_id ); ?>"
		style="vertical-align:middle;">
			<?php echo floatval( $value ); ?>
		</span>
	<?php }

	public function render_section( array $args ) {
		if ( ! empty( $args['description'] ) ) { ?>
			<p class="description">
				<?php echo wp_kses( $args['description'], $this->kses_section_description ); ?>
			</p>
		<?php }
	}

	public function print_styles() { ?>
		<style id="wpgpt-settings-page-styles">

			.wpgpt-setting--type-range input[type="range"] {
				width: 100%;
				vertical-align: middle;
			}

			.wpgpt-setting--type-range input[type="range"] + span {
				vertical-align: middle;
				font-style: italic;
				font-weight: bold;
			}

			@media screen and (min-width: 783px) {
				.wpgpt-setting--type-range input[type="range"] {
					width: 25em;
				}
			}

		</style>
	<?php }

	public function print_scripts() { ?>
		<script id="wpgpt-settings-page-scripts">

		</script>
	<?php }

	public function render_page() { ?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<p class="description"><?php echo wp_kses( $this->description, $this->kses_page_description ); ?></p>
			<form action="options.php" method="POST">
				<?php settings_fields( 'wpgpt' ); ?>
				<?php do_settings_sections( 'wpgpt' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<style>
		</style>
	<?php }
}
