<?php
class Autoload {
    
    /**
     * Autoloads class files from /application/lib
     * Include Autoload class in index and call static function
     * 
     * @example Autoload::lib;
     * 
     * @param string $class
     */
    public static function lib() {
        
        spl_autoload_register(function ($class) {
            include '/application/lib/' . $class . '.php';
        });
        
    }
    
}
