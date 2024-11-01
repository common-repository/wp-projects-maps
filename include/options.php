<?php
// create custom plugin settings menu
add_action('admin_menu', 'wpprojectsmaps_plugin_create_menu');

function wpprojectsmaps_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('WP Projects Maps Settings', 'WP Projects Maps', 'administrator', __FILE__, 'wpprojectsmaps_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_wpprojectsmaps_plugin_settings' );
}


function register_wpprojectsmaps_plugin_settings() {
	//register our settings
	register_setting( 'wpprojectsmaps-settings-group', 'api_key' );
	register_setting( 'wpprojectsmaps-settings-group', 'center_geo' );
	register_setting( 'wpprojectsmaps-settings-group', 'mapzoom' );
  register_setting( 'wpprojectsmaps-settings-group', 'maptype' );
  register_setting( 'wpprojectsmaps-settings-group', 'show_gui' );
  register_setting( 'wpprojectsmaps-settings-group', 'disable_scroll' );
  register_setting( 'wpprojectsmaps-settings-group', 'disable_drag' );
  register_setting( 'wpprojectsmaps-settings-group', 'custom_map_styling' );
	register_setting( 'wpprojectsmaps-settings-group', 'markeroption' );

}

function wpprojectsmaps_settings_page() {
?>
<div class="wrap">
<h1>WP Projects Maps</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wpprojectsmaps-settings-group' ); ?>
    <?php do_settings_sections( 'wpprojectsmaps-settings-group' ); ?>
    <table class="form-table">
				<tr valign="top">
				<th scope="row">API Key (Google maps)</th>
				<td><input type="text" name="api_key" value="<?php echo esc_attr( get_option('api_key') ); ?>" /></td>
				</tr>

        <tr valign="top">
        <th scope="row">Center GEO Location</th>
        <td><input type="text" name="center_geo" value="<?php echo esc_attr( get_option('center_geo') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Map Zoom</th>
        <td><input type="text" name="mapzoom" value="<?php echo esc_attr( get_option('mapzoom') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Map Type</th>
        <td>
          <select name="maptype">
            <option value="roadmap" <?php if(get_option('maptype') == "roadmap"){ echo "selected='selected'";} ?>>Roadmap</option>
            <option value="satellite" <?php if(get_option('maptype') == "satellite"){ echo "selected='selected'";} ?>>Satellite</option>
            <option value="hybrid" <?php if(get_option('maptype') == "hybrid"){ echo "selected='selected'";} ?>>Hybrid</option>
            <option value="terrain" <?php if(get_option('maptype') == "terrain"){ echo "selected='selected'";} ?>>Terrain</option>
          </select>
        </td>

        </tr>
        <tr valign="top">
        <th scope="row">Disable Controls</th>
        <td><input type="checkbox" name="show_gui" value="vink" <?php if(get_option('show_gui') == "vink"){ echo "checked='checked'";} ?> /></td>
        </tr>

        </tr>
        <tr valign="top">
        <th scope="row">Disable Scroll</th>
        <td><input type="checkbox" name="disable_scroll" value="vink" <?php if(get_option('disable_scroll') == "vink"){ echo "checked='checked'";} ?> /></td>
        </tr>

        </tr>
        <tr valign="top">
        <th scope="row">Disable Drag</th>
        <td><input type="checkbox" name="disable_drag" value="vink" <?php if(get_option('disable_drag') == "vink"){ echo "checked='checked'";} ?> /></td>
        </tr>

				<tr valign="top">
        <th scope="row">Marker option</th>
        <td>
          <select name="markeroption">
            <option value="directlink" <?php if(get_option('markeroption') == "directlink"){ echo "selected='selected'";} ?>>Direct link</option>
            <option value="infobox" <?php if(get_option('markeroption') == "infobox"){ echo "selected='selected'";} ?>>Info box</option>
          </select>
        </td>

        </tr>
        <tr valign="top">
        <th scope="row">Custom map styling</th>
        <td>
          <textarea name="custom_map_styling" rows="8" cols="40"><?php if(get_option('custom_map_styling') !== ""){ echo esc_textarea(get_option('custom_map_styling'));} ?></textarea>
        </td>
        </tr>
    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
