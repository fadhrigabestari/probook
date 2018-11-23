<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_2 = $_POST['confirm-password'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];

global $db_conn;

try {
  $db_conn->beginTransaction();

  if ($password !== $password_2)
    throw new Exception('passwords do not match');
  if (!check_username($username))
    throw new Exception('username unavailable');
  if (!check_email($email))
    throw new Exception('email unavailable');

  $stmt = $db_conn->prepare('insert into Users (name, username, password, email, address, phone)
    values(?, ?, ?, ?, ?, ?)');
  $stmt->execute([$name, $username, $password, $email, $address, $phone]);

  $new_uid = intval($db_conn->lastInsertId());
  // Log in to new account
  set_token($new_uid);

  $db_conn->commit();
} catch (Exception $e) {
  $db_conn->rollBack();
  // Registration failed! Go back
  redirect_to('register');
}

// Success, welcome
redirect_to('');
