<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]

    public function index(): Response
    {
        //dd($this->getUser()->getRoles());
        if ($this->getUser()) {
            foreach ($this->getUser()->getRoles() as $role) {
                $role = $role;
            }

            switch ($role) {
                case 'ROLE_RECRUTEUR':
                    $roleUser = 'Recruteur';
                    break;
                case 'ROLE_CANDIDAT':
                    $roleUser = 'Candidat';
                    break;
                case 'ROLE_PARTENAIRE':
                    $roleUser = 'Candidat';
                    break;
                case 'ROLE_PARTENAIRE':
                    $roleUser = 'Candidat';
                    break;
                case 'ROLE_ADMIN':
                    $roleUser = 'admin';
                    break;

                default:

                    break;
            }

            return $this->render('accueil/index.html.twig', [
                'role' => $roleUser,
            ]);
        } else {
            return $this->render('accueil/index.html.twig', []);
        }
    }
}
