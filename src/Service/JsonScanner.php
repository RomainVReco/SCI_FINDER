<?php

use App\Controller\SciController;
use App\Entity\Sci;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'config.php'); 

$file = DIR_JSON . "\madeup.json";
$data = file_get_contents($file);
$obj = json_decode($data);

echo count($obj);

$manager = new ObjectManager();
$sciController = new SciController($sciRepo, $serializer);

// for ($i = 0; $i<count($obj); $i++) {
for ($i = 0; $i<3; $i++) {
    $sci = new Sci;
    $sci->setIdSCI($obj[$i]->id);
    $sci->setSiren($obj[$i]->formality->siren);
    $sci->setDateCreation($obj[$i]->formality->content->natureCreation->dateCreation);
    $sci->setEtablieEnFrance($obj[$i]->formality->content->natureCreation->etablieEnFrance);
    $sci->setSalarieEnFrance($obj[$i]->formality->content->natureCreation->salarieEnFrance);
    $sci->setFormeJuridique($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique);
    $sci->setDenomination($obj[$i]->formality->content->personneMorale->identite->entreprise->denomination);
    $sci->setDateImmat($obj[$i]->formality->content->personneMorale->identite->entreprise->dateImmat);
    $sci->setMontantCapital($obj[$i]->formality->content->personneMorale->identite->description->montantCapital);
    $sci->setDeviseCapital($obj[$i]->formality->content->personneMorale->identite->description->montantCapital);

    if (!is_null($obj[$i]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture)){
        $sci->setDateEffetFermeture($obj[$i]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture);
    } 
    if (!is_null($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe)){
        $sci->setCodeApe($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe);
    }
    $sci->setPositionInJson($i);
    $sci->setFileName('madeup.json');
    $request = Request::create(
        ''
    );
    $request->setBody

    // $manager->persist($sci);
    
}
$manager->flush();

    // echo $obj[$i]->id;
    // echo $obj[$i]->formality->siren;