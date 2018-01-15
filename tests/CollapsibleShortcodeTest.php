<?php

use PHPUnit\Framework\TestCase;

use ColbyComms\Collapsible\CollapsibleShortcode;

class CollapsibleShortcodeTest extends TestCase {
	public function test_render() {
		$output = "
			<div class=\"collapsible\" data-collapsible>
				<button class=\"collapsible-heading btn primary\" aria-pressed=\"false\">
					Trigger
				</button>
				<div class=\"collapsible-panel\" aria-hidden=\"true\">
					Content
				</div>
			</div>";

		$this->assertEquals(
			$output,
			CollapsibleShortcode::render(
				[
					'open' => 'false',
					'title' => 'Trigger',
				],
				'Content'
			)
		);
	}
}