<?php

if (controlAccess() === false) {
    http_response_code(403);
    exit();
}

$hash = getRequestPath();

if (strlen($hash) == 0) {
    http_response_code(400);
    exit();
}

if (file_exists(hashToFilename($hash))) {
    if (unlink(hashToFilename($hash))) {
        http_response_code(200);
    } else {
        http_response_code(500);
        exit();
    }
} else {
    http_response_code(404);
    exit();
}