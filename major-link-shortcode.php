<?php
/**
 * Plugin Name: Major Link Shortcode
 * Description: Example of a Shortcake-enabled shortcode for UNC CAUSE 2016
 * Version: 0.1.0
 * Author: Brian DeConinck, OIT Design, NC State University
 * Author URI: https://design.oit.ncsu.edu
 *
 */

// Define your shortcode

function major_link_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
      'url' => null, // An array of attributes with default values
    ), $atts));

    return sprintf( // The code that's supposed to run when WordPress sees [major-link]
      '<a href="%s" class="major-link">%s <img src="%s" aria-hidden="true" /></a>',
      $url,
      $content,
      plugins_url('major-link-shortcode/assets/arrow.svg')
    );
}

function register_shortcode(){
   add_shortcode('major-link', 'major_link_shortcode');
}

add_action('init', 'register_shortcode');

// [major-link url="https://www.ncsu.edu/"]Visit the NC State Homepage[/major-link] will now work as a standard shortcode

// Now, define your Shortcake-powered shortcode UI

function add_shortcake_for_major_link() {

if ( function_exists('shortcode_ui_register_for_shortcode') ) { // First, check to make sure Shortcake is activated by checking if its shortcode_ui_register_for_shortcode function exists. If you don't do this first, you will break WordPress if Shortcake is ever deactivated.

	shortcode_ui_register_for_shortcode(
	    'major-link', // Name of the shortcode, matching above
	    array(
	        'label'         => 'Major Link', // Label that users will see
	        'listItemImage' => 'dashicons-arrow-right-alt', // Icon that users will see. You can use Dashicons or a custom image URL
	        'inner_content' => array(
	            'label'           => 'Link Text', // Label for the inner_content field, eg. [major-link]The content that goes in here[/major-link]
	            'description'     => 'Enter the text that will be clicked on.', 
	        ),
	        'attrs'         => array(
	            array(
	                'label'       => 'URL', // Label for the URL field
	                'attr'        => 'url', // Name of your attribute. Must match an attribute defined above.
	                'type'        => 'url', // Type of field. Supported types: text, checkbox, textarea, radio, select, email, url, number, date, attachment, color, post_select, term_select
	                'description' => 'Enter your destination URL.',
	            )
	        )
	    )
	);	
}

}

if ( function_exists('shortcode_ui_register_for_shortcode') ) { // First, check to make sure Shortcake is activated by checking if its shortcode_ui_register_for_shortcode function exists. If you don't do this first, you will break WordPress if Shortcake is ever deactivated.

	shortcode_ui_register_for_shortcode(
	    'major-link', // Name of the shortcode, matching above
	    array(
	        'label'         => 'Major Link', // Label that users will see
	        'listItemImage' => 'dashicons-arrow-right-alt', // Icon that users will see. You can use Dashicons or a custom image URL
	        'inner_content' => array(
	            'label'           => 'Link Text', // Label for the inner_content field, eg. [major-link]The content that goes in here[/major-link]
	            'description'     => 'Enter the text that will be clicked on.', 
	        ),
	        'attrs'         => array(
	            array(
	                'label'       => 'URL', // Label for the URL field
	                'attr'        => 'url', // Name of your attribute. Must match an attribute defined above.
	                'type'        => 'url', // Type of field. Supported types: text, checkbox, textarea, radio, select, email, url, number, date, attachment, color, post_select, term_select
	                'description' => 'Enter your destination URL.',
	            )
	        )
	    )
	);	
}

add_action('init', 'add_shortcake_for_major_link');


// Add this plugin's CSS to the front end
wp_register_style('MajorLinkShortcode-style', plugins_url('major-link-shortcode/css/style.css'));
wp_enqueue_style('MajorLinkShortcode-style');

// Add this plugin's CSS to the WP editor
function major_link_add_styles_to_editor() {
	add_editor_style( plugins_url('major-link-shortcode/css/style.css') );
}

add_action('admin_init', 'major_link_add_styles_to_editor');
