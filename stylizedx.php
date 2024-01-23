<?php
/**
 * Plugin Name:       StylizedX
 * Description:       Style variations color switcher, dark mode for FSE themes
 * Version:           1.0.0
 * Author:            DeoThemes
 * Author URI:        https://deothemes.com
 * Plugin URI:        https://ona.deothemes.com/ona-news
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       stylizedx
 * Domain Path:       /languages
 *
 * @link https://deothemes.com
 * @since 1.0.0
 * @package StylizedX
*/

if ( ! defined( 'ABSPATH' ) )   exit; // Exit if accessed directly.

define( 'STYLIZEDX_VERSION', '1.0.0' );
define( 'STYLIZEDX_URL', plugin_dir_url( __FILE__ ) );
define( 'STYLIZEDX_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'StylizedX' ) ) :

	/**
	* Main StylizedX Class.
	*
	* @since 1.0.0
	*/
	final class StylizedX {
		/**
		 * This plugin's instance.
		 *
		 * @var StylizedX
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		* Main StylizedX Instance.
		*
		* Insures that only one instance of StylizedX exists in memory at any one
		* time. Also prevents needing to define globals all over the place.
		*
		* @since 1.0.0
		* @static
		* @return object|StylizedX The one true StylizedX
		*/
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof StylizedX ) ) {
				self::$instance = new StylizedX();
				self::$instance->init();
			}
			return self::$instance;
		}

		/**
		 * Load actions
		 *
		 * @return void
		 */
		private function init() {
			$this->includes();

			add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), 10, 2 );
			add_action( 'init', array( $this, 'register_blocks' ), 99 );
			
			// Enqueue assets
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );			
			add_action( 'wp_head', array( $this, 'enqueue_scripts' ), 7 );			
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );			

			// Ajax actions
			add_action( 'wp_ajax_stylizedx_style_switcher_ajax_action', array( $this, 'style_switcher_ajax' ) );
			add_action( 'wp_ajax_nopriv_stylizedx_style_switcher_ajax_action', array( $this, 'style_switcher_ajax' ) );
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @since 1.0.0
		 * @return void
		 */
		private function includes() {
			require_once STYLIZEDX_PATH . 'admin/class-stylizedx-admin.php';
		}

		/**
		 * Enqueue scripts
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'stylizedx-scripts', STYLIZEDX_URL . '/assets/js/scripts.js', array(), STYLIZEDX_VERSION, array( 'strategy' => 'defer' ));
			wp_localize_script( 'stylizedx-scripts', 'stylizedx_ajax',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'ajax_nonce' => wp_create_nonce( 'stylizedx_nonce' )					
				) );
		}

		/**
		 * Enqueue assets
		 */
		public function enqueue_assets() {
			wp_enqueue_style( 'stylizedx-style', STYLIZEDX_URL . '/assets/css/style.css', array(), STYLIZEDX_VERSION );
		}

		public function register_blocks() {
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type(
				STYLIZEDX_PATH . '/build'
			);
		}

		/**
		 * Enqueue admin assets
		 */
		public function enqueue_admin_assets() {
			wp_enqueue_style( 'stylizedx-admin-styles', STYLIZEDX_URL . '/admin/style.css', array(), STYLIZEDX_VERSION );
		}

		/**
		 * Register blocks categories
		 */
		public function register_block_categories( $categories ) {
			return array_merge(
				$categories,
					array(
						array(
							'slug' => 'stylizedx-category',
							'title' => esc_html__( 'StylizedX', 'stylizedx' )
						)
					)
				);
		}

		/**
		 * Ajax action
		 */
		public function style_switcher_ajax() {
			check_ajax_referer( 'stylizedx_nonce', 'security' );

			$settings = get_option( 'stylizedx_settings', array() );

			$json_resolver = new WP_Theme_JSON_Resolver();
			$data = $json_resolver->get_theme_data();
			$variations = $json_resolver::get_style_variations();
			$selected_variation = '';

			if ( ! empty( $settings ) ) {
				if ( isset( $settings['variation'] ) ) {
					foreach ( $variations as $variation ) {
						if ( $variation['title'] === $settings['variation'] ) {
							$selected_variation = $variation;
						}
					}
				}
			}
			else {
				if ( is_array( $variations ) ) {
					$selected_variation = $variations[0];
				}
			}

			$json = new WP_Theme_JSON( $selected_variation, 'theme' );
			$origins = array( 'default', 'theme', 'custom' );
			$css = $json->get_stylesheet( array( 'variables' ), $origins );

			wp_send_json_success( $css ); 
		}
		
	}
endif;

/**
 * The main function for that returns StylizedX
 *
 * The main function responsible for returning the one true StylizedX
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $stylizedx = StylizedX(); ?>
 *
 * @since 1.0.0
 * @return object|StylizedX The one true StylizedX Instance.
 */
function StylizedX() {
	return StylizedX::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	add_action( 'plugins_loaded', 'StylizedX', 90 );
} else {
	StylizedX();
}