<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PublicaOffre;
use App\Form\PublicaOffreType;
use App\Repository\PublicaOffreRepository;
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
    //#[IsGranted('ROLE_RECRUTEUR')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publicaOffre = new PublicaOffre();
        $form = $this->createForm(PublicaOffreType::class, $publicaOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // generation et insertion de la date de publication
            $publicaOffre->setDatePublication(new \DateTime());
            
            //affectation de l'id de l'utilisateur
            $publicaOffre->setUser($this->getUser());
            $entityManager->persist($publicaOffre);
            $entityManager->flush();

            return $this->redirectToRoute('app_publica_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('publica_offre/new.html.twig', [
            'publica_offre' => $publicaOffre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_publica_offre_show', methods: ['GET'])]
    public function show(PublicaOffre $publicaOffre): Response
    {

        return $this->render('publica_offre/show.html.twig', [
            'publica_offre' => $publicaOffre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_publica_offre_edit', methods: ['GET', 'POST'])]
    //#[IsGranted('ROLE_RECRUTEUR')]
    public function edit(Request $request, PublicaOffre $publicaOffre, EntityManagerInterface $entityManager): Response
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
    //#[IsGranted('ROLE_RECRUTEUR')]
    public function delete(Request $request, PublicaOffre $publicaOffre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publicaOffre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($publicaOffre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_publica_offre_index', [], Response::HTTP_SEE_OTHER);
    }
}
