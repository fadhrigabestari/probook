<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

if (!isset($_REQUEST['search'])) {
    require 'views/search-book.php';
} else {
    // global $db_conn;
    // $query = $_REQUEST['search'];
    // $stmt = $db_conn->prepare('
    //     select
    //         Books.idBook, title, author, cover, description, avg(rating) as rating,
    //         count(Reviews.idTransaction) as reviewCount
    //     from Books
    //     left outer join Transactions on Books.idbook = Transactions.idBook
    //     left outer join Reviews on Transactions.idTransaction = Reviews.idTransaction
    //     where title like ? group by Books.idBook');
    // $stmt->execute(["%$query%"]);
    // $results = $stmt->fetchAll();

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
  	   $soap = new SoapClient($wsdl, $options);
  	   $results = $soap->searchBook($_REQUEST['search']);
       $results = $results->item;
    }
    catch(Exception $e) {
  	   die($e->getMessage());
    }

    require 'views/search-result.php';
}
