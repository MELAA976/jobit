<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\OffreUser;
use App\Entity\PublicaOffre;
use App\Form\CategoryType;
use App\Form\OffreUserType;
use App\Form\PublicaOffreType;
use App\Repository\OffreUserRepository;
use App\Repository\PublicaOffreRepository;
use App\Security\Voter\OffreVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/publica/offre')]
final class PublicaOffreController extends AbstractController
{
    #[Route(name: 'app_publica_offre_index', methods: ['GET'])]
    public function index(PublicaOffreRepository $publicaOffreRepository): Response
    {

        return $this->render('publica_offre/index.html.twig', [
            'publica_offres' => $publicaOffreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_publica_offre_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_RECRUTEUR')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publicaOffre = new PublicaOffre();
        $formPubli = $this->createForm(PublicaOffreType::class, $publicaOffre);
        $formPubli->handleRequest($request);

        //ajout de categorie
        $category = new Category();
        $formCat = $this->createForm(CategoryType::class, $category);
        $formCat->handleRequest($request);

        //ajout de publicartion

        if ($formPubli->isSubmitted() && $formPubli->isValid()) {

            // generation et insertion de la date de publication
            $publicaOffre->setDatePublication(new \DateTime());

            //affectation de l'id de l'utilisateur
            $publicaOffre->setUser($this->getUser());
            $entityManager->persist($publicaOffre);
            $entityManager->flush();


            return $this->redirectToRoute('app_publica_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($formCat->isSubmitted() && $formCat->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
        }



        return $this->render('publica_offre/new.html.twig', [
            /*'formCat' => $formCat,*/
            /*'category' => $category,*/
            'publica_offre' => $publicaOffre,
            'formPubli' => $formPubli,

        ]);
    }

    #[Route('/{id}', name: 'app_publica_offre_show', methods: ['GET', 'POST'])]
    public function show(PublicaOffre $publicaOffre, Request $request, EntityManagerInterface $entityManager, OffreUserRepository $offre, $id): Response
    {
        //Création d'un offre user
        $offreUser = new OffreUser();
        $idUser = $this->getUser();

        //verification si on a deja postuller a cet offre
        $offreRepo = $offre->findBy([
            'offre' => $id,
            'user' => $idUser,
        ]);

        //creation de la condition de la verification de postullation
        $postule = false;
        if (count($offreRepo) > 0) {
            $postule = true;
        };

        $routeName = $request->attributes->get('_route'); //recuperation de la route actuelle
        $routeParameters = $request->attributes->get('_route_params'); //recuperation de l'id de la route




        //Creation du formulaire
        $form = $this->createForm(OffreUserType::class, $offreUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ajout id de l'offre
            $offreUser->setOffre($publicaOffre);

            // id de l'utilisateur
            $offreUser->setUser($this->getUser());

            // date de postulation
            $offreUser->setDateCandidature(new \DateTime());

            $entityManager->persist($offreUser);
            $entityManager->flush();
            return $this->redirectToRoute($routeName, $routeParameters);
            /* redirection vers la route actuel*/
        }

        return $this->render('publica_offre/show.html.twig', [
            'publica_offre' => $publicaOffre,
            'form' => $form,
            'postule' => $postule,
            'idpostules' => $offreRepo,


        ]);


        //supprimer le postule

    }


    #[Route('/{id}/edit', name: 'app_publica_offre_edit', methods: ['GET', 'POST'])]
    #[IsGranted(OffreVoter::EDIT_OFFRE, subject: 'publicaOffre')]
    public function edit(Request $request, PublicaOffre $publicaOffre, EntityManagerInterface $entityManager, int $id): Response
    {
        $form = $this->createForm(PublicaOffreType::class, $publicaOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // generation et insertion de la date de modification de l'offre
            $publicaOffre->setDateModification(new \DateTime());
            //dd($publicaOffre);
            $entityManager->flush();

            return $this->redirectToRoute('app_publica_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('publica_offre/edit.html.twig', [
            'publica_offre' => $publicaOffre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_publica_offre_delete', methods: ['POST'])]
    #[IsGranted(OffreVoter::EDIT_OFFRE, subject: 'publicaOffre')]
    public function delete(Request $request, PublicaOffre $publicaOffre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publicaOffre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($publicaOffre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_publica_offre_index', [], Response::HTTP_SEE_OTHER);
    }
}
