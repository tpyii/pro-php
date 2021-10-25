<div><?= $flash['message'] ?></div>
<h1>Товары</h1>
<ul>
  <?php foreach ($products as $item): ?>
  <li>
    <h2><a href="/products/<?= $item->id ?>"><?= $item->name ?></a></h2>
    <p>Цена: <?= $item->price ?></p>
    <form action="/basket" method="POST">
      <input type="hidden" name="product_id" value="<?= $item->id ?>">
      <input type="submit" value="В корзину">
    </form>
  </li>
  <?php endforeach ?>
</ul>
