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

    private SciRepository $sciRepo;
    private SerializerInterface $serializer;

    public function __construct(SciRepository $sciRepo, SerializerInterface $serializer) 
    {
        $this->sciRepo = $sciRepo;
        $this->serializer = $serializer;
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

    #[Route('api/sci/partial/{id}', name:'partialSCI', methods:['GET'])]
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
    UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator): JsonResponse
     {
        // var_dump($request);  
        $sci = $this->serializer->deserialize($request->getContent(), Sci::class, 'json');
        $em->persist($sci);
        $em->flush();

        $jsonSCI = $this->serializer->serialize($sci, 'json');
        $location = $urlGenerator->generate('singleSCI', ['id' => $sci->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

        return new JsonResponse($jsonSCI, Response::HTTP_CREATED, ["Location" => $location], true);
     }

    #[Route('api/sci/{id}', name:'deleteSci', methods:['DELETE'])]
    public function deleteSci(int $id, EntityManagerInterface $em): JsonResponse{
        $sci = $this->sciRepo->find($id);
        if ($sci) {
            $em->remove($sci);
            $em->flush();
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('api/sci/{passwor}', name:'updateSci', methods:['PUT'])]
    public function saveScriptSci(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse{
    $file = DIR_JSON_PART;
    $data = file_get_contents($file);
    $obj = json_decode($data);

    // Mettre la condition  pour vérifier la forme juridique
    print_r(count($obj));
    // for ($i = 0; $i<count($obj); $i++) {
    for ($i = 0; $i<3; $i++) {
        if (!empty($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique))
            {
                if (strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"Société civile immobilière") || 
                strcmp($obj[$i]->formality->content->personneMorale->identite->entreprise->formeJuridique,"6540"))
                {
                    $sci = new Sci();
                    $sci->setIdSCI($obj[$i]->id);
                    $sci->setSiren($obj[$i]->formality->siren);
                    $sci->setPositionInJson($i+1);
                    $sci->setFileName('madeup.json');
                    print_r($sci);
                    $em->persist($sci);
                    $em->flush();

                    $jsonSCI = $this->serializer->serialize($sci, 'json');
                    $location = $urlGenerator->generate('singleSCI', ['id' => $sci->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

                    return new JsonResponse($jsonSCI, Response::HTTP_CREATED, ["Location" => $location], true);
                } else echo "noway";
        } else echo "another way ";
    }
        }
}
