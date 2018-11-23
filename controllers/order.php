<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $db_conn;
global $auth_user;
global $router_extrapath;
$content = json_decode(file_get_contents('php://input'), true);

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
