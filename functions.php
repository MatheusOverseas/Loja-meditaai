
<?php
function medita_add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'medita_add_woocommerce_support');

function medita_css() {
  wp_register_style('medita-style', get_template_directory_uri() . '/style.css', [], '1.0.0', false);
  wp_enqueue_style('medita-style');
}
add_action('wp_enqueue_scripts', 'medita_css');

function medita_custom_images() {
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'medita_custom_images');

function medita_loop_shop_per_page() {
  return 6;
}
add_filter('loop_shop_per_page', 'medita_loop_shop_per_page');

function remove_some_body_class($classes) {
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);
  $search = in_array('archive', $classes) || in_array('product-template-default', $classes);
  if($woo_class && $woopage_class && $search) {
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }
  return $classes;
}
  add_filter('body_class', 'remove_some_body_class');
  include(get_template_directory() . '/inc/product-list.php');


  add_filter('woocommerce_enable_order_notes_field', '__return_false');

  function meu_dashboard (){
    echo 'Medita Aí';
  }

  add_action('woocommerce_account_dashboard', 'meu_dashboard');


  include(get_template_directory() . '/inc/user-custom-menu.php');
  include(get_template_directory() . '/inc/checkout-customizado.php');
?>