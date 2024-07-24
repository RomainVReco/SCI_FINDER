<?php

use App\Entity\Sci;

use Symfony\Component\HttpFoundation\Request;


require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'config.php'); 
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . 'Sci.php'); 
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$path = 'C:\Users\rvorlet\Documents\Git';
$dir = scandir($path);
print_r($dir);
// $file = DIR_JSON;

// $data = file_get_contents($file);
// $obj = json_decode($data);

// Mettre la condition  pour vérifier la forme juridique
// print_r(count($obj));

// print_r(count($obj));

// for ($i = 0; $i<count($obj); $i++) {
// for ($i = 0; $i<3; $i++) {
//     if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique))
//         {
//             if (strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"Société civile immobilière") || 
//             strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"6540"))
//             {
//                 $sci = new Sci();
//                 $sci->setIdSCI($obj[$i]->id);
//                 $sci->setSiren($obj[$i]->formality->siren);
//                 // $sci->setDateCreation(new DateTime($obj[$i]->formality->content->natureCreation->dateCreation));
//                 // $sci->setEtablieEnFrance($obj[$i]->formality->content->natureCreation->etablieEnFrance);
//                 // $sci->setSalarieEnFrance($obj[$i]->formality->content->natureCreation->salarieEnFrance);
//                 // $sci->setFormeJuridique($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique);
//                 // $sci->setDenomination($obj[$i]->formality->content->personneMorale->identite->entreprise->denomination);
//                 // $sci->setDateImmat(new DateTime($obj[$i]->formality->content->personneMorale->identite->entreprise->dateImmat));
//                 // $sci->setMontantCapital($obj[$i]->formality->content->personneMorale->identite->description->montantCapital);
//                 // $sci->setDeviseCapital($obj[$i]->formality->content->personneMorale->identite->description->deviseCapital);
            
//                 // if (!empty($obj[$i]->formality->content->personneMorale->identite->description->objet)) {
//                 //     $sci->setDescription($obj[$i]->formality->content->personneMorale->identite->description->objet);
//                 // }
            
//                 // if (!empty($obj[$i]->formality->content->personneMorale->etablissementPrincipal)){
//                 //     $sci->setDateEffetFermeture(new DateTime($obj[$i]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture));
//                 // } 
//                 // if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe)){
//                 //     $sci->setCodeApe($obj[$i]->formality->content->personneMorale->identite->entreprise->codeApe);
//                 // }
//                 $sci->setPositionInJson($i);
//                 $sci->setFileName('madeup.json');
//                 print_r($sci);
//                 $request = Request::create(
//                     '/api/sci', 
//                     'POST',
//                     [],
//                     [],
//                     [],
//                     [], 
//                 $sci);       
//             } else echo "noway";
//     } else echo "another way ";
// }
//     // echo $obj[$i]->id;
//     // echo $obj[$i]->formality->siren;