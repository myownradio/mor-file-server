<?php

$hash = getRequestPath();

set_time_limit(0);

if (strlen($hash) == 0) {
    die(disk_free_space(CACHE_DIR));
}

$filename = hashToFilename($hash);

if (!file_exists($filename)) {
    http_response_code(404);
    exit();
}

error_log("File found! Redirecting to... /" . $filename);
http_response_code(301);
header("Location: /" . $filename);
//http_response_code(200);
//
//$fh = fopen($filename, "r");
//
//while($data = fread($fh, BUFFER_SIZE)) {
//    echo $data;
//    flush();
//}
//
//fclose($fh);
