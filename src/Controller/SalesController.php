<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class SalesController extends AbstractController
{
    /**
     * @Route("/sales", name="sales")
     */
    public function index()
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'http://dggrow.test/api');
        $content = json_decode($response->getContent(), true);

        return $this->render('sales/list.html.twig', [
            'controller_name' => 'SalesController',
            'page_name' => 'Sales',
            'user' => ['name' => 'John', 'surname' => 'Smith'],
            'tableData' => $content,
        ]);
    }
}
