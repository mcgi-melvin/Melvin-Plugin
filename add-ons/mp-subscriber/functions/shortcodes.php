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
    <div class="mp-form-message mp-popup">

    </div>

    <div class="mp-form-content">
      <?php if( strlen( $content ) > 0 ): ?>
        <div class="mp-input-container">
          <?= $content; ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if( get_field( 'mp_subscriber_top_content', 'option' ) ): ?>
    <div class="mp-top-content">
      <?= get_field( 'mp_subscriber_top_content', 'option' ); ?>
    </div>
    <?php endif; ?>

    <form id="mp_form" class="mp-form" method="POST" action="/wp-admin/admin-ajax.php?action=mp_save_subscription" autocomplete="off">
      <input type="hidden" name="action" value="mp_save_subscription" />
      <input type="hidden" name="mp_subscriber_list" value="<?= $list_id; ?>"/>

      <div class="mp-input-container">
        <label for="">Your Name</label>
        <div class="mp-form-row">
          <?php if( get_field( 'mp_use_fullname', 'option' ) ): ?>

            <div class="mp-form-col">
              <input id="mp_subscriber_fullname" type="text" name="mp_subscriber_fullname" placeholder="Full Name" required />
            </div>

          <?php else: ?>

            <div class="mp-form-col">
              <input id="mp_subscriber_fname" type="text" name="mp_subscriber_fname" placeholder="First Name" required />
            </div>
            <div class="mp-form-col">
              <input id="mp_subscriber_lname" type="text" name="mp_subscriber_lname" placeholder="Last Name" required />
            </div>

          <?php endif; ?>

        </div>
      </div>

      <div class="mp-input-container">
        <div class="mp-w-100">
          <label for="">Your Email Address</label>
          <input id="mp_subscriber_email" type="email" name="mp_subscriber_email" placeholder="ex. you@example.com" required />
        </div>
      </div>

      <?php if( $options ): ?>
        <div class="mp-input-container">
          <label for="">Select List</label>
          <select id="mp_subscription" name="mp_subscriber_subscription" multiple>
            <?php foreach( $options as $term ): ?>
              <option value="<?= $term->term_id ?>"><?= $term->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php endif; ?>

      <?php

      if( get_field( 'mp_subscriber_additional_fields', 'option' ) ):
        foreach( get_field( 'mp_subscriber_additional_fields', 'option' ) as $field ):
          echo '<div class="mp-input-container">';
          $name = 'mp_subscriber_' . strtolower( $field['label'] );
          $selections = $field['selections'];
          switch( $field['type'] ){
            case 'select':
              ?>
                <label for="">Select <?= $field['label']; ?> </label>
                <select id="<?= $name; ?>" name="<?= $name; ?>" >
                  <?php foreach( $selections as $selection ): ?>
                    <option value="<?= strtolower( $selection['label'] ) ?>"> <?= $selection['label'] ?> </option>
                  <?php endforeach; ?>
                </select>
              <?php
            break;
            default:
            ?>
            <label><?= $field['label']; ?></label>
            <input type="<?= $field['type']; ?>" name="<?= $name; ?>" placeholder="<?= $field['placeholder'] ?>" />
            <?php
            break;
          }
          echo '</div>';
        endforeach;
      endif;
      ?>

      <?php if( get_field( 'mp_subscriber_bottom_content', 'option' ) ): ?>
      <div class="mp-bottom-content">
        <?= get_field( 'mp_subscriber_bottom_content', 'option' ); ?>
      </div>
      <?php endif; ?>

      <div class="mp-input-container">
        <!--
          <input class="mp-button" type="submit" value="Subscribe" />
        -->
        <button class="mp-button">Subscribe <img class="button-loader mp-d-none" src="<?= PLUGIN_URL . '/assets/images/loader.svg'; ?>"> </button>
      </div>

      <p>By clicking this button, you agree to <?= get_bloginfo( 'name' ); ?>'s <a href="<?= !empty( get_field( 'mp_subscriber_terms_use', 'option' ) ) ? get_field( 'mp_subscriber_terms_use', 'option' ) : 'javascript:void(0);'; ?>">anti-spam policy and Terms of Use.</a></p>

    </form>

  </div>
<?php
  $content = ob_get_clean();

  return $content;
}



function mp_manage_subscription( $atts, $content = "" ) {
  ob_start();
  $id = 0;

  // Get subscriber id from attribute
  if( isset( $atts['subscriber_id'] ) ) {
    $id = (int)$atts['subscriber_id'];
  }

  // Get subscriber ID from queried post
  if( is_single() ) {
    $id = get_the_ID();
  }

  // Get Subscriber ID from GET Request
  if( isset( $_GET['subscriber_id'] ) ) {
    // Decrypt subscriber ID if encrypted
    if( !is_numeric( $_GET['subscriber_id'] ) ) {
      $id = (int)Cryptor::decrypt( $_GET['subscriber_id'] );
    } else {
      $id = (int)$_GET['subscriber_id'];
    }
  }

  $subscriber_list = mp_get_subscriptions( $id );
  ?>
  <div id="mp_manage_subscription_form_container" class="mp-manage-subscription-form-container" data-subscriber="<?= Cryptor::encrypt( $id ); ?>">
    <?php if( $subscriber_list ): ?>

    <form id="mp_manage_subscription_form" action="#" method="POST" onsubmit="mp_unsubscribe_list( event );">

      <table class="mp-table-fixed mp-table-bordered">
        <thead>
          <tr>
            <th>List Name</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody class="mp_tbody_subscriber_list">

        </tbody>
      </table>
      <div class="mp-text-right">
        <input type="submit" class="mp-button" value="Update" />
        <button class="mp-button" onclick="mp_subscriber_deleteRecord();"> Unsubscribe </button>
      </div>
     </form>


   <?php elseif( !mp_subscriber_has_subscription( $id, $subscriber_list ) && FALSE !== get_post_status( $id ) ): ?>
      You are not subscribed to any list
      <div class="">
        <button class="mp-button" onclick="mp_subscriber_deleteRecord();"> Delete Subscription </button>
      </div>


    <?php elseif( FALSE == get_post_status( $id ) ) : ?>
      Nothing in here
    <?php endif; ?>

  </div>


  <?php
  return ob_get_clean();
}


?>
