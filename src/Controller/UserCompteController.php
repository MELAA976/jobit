<?php
namespace App\Controller;
use App\Security\Voter\AccesUserVoter;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user/compte/{id}')]
#[IsGranted(AccesUserVoter::VIEW, subject: 'id')]
final class UserCompteController extends AbstractController
{
    #[Route(name: 'app_user_compte')]
    
    public function index(int $id): Response
    {
        $user = $this->getUser();
        //dd($id);

        //info sur l'utilisateur

        return $this->render('user_compte/indexuser.html.twig', [
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
