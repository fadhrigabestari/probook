<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

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
    global $router_extrapath;
    $idTransaction = intval($router_extrapath); 
    $reviewstmt = $db_conn->prepare('select cover, idBook, books.title, books.author from Transactions natural join Books where idTransaction = ?');
    $reviewstmt->execute([$idTransaction]);
    $result = $reviewstmt->fetch();
    require 'views/history-review.php';
}

