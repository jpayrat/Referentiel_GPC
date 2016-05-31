<?php

namespace RefGPC;

class path{

    const RACINE = 'Referentiel_GPC-MVC';

    private static $_instance = null;
    private function __construct() {}

    public static function inst() {
        if (self::$_instance == null) {	self::$_instance = new path();	}
        return self::$_instance;
    }

    // racine pour les include('')
    public static function root() {
        return $_SERVER['DOCUMENT_ROOT'].(MODE_LOCAL == true ? self::RACINE : '/' ).'/';
    }

    // racine pour les adresses href=''
    public static function http() {
        return "http://".$_SERVER['HTTP_HOST'].(MODE_LOCAL == true ? '/'. self::RACINE : '/' ).'/';
    }
}