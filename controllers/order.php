<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $db_conn;
global $auth_user;
global $router_extrapath;
$content = json_decode(file_get_contents('php://input'), true);

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

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
  $buy = $soap->buyBook($content['idBook'], $content['quantity'], 123);
}
catch(Exception $e) {
  die($e->getMessage());
}

if($buy) {
  $getbookstmt = $db_conn->prepare('select * from Books where idBook = ?');
  $result = $getbookstmt->execute([$content['idBook']]);
  if (!isset($getbookstmt)) {
    $bookstmt = $db_conn->prepare('insert into Books(idBook) values(?)');
    $bookstmt->execute([$content['idBook']]);
  }

  $orderDate = date('Y-m-d');
  $orderstmt = $db_conn->prepare('insert into Transactions(idBook,
    idUser, orderDate, quantity)
    values (?, ?, ?, ?)');
  $orderstmt->execute([$content['idBook'], $auth_user['idUser'], $orderDate, $content['quantity']]);
  if($orderstmt) {
    $last_id = $db_conn->lastInsertId();
  }
  $result = array("idTransaction"=>$last_id);

  header('content-type: application/json; charset=utf-8');
  echo json_encode($result);
}
