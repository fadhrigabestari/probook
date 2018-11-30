<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

if (!isset($_REQUEST['search'])) {
    require 'views/search-book.php';
} else {
  //web service
  global $db_conn;
  $wsdl = 'http://localhost:8081/api/books?wsdl';
  $soap = new SoapClient($wsdl);
  $results = $soap->searchBook($_REQUEST['search']);

  for ($i = 0; $i < sizeof($results->item); $i++) {
      $book_id = $results->item[$i]->idBook;
      $stmt = $db_conn->prepare('select idTransaction, avg(rating), count(idTransaction) from transactions natural join reviews where idBook = ? group by ?');
      $stmt->execute([$book_id, $book_id]);
      $ratings = $stmt->fetchAll();
       if(count($ratings) !== 0) {
          $results->item[$i]->rating = $ratings['avg(rating)'];
          $results->item[$i]->ratingCount = $rating['count(idTransaction)'];  
       }
      
  }
  
    
 

  $result = json_encode($results);
  echo($result);
}
