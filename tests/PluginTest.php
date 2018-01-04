<?php

use PHPUnit\Framework\TestCase;
use ColbyComms\Collapsible\Plugin;

class PluginTest extends TestCase {
	public function test_hooks_added() {
		$plugin = new Plugin();
		$this->assertEquals( 10, has_filter( 'init', [ $plugin, 'register_container_shortcodes' ] ) );

		do_action( 'init' );
		$this->assertEquals( 'hello', do_shortcode( '[tboot_accordion]hello[/tboot_accordion]' ) );

		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_script_is( 'colbycomms/collapsible', 'registered' ) );
	}
}
