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
  $getcardstmt = $db_conn->prepare('select cardNumber from users where username = ?');
  $getcardstmt->execute([$auth_user['username']]);
  $getcard = $getcardstmt->fetch();

  $soap = new SoapClient($wsdl, $options);
  $buy = $soap->buyBook($content['idBook'], $content['quantity'], $getcard['cardNumber']);
}
catch(Exception $e) {
  die($e->getMessage());
}

if($buy) {
  $getbookstmt = $db_conn->prepare('select * from Books where idBook = ?');
  $getbookstmt->execute([$content['idBook']]);
  $getbook = $getbookstmt->fetch();
  if ($getbook == false) {
    $bookstmt = $db_conn->prepare('insert into Books(idBook) values(?)');
    $bookstmt->execute([$content['idBook']]);
  }

  $getcatstmt = $db_conn->prepare('select * from categorynames where name = ?');
  $getcatstmt->execute([$content['category']]);
  $getcat = $getcatstmt->fetch();
  if ($getcat == false) {
    $categorynamestmt = $db_conn->prepare('insert into categorynames(name) values(?)');
    $categorynamestmt->execute([$content['category']]);
  }
  $idcatstmt = $db_conn->prepare('select idCategory from categorynames where name=?');
  $idcatstmt->execute([$content['category']]);
  $idcat = $idcatstmt->fetch();

  $getcat2stmt = $db_conn->prepare('select * from BookCategories where idBook = ?');
  $getcat2stmt->execute([$content['idBook']]);
  $getcat2 = $getcat2stmt->fetch();
  if($getcat2 == false) {
    $bookcategorystmt = $db_conn->prepare('insert into BookCategories values(?,?)');
    $bookcategorystmt->execute([$content['idBook'],$idcat['idCategory']]);
  }

  $orderDate = date('Y-m-d');
  $orderstmt = $db_conn->prepare('insert into Transactions(idBook,
    idUser, orderDate, quantity)
    values (?, ?, ?, ?)');
  $orderstmt->execute([$content['idBook'], $auth_user['idUser'], $orderDate, $content['quantity']]);
  if($orderstmt) {
    $last_id = $db_conn->lastInsertId();
  }
  $result = array("idTransaction"=>$last_id,"code"=>200);

  header('content-type: application/json; charset=utf-8');
  echo json_encode($result);
} else {
  $result = array("code"=>400);
  header('content-type: application/json; charset=utf-8');
  echo json_encode($result);
}
