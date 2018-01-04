<?php
/**
 * Plugin setup.
 *
 * @package colbycomms/wp-collapsible
 */

namespace ColbyComms\Collapsible;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

new Plugin();
new CollapsibleShortcode();
new OptionsPage();
