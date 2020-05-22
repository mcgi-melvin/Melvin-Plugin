<?php
/*
*
* Template use for subscriber slug
* 
*
*/

get_header();
?>

<div class="mp-spaceholder"></div>
<main id="mp_manage_subscription_page" class="mp-manage-subscription-page mp-container">
<?= do_shortcode('[wpp-manage-subscription]'); ?>
</main>
<div class="mp-spaceholder"></div>

<?php get_footer(); ?>
