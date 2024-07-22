<?php

use App\Entity\Sci;

use Doctrine\DBAL\Types\DateTimeTzType;
use Symfony\Component\HttpFoundation\Request;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'config.php'); 
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . 'Sci.php'); 

$file = DIR_JSON . "\stock_000001_formalite.json";
$data = file_get_contents($file);
$obj = json_decode($data);

// Mettre la condition  pour vérifier la forme juridique

for ($i = 0; $i<count($obj); $i++) {
// for ($i = 0; $i<3; $i++) {
    if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique))
        {
            if (strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"Société civile immobilière") || 
            strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"6540"))
            {
                $sci = new Sci();
                $sci->setIdSCI($obj[$i]->id);
                $sci->setSiren($obj[$i]->formality->siren);
                $sci->setDateCreation(new DateTime($obj[$i]->formality->content->natureCreation->dateCreation));
                // $sci->setEtablieEnFrance($obj[$i]->formality->content->natureCreation->etablieEnFrance);
                // $sci->setSalarieEnFrance($obj[$i]->formality->content->natureCreation->salarieEnFrance);
                // $sci->setFormeJuridique($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique);
                // $sci->setDenomination($obj[$i]->formality->content->personneMorale->identite->entreprise->denomination);
                // $sci->setDateImmat(new DateTime($obj[$i]->formality->content->personneMorale->identite->entreprise->dateImmat));
                // $sci->setMontantCapital($obj[$i]->formality->content->personneMorale->identite->description->montantCapital);
                // $sci->setDeviseCapital($obj[$i]->formality->content->personneMorale->identite->description->deviseCapital);
            
                // if (!empty($obj[$i]->formality->content->personneMorale->identite->description->objet)) {
                //     $sci->setDescription($obj[$i]->formality->content->personneMorale->identite->description->objet);
                // }
            
                // if (!empty($obj[$i]->formality->content->personneMorale->etablissementPrincipal)){
                //     $sci->setDateEffetFermeture(new DateTime($obj[$i]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture));
                // } 
                // if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe)){
                //     $sci->setCodeApe($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe);
                // }
                $sci->setPositionInJson($i);
                $sci->setFileName('madeup.json');
                $arraySCI = (array) $sci;
                // $request = Request::create(
                //     '/api/sci',
                //     'POST',
                //     $arraySCI
                // );
                print_r($arraySCI);
            } else echo "noway";
    } else echo "another way ";
}
    // echo $obj[$i]->id;
    // echo $obj[$i]->formality->siren;