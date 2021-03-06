<?php

namespace RefGPC\_systemClass;

class Autoloader{


    const RACINE_NAMESPACE = 'RefGPC';

    static function register(){
       spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($className){
        if(strpos($className, self::RACINE_NAMESPACE.'\\') === 0){

            $className = str_replace(self::RACINE_NAMESPACE.'\\', '', $className);
            $className = str_replace('\\', '/', $className);
            //echo '<br />Chargement de ce fichier qui fait le require : '.PATH.$className.'.php';
            require PATH.$className.'.php';
        }
    }
}
