<?php
/**
 * Plugin Name: Major Link Shortcode
 * Description: Example of a Shortcake-enabled shortcode
 * Version: 0.1.0
 * Author: Brian DeConinck, OIT Design, NC State University
 * Author URI: https://design.oit.ncsu.edu
 *
 */

// Define your shortcode

function major_link_shortcode($attrs, $content = null) {
	extract(shortcode_atts(array(
 		'url' => null,
 	), $attrs));

	return sprintf(
 		'<a class="major-link" href="%s">%s <img src="%s" />',
 		esc_url( $attrs['url'] ),
 		esc_html( $content ),
		plugins_url('major-link-shortcode/assets/arrow.svg')
 	);
}

function register_shortcode() {
	add_shortcode('major-link', 'major_link_shortcode');
}

add_action('init', 'register_shortcode');

// Define your Shortcake-powered UI

function add_ui_for_major_link() {
	if ( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		shortcode_ui_register_for_shortcode(
	 		'major-link',
	 		array(
	 			'label' => 'Major Link',
 				'listItemImage' => 'dashicons-arrow-right-alt',
 				'inner_content' => array(
		 			'label' => 'Link Text',
 					'description' => 'Enter the text that will be clicked on.',
					),
 				'attrs' => array(
 					array(
 						'label' => 'URL',
 						'attr' => 'url',
 						'type' => 'url',
 						'description' => 'Enter your destination URL.',
 					)
 				)
		 	)
 		);
	}
}

add_action('init', 'add_ui_for_major_link');

// Add this plugin's CSS to the WP editor

// Add this plugin's CSS to the front end
wp_register_style('MajorLinkShortcode-style', plugins_url('major-link-shortcode/css/style.css'));
wp_enqueue_style('MajorLinkShortcode-style');

function major_link_add_styles_to_editor() {
	add_editor_style( plugins_url('major-link-shortcode/css/style.css') );
}
add_action('admin_init', 'major_link_add_styles_to_editor');
