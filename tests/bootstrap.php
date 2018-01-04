<?php

global $wp_filter, $wp_plugin_paths, $post, $wp_object_cache, $wpdb;

require dirname( __DIR__ ) . '/vendor/autoload.php';

//require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/class-wp-hook.php';
$wp_plugin_paths = [];
$post = (object) [
	'post_content' => ''
];

define( 'WP_DEBUG', false );
define( 'ABSPATH', dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core' );
define( 'WPINC', '/wp-includes' );
define( 'WPMU_PLUGIN_DIR', __DIR__ );
define( 'WP_PLUGIN_URL', __DIR__ );
define( 'WP_PLUGIN_DIR', __DIR__ );

function wp_cache_get() {
	return false;
}

class Mock_Wpdb {
	public $options = [];
	function suppress_errors() {
		return true;
	}

	function get_results() {
		return '';
	}
}

$wpdb = new Mock_Wpdb();


require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/functions.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/plugin.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/shortcodes.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/formatting.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/l10n.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/pomo/translations.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/functions.wp-scripts.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/functions.wp-styles.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/class-wp-dependency.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/class.wp-dependencies.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/class.wp-styles.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/class.wp-scripts.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/link-template.php';
require dirname( __DIR__ ) . '/vendor/johnpbloch/wordpress-core/wp-includes/load.php';

class Mock_Object_Cache {
	function get() {
		return false;
	}
}

$wp_object_cache = new Mock_Object_Cache();
