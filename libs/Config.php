<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.05.15
 * Time: 20:52
 */

namespace libs;


class Config {

    private static $settings = null;

    private static function load() {
        self::$settings = parse_ini_file("server.ini", true);
    }

    public static function getSetting($section, $key) {
        if (self::$settings === null) {
            self::load();
        }
        return self::$settings[$section][$key];
    }

} 