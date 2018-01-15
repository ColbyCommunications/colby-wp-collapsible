<?php
/**
 * CollapsibleShortcode.php
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

use ColbyComms\Collapsible\WpFunctions as WP;

/**
 * Creates [collapsible].
 */
class CollapsibleShortcode {
	/**
	 * The shortcode attribute defaults.
	 *
	 * @var array
	 */
	public static $defaults = [
		'title' => '',
		'trigger' => '',
		'open' => 'false',
	];

	/**
	 * Adds hooks.
	 */
	public function __construct() {
		WP::add_action( 'init', [ __CLASS__, 'register_shortcode' ] );
	}

	/**
	 * Registers the shortcodes.
	 */
	public static function register_shortcode() {
		WP::add_shortcode( 'collapsible', [ __CLASS__, 'render' ] );
		WP::add_shortcode( 'tboot_accordion_section', [ __CLASS__, 'render' ] );
	}

	/**
	 * Sets up the variables used by the render function.
	 *
	 * @param array  $atts Shortcode params.
	 * @param string $content Shortcode content.
	 * @return array Parameters to pass to the get_html method.
	 */
	public static function get_template_params(
		array $atts = [],
		string $content = ''
	) : array {
		// Support for previous version of the shortcode.
		if ( isset( $atts['title'] ) ) {
			$atts['trigger'] = $atts['title'];
		}

		$pressed = in_array( $atts['open'], [ 'true', '1' ], true );

		return [
			'pressed' => $pressed ? 'true' : 'false',
			'hidden' => $pressed ? 'false' : 'true',
			'trigger' => WP::esc_attr( $atts['trigger'] ),
			'content' => WP::apply_filters( 'the_content', $content ),
		];
	}

	/**
	 * Renders the HTML for the shortcode.
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string The HTML output.
	 */
	public static function get_html( array $atts = [] ) : string {
		$atts = array_merge(
			[
				'pressed' => false,
				'hidden' => true,
				'trigger' => '',
				'content' => '',

			],
			$atts
		);

		if ( empty( $atts['trigger'] ) || empty( $atts['content'] ) ) {
			return '';
		}

		return "
			<div class=\"collapsible\" data-collapsible>
				<button class=\"collapsible-heading btn primary\" aria-pressed=\"$atts[pressed]\">
					$atts[trigger]
				</button>
				<div class=\"collapsible-panel\" aria-hidden=\"$atts[hidden]\">
					$atts[content]
				</div>
			</div>";
	}

	/**
	 * The shortcode callback.
	 *
	 * @param array  $atts Shortcode attributes.
	 * @param string $content Shortcode content.
	 * @return string Rendered shortcode.
	 */
	public static function render( $atts = [], $content = '' ) {
		$atts = WP::shortcode_atts( self::$defaults, $atts );

		if ( empty( $atts['trigger'] ) ) {
			$atts['trigger'] = $atts['title'];
		}

		$params = self::get_template_params( $atts, $content );

		return self::get_html( $params );
	}
}
