<?php

namespace RefGPC\_models;

class chxBaseLrMp{

    public function libelleBase($ui){

        if($ui == 'LR'){
            $libelleBase = 'Languedoc-Roussillon';
        }
        else {
            $libelleBase = 'Midi-Pyrénées';
        }

        return $libelleBase;
    }

    public function codeBase($ui) {
        
        if($ui == 'LR'){
            $codeBase = 'K2';
        }
        else {
            $codeBase = 'T1';
        }

        return $codeBase;
    }

    public function classCSSLien($bool) {

        return $bool ?  'actif' : '';
    }

}

