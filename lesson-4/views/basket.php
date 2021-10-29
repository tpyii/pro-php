<div><?= $flash['message'] ?></div>
<h1>Корзина</h1>
<ul>
  <?php foreach ($items as $item): ?>
  <li>
    <h2><a href="/products/<?= $item->product_id ?>"><?= $item->name ?></a></h2>
    <p>Цена: <?= $item->price ?></p>
    <form action="/basket/<?= $item->id ?>" method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <input type="submit" value="Удалить">
    </form>
  </li>
  <?php endforeach ?>
</ul>
