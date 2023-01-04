<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Detector extends AbstractController
{

    protected $seiltva;

    public function __construct($seiltva)
    {
        $this->seiltva = $seiltva;
    }

    public function detect(float $prix): bool
    {
        if ($prix > $this->seiltva) {
            return true;
        } else {
            return false;
        }
    }
}
