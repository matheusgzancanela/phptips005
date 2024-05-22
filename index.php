<?php

use CoffeeCode\Paginator\Paginator;
use Source\Models\Post;

require __DIR__ . "/vendor/autoload.php";

$post = new Post();
$page = filter_input(INPUT_GET, "page");

//$paginator = new Paginator("http://localhost/phptips/ep05/?page=", "Página", ["Primeira Página", "Primeira"], ["Última Página", "Última"]);
$paginator = new Paginator("http://localhost/phptips/ep05/?page=");
$paginator->pager($post->find()->count(), 3, $page, 2);

$posts = $post->find()->limit(2)->offset(1)->fetch(true);

echo "<p>Página {$paginator->page()} de {$paginator->pages()}</p>";

if ($posts) {
  foreach ($posts as $post) {
    echo "<article class='post'><img src='{$post->cover}'/><div><h1>{$post->title}</h1><div>{$post->description}</div></div></article>";
  }
}