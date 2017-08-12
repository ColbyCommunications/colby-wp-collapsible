<?php
/**
 * Plugin Name: Colby Collapsible
 * Description: A [collapsible] shortcode to generate expandable content sections.
 * Author: John Watkins, Colby Communications
 */

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

	$open = $atts['open'] && '1' === $atts['open'] ? ' open' : '';
	$active = $open ? ' active': '';

	$trigger = esc_attr( $atts['trigger'] );
	$content = apply_filters( 'the_content', $content );

	$svg = '';
	if ( shortcode_exists( 'colby-svg' ) ) {
		$svg = do_shortcode( '[colby-svg name="down-arrow"]' );
	}

	return "
		<div class=\"collapsibleContainer$open\" data-collapsible>
			<span class=trigger data-trigger>
				<button class=\"btn btn-primary$active\">$trigger $svg</button>
			</span>
			<div class=collapsibleContentContainer>
				<div class=collapsibleContent>
					$content
				</div>
			</div>
		</div>
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


add_action( 'wp_enqueue_scripts', function() {
	$min = defined( 'PROD' ) && PROD === true ? '.min' : '';
	$dist = plugin_dir_url( __FILE__ ) . 'dist';

	wp_register_script('collapsible', "$dist/colby-wp-collapsible$min.js", [], '', true);
	wp_register_style('collapsible', "$dist/colby-wp-collapsible$min.css", ['colby-bootstrap'], '');
}, 10, 1 );

function maybe_enqueue_collapsible() {
	global $post;

	if ( has_shortcode( $post->post_content, 'tboot_accordion_section')
			|| has_shortcode( $post->post_content, 'collapsible' ) ) {
		wp_enqueue_script( 'collapsible' );
		wp_enqueue_style( 'collapsible' );
	}
}
add_action( 'wp_enqueue_scripts', 'maybe_enqueue_collapsible' );
