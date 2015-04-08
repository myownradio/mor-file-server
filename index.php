<?php

require_once "core/functions.php";
require_once "core/firewall.php";

const CACHE_DIR = "cache";
const BUFFER_SIZE = 4096;
const MAX_UPLOAD_SIZE = 250000000;

error_log(
    FILTER_INPUT(INPUT_SERVER, "REQUEST_METHOD") . ": " .
    FILTER_INPUT(INPUT_SERVER, "SERVER_NAME") . FILTER_INPUT(INPUT_SERVER, "REQUEST_URI")
);

switch (FILTER_INPUT(INPUT_SERVER, "REQUEST_METHOD")) {


    case 'POST':
        include "core/post.php";
        break;

    case 'PUT':
        include "core/put.php";
        break;

    case 'DELETE':
        include "core/delete.php";
        break;

    case 'GET':
        include "core/get.php";
        break;

    case 'SIZE':
        include "core/size.php";
        break;

    case 'STAT':
        http_response_code(200);
        echo disk_free_space(CACHE_DIR);
        break;

    default:
        http_response_code(501);
        break;
}

