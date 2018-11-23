<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

function authenticate($username, $password, $requsername, $reqpassword) {
  return ($username === $requsername) && ($password === $reqpassword);
}

function redir_success() {
  // Redirect the user
  $redir = $_GET['redir'] ?? '';
  $safe_redir = sanitize_url($redir);
  if ($safe_redir !== null) {
    redirect_to($safe_redir);
  } else {
    redirect_to('');
  }
}

global $db_conn;

// Redirect if the user is already logged in
if (check_access())
  redir_success();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $loginstmt = $db_conn->prepare('select idUser, username, password
      from Users
      where username = ?');
  $loginstmt->execute([$username]);
  $user = $loginstmt->fetch();

  if(is_array($user) && authenticate($user['username'], $user['password'], $username, $password)) {
    // Success
    set_token($user['idUser']);
    // Redirect user
    redir_success();
  }
  // Authentication failed.
  redirect_to('login?redir=' . urlencode($_GET['redir'] ?? ''));

} else {

  // User unauthenticated
  http_response_code(401);
  require 'views/user-login.php';

}
