<?php get_header(); ?>
<pre>
<?php

$products = [];
  if(have_posts()) { while(have_posts()) { the_post();
    $products[] = wc_get_product(get_the_ID());
  } }

  $data = [];
  $data['products'] = format_products($products);
  

?>
</pre>

<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>

<article class="container products-archive">
  <nav class="filtros">
    <div class="filtro">
      <h3 class="filtro-titulo">Categorias</h3>
      <?php
        wp_nav_menu([
          'menu' => 'categorias-interna',
          'menu_class' => 'filtro-cat',
          'container' => false,
        ]);
      ?>
    </div>
    <div class="filtro">
      <?php
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        foreach($attribute_taxonomies as $attribute) {
          the_widget('WC_Widget_Layered_Nav', [
            'title' => $attribute->attribute_label,
            'attribute' => $attribute->attribute_name,
          ]);
        };
      ?>
    </div>
    <div class="filtro">
        <h3 class="filtro-titulo">Filtrar por preço</h3>
        <form class="filtro-preco">
          <div>
            <label for="min_price">De R$</label>
            <input required type="text" name="min_price" id="min_price" value="<?= $_GET['min_price']?>">
          </div>
          <div>
            <label for="max_price">Até R$</label>
            <input required type="text" name="max_price" id="max_price" value="<?= $_GET['max_price']?>">
          </div>
          <button type="submit">Filtrar</button>
        </form>
    </div>
  </nav>
  <main>
   <?php if($data['products'][0]) { ?>
   <?php woocommerce_catalog_ordering();?>
    <?php medita_product_list($data['products']); ?>
    <?= get_the_posts_pagination(); ?>
   <?php } else { ?>
    <p>Nenhum resultado para a sua busca!</p>
   <?php } ?>
   
  </main>  
</article>

<?php get_footer(); ?>