<?php

namespace RefGPC\_systemClass;

use \RefGPC\_controleurs\ilotControleur;

class Dispatch {

    // nom du controleur par defaut
    const DEFCONTROLLERNAME = 'ilotControleur';
    // action par defaut
    const DEFACTIONNAME = 'affIndex';

    private $knownControllers = array(); // liste des controlleurs connus

    /* index tableau $paramsUrl
     * 0 : ui LR ou MP
     * 1 : controleur
     * 2 : methode
     * 3+ : autres parametres
     */
    public $paramsUrl;

    public function __construct($url) {
        $this->initControleurs();
        // traite les données de l'url
        $this->paramsUrl = $this->traiteURL($url);
        //var_dump($this->paramsUrl);
    }
    
    public function createController() {
        $name = 'RefGPC/_controleurs/' . $this->paramsUrl[1];
        echo '<br />createController :: Classe appele : ' . $name;
        // \RefGPC\_controleurs
        return new $name();
    }

    /**
     * initialise les controlleurs connus de Dispatch
     * Evite de faire l'appel à addController() dans la page d'accueil dispatcher.php
     */
    private function initControleurs() {
        //Lister tout les controleur existant;
        $initControllers = array('ilotControleur', 'centreControleur');
        array_merge($this->knownControllers, $initControllers);
    }

    /**
     * Ajoute un controleur à la liste des controlleurs connus
     * @param type $name String nom du nouveau controleur
     */
    public function addController($name) {
        $this->knownControllers[] = $name;
    }
/*
    public function createController($name) {
        // verifie l'existence du controller
        if ($this->controllerExists($name)) {
            //$name = '\controllers\tutoriels';
            //echo 'plop'.$name.'plop';
            $name = 'RefGPC/_controleurs/' . $name;
            echo '<br />Classe appele : ' . $name;
            return new $name();
        } else {
            $this->listeController();
            $msg = 'Dispatch :: Controleur [' . $name . '] inconnu de Dispatch.';
            throw new RefGpcException($msg);
            return null;
        }
    }
*/
    private function controllerExists($name) {
        return in_array($name, $this->knownControllers);
    }

    // utile pour debug : var_dump
    private function listeController() {
        echo '<br>listeController :';
        foreach ($this->knownControllers as $c) {
            echo '<br>controller [' . $c . ']';
        }
    }

    // ---------------------------------------------------------------
    /**
     * traitement de l'url.
     * Format de l'URL : referentielGPC.com/BaseLR-MP/Controleur/methode
     * @param type $url
     */
    protected function traiteURL($url) {
        //$pageAsk = htmlentities($_GET['url']); // Récup sécurisé de l'url
        $pageAsk = (string) filter_input(INPUT_GET, 'url');
        $pageAsk = rtrim($pageAsk, '/');
        $pageAsk = explode('/', $pageAsk); // séparation des éléments de l'url

        //var_dump($this->paramsUrl);
        // Calcul de la base choisie LR ou MP
        if (isset($pageAsk[0])) {
            if (!preg_match('#[A-Z]{2}#', $pageAsk[0])) {
                $pageAsk[0] = 'MP';  // ui par défaut
            }
            else {
                $pageAsk[0] = $pageAsk[0] == 'LR' ? 'LR' : 'MP';
            }
        }
        else {
           $pageAsk[0] = 'MP';
        }
        
        // Calcul du controleur : $controllerName = $pageAsk[1].'Controleur';
        $pageAsk[1]  = isset($pageAsk[1]) ? $pageAsk[1] . 'Controleur' : self::DEFCONTROLLERNAME; 
        if (!$this->controllerExists($pageAsk[1])) { $pageAsk[1] = self::DEFCONTROLLERNAME; }
        
        // Calcul de la method du controleur à utiliser
        $pageAsk[2] = isset($pageAsk[2]) ? $pageAsk[2] : self::DEFACTIONNAME;
        if (!method_exists($pageAsk[1], $pageAsk[2])) { 
            $pageAsk[1] = self::DEFCONTROLLERNAME; 
            $pageAsk[2] = self::DEFACTIONNAME;
        }
        
        return $pageAsk;
      
    }

}
