<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route('/{age<\d+>?0}', name: 'test', methods: ['GET', 'POST'])]
    public function index(Request $request, $age)
    {
        dump($request);

        return new Response("Vous avez $age ans");
    }

    #[Route('/test/{age<\d+>?0}', name: 'test', methods: ['GET', 'POST'])]
    public function test(Request $request, $age)
    {
        dump($request);

        return new Response("Vous avez $age ans");
    }
}
