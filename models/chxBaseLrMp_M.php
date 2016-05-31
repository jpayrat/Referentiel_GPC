<?php

function libelleBase($ui) {

    if($ui == 'LR'){
        $libelleBase = 'Languedoc-Roussillon';
    }
    else {
        $libelleBase = 'Midi-Pyrénées';
    }

    return $libelleBase;
}

function classCSSLien($bool){
    return $bool ?  'actif' : '';
}