<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserCompteController extends AbstractController
{
    #[Route('/user/compte', name: 'app_user_compte')]
    public function index(): Response
    {
        
        return $this->render('user_compte/index.html.twig', [
            'controller_name' => 'UserCompteController',
        ]);
    }
}
