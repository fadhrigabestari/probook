<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

if (!isset($_REQUEST['search'])) {
    require 'views/search-book.php';
} else {
  // database
  global $db_conn;
  $json = json_decode($result, true);
  $books = $json["items"];
  $ratings = array();
  foreach($books as $book) {
      // $book_ids[] = $book["idbook"];
    $stmt = $db_conn->prepare('select idTransaction, avg(rating) from transactions where idBook = ? group by idBook');
    $stmt->execute($book["idBook"]);
    $rating = $stmt->fetchAll();
    $ratings[] = $rating['avg(rating)'];
  }
  

}
