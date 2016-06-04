<?php
namespace RefGPC\_controleurs;
use \RefGPC\_models\chxBaseLrMp;
use \RefGPC\_models\menuLateral;
use \RefGPC\_models\Form;
use \RefGPC\_systemClass\RefGPC;
use \RefGPC\_systemClass\controleurCallView;

class ilotControleur extends controleurCallView
{

    public function affIndex($ui) {

        $variables = array();

        $variable['lienHorizLR'] = WEBPATH.'LR/ilot';
        $variable['lienHorizMP'] = WEBPATH.'MP/ilot';

        // Gestion du choix de la base LR / MP
        //require($dirModels.'chxBaseLrMp_M.php');
        $chxBaseLrMp_M = new chxBaseLrMp();

        $variable['classCSSLienMP'] = $chxBaseLrMp_M->classCSSLien($ui == 'MP');
        $variable['classCSSLienLR'] = $chxBaseLrMp_M->classCSSLien($ui == 'LR');
        $variable['libelleBase'] = $chxBaseLrMp_M->libelleBase($ui);
        $variable['codeBase'] = $chxBaseLrMp_M->codeBase($ui);


        // Gestion du menu latéral
        // Principe général : Le menu dans lequel ont est doit être surligné

            $menuLateral_M = new menuLateral();
            $variable['classLienMenuLateralIlot'] = $menuLateral_M->classCSSMenuLateralActifIlot('ilot');
            $variable['classLienMenuLateralCentre'] = $menuLateral_M->classCSSMenuLateralActifCentre('ilot');

        //Affichage du formulaire
            $form_M = new Form();

            $variable['selectIlotList'] = $form_M->select('ilotList', $variable['codeBase']);
            $variable['selectTypeIlot'] = $form_M->select('typeIlot', $variable['codeBase']);
            $variable['selectUsed'] = $form_M->select('used', $variable['codeBase']);
            $variable['selectCompetence'] = $form_M->select('competence', $variable['codeBase']);
            $variable['selectServiceCible'] = $form_M->select('serviceCible', $variable['codeBase']);
            $variable['selectEntreprise'] = $form_M->select('entreprise', $variable['codeBase']);
            $variable['selectSiteGeo'] = $form_M->select('siteGeo', $variable['codeBase']);
            $variable['selectDomaineAct'] = $form_M->select('domaineAct', $variable['codeBase']);


        $nbIlot = RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');

        //$input = createInput('rechercheGenPPros', 'text', 'rechercheGenPpros', 'Date, joueur, évenement etc...');
        //$nbPartiePros = calculNbPProsGlobal();


        // Envoi à la vue

        $this->render('affIndex', $variable);
        //require($dirVues.'defaut.php');



    }


}