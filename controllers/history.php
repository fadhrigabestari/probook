<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $db_conn;
global $auth_user;
$stmt = $db_conn->prepare('select Transactions.idTransaction, Transactions.quantity, Transactions.orderdate, Books.cover, Books.title, Reviews.comment from Transactions natural join Books left OUTER join Reviews on Transactions.idTransaction = Reviews.idTransaction where idUser = ? order by Transactions.idTransaction DESC');
$stmt->execute([$auth_user['idUser']]);
$results = $stmt->fetchAll();
require 'views/history.php';
