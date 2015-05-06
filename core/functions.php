<?php

$algorithm = "sha512";

/**
 * @param $hash
 * @return string
 */
function hashToFilename($hash) {
    return hashToPath($hash)."/".$hash;
}

/**
 * @param $path
 */
function createDirectoryByHash($path) {
    if (!file_exists(hashToPath($path))) {
        @mkdir(hashToPath($path), 0777, true);
    }
}

/**
 * @param $hash
 * @return string
 */
function hashToPath($hash) {
    return getcwd() . CACHE_DIR."/".substr($hash, 0, 1)."/".substr($hash, 1, 1);
}

function getRequestPath() {
    $uri = FILTER_INPUT(INPUT_SERVER, "REQUEST_URI");

    $off = strpos($uri, "?");
    if ($off === false) {
        return substr($uri, 1);
    } else {
        return substr($uri, 1, $off - 1);
    }
}

function genUniqueName() {
    $length = 16;
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $random = "";
    while ($length --) {
        $random .= substr($chars, rand(0, strlen($chars) - 1), 1);
    }
    return $random;
}

