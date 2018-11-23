<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

unset_token();
redirect_to('login');
