<?php
// KONTROLER USTAWIEŃ JAKO METODY STATYCZNIE UDOSTĘPNIA INTERFEJS DO PRZETRZYMYWANIA INFORMACJI, METODY GET POBIERAJĄCE DANE I SET USTAWIAJĄCE, JEDNAK TE WYMAGAJĄ UTWORZENIA OBIEKTU, A TO STANIE SIĘ TYLKO W PANELU ADMINA (BEZPIECZEŃSTWO)
class controller_settings
{
    private static $pageTitle  = "";
    private static $pageEncoding  = "UTF-8";
    private static $pageLanguage  = "pl";
    private static $pageDescription = "";
    private static $pageKeywords = "";
    private static $pageAuthor = "Oskar 'archi_tektur' Barcz";

    function __construct()
    {
    }

//GETTERY
    public static function getPageDetails()
    {
        return array(   'pageTitle' => self::$pageTitle,
                        'pageEncoding' => self::$pageEncoding,
                        'pageLanguage' => self::$pageLanguage,
                        'pageDescription' => self::$pageDescription,
                        'pageKeywords' => self::$pageKeywords,
                        'pageAuthor' => self::$pageAuthor);
    }
}
