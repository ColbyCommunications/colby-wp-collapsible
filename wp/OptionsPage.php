<?php
/**
 * OptionsPage.php
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

use ColbyComms\Collapsible\WpFunctions as WP;

/**
 * Sets up an options page using Carbon Fields.
 */
class OptionsPage {
	/**
	 * Adds hooks.
	 */
	public function __construct() {
		WP::add_action( 'carbon_fields_register_fields', [ $this, 'create_container' ] );
		WP::add_action( 'carbon_fields_register_fields', [ $this, 'add_plugin_options' ] );
	}

	/**
	 * Creates the options page.
	 */
	public function create_container() {
		$this->container = Container::make( 'theme_options', 'Collapsible Options' )
			->set_page_parent( 'plugins.php' );
	}

	/**
	 * Adds the plugin options.
	 */
	public function add_plugin_options() {
		$this->container->add_fields(
			[
				Field::make( 'checkbox', 'wp_collapsible_use_styles', 'Load plugin styles?' )
					->set_default_value( true )
					->set_help_text( 'Uncheck this box if styles are provided by the theme.' ),
			]
		);
	}
}
