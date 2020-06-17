<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function add(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        $status = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $client = HttpClient::create();
            $response = $client->request('POST', 'http://dggrow.test/api/store');
            $status = json_decode($response->getContent(), true);
            unset($product);
            unset($form);
            $product = new Product();
            $form = $this->createForm( ProductType::class, $product);
        }

        return $this->render('product/new.html.twig', [
            'controller_name' => 'ProductController',
            'page_name' => 'Add product',
            'user' => ['name' => 'John', 'surname' => 'Smith'],
            'status' => $status,
            'form' => $form->createView()
        ]);
    }
}
