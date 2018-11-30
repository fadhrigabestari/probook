<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

// $bookstmt = $db_conn->prepare('select idBook, title, author, cover, description
//   from Books
//   where idBook = ?');
// $bookstmt->execute([$id]);
// $book = $bookstmt->fetch();
// if($book == false) {
//   http_response_code(404);
//   require 'views/not-found.php';
//   die;
// }

global $db_conn;
global $router_extrapath;

$wsdl = 'http://localhost:8081/api/books?WSDL';

$options = array(
  'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
  'style'=>SOAP_RPC,
  'use'=>SOAP_ENCODED,
  'soap_version'=>SOAP_1_1,
  'cache_wsdl'=>WSDL_CACHE_NONE,
  'connection_timeout'=>15,
  'trace'=>true,
  'encoding'=>'UTF-8',
  'exceptions'=>true,
);
try {
  $id = $router_extrapath;
  $soap = new SoapClient($wsdl, $options);
  $book = $soap->detailBook($id);
  if(isset($book)) {
    $reviewstmt = $db_conn->prepare('select picture, username, comment, rating
      from Reviews natural join Transactions natural join Users
      where idBook = ?');
    $reviewstmt->execute([$id]);
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

    try {
        $recommend = $soap->recommendBook($book->categories);
        if(is_array($recommend->item)) {
          $recommend = $recommend->item[0];
        } else {
          $recommend = $recommend->item;
        }
    } catch(Exception $e) {
        die($e->getMessage());
    }
  }
}
catch(Exception $e) {
  die($e->getMessage());
}


require 'views/book-detail.php';
