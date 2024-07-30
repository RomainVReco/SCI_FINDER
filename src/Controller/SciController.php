<?php

namespace App\Controller;

use App\Repository\SciRepository;
use App\Entity\Sci;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SciController extends AbstractController
{

    public function __construct(private SciRepository $sciRepo, private SerializerInterface $serializer) 
    {
    }

    #[Route('/api/sci/script/', name:'scriptSci', methods:['GET'])]
    public function saveScriptSci(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
    
        $path = 'D:\Stockage\stock RNE formalité\\';
        $dir = scandir($path);
        print_r($dir);
        $setSci = new \Ds\Set();
        $arraySci = [];
        $totalScan = 0;
        $totalSci = 0;

    // Mettre la condition  pour vérifier la forme juridique
    // for ($i = 0; $i<count($obj); $i++) {
        for ($i = 2; $i<4; $i++) {
            $fileName = $dir[$i];
            $file = $path . $fileName;
            print_r($file);
            $data = file_get_contents($file);
            $obj = json_decode($data);
            echo(" \n");
            print_r("Nom fichier : " . $fileName);
            echo(" \n");
            print_r("Nombre objets du fichier : " . count($obj));
            echo(" \n");
            
            for ($j = 0 ; $j<3; $j++) {
                $totalScan++;
            if (isset($obj[$j]->formality->content->natureCreation->formeJuridique))
                {
                    $formeJuridique = $obj[$j]->formality->content->natureCreation->formeJuridique;
                    if ($formeJuridique === "6540" || $formeJuridique === "Société civile immobilière")
                    {
                        $sci = new Sci();
                        $sci->setIdSCI($obj[$j]->id);
                        $sci->setSiren($obj[$j]->formality->siren);
                        if (isset($obj[$j]->formality->content->natureCreation->dateCreation)) $sci->setDateCreation(new DateTime($obj[$j]->formality->content->natureCreation->dateCreation));
                        if (isset($obj[$j]->formality->content->natureCreation->etablieEnFrance)) $sci->setEtablieEnFrance($obj[$j]->formality->content->natureCreation->etablieEnFrance);
                        if (isset($obj[$j]->formality->content->natureCreation->salarieEnFrance)) $sci->setSalarieEnFrance($obj[$j]->formality->content->natureCreation->salarieEnFrance);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique)) $sci->setFormeJuridique($obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->denomination)) $sci->setDenomination($obj[$j]->formality->content->personneMorale->identite->entreprise->denomination);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->dateImmat)) $sci->setDateImmat(new DateTime($obj[$j]->formality->content->personneMorale->identite->entreprise->dateImmat));
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->montantCapital)) $sci->setMontantCapital($obj[$j]->formality->content->personneMorale->identite->description->montantCapital);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->deviseCapital)) $sci->setDeviseCapital($obj[$j]->formality->content->personneMorale->identite->description->deviseCapital);
                        
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->objet)) $sci->setDescription($obj[$j]->formality->content->personneMorale->identite->description->objet);
                        if (isset($obj[$j]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture)) $sci->setDateEffetFermeture(new DateTime($obj[$j]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture));
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->codeApe)) $sci->setCodeApe($obj[$j]->formality->content->personneMorale->identite->entreprise->codeApe);
                        
                        $sci->setPositionInJson($j);
                        $sci->setFileName($fileName);
                        $setSci->add($sci);
                        array_push($arraySci, $sci);
                        $totalSci++;
        
                    }
            } 
            if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique)) {
                $formeJuridique = $obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique;
                if (in_array($formeJuridique,["Société civile immobilière","6540"], true)) {
                        $sci = new Sci();
                        $sci->setIdSCI($obj[$j]->id);
                        $sci->setSiren($obj[$j]->formality->siren);
        
                        if (isset($obj[$j]->formality->content->natureCreation->dateCreation)) $sci->setDateCreation(new DateTime($obj[$j]->formality->content->natureCreation->dateCreation));
                        if (isset($obj[$j]->formality->content->natureCreation->etablieEnFrance)) $sci->setEtablieEnFrance($obj[$j]->formality->content->natureCreation->etablieEnFrance);
                        if (isset($obj[$j]->formality->content->natureCreation->salarieEnFrance)) $sci->setSalarieEnFrance($obj[$j]->formality->content->natureCreation->salarieEnFrance);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique)) $sci->setFormeJuridique($obj[$j]->formality->content->personneMorale->identite->entreprise->formeJuridique);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->denomination)) $sci->setDenomination($obj[$j]->formality->content->personneMorale->identite->entreprise->denomination);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->dateImmat)) $sci->setDateImmat(new DateTime($obj[$j]->formality->content->personneMorale->identite->entreprise->dateImmat));
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->montantCapital)) $sci->setMontantCapital($obj[$j]->formality->content->personneMorale->identite->description->montantCapital);
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->deviseCapital)) $sci->setDeviseCapital($obj[$j]->formality->content->personneMorale->identite->description->deviseCapital);
                        
                        if (isset($obj[$j]->formality->content->personneMorale->identite->description->objet)) $sci->setDescription($obj[$j]->formality->content->personneMorale->identite->description->objet);
                        if (isset($obj[$j]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture)) $sci->setDateEffetFermeture(new DateTime($obj[$j]->formality->content->personneMorale->etablissementPrincipal->descriptionEtablissement->dateEffetFermeture));
                        if (isset($obj[$j]->formality->content->personneMorale->identite->entreprise->codeApe)) $sci->setCodeApe($obj[$j]->formality->content->personneMorale->identite->entreprise->codeApe);
                        
                        $sci->setPositionInJson($j);
                        $sci->setFileName($fileName);
                        $setSci->add($sci);
                        array_push($arraySci, $sci);
                        $totalSci++;
                    }
            }
            $em->persist($sci);
        }
    }
        $unitOfWorks=$em->getUnitOfWork();
        $insertions = $unitOfWorks->getScheduledEntityInsertions();
        $em->flush();
        $data = [
            'success' => 'ok', 
            'insertions' => count($insertions)
            ];
        return new JsonResponse($data, Response::HTTP_CREATED, [], false);

    } 

    #[Route('/api/sci', name:'AllSCI', methods:['GET'])]
    public function getAllSCI(): JsonResponse
    {
        $sciList = $this->sciRepo->findAll();
        $jsonSciList = $this->serializer->serialize($sciList, 'json');
        return new JsonResponse($jsonSciList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/sci/{id}', name:'singleSCI', methods:['GET'])]
    public function getSingleSCI(int $id): JsonResponse
    {
        $sci = $this->sciRepo->find($id);
        if ($sci) {
            $jsonSCI = $this->serializer->serialize($sci, 'json',);
            return new JsonResponse($jsonSCI, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/sci/partial/{id}', name:'partialSCI', methods:['GET'])]
    public function getSciFromPartialId(int $id): JsonResponse
    {
        $sci = $this->sciRepo->findByPartialId($id);
        if ($sci) {
            $jsonSCI = $this->serializer->serialize($sci, 'json');
            return new JsonResponse($jsonSCI, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/sci', name:'createSCI', methods:['POST'])]
    public function createSCI (Request $request, EntityManagerInterface $em, 
    UrlGeneratorInterface $urlGenerator): JsonResponse
     {
        // var_dump($request);  
        $sci = $this->serializer->deserialize($request->getContent(), Sci::class, 'json');
        $em->persist($sci);
        $em->flush();

        $jsonSCI = $this->serializer->serialize($sci, 'json');
        $location = $urlGenerator->generate('singleSCI', ['id' => $sci->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

        return new JsonResponse($jsonSCI, Response::HTTP_CREATED, ["Location" => $location], true);
     }

    #[Route('/api/sci/{id}', name:'deleteSci', methods:['DELETE'])]
    public function deleteSci(int $id, EntityManagerInterface $em): JsonResponse{
        $sci = $this->sciRepo->find($id);
        if ($sci) {
            $em->remove($sci);
            $em->flush();
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

   

}