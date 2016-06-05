<?php
namespace RefGPC\_models;
use \RefGPC\_systemClass\RefGpcException;
/**
 * Description of ModelVueDefaut
 * Données de base pour affichier une vue
 * @author Marc
 */
class ModelVueDefaut {
    // le tableau des class css
    protected $cssClass;
    protected $cssClassAutorised = array();
    
    public function __construct($menu) {
        $this->cssClassAutorised =  array('ilot', 'centre', 'tech');
        $this->setMenu($menu);
    }
    
    private function setMenu($menu) {
        $this->cssClass['ilot'] = '';
        $this->cssClass['centre'] = '';
        $this->cssClass['tech'] = '';    

        if (!in_array($menu, $this->cssClassAutorised)) {
            throw new RefGpcException('Erreur class css [' .$menu. '] inconnue pour le menu lateral !');
        }
        $this->cssClass[$menu] = 'actif';
    }
    
    // menu lateral
    function cssIlot() { return $this->cssClass['ilot']; }
    function cssCentre() { return $this->cssClass['centre']; }    
    function cssTech() { return $this->cssClass['tech']; }
    
    public function getData() {
        $d = array();
        $d['classLienMenuLateralIlot'] = $this->cssIlot();
        $d['classLienMenuLateralCentre'] = $this->cssCentre();
        $d['classLienMenuLateralTech'] = $this->cssTech();
        return $d;
    }
    
}
