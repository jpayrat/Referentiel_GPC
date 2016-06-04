<?php

namespace RefGPC\_systemClass;
use \RefGPC\_controleurs\ilotControleur;



class Dispatch {

	static private $controllers;

	static public function addController($name) {
		self::$controllers[] = $name;
	}

	static public function createController($name) {
		// verifie l'existence du controller
			
			
		if (self::controllerExists($name)) {
			//$name = '\controllers\tutoriels';
			//echo 'plop'.$name.'plop';
			$name = 'RefGPC/_controleurs/'.$name;
			echo '<br />Classe appele : '.$name;
			return new $name();
		}
		else {
			return null;
		}
	}
	
	static private function controllerExists($name) {
		return in_array($name, self::$controllers);
	}
}
