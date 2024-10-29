<?php

namespace App\Controller;

use App\Entity\OffreUser;
use App\Form\OffreUserType;
use App\Repository\OffreUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/offre/user')]
final class OffreUserController extends AbstractController
{
    #[Route(name: 'app_offre_user_index', methods: ['GET'])]
    public function index(OffreUserRepository $offreUserRepository): Response
    {
        return $this->render('offre_user/index.html.twig', [
            'offre_users' => $offreUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offre_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offreUser = new OffreUser();
        $form = $this->createForm(OffreUserType::class, $offreUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $offreUser->setDateCandidature(new \DateTime());
            dd($offreUser);
            $entityManager->persist($offreUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_user/new.html.twig', [
            'offre_user' => $offreUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_user_show', methods: ['GET'])]
    public function show(OffreUser $offreUser): Response
    {
        return $this->render('offre_user/show.html.twig', [
            'offre_user' => $offreUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_offre_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffreUser $offreUser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreUserType::class, $offreUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_user/edit.html.twig', [
            'offre_user' => $offreUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_user_delete', methods: ['POST'])]
    public function delete(Request $request, OffreUser $offreUser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offreUser->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($offreUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
