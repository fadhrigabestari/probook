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

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $db_conn;
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $idTransaction = $_POST['idTransaction'];
    $reviewstmt = $db_conn->prepare('insert into Reviews (idTransaction, rating, comment) values(?, ?, ?)');
    $reviewstmt->execute([$idTransaction, $rating, $comment]);
    redirect_to('history');
} else {
    global $db_conn;
    global $auth_user;
    global $router_extrapath;
    $idTransaction = intval($router_extrapath);
    $reviewstmt = $db_conn->prepare('select idBook from Transactions natural join Books where idTransaction = ?');
    $reviewstmt->execute([$idTransaction]);
    $result = $reviewstmt->fetch();

    $id = $result['idBook'];
    $soap = new SoapClient($wsdl, $options);
    $book = $soap->detailBook($id);

    $detail['title'] = (string)$book->title;
    $detail['cover'] = (string)$book->cover;
    $detail['description'] = (string)$book->description;
    $detail['authors'] = $book->authors;
    $detail['categories'] = $book->categories;

    require 'views/history-review.php';
}
