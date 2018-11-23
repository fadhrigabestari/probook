<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

global $auth_user;
$result = $auth_user;
require 'views/data-profile.php';
