<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $db_conn;
global $auth_user;

$result = $auth_user;

function update_image() {
  global $db_conn;
  global $auth_user;
  $pic = $_FILES['picture'];
  $fname = $pic['tmp_name'];
  $ext = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
  if (!in_array($ext, ['jpg', 'jpeg', 'png'], true))
    return;
  if (!is_uploaded_file($fname))
    return;
  $md5 = md5_file($fname);
  $targetdir = dirname(__DIR__) . '/uploadimg/';
  $targetname = "$md5.$ext";
  move_uploaded_file($fname, $targetdir . $targetname);
  $picstmt = $db_conn->prepare('update Users
  set picture = ?
  where idUser = ?');
  $picstmt->execute([$targetname, $auth_user['idUser']]);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $userstmt = $db_conn->prepare('update Users
  set name = ?, address = ?, phone = ?
  where idUser = ?');
  $userstmt->execute([$_POST['name'], $_POST['address'], $_POST['phone'], $auth_user['idUser']]);
  if(($_FILES['picture']['error'] ?? null) === UPLOAD_ERR_OK) {
    update_image();
  }
  if($userstmt || $picstmt) {
    redirect_to('profile');
  } else {
    redirect_to('update');
  }

} else {

    require 'views/edit-profile.php';

}
