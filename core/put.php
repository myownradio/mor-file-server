<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (controlAccess() === false) {
    http_response_code(403);
    exit();
}

ignore_user_abort(true);

$temp = CACHE_DIR . "/" . genUniqueName();

$fh = fopen("php://input", "r");
$out = fopen($temp, "w");
$digest = hash_init($algorithm);

while (($data = fread($fh, 1024)) && (connection_aborted() == 0)) {
    hash_update($digest, $data);
    fwrite($out, $data);
}

fclose($out);
fclose($fh);

if (connection_aborted()) {

    unlink($out);

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

