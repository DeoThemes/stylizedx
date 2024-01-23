<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://deothemes.com
 * @since      1.0.0
 *
 * @package    StylizedX
 * @subpackage StylizedX/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class StylizedX_Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu_pages' ] );
		add_action( 'admin_init', [ $this, 'add_plugin_options' ] );
	}

	/**
	 * Add menu pages.
	 *
	 * @since    1.0.0
	 */
	public function add_menu_pages() {

		add_menu_page(
			esc_html__( 'StylizedX', 'stylizedx' ),
			esc_html__( 'StylizedX', 'stylizedx' ),
			'manage_options',
			'stylizedx',
			[ $this, 'admin_page_content' ],
			'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAxOCAxOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xOCA5QzE4IDEzLjk3MDYgMTMuOTcwNiAxOCA5IDE4QzQuMDI5NDQgMTggMCAxMy45NzA2IDAgOUMwIDQuMDI5NDQgNC4wMjk0NCAwIDkgMEMxMy45NzA2IDAgMTggNC4wMjk0NCAxOCA5Wk0yLjk5Mjc0IDkuNDgwODFDMi45ODQzNyAxMS40MTk5IDQuNTMzMjEgMTIuOTk4OSA2LjQ0NjUxIDEyLjk5ODlDNy4yMjUxMiAxMi45OTg5IDcuOTc4NjEgMTIuNzMyNCA4LjU4OTc3IDEyLjI0NTJMOC43MjM3MiAxMi4xMjY3TDguNzY1NTggMTIuMDg0NEwxMi41NDk4IDguNjM0MDNDMTIuMDY4MSA4LjA5MjEgMTEuMjQzNyA4LjA0NTI0IDEwLjcxMjQgOC41MzI0Mkw3Ljg1NzQ5IDExLjEzNkM3LjQ2NzkxIDExLjQ4MzEgNi45NjU1OCAxMS42NzQgNi40NDY1MSAxMS42NzRDNS4yNTMyMSAxMS42NzQgNC4yNzgxNCAxMC42Nzg3IDQuMjk5MzUgOS40NjM4N0M0LjMyMDU2IDguMjY5OTIgNS4yOTk1NCA3LjMxNzU4IDYuNDgwNTYgNy4zMTc1OEg3LjM3NTgxQzguMDk1ODEgNy4zMTc1OCA4LjY3NzQgNi43Mjg3OSA4LjY3NzQgNS45OTY2MUg2LjQ4ODM3QzQuNTc1NjMgNi4wMDA1NiAzLjAwMTEyIDcuNTUwMTYgMi45OTI3NCA5LjQ4MDgxWk05LjQwNTc3IDYuNzU0MTlIOS40MTQxNEMxMC4wMjE0IDYuMjY3NTggMTAuNzc0OSA2LjAwMDU2IDExLjU1MjkgNi4wMDUwOEMxMy40NjYyIDYuMDA1MDggMTUuMDE1MSA3LjU4NDAzIDE1LjAwNjcgOS41MjMxNEMxNC45OTgzIDExLjQ0OTggMTMuNDIwNSAxMi45OTk0IDExLjUxNTUgMTMuMDAyOEg5LjMyNTk1QzkuMzI1OTUgMTIuMjcwMSA5LjkwODA5IDExLjY4MTkgMTAuNjI4MSAxMS42ODE5SDExLjUyMzlDMTIuNzA0OSAxMS42ODE5IDEzLjY4ODQgMTAuNzI5NSAxMy43MDUxIDkuNTI3MUMxMy43MjU4IDguMzEyMjYgMTIuNzUwNyA3LjMxNzAyIDExLjU1NzQgNy4zMTcwMkMxMS4wNDI4IDcuMzE3MDIgMTAuNTM2NiA3LjUwNzI2IDEwLjE0NyA3Ljg1NDQzTDcuMjkyMDkgMTAuNDU4NUM2Ljc2MDE5IDEwLjk0NTcgNS45MzU4MSAxMC44OTg5IDUuNDU0MTQgMTAuMzU2OUw5LjQwNTc3IDYuNzU0MTlaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K',
			2
		);
	}

	public function admin_page_content() {
		?>
		<div class="stylizedx-page-header">
			<div class="stylizedx-page-header__container">
				<div class="stylizedx-page-header__branding">

						<img src="<?php echo esc_url( STYLIZEDX_URL . '/admin/logo.png' ); ?>" class="stylizedx-page-header__logo" alt="<?php echo esc_attr__( 'StylizedX', 'stylizedx' ); ?>" />

					<span class="stylizedx-version"><?php echo esc_html( STYLIZEDX_VERSION ); ?></span>
				</div>
				<div class="stylizedx-page-header__tagline">
					<span  class="stylizedx-page-header__tagline-text">				
						<?php echo esc_html__( 'Made by ', 'stylizedx' ); ?>
						<a href="https://deothemes.com/"><?php echo esc_html__( 'DeoThemes', 'stylizedx' ); ?></a>						
					</span>					
				</div>				
			</div>
		</div>

		<div class="wrap stylizedx-container">
			<div class="stylizedx-grid">
				<div class="stylizedx-grid-content">
					<div class="stylizedx-body">

						<ol class="stylizedx-list">
							<li><?php echo esc_html__( 'Select style variaton and Save changes.', 'stylizedx' ) ?></li>
							<li><?php echo esc_html__( 'Add Switcher block anywhere on a page.', 'stylizedx' ) ?></li>
						</ol>

						<?php settings_errors(); ?>
						<form name="stylizedx-options-form" method="post" action="options.php">
							<?php 
								settings_fields( 'stylizedx-settings-group' );
								do_settings_sections( 'stylizedx' );
								submit_button();
							?>
						</form>

					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public function add_plugin_options() {

		// Settings
		register_setting(
			'stylizedx-settings-group',
			'stylizedx_settings',
			array(
				'type' => 'array',
				'sanitize_callback' => [ $this, 'sanitize_options' ]
			)
		);

		// Sections
		add_settings_section(
			'stylizedx_section',
			'',
			'',
			'stylizedx'
		);

		// Fields
		add_settings_field(
			'stylizedx_variations_select',
			esc_html__( 'Style Variation', 'stylizedx' ),
			[ $this, 'select_field' ],
			'stylizedx',
			'stylizedx_section'
		);

	}



	/**
	* Select field.
	*
	* @since    1.0.0
	*/
	public function select_field() {
		$json_resolver = new WP_Theme_JSON_Resolver();
		$variations = $json_resolver::get_style_variations();
		$settings = get_option( 'stylizedx_settings', array() );

		?>
		<select name="stylizedx_settings[variation]" class="placeholder placeholder-active">
			<option value=""><?php esc_attr_e( 'Default', 'stylizedx' ); ?></option>
			<?php if ( ! empty( $variations ) ) : ?>
				<?php foreach ( $variations as $variation ) : ?>
					<option value="<?php echo esc_attr( $variation['title'] ); ?>" <?php selected( $variation['title'], isset( $settings['variation'] ) ? $settings['variation'] : '', true ); ?>><?php echo esc_attr( $variation['title'] ); ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<?php
	}


	/**
	* Sanitize options
	*
	* @return mixed
	* @since    1.0.0
	*/
	function sanitize_options( $options ) {
		$sanitized = array();
		foreach ( $options as $option => $value ) {
			$sanitized[ $option ] = ( isset( $options[$option] ) ) ? sanitize_text_field( $value ) : '';
		}
		return $sanitized;
	}

}

$stylizedx_admin = new StylizedX_Admin();
