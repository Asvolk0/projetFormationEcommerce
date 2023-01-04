<?php

namespace App\Controller;

use App\Services\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    protected $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    #[Route('/test1', name: 'home', methods: ['GET', 'POST'])]
    public function index()
    {
        $tva = $this->calculator->calcul(200);

        return new Response("test de la $tva");
    }

    #[Route('/test/{age<\d+>?0}', name: 'test', methods: ['GET', 'POST'])]
    public function test(Request $request, $age)
    {
        dump($request);

        return new Response("Vous avez $age ans");
    }
}
