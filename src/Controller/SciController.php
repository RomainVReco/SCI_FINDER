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

    #[Route('/api/sci/script/{password}', name:'scriptSci', methods:['GET'])]
    public function saveScriptSci(string $password, Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
    
    $file = DIR_JSON;
    $data = file_get_contents($file);
    $obj = json_decode($data);

    // Mettre la condition  pour vérifier la forme juridique
    // for ($i = 0; $i<count($obj); $i++) {
    if ($password == "Jambon") 
    {
        for ($i = 0; $i<3; $i++) 
        {
            if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique))
                {
                    if (strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"Société civile immobilière") || 
                    strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"6540"))
                    {
                        $sci = new Sci();
                        $sci->setIdSCI($obj[$i]->id);
                        $sci->setSiren($obj[$i]->formality->siren);
                        $sci->setPositionInJson($i+1);
                        $sci->setFormeJuridique('Société civile immobilière');
                        $sci->setFileName('madeup.json');
                        $em->persist($sci);   
                    } 
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

    } else {
        return new JsonResponse(null, Response::HTTP_FORBIDDEN);
    }
    return null;
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