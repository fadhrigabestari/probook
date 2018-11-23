<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $db_conn;
global $router_extrapath;
$id = intval($router_extrapath);
$bookstmt = $db_conn->prepare('select idBook, title, author, cover, description
  from Books
  where idBook = ?');
$reviewstmt = $db_conn->prepare('select picture, username, comment, rating
  from Reviews natural join Transactions natural join Users
  where idBook = ?');
$bookstmt->execute([$id]);
$reviewstmt->execute([$id]);
$book = $bookstmt->fetch();
if($book == false) {
  http_response_code(404);
  require 'views/not-found.php';
  die;
}
$reviews = $reviewstmt->fetchAll();
if(count($reviews) == 0) {
  $avgrating = 0;
} else {
  $sumrating = 0;
  foreach ($reviews as $review) {
    $sumrating += floatval($review['rating']);
  }
  $avgrating = $sumrating / count($reviews);
}
require 'views/book-detail.php';
