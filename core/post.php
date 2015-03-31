<?php


if (controlAccess() === false) {
    http_response_code(403);
    exit();
}

if (!isset($_FILES["file"], $_FILES["file"]["tmp_name"]) || empty($_FILES["file"]["tmp_name"])) {
    http_response_code(400);
    exit();
}


$path = $_FILES["file"]["tmp_name"];

set_time_limit(3600);

if (FILTER_INPUT(INPUT_POST, "hash") === null) {
    $hash = hash_file($algorithm, $path);
} else {
    $hash = FILTER_INPUT(INPUT_POST, "hash");
}


if (file_exists(hashToFilename($hash))) {
    http_response_code(201);
    exit($hash);
}

createDirectoryByHash($hash);

if (move_uploaded_file($path, hashToFilename($hash))) {
    http_response_code(201);
    echo $hash;
} else {
    http_response_code(500);
    exit();
}