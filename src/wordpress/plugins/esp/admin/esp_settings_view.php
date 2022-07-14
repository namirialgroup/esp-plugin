<?php

/*
 *  Esp Option Page
 */

function esp_options_page()
{
    ?>
    <div>
        <?php screen_icon(); ?>
        <h2>Esp Configuration Tab</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'esp_options_group' ); ?>
            <table>
                <tr>
                    <th scope="row"><label for="esp_host">Host (No trailing slash)</label></th>
                    <td><input type="text" id="esp_host" name="esp_host"
                               value="<?php echo get_option('esp_host'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_env">Environment Name</label></th>
                    <td><input type="text" id="esp_env" name="esp_env"
                               value="<?php echo get_option('esp_env'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_final">Final Uri (Redirect Uri)</label></th>
                    <td><input type="text" id="esp_final" name="esp_final"
                               value="<?php echo get_option('esp_final'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_apikey">Api Key</label></th>
                    <td><input type="text" id="esp_apikey" name="esp_apikey"
                               value="<?php echo get_option('esp_apikey'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_level">Authentication Level (1/2/3)</label></th>
                    <td><input type="text" id="esp_level" name="esp_level"
                               value="<?php echo get_option('esp_level'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_attributes">Attribute Set</label></th>
                    <td><input type="text" id="esp_attributes" name="esp_attributes"
                               value="<?php echo get_option('esp_attributes'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="esp_spidtype">Spid Type</label></th>
                    <td><input type="text" id="esp_spidtype" name="esp_spidtype"
                               value="<?php echo get_option('esp_spidtype'); ?>" /></td>
                </tr>
            </table>
            <?php  submit_button(); ?>
        </form>
    </div>
    <?php
} ?>