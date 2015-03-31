<?php

$hash = getRequestPath();
$filename = hashToFilename($hash);

if (!file_exists(hashToFilename($hash))) {
    http_response_code(404);
    exit();
}

http_response_code(200);
echo filesize($filename);

