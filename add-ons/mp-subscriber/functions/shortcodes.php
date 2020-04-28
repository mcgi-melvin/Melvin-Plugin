<?php
/* 2.1 melvin_subscribe_form - Subscribe Form */
function melvin_subscribe_form( $atts, $content = "" ) {

  $list_id = 0;
  if( isset( $atts['id'] ) ) $list_id = (int)$atts['id'];
  $options = get_terms(array(
    'taxonomy' => 'subscriber_list',
    'hide_empty' => false,
  ));

  ob_start();
  ?>
  <div class="mp-form-container">
    <div class="mp-form-message">

    </div>
    <form id="melvin_plugin_form" class="melvin-plugin-form" method="POST" action="/wp-admin/admin-ajax.php?action=mp_save_subscription" autocomplete="off">
      <input type="hidden" name="action" value="mp_save_subscription" />
      <input type="hidden" name="mp_list" value="<?= $list_id; ?>"/>

      <div class="mp-input-container">
        <label for="">Your Name</label>
        <div class="mp-form-row">
          <div class="mp-form-col">
            <input id="mp_fname" type="text" name="mp_fname" placeholder="First Name" required />
          </div>
          <div class="mp-form-col">
            <input id="mp_lname" type="text" name="mp_lname" placeholder="Last Name" required />
          </div>
        </div>
      </div>

      <div class="mp-input-container">
          <div class="mp-w-100">
            <label for="">Your Email Address</label>
            <input id="mp_email" type="email" name="mp_email" placeholder="ex. you@example.com" required />
          </div>
      </div>

      <?php if( strlen( $content ) > 0 ): ?>
        <div class="mp-input-container">
          <?= $content; ?>
        </div>
      <?php endif; ?>

      <?php if( $atts['subscribe_list'] ): ?>
        <div class="mp-input-container">
          <label for="">Select List</label>
          <select id="mp_subscription" name="mp_subscription" multiple>
            <?php foreach( $options as $term ): ?>
              <option value="<?= $term->term_id ?>"><?= $term->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php endif; ?>

      <div class="mp-input-container">
        <input class="mp-button" type="submit" name="mp_submit" value="Subscribe" required />
      </div>

    </form>
  </div>
<?php
  $content = ob_get_clean();

  return $content;
}
?>
