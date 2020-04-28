<div class="wrap">
  <h2>Plugin Options</h2>
  <form action="options.php" method="POST">

    <?php settings_fields('mp_plugin_options'); ?>

    <?php @do_settings_fields('mp_option_admin_page','mp_plugin_options'); ?>

    <table class="form-table">
      <tbody>

        <tr>
          <th scope="row"><label for="mp_manage_plugin_option_page">Turn ACF On or Off</label></th>
          <td>
            <input type="checkbox" name="mp_toggle_acf" value="<?= mp_checkbox_value('mp_toggle_acf'); ?>" <?= mp_checkbox_status('mp_toggle_acf'); ?> />
            <p class="description" id="mp_manage_plugin_option_page-description">
              Toggle the checkbox to turn ACF Field on and off.
            </p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="mp_manage_plugin_option_page">Facebook APP ID</label></th>
          <td>
            <input type="text" name="mp_fb_app_id" value="<?= get_option('mp_fb_app_id'); ?>" />
            <p class="description" id="mp_manage_plugin_option_page-description">
              Facebook App IP is required to display the facebook login
            </p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="mp_manage_plugin_option_page">Google API Key</label></th>
          <td>
            <input type="text" name="mp_google_api_key" value="<?= get_option('mp_google_api_key'); ?>" />
            <p class="description" id="mp_manage_plugin_option_page-description">
              Google API Key is required to display the google login
            </p>
          </td>
        </tr>

      </tbody>
    </table>

    <?php @submit_button(); ?>

  </form>
</div>
