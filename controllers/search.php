<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

if (!isset($_REQUEST['search'])) {
    require 'views/search-book.php';
} else {
    global $db_conn;
    $query = $_REQUEST['search'];
    $stmt = $db_conn->prepare('
        select
            Books.idBook, title, author, cover, description, avg(rating) as rating,
            count(Reviews.idTransaction) as reviewCount
        from Books
        left outer join Transactions on Books.idbook = Transactions.idBook
        left outer join Reviews on Transactions.idTransaction = Reviews.idTransaction
        where title like ? group by Books.idBook');
    $stmt->execute(["%$query%"]);
    $results = $stmt->fetchAll();
    require 'views/search-result.php';
}
