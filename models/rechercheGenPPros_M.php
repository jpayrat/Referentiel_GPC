<?php

function createInput($class, $type, $name, $placeholder)
{

    $input = '<input class="'.$class.'" type="'.$type.'"" name="'.$name.'"" placeholder="'.$placeholder.'"">';

    return $input;

}


function calculNbPProsGlobal()
{

    $sql3 = "SELECT COUNT(id) AS nb_parties FROM `".$table_pro."`";
    $reponse3 = mysql_query($sql3) or die ('Erreur 02: '.mysql_error() );
    $resultat3 = mysql_fetch_array($reponse3);
    $nb_parties_pros = $resultat3['nb_parties'];

    return $nb_parties_pros;

}