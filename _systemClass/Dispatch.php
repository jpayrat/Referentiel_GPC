<?php

namespace RefGPC\_systemClass;

//use \RefGPC\_controleurs\ilotControleur;

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
    protected $paramsUrl;

    public function __construct($url) {
        $this->initControleurs();
        // traite les données de l'url
        $this->paramsUrl = $this->traiteURL($url);
        
        
        
    }
    // helpers
    public function baseName() { return $this->paramsUrl[0]; }
    public function controllerName() { return $this->paramsUrl[1]; }
    public function methodName() { return $this->paramsUrl[2]; }
    
    
    public function createController() {
        $name = '\\RefGPC\\_controleurs\\' . $this->controllerName();
        //echo '<br />Dispatch::createController : Classe appele : [' . $name.']';
        // \RefGPC\_controleurs
        return new $name();
    }

    /**
     * Cree le controleur et execute la methode.
     * @throws RefGpcException
     */
    public function exec() {
        //var_dump($this->paramsUrl);
        $controller = $this->createController();
        if (method_exists($controller, $this->methodName())) {
            $data = $this->paramsUrl;
            unset($data[1]);
            unset($data[2]);
            call_user_func_array(array($controller, $this->methodName()), $data);
        }
        else {
            // TODO: crer le controller des erreur et renvoyer sur erreur 404
            echo '<br /> ERREUR 404';
            var_dump($this->paramsUrl);
            throw new RefGpcException('Dispatch::exec() : methode ['.$this->methodName().'] inexistante !');
        }
    }
    
    /**
     * initialise les controlleurs connus de Dispatch
     * Evite de faire l'appel à addController() dans la page d'accueil dispatcher.php
     */
    private function initControleurs() {
        //Lister tout les controleur existant;
        $initControllers = array(
            'baseControleur',
            'centreControleur',
            'ilotControleur'
            );
        array_merge($this->knownControllers, $initControllers);
    }

    /**
     * Ajoute un controleur à la liste des controlleurs connus
     * @param type $name String nom du nouveau controleur
     */
    public function addController($name) { $this->knownControllers[] = $name; }
    
    private function controllerExists($name) { return in_array($name, $this->knownControllers); }
    // ---------------------------------------------------------------
    /**
     * traitement de l'url et déterminer le controler, la methode et les paremetres.
     * Format de l'URL : referentielGPC.com/BaseLR-MP/Controleur/methode
     * @param type $url
     * @return type array() : le nom du controleur, la methode et les params 
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
        return $pageAsk;
      
    }

}
