<?php

$PREFIX = "/framework";

try
{

    require_once './code/index.php'; // ładowanie aplikacji
    session_start(); //uruchamianie sesji
    Router($PREFIX); //uruchamianie przekierowań
}
catch (Exception $e)
{
    echo 'ERROR: [' . $e->getCode() . '] ' . $e->getMessage();    // NIE POKAZUJEMY STOSU WYWOLAN, ABY W MOMENCIE AWARII POLACZENIA, NIE WYSWIETLIC PRZYPADKOWO HASLA DO BAZY DANYCH!
}
