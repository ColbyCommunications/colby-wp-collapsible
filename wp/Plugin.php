<?php
/**
 * Plugin.php
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

/**
 * Performs core plugin setup.
 */
class Plugin {
	/**
	 * Adds hooks.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'remove_tboot_shortcodes' ] );
		add_action( 'init', [ $this, 'register_container_shortcodes' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script_and_style' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'maybe_enqueue_script' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'maybe_enqueue_style' ] );
	}

	/**
	 * Handles legacy shortcodes that no longer do anything.
	 */
	public function register_container_shortcodes() {
		add_shortcode( 'tboot_accordion', [ $this, 'render_collapsible_container' ] );
		add_shortcode( 'collapsible-container', [ $this, 'render_collapsible_container' ] );
	}

	/**
	 * Returns the content unmodified.
	 *
	 * @param array  $_ Unused $atts param.
	 * @param string $content The shortcode content.
	 * @return string
	 */
	public function render_collapsible_container( $_, $content = '' ) {
		return apply_filters( 'the_content', $content );
	}

	/**
	 * Registers the plugin's script.
	 */
	public function register_script_and_style() {
		$root_url = plugin_dir_url( dirname( __DIR__ ) . '/index.php' );

		if ( ! file_exists( $root_url ) ) {
			$root_url = get_template_directory_uri() . '/vendor/colbycomms/wp-collapsible/';
		}

		$dist = "{$root_url}dist";

		wp_register_script( 'colbycomms/collapsible', "$dist/index.js", [], '', true );
		wp_register_style( 'colbycomms/collapsible', "$dist/colby-wp-collapsible.css", [], '' );
	}

	/**
	 * Enqueues the script if the shortcode exists on the page.
	 */
	public function maybe_enqueue_script() {
		global $post;

		if ( has_shortcode( $post->post_content, 'tboot_accordion_section' )
				|| has_shortcode( $post->post_content, 'collapsible' ) ) {
			wp_enqueue_script( 'colbycomms/collapsible' );
		}
	}

	/**
	 * Enqueues the style if the shortcode xists on the page and the option is set to true.
	 */
	public function maybe_enqueue_style() {
		global $post;

		if ( ! has_shortcode( $post->post_content, 'tboot_accordion_section' )
				&& ! has_shortcode( $post->post_content, 'collapsible' ) ) {
			return;
		}

		if ( ! carbon_get_theme_option( 'wp_collapsible_use_styles' ) ) {
			return;
		}

		wp_enqueue_style( 'colbycomms/collapsible' );
	}

	/**
	 * Removes shortcodes created by a legacy Colby product.
	 */
	public function remove_tboot_shortcodes() {
		array_map( 'remove_shortcode', [ 'tboot_accordion', 'tboot_accordion_section' ] );
	}
}
