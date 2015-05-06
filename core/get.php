<?php

$hash = getRequestPath();

set_time_limit(0);

if (strlen($hash) == 0) {
    die(disk_free_space(getcwd() . CACHE_DIR));
}

$filename = hashToFilename($hash);

if (!file_exists($filename)) {
    http_response_code(404);
    exit();
}

http_response_code(301);

header("Location: /" . $filename);
