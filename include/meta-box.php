<?php
/* Metabox toevoegen */
add_action( 'add_meta_boxes', 'wppm_geolocatie_box' );
function wppm_geolocatie_box() {
    $screens = get_post_types( array( 'public' => true ) );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'geolocatie_project',            // Unique ID
            'Project Geolocation',      // Box title
            'wppm_geolocatie_project_box',  // Content callback
             $screen                      // post type
        );
    }
}
?>
<?php /* Prints the box content */

function wppm_geolocatie_project_box( $post ) {
$value = get_post_meta( $post->ID, 'geolocatie_project', true );
?>
   <label for="geolocatie_project"> Put the GEO location in the input box. Like the example in the input box. </label><br><br>
   <input type="text" name="geolocatie_project" placeholder="51.975382, 6.305837" value="<?php echo $value; ?>">
<?php
}
$postnummer = $post->ID;
add_action( 'save_post', 'wppm_save_postdata' );
function wppm_save_postdata( $postnummer ) {
    if ( array_key_exists('geolocatie_project', $_POST ) ) {
        $clean = sanitize_text_field($_POST['geolocatie_project']);
        update_post_meta( $postnummer,
           'geolocatie_project',
            $clean
        );
    }
}
?>
