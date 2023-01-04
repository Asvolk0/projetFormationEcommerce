<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{name?World}', name: 'hello', methods: ["GET"], requirements: ["name" => "[a-zA-Z]+"])]
    public function index($name): Response
    {
        return $this->render('hello.html.twig', [
            'name' => $name
        ]);
    }

    #[Route('/ex', name: 'exemple')]
    public function exemple(): Response
    {
        return $this->render('exemple.html.twig', [
            'age' => 33
        ]);
    }
}
