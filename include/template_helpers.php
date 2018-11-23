<?php
(basename(__FILE__) !== basename($_SERVER['SCRIPT_NAME'])) or die;

/* Echo a HTML-escaped version of $value.
 * Safe for use in:
 * * HTML content
 * * HTML attributes with single quotes (')
 * * HTML attributes with double quotes (")
 * NOT SAFE for use with unquoted attributes or anything else
 */
function e($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

function eu($target_mainpath, $target_extrapath=null) {
    e(make_url($target_mainpath, $target_extrapath));
}

function es($path) {
    e(make_static_url($path));
}

/* Echo a JSON-escaped version of $value.
 * Safe for use in:
 * * <script> tags
 * NOT SAFE for use in:
 * * HTML attributes
 */
function ej($value) {
    echo json_encode($value, JSON_HEX_TAG|JSON_HEX_AMP);
}

function eju($target_mainpath, $target_extrapath=null) {
    ej(make_url($target_mainpath, $target_extrapath));
}

function ejs($path) {
    ej(make_static_url($path));
}

