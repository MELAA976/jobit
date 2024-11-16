<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/partials')]
class PartialsController extends AbstractController
{
    #[Route(name: 'app_partials_header')]
    public function header(): Response
    {
        dd($this->getUser());
        return $this->render('partials/header.html.twig', [
            'controller_name' => 'PartialsController',
        ]);
    }


    #[Route(name: 'app_partials_header')]
    public function  footer(): Response
    {
        return $this->render('partials/header.html.twig', [
            'controller_name' => 'PartialsController',
        ]);
    }
}
