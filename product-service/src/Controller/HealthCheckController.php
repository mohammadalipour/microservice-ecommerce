<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/api/health-check', methods: ['POST'])]
    public function index(): JsonResponse
    {
        try {
            return $this->json(['success' => true]);
        } catch (Exception $exception) {
            return new JsonResponse(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
}