<?php

namespace RefGPC\_models;

/**
 * choix de la base K2 ou T1
 */
class ChoixBase
{
    protected $ui;
    function __construct($choixUI) {
        //var_dump($choixUI);
        $this->ui = $choixUI;
        //var_dump($this->ui);
    }
    
    function libelle() { return $this->ui == 'LR' ? 'Languedoc-Roussillon' : 'Midi-Pyrénées';  }
    function code() { return $this->ui == 'LR'? 'K2' : 'T1';  }
    function classCSSLien($ilot) { return $ilot == $this->ui ?  'actif' : ''; }
    
    public function getData() {
        $data = array();
        $data['codeBase'] = $this->code();
        $data['libelleBase'] = $this->libelle();
        $data['classCSSLienLR'] = $this->classCSSLien('LR');
        $data['classCSSLienMP'] = $this->classCSSLien('MP');
        return $data;
    }

}