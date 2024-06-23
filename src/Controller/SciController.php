<?php

namespace App\Controller;

use App\Repository\SciRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SciController extends AbstractController
{
    #[Route('/api/sci', name:'sci', methods:['GET'])]
    public function getAllSCI(SciRepository $sciRepo, SerializerInterface $serializer): JsonResponse
    {
        $sciList = $sciRepo->findAll();

        $jsonSciList = $serializer->serialize($sciList, 'json');
        return new JsonResponse($jsonSciList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/sci/{id}', name:'sci', methods:['GET'])]
    public function getSingleSCI(int $id, SciRepository $sciRepo, SerializerInterface $serializer): JsonResponse
    {
        $sci = $sciRepo->find($id);
        if ($sci) {
            $jsonSCI = $serializer->serialize($sci, 'json',);
            return new JsonResponse($jsonSCI, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('api/sci/partial/{id}', name:'sci', methods:['GET'])]
    public function getSciFromPartialId(int $id, SciRepository $sciRepo, SerializerInterface $serializer): JsonResponse
    {
        $sci = $sciRepo->findByPartialId($id);
        if ($sci) {
            $jsonSCI = $serializer->serialize($sci, 'json');
            return new JsonResponse($jsonSCI, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    
}
