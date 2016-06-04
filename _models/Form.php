<?php
namespace RefGPC\_models;
use \RefGPC\_systemClass\RefGPC;

class Form
{
    private $data;
    private $nbIlot;

    
    public function __construc($data = array())
    {
        $this->data = $data;
    }
    public function input($name)
    {

        $nbIlot = RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');
        echo '<input type="text" name="' . $name . '" placeholder="' . $nbIlot . '"></input>';

    }

    public function select($name, $codeBase)
    {

        $varReturn = '<select id="' . $name . '" name="' . $name . '">';
        $varReturn .= '<option value="***" selected="selected">Tous</option>';

        switch ($name) {

            case 'ilotList':
                $sql = "SELECT DISTINCT `iloCodeIlot`, `iloLibelleIlot` FROM `TM_Ilots` WHERE `iloCodeBase` = '" . $codeBase . "' ORDER BY `iloCodeIlot` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option>' . $row['iloCodeIlot'] . ' - ' . $row['iloLibelleIlot'] . '</option>';
                }
                break;

            case 'typeIlot':
                $sql = "SELECT DISTINCT `tiIdTypeIot` FROM `TM_Ilots` WHERE `iloCodeBase` = '" . $codeBase . "' ORDER BY `tiIdTypeIot` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option>' . $row['tiIdTypeIot'] . ' </option>';
                }
                break;

            case 'used':
                $sql = "SELECT `used` FROM `t_used` ORDER BY `used` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option>' . $row['used'] . ' </option>';
                }
                break;

            case 'competence':
                $sql = "SELECT DISTINCT t_competences.coIdCompetence FROM `TM_Ilots` LEFT JOIN t_competences ON t_competences.coIdCompetence = tm_ilots.coIdCompetence WHERE coCodeBase = '" . $codeBase . "' ORDER BY `coIdCompetence` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option value="' . addslashes($row['coIdCompetence']) . '">' . addslashes($row['coIdCompetence']) . ' </option>';
                }
                break;

            case 'serviceCible':
                $sql = "SELECT DISTINCT t_servicedemandeur.sedIdServDem FROM `TM_Ilots` LEFT JOIN t_servicedemandeur ON t_servicedemandeur.sedIdServDem = tm_ilots.sedIdServDem WHERE sedCodeBase = '" . $codeBase . "' ORDER BY `sedIdServDem` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option value="' . $row['sedIdServDem'] . '">' . $row['sedIdServDem'] . ' </option>';
                }
                break;

            case 'entreprise':
                $sql = "SELECT DISTINCT t_entreprise.enIdEntreprise, t_entreprise.enLibelleEntreprise FROM `TM_Ilots` LEFT JOIN t_entreprise ON t_entreprise.enIdEntreprise = tm_ilots.enIdEntreprise WHERE enCodeBase = '" . $codeBase . "' ORDER BY `enIdEntreprise` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option value="' . $row['enIdEntreprise'] . '">' . $row['enLibelleEntreprise'] . ' ( ' . $row['enIdEntreprise'] . ')</option>';
                }
                break;

            case 'siteGeo':
                $sql = "SELECT DISTINCT t_sites.siIdSite, t_sites.siLibelleSite FROM `TM_Ilots` LEFT JOIN t_sites ON t_sites.siIdSite = tm_ilots.siIdSite WHERE siCodeBase = '" . $codeBase . "' ORDER BY `siLibelleSite` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option value="' . $row['siIdSite'] . '">' . $row['siLibelleSite'] . '</option>';
                }
                break;

            case 'domaineAct':
                $sql = "SELECT DISTINCT t_domaineactivite.dacIdDomAct, t_domaineactivite.daLibelleDomAct FROM `TM_Ilots` LEFT JOIN t_domaineactivite ON t_domaineactivite.dacIdDomAct = tm_ilots.dacIdDomAct WHERE daCodeBase = '" . $codeBase . "' ORDER BY `daLibelleDomAct` ";
                $rep = RefGPC::getDB()->queryAll($sql);
                foreach ($rep as $row) {
                    $varReturn .= '<option value="' . $row['dacIdDomAct'] . '">' . $row['dacIdDomAct'] . ' - ' . $row['daLibelleDomAct'] . ' </option>';
                }
                break;

             default : ;
        }

        $varReturn .= '</select>';

        return $varReturn;
    }

}

