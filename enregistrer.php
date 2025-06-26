<?php
$codeSecret = 'arvis';

if ($_POST['code'] !== $codeSecret) {
  echo json_encode(['success' => false, 'message' => 'Code incorrect']);
  exit;
}

$titre = strip_tags($_POST['titre']);
$commentaire = strip_tags($_POST['commentaire']);
$image = $_POST['image'];
$date = date('d/m/Y');

$newArticle = [
  'titre' => $titre,
  'commentaire' => $commentaire,
  'image' => $image,
  'date' => $date
];

$file = 'articles.json';
$articles = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$articles[] = $newArticle;
file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));

echo json_encode(['success' => true, 'articles' => $articles]);

