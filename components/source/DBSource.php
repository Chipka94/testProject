<?php

/**
 * Class DBSource
 * Формирует подключение к БД
 */

class DBSource {

    public static function getConnection() {
        $settingsPath = ROOT."/config/dbSettings.php";
        $settings = include($settingsPath);

        $host = $settings["host"];
        $user = $settings["user"];
        $dbname = $settings["dbname"];
        $password = $settings["password"];

        $dbh = "mysql:host=$host;dbname=$dbname";
        return new PDO($dbh, $user, $password);
    }
}