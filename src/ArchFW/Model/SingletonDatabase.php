<?php
final class Singleton
{
    /**
     * Przechowuje instancję klasy Singleton
     *
     * @var object
     * @access private
     */
    private static $dbInstance = false;
 
    /**
     * Zwraca instancję obiektu Singleton
     *
     * @return Singleton
     * @access public
     * @static
     */
    public static function getInstance()
    {
        if( self::$dbInstance === false )
        {
            self::$dbInstance = new Singleton();
        }
        return self::$dbInstance;
    }
 
    private function __construct() 
    {

    }
}
