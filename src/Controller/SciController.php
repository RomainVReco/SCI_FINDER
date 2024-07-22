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
        $sci = $this->serializer->deserialize($request->getContent(), Sci::class, 'json');
        $em->persist($sci);
        $em->flush();

        $jsonSCI = $this->serializer->serialize($sci, 'json');
        $location = $urlGenerator->generate('singleSCI', ['id' => $sci->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

        return new JsonResponse($jsonSCI, Response::HTTP_CREATED, ["Location" => $location], true);
     }
}
