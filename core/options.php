<?php

use libs\FFprobe;

$hash = getRequestPath();

$filename = hashToFilename($hash);

if (!file_exists($filename)) {
    http_response_code(404);
    exit();
}

$probe = FFprobe::read($filename);

header("Content-Type: application/json");

echo json_encode($probe);
