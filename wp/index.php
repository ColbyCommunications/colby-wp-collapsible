<?php
/**
 * Plugin setup.
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

define( __NAMESPACE__ . '\VERSION', '1.0.1' );
define( __NAMESPACE__ . '\TEXT_DOMAIN', 'wp-collapsible' );

new Plugin();
new CollapsibleShortcode();
new OptionsPage();

WpFunctions::add_action( 'after_setup_theme', '\\Carbon_Fields\\Carbon_Fields::boot' );
