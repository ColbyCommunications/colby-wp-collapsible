<?php

use PHPUnit\Framework\TestCase;
use ColbyComms\Collapsible\CollapsibleShortcode;

class CollapsibleShortcodeTest extends TestCase {
	public function test_hooks_added() {
		$shortcode = new CollapsibleShortcode();
		$this->assertEquals( 10, has_action( 'init', [ $shortcode, 'register_shortcode' ] ) );

		do_action( 'init' );
		$this->assertTrue( shortcode_exists( 'collapsible' ) );

		$this->assertEquals( '', do_shortcode( '[collapsible]' ) );
		$this->assertEquals( '', do_shortcode( '[collapsible]lorem[/collapsible]' ) );
	}
}
