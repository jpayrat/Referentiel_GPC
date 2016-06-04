<?php
namespace RefGPC\_controleurs;

class ilotControleur
{

    public function index() {
        echo 'index '.'<br/>';
        $mo = new model();
        $d = array();
        $d['tuto'] = array(
            'titre' => 'Salut',
            'description' => 'Exemple de description',
        );

        var_dump($d);
        echo 'plop';
        //$this->render('index');
    }


}