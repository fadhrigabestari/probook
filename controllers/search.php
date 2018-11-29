<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

if (!isset($_REQUEST['search'])) {
    require 'views/search-book.php';
} else {
  //web service
  $wsdl = 'http://localhost:8081/api/books?wsdl';
  $soap = new SoapClient($wsdl);
  $results = $soap->searchBook($_REQUEST['search']);
  $result = json_encode($results);
  echo($result);
}
