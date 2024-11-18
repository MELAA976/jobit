<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $dataForm = $form->getData();
            //dd($dataForm);
            $roles = $dataForm->getRoles();

            foreach ($roles as $role) {
                $role = $role;
            }

            switch ($role) {

                case "ROLE_CANDIDAT":
                    $photoUser = $form['photo']->getData(); //selection de la photo
                    $fileName = uniqid() . '.' . $photoUser->guessExtension(); // creation du nom du fichier
                    $dataForm->setPhoto($fileName); //affectation du nom au fichier
                    $photoUser->move($this->getParameter('photo_profiles'), $fileName); //deplacement du fichier dans son dossier
                    $user->setToken(null); // rentre null les cases du formulaire non utilisé
                    $user->setLogo(null);
                    $user->setSiteWeb(null);
                    $user->setEntreprise(null);
                    //dd($user);
                    break;

                case "ROLE_RECRUTEUR":
                    //$user->setRoles(array('ROLE_RECRUTEUR'));
                    $photoUser = $form['photo']->getData();
                    $fileName = uniqid() . '.' . $photoUser->guessExtension();
                    $dataForm->setPhoto($fileName);
                    $photoUser->move($this->getParameter('photo_profiles'), $fileName);
                    $user->setToken(null); // rendre null les cases du formulaire non utilisé
                    $user->setLogo(null);
                    $user->setSiteWeb(null);
                    break;


                case 'ROLE_PARTENAIRE':
                    //$user->setRoles(array('ROLE_PARTENAIRE'));
                    $logoPartn = $form['logo']->getData();
                    $fileName = uniqid() . '.' . $logoPartn->guessExtension();
                    $dataForm->setLogo($fileName);
                    $logoPartn->move($this->getParameter('logo_partenaires'), $fileName);
                    $user->setEntreprise(null);
                    $user->setPrenom(null);
                    $user->setDateNaissance(null);
                    $user->setPrenom(null);
                    $user->setPhoto(null);
                    $user->setPrenom(null);
                    $user->setPresentation(null);
                    break;
            }




            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();


            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();



            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
