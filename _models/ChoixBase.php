<?php

namespace RefGPC\_models;

/**
 * choix de la base K2 ou T1
 */
class ChoixBase
{
    protected $ui;
    function __construct($choixUI) {
        $this->ui = $choixUI;
    }
    
    function libelle() { return $this->ui == 'LR' ? 'Languedoc-Roussillon' : 'Midi-Pyrénées';  }
    function code() { return $this->ui == 'LR'? 'K2' : 'T1';  }
    function classCSSLien($ilot) { return $ilot == $this->ui ?  'actif' : ''; }

}