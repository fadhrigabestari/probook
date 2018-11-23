<?php

// Setup

mb_internal_encoding('UTF-8');
require 'config.php';
require 'include/router.php';
require 'include/template_helpers.php';
require 'include/database.php';
require 'include/authentication.php';

// Routing

// Routes that don't require authentication
$noauth_routes = ['register', 'paths.js', 'login', 'logout'];

// Routes that require the user to be logged in
$logged_in_routes = [
    'search', 'detail', 'order',
    'history', 'review',
    'profile', 'update', ''
];

$index_routes = array_merge($noauth_routes, $logged_in_routes);

function handle_path($mainpath, $extrapath) {
  global $noauth_routes;
  global $logged_in_routes;
  $authenticated = check_access();
  if (in_array($mainpath, $noauth_routes, true)) {
    // Handle paths that don't care about authentication
    invoke_controller($mainpath);
  } else if (in_array($mainpath, $logged_in_routes, true)) {
    if (!$authenticated) {
      redirect_to_login();
    } else {
      if ($mainpath == '') {
        // Handle main page
        redirect_to('search');
      } else {
        invoke_controller($mainpath);
      }
    }
  }
}

function handle_not_found($path) {
  http_response_code(404);
  echo 'not found mate';
  die;
}

function redirect_to_login() {
  global $router_fullpath;
  $redirpath = urlencode($router_fullpath);
  redirect_to("login?redir=$redirpath");
}

function invoke_controller($mainpath) {
  require "controllers/$mainpath.php";
}

router_start($index_routes, 'handle_path', 'handle_not_found');
