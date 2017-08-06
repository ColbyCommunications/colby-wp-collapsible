<?php

foreach ( [ 'tboot_accordion', 'tboot_accordion_section' ] as $shortcode ) {
	remove_shortcode( $shortcode );
}


function render_collapsible( $atts, $content ) {
	$atts = $atts ?: [];

	if ( $atts['title'] ) {
		$atts['trigger'] = $atts['title'];
	}

	if ( ! $atts['trigger'] ) {
		return '';
	}

	$data_open = $atts['open'] && '1' === $atts['open']
		? "data-open=\"true\""
		: '';

	$trigger = esc_attr( $atts['trigger'] );
	$content = apply_filters( 'the_content', $content );

	return "
		<div data-collapsible $data_open data-trigger=\"$trigger\">$content</div>
	";
}

function register_collapsible_shortcode() {
	add_shortcode( 'collapsible', 'render_collapsible' );
	add_shortcode( 'tboot_accordion_section', function( $atts, $content ) {
		$atts = $atts ?: [];

		if ( $atts['title'] ) {
			$atts['trigger'] = $atts['title'];
		}

		return render_collapsible( $atts, $content );
	} );
}

function collapsible_container( $_, $content ) {
	return do_shortcode( $content );
};

function register_collapsible_container() {
	add_shortcode( 'tboot_accordion', 'collapsible_container' );
	add_shortcode( 'collapsible-container', 'collapsible_container' );
}

add_action( 'init', 'register_collapsible_shortcode' );
add_action( 'init', 'register_collapsible_container' );
