<?php

namespace App\Controller;

use App\Repository\SciRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SciController extends AbstractController
{
    #[Route('/api/0.1/sci', name:'sci', methods:['GET'])]
    public function getAllSCI(SciRepository $sciRepo, SerializerInterface $serializer): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SciController.php',
        ]);
    }
}
