<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 30.03.15
 * Time: 11:30
 */

function controlAccess() {
    $ip = FILTER_INPUT(INPUT_SERVER, "REMOTE_ADDR");
    $whitelist = [
        "127.0.0.1",
        "91.231.229.130",
        "176.38.54.30",
        "176.38.54.34",
        "94.153.222.226"
    ];
    return array_search($ip, $whitelist) !== false;
}
