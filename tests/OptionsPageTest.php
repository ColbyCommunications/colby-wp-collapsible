<?php

use PHPUnit\Framework\TestCase;
use ColbyComms\Collapsible\OptionsPage;

class OptionsPageTest extends TestCase {
	public function test_hooks_added() {
		$page = new OptionsPage();
		$this->assertEquals( 10, has_action( 'after_setup_theme', [ $page, 'init' ] ) );
	}
}
