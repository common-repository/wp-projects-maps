<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); //security
/*
Plugin Name: WP Project Maps
Plugin URI:  http://www.wpprojectsmaps.com
Description: Showcase the locations of your projects on a map
Version:     1.0
Author:      Alwin Berendsen
Author URI:  http://www.alwinberendsen.nl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-project-maps
*/

/* metabox toevoegen aan post */
include(plugin_dir_path( __FILE__ ) . '/include/meta-box.php');
/* functies toevoegen */
include(plugin_dir_path( __FILE__ ) . '/assets/functies.php');
/* options page */
include(plugin_dir_path( __FILE__ ) . '/include/options.php');

/* add shortcode */
function wpprojectmaps_shortcode( $atts, $content = null ) {
	$key = esc_attr(get_option("api_key"));
	wp_enqueue_script('jquery');
	wp_register_script('wppm_googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . $key . '&callback=initMap', array(), '1.0.0', true);
	wp_enqueue_script('wppm_googlemaps');
	$a = shortcode_atts( array(
		'width' => 'width',
    'height' => 'height'
	), $atts );
  //$mapdiv = "<div id='map' width='" . esc_attr($a['width']) . "' height='" . esc_attr($a['height']) . "'></div>";
	return wppm_render_map(esc_attr($a['width']), esc_attr($a['height']));
}
add_shortcode( 'wpprojectsmaps', 'wpprojectmaps_shortcode' );


?>
