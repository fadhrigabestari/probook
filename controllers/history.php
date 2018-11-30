<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

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
  global $db_conn;
  global $auth_user;
  $stmt = $db_conn->prepare('select Transactions.idTransaction, Transactions.quantity,
  Transactions.orderdate, Books.idBook, Reviews.comment from Transactions natural join
  Books left OUTER join Reviews on Transactions.idTransaction = Reviews.idTransaction where idUser = ? order by Transactions.idTransaction DESC');
  $stmt->execute([$auth_user['idUser']]);
  $results = $stmt->fetchAll();
  $details = array();
  foreach($results as $result) {
    $id = $result['idBook'];
    $soap = new SoapClient($wsdl, $options);
    $book = $soap->detailBook($id);
    $temptitle = (string)$book->title;
    $tempcover = (string)$book->cover;
    $details['title'] = $temptitle;
    $details['cover'] = $tempcover;
  }
}
catch(Exception $e) {
  die($e->getMessage());
}
require 'views/history.php';
