<div><?= $flash['message'] ?></div>
<h1><?= $product->name ?></h1>
<p>Цена: <?= $product->price ?></p>
<form action="/basket" method="POST">
  <input type="hidden" name="product_id" value="<?= $product->id ?>">
  <input type="submit" value="В корзину">
</form>
