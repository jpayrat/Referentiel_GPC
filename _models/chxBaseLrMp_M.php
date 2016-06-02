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

function codeBase($ui) {

    if($ui == 'LR'){
        $codeBase = 'K2';
    }
    else {
        $codeBase = 'T1';
    }

    return $codeBase;
}


function classCSSLien($bool){
    return $bool ?  'actif' : '';
}

