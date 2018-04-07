<?php

$PREFIX = "";

try {
    if ($_SERVER["HTTPS"] != "on") {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
        exit();
    }
    require_once './code/index.php'; // ładowanie aplikacji
    session_start(); //uruchamianie sesji
    Router($PREFIX); //uruchamianie przekierowań
} catch (Exception $e) {
    echo 'ERROR: [' . $e->getCode() . '] ' . $e->getMessage();    // NIE POKAZUJEMY STOSU WYWOLAN, ABY W MOMENCIE AWARII POLACZENIA, NIE WYSWIETLIC PRZYPADKOWO HASLA DO BAZY DANYCH!
}
