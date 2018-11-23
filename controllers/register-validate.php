<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

$content = json_decode(file_get_contents('php://input'), true);

$res = [];

global $db_conn;

$db_conn->beginTransaction();

if (isset($content['username'])) {
    $res['username'] = check_username($content['username']);
}

if (isset($content['email'])) {
    $res['email'] = check_email($content['email']);
}

$db_conn->commit();

header('content-type: application/json; charset=utf-8');
echo json_encode($res);
