<?php

namespace App\Controller;

use App\Entity\OffreUser;
use App\Repository\OffreUserRepository;
use App\Repository\PublicaOffreRepository;
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
        //$user = $this->getUser();
        //dd($id);

        //info sur l'utilisateur

        return $this->render('user_compte/indexuser.html.twig', [
            /*'user' => $user,*/]);
    }


    #[Route('/infouser', name: 'app_user_compte_info')]
    public function infUser(int $id): Response
    {
        $user = $this->getUser();

        //info sur l'utilisateur

        return $this->render('user_compte/infouser.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/offrepst', name: 'app_user_compte_offrepst')]
    public function infUserOffre(OffreUserRepository $offreUserRepository, int $id): Response
    {

        //dd($offreUserRepository->findAll());

        $offreUserCandidat =  $offreUserRepository->findBy(
            ['user' => $id]
        );
        //dd($offreUserCandidat);



        //info sur l'utilisateur

        return $this->render('user_compte/offrepst.html.twig', [
            'offreUserCandidat' => $offreUserCandidat,
        ]);
    }

    #[Route('/offrepublie', name: 'app_user_compte_offrepublie')]
    public function infoUserOffrePubli(int $id, PublicaOffreRepository $publicaOffre): Response
    {

        $user = $this->getUser();
        $offreUserCree =  $publicaOffre->findBy(
            ['User' => $id]
        );
        //dd($offreUserCree);

        //info sur l'utilisateur

        return $this->render('user_compte/offrepublie.html.twig', [
            'offrePublier' => $offreUserCree,
        ]);
    }
}
