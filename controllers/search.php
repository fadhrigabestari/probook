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
  if ($results->item!=null) {
      for ($i = 0; $i < sizeof($results->item); $i++) {
          $book_id = $results->item[$i]->idBook;
          $stmt = $db_conn->prepare('select idTransaction, avg(rating) as avg_rating, count(idTransaction) as count_id from transactions natural join reviews where idBook = ? group by idBook');
          $stmt->execute([$book_id]);

          $ratings = $stmt->fetch();
           if($ratings) {
              $results->item[$i]->rating = $ratings['avg_rating'];
              $results->item[$i]->ratingCount = $ratings['count_id'];
           }
      }
      
  }
  $result = json_encode($results);
  echo($result);
}
