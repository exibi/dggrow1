<?php

namespace App\Controller;

use App\Services\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return JsonResponse::fromJsonString($this->apiService->getData());
    }

    /**
     * @Route("/api/store", name="api_store")
     */
    public function store()
    {
        return JsonResponse::fromJsonString('{"status": "ok"}');
    }
}
