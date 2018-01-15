<?php
/**
 * Plugin.php
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

use Carbon_Fields\Helper\Helper;

use ColbyComms\Collapsible\WpFunctions as WP;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Performs core plugin setup.
 */
class Plugin {
	/**
	 * Adds hooks.
	 */
	public function __construct() {
		WP::add_action( 'init', [ __CLASS__, 'remove_tboot_shortcodes' ] );
		WP::add_action( 'init', [ __CLASS__, 'register_container_shortcodes' ] );
		WP::add_action( 'wp_enqueue_scripts', [ __CLASS__, 'register_script_and_style' ] );
		WP::add_action( 'wp_enqueue_scripts', [ __CLASS__, 'maybe_enqueue_script' ] );
		WP::add_action( 'wp_enqueue_scripts', [ __CLASS__, 'maybe_enqueue_style' ] );
	}

	/**
	 * Handles legacy shortcodes that no longer do anything.
	 */
	public static function register_container_shortcodes() {
		WP::add_shortcode( 'tboot_accordion', [ __CLASS__, 'render_collapsible_container' ] );
		WP::add_shortcode( 'collapsible-container', [ __CLASS__, 'render_collapsible_container' ] );
	}

	/**
	 * Returns the content unmodified.
	 *
	 * @param array  $_ Unused $atts param.
	 * @param string $content The shortcode content.
	 * @return string
	 */
	public static function render_collapsible_container( $_, $content = '' ) {
		return WP::apply_filters( 'the_content', $content );
	}

	/**
	 * Registers the plugin's script.
	 */
	public static function register_script_and_style() {
		$root_url = WP::plugin_dir_url( dirname( __DIR__ ) . '/index.php' );

		// If the root dir wasn't found, the plugin was probably installed via Composer in a theme.
		if ( ! file_exists( $root_url ) && function_exists( 'get_template_directory_uri' ) ) {
			$root_url = WP::get_template_directory_uri() . '/vendor/colbycomms/wp-collapsible/';
		}

		$dist = "{$root_url}dist";

		WP::wp_register_script(
			TEXT_DOMAIN,
			"$dist/index.js",
			[],
			VERSION,
			true
		);

		WP::wp_register_style(
			TEXT_DOMAIN,
			"$dist/colby-wp-collapsible.css",
			[],
			VERSION
		);
	}

	/**
	 * Enqueues the script if the shortcode exists on the page.
	 */
	public static function maybe_enqueue_script() {
		global $post;

		if ( empty( $post ) ) {
			return;
		}

		/**
		 * Filters whether to enqueue this plugin's script.
		 *
		 * @param bool Yes or no.
		 */
		$do_script = WP::apply_filters( 'colbycomms_collapsible__enqueue_script', true );

		if ( ! $do_script ) {
			return;
		}

		if ( WP::has_shortcode( $post->post_content, 'tboot_accordion_section' )
				|| WP::has_shortcode( $post->post_content, 'collapsible' ) ) {
			WP::wp_enqueue_script( TEXT_DOMAIN );
		}
	}

	/**
	 * Enqueues the style if the shortcode xists on the page and the option is set to true.
	 */
	public static function maybe_enqueue_style() {
		global $post;

		if ( empty( $post ) ) {
			return;
		}

		/**
		 * Filters whether to enqueue this plugin's stylesheet.
		 *
		 * @param bool Yes or no.
		 */
		$do_style = WP::apply_filters( 'colbycomms_collapsible__enqueue_style', true );

		if ( ! $do_style ) {
			return;
		}

		if ( ! WP::has_shortcode( $post->post_content, 'tboot_accordion_section' )
				&& ! WP::has_shortcode( $post->post_content, 'collapsible' ) ) {
			return;
		}

		if ( ! Helper::get_theme_option( 'wp_collapsible_use_styles' ) ) {
			return;
		}

		WP::wp_enqueue_style( TEXT_DOMAIN );
	}

	/**
	 * Removes shortcodes created by a legacy Colby product.
	 */
	public static function remove_tboot_shortcodes() {
		array_map(
			[ __NAMESPACE__ . '\WpFunctions', 'remove_shortcode' ],
			[ 'tboot_accordion', 'tboot_accordion_section' ]
		);
	}
}
