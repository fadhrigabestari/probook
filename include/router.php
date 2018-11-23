<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

function router_start($main_paths, $handler_fn, $not_found_handler) {
    global $router_routes;
    global $router_fullpath;
    global $router_mainpath;
    global $router_extrapath;

    $mainpaths_regex = implode('|', $main_paths);
    $router_routes = "/^\\/($mainpaths_regex)(\\/(.*))?$/";
    $path = $_SERVER['PATH_INFO'] ?? '/';
    $router_fullpath = $path;
    if (isset($_SERVER['QUERY_STRING']))
        $router_fullpath .= '?' . $_SERVER['QUERY_STRING'];
    $matches = [];
    preg_match($router_routes, $path, $matches);
    if (!isset($matches[1])) {
        $not_found_handler($path);
        die;
    }
    $router_mainpath = $matches[1];
    $router_extrapath = $matches[3] ?? null;
    $handler_fn($router_mainpath, $router_extrapath);
}

// Helper functions

function check_path($path) {
    global $router_routes;
    return preg_match($router_routes, $path) === 1;
}

function sanitize_url($url) {
    $path = parse_url($url, PHP_URL_PATH);
    if (!check_path($path))
        return null;
    $query = parse_url($url, PHP_URL_QUERY);
    if (isset($query))
        $path .= '?' . $query;
    return $path;
}

function make_url($target_mainpath, $target_extrapath=null) {
    $target_mainpath = ltrim($target_mainpath, '/');
    $target = "${_SERVER['SCRIPT_NAME']}/$target_mainpath";
    if (isset($target_extrapath))
        $target .= "/$target_extrapath";
    return $target;
}

function make_static_url($path) {
    $parent = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $target = "$parent/$path";
    return $target;
}

function redirect_to($target_mainpath, $target_extrapath=null) {
    $target = make_url($target_mainpath, $target_extrapath);
    header("Location: $target");
    die;
}
