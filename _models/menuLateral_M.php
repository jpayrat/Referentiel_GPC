<?php

function classCSSMenuLateralActif($menu){

    global $classLienMenuLateralIlot;
    global $classLienMenuLateralCentre;
    global $classLienMenuLateralTech;

    if($menu === 'ilot'){
        $classLienMenuLateralIlot = 'actif';
        $classLienMenuLateralCentre = '';
        $classLienMenuLateralTech = '';
    }
    elseif($menu === 'centre'){
        $classLienMenuLateralIlot = '';
        $classLienMenuLateralCentre = 'actif';
        $classLienMenuLateralTech = '';
    }
    else{
        $classLienMenuLateralIlot = '';
        $classLienMenuLateralCentre = '';
        $classLienMenuLateralTech = 'actif';
    }

}