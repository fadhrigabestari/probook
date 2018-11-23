<?php

$auth_user = null;

function check_access() {
  global $db_conn;
  global $auth_user;
  $cookie = $_COOKIE['authToken'] ?? null;
  $uid = intval($cookie); // currently
  if ($cookie === null)
    return false;
  $stmt = $db_conn->prepare('select * from Users where idUser = ?');
  $stmt->execute([$uid]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user === false)
    return false;
  $auth_user = $user;
  return true;
}

function set_token($uid) {
  // Make this a session cookie
  setcookie('authToken', "$uid", 0, make_url(''), '', false, true);
}

function unset_token() {
  setcookie('authToken', false, 1, make_url(''), '', false, true);
}
