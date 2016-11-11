<?php
/*
Plugin Name: io Sources
Plugin URI: http://alansari.io
Description: Add Sources links below posts using ACF
Version: 1.0.0
Author: Omar Al-Ansari
Author URI: http://alansari.io
License: GPLv2
*/

add_action( 'wp_enqueue_scripts', 'io_custom_css_style' );
/**
 * Register and load custom css style for plugin
 */
function io_custom_css_style()
{
    // Register the style like this for a plugin:
    wp_register_style( 'io-custom-css-style', plugins_url( '/io-sources.css', __FILE__ ), array(), '1.0.0', 'all' );
    
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'io-custom-css-style' );
}


//Source Custom Fields
add_action( 'genesis_entry_footer', 'io_sources_custom_fields' );
/**
 * Add sources to posts, if posts have sources assigned. Utilizes ACF Pro
 */
function io_sources_custom_fields() {

	if ( is_singular( $post_types = 'post' ) ) {

		// check if the repeater field has rows of data
		if( have_rows('sources') ):

			echo '<div class="sources">Sources:<ul>';

		 	// loop through the rows of data
		    while ( have_rows('sources') ) : the_row();

				$sourceLink = get_sub_field('source_url');
				$sourceTitle = get_sub_field('source_title');

				printf('<li><a href="%s" target="_blank">%s</a></li>', $sourceLink, $sourceTitle);
				
		    endwhile;

		    echo '</ul></div>';

		else :

		    // no rows found

		endif;
	}
}