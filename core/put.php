<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (controlAccess() === false) {
    http_response_code(403);
    exit();
}

set_time_limit(0);

$temp = getcwd() . CACHE_DIR . "/" . genUniqueName();

$fh = fopen("php://input", "r");
$out = fopen($temp, "w");
$digest = hash_init($algorithm);
$counter = MAX_UPLOAD_SIZE;

while (($data = fread($fh, BUFFER_SIZE)) && ($counter > 0)) {

    $counter -= strlen($data);
    hash_update($digest, $data);
    fwrite($out, $data);

}

fclose($out);
fclose($fh);

if ($counter <= 0) {

    error_log("Request is too large");
    http_response_code(413);
    unlink($temp);

} else {

    $hash = hash_final($digest);
    createDirectoryByHash($hash);

    $filename = hashToFilename($hash);

    if (!file_exists($filename)) {
        rename($temp, $filename);
    } else {
        unlink($temp);
    }

    echo $hash;

}

