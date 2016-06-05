<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RefGPC\_vues;

/**
 * Description of ilotVue
 *
 * @author Marc
 */
class ilotVue {

    //put your code here
    var $vars;

    public function __construct($data = array()) {
        $this->vars = $data;
        
       // var_dump($this);
       
    }

    public function afficheHaut() { 
        extract($this->vars);

        //echo '<br /> webpath ['.WEBPATH.']';
        //echo '<br /> classCSSLienMP ['.$classCSSLienMP.']';
        require("haut.php"); }
    public function afficheBas() { 
        extract($this->vars);
        require("bas.php"); 
        
    }
    
    public function affiche() {
        extract($this->vars);
        //echo '<br /> classCSSLienMP ['.$classCSSLienMP.']';
        //echo '<br /> webpath ['.WEBPATH.']';
        $this->afficheHaut();
        
        
        echo '<section class="corps">
                <div class="lateral_nav">';
        // echo '<br />ddddd|'.$classLienMenuLateralIlot.'|';
        require('menuLateral_V.php');
        echo '</div>   ';
        $this->afficheContenu();
        echo '</section>';
                
        $this->afficheBas();
    }
    
    public function afficheContenu() {
        extract($this->vars);
       require('contenu.php');
      
    }

}
