<?php
/**
 * CollapsibleShortcode.php
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

/**
 * Creates [collapsible].
 */
class CollapsibleShortcode {
	/**
	 * The shortcode attribute defaults.
	 *
	 * @var array
	 */
	public $defaults = [
		'title' => '',
		'trigger' => '',
		'open' => 'false',
	];

	/**
	 * Adds hooks.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_shortcode' ] );
	}

	/**
	 * Registers the shortcodes.
	 */
	public function register_shortcode() {
		add_shortcode( 'collapsible', [ $this, 'render' ] );
		add_shortcode( 'tboot_accordion_section', [ $this, 'render' ] );
	}

	/**
	 * Sets up the variables used by the render function.
	 */
	public function set_up() {
		$this->atts = shortcode_atts( $this->defaults, $this->atts );

		// Support for previous version of the shortcode.
		if ( isset( $this->atts['title'] ) ) {
			$this->atts['trigger'] = $this->atts['title'];
		}

		$this->pressed = 'true' === $this->atts['open'] || '1' === $this->atts['open']
			? 'true'
			: 'false';
		$this->hidden = 'true' === $this->pressed ? 'false' : 'true';
		$this->trigger = esc_attr( $this->atts['trigger'] );
		$this->content = apply_filters( 'the_content', $this->content );
	}

	/**
	 * The shortcode callback.
	 *
	 * @param array  $atts Shortcode attributes.
	 * @param string $content Shortcode content.
	 * @return string Rendered shortcode.
	 */
	public function render( $atts = [], $content = '' ) {
		$this->atts = $atts;
		$this->content = $content;
		$this->set_up();

		if ( empty( $this->atts['trigger'] ) || empty( $this->content ) ) {
			return '';
		}

		return "
			<div class=\"collapsible\" data-collapsible>
				<button class=\"collapsible-heading btn primary\" aria-pressed=\"$this->pressed\">
					$this->trigger
				</button>
				<div class=\"collapsible-panel\" aria-hidden=\"$this->hidden\">
					$this->content
				</div>
			</div>
		";
	}
}
