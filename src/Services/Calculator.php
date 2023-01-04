<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class Calculator
{
    protected $logger;
    protected $tva;

    public function __construct(LoggerInterface $logger, float $tva)
    {
        $this->logger = $logger;
        $this->tva = $tva;
    }

    public function calcul(float $prix): float
    {
        $this->logger->info("Un calcul à eu lieu : $prix");
        return $prix * (20 / 100);
    }
}
