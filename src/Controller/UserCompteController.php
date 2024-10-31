<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/user/compte')]
final class UserCompteController extends AbstractController
{
    #[Route(name: 'app_user_compte')]
    public function index(): Response
    {
        $user = $this->getUser();
        
        //info sur l'utilisateur
    
        return $this->render('user_compte/indexUser.html.twig', [
            'user' => $user,
        ]);
    }


    #[Route('/infouser', name: 'app_user_compte_info')]
    public function infUser(): Response
    {
        $user = $this->getUser();
        
        //info sur l'utilisateur
    
        return $this->render('user_compte/infouser.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/offrepst', name: 'app_user_compte_offrepst')]
    public function infUserOffre(): Response
    {
        $user = $this->getUser();
        
        //info sur l'utilisateur
    
        return $this->render('user_compte/offrepst.html.twig', [
            'user' => $user,
        ]);
    }
}
