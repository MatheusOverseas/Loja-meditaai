<?php get_header(); ?>
<?php

function format_single_product($id, $img_size = 'medium'){
  $product = wc_get_product($id);

  $gallery_ids = $product->get_gallery_attachment_ids();
  $gallery = [];
  if($gallery_ids){
    foreach($gallery_ids as $img_id){
      $gallery[] = wp_get_attachment_image_src($img_id, $img_size)[0];
    }
  }

  return [
    'id' => $id,
    'name' => $product->get_name(),
    'price'=> $product->get_price_html(),
    'link'=> $product->get_permalink(),
    'sku' => $product->get_sku(),
    'description' =>$product->get_description(),
    'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
    'gallery'=> $gallery,
  ];
}

?>

<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>

<div class="container notificacao">
  <?php wc_print_notices(); ?>
</div>

<main class="container product">
  <?php
    if(have_posts()) {while(have_posts()){ the_post();
      $produto = format_single_product(get_the_ID());
  ?>
  <div class=product-gallery data-gallery="gallery">
      <div class="product-gallery-list">
        <?php foreach($produto['gallery'] as $img){ ?>
          <img data-gallery="list" src="<?= $img?>" alt="<?=$produto['name']?>">
       <?php } ?>
      </div>
      <div class="produto-gallery-main">
          <img data-gallery="main" src="<?= $produto['img']?>" alt="<?=$produto['name']?>">
      </div>
  </div>
  <div class="product-detail">
      <small><?= $produto['sku']; ?></small>
      <h1><?= $produto['name']; ?></h1>
      <p class="product-info-price"><?= $produto['price']; ?></p>
      <?php woocommerce_template_single_add_to_cart(); ?>
      <h2>Descrição</h2>
      <p><?= $produto['description']; ?></p>
  </div>
  <?php }}?>
 </main>

 <?php
  $related_ids = wc_get_related_products($produto['id'], 6);
  $related_products = [];
  foreach($related_ids as $product_id) {
    $related_products[] = wc_get_product( $product_id);
  }
  $related = format_products($related_products);
 ?>

  <section class="container-separador">
    <div class="container">
      <h2 class="subtitulo">Relacionados</h2>
      <?php medita_product_list($related); ?>
    </div>
  </section>


<?php get_footer(); ?>
