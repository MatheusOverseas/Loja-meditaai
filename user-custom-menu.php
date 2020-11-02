<?php

// Adcionar novo Menu

function medita_custom_menu ($menu_links){
  $menu_links = array_slice($menu_links, 0, 5, true) 
  + ['certificados' => 'Certificados']
  + array_slice($menu_links, 5, NULL, true);


  return $menu_links;
}
add_filter('woocommerce_account_menu_items', 'medita_custom_menu');

function medita_add_endpoint(){
  add_rewrite_endpoint('certificados', EP_PAGES);
}
add_action('init', 'medita_add_endpoint');

function medita_certificados() {
  echo "<h2>Certificados</h2>";
}
add_action('woocommerce_account_certificados_endpoint', 'medita_certificados');

?>