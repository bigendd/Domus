<?php

namespace App\Controller;

use App\Entity\DetailsRealisation;
use App\Form\DetailsRealisationType;
use App\Repository\DetailsRealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/details/realisation')]
final class DetailsRealisationController extends AbstractController
{
    #[Route(name: 'app_details_realisation_index', methods: ['GET'])]
    public function index(DetailsRealisationRepository $detailsRealisationRepository): Response
    {
        return $this->render('details_realisation/index.html.twig', [
            'details_realisations' => $detailsRealisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_details_realisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailsRealisation = new DetailsRealisation();
        $form = $this->createForm(DetailsRealisationType::class, $detailsRealisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detailsRealisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_details_realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('details_realisation/new.html.twig', [
            'details_realisation' => $detailsRealisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_realisation_show', methods: ['GET'])]
    public function show(DetailsRealisation $detailsRealisation): Response
    {
        return $this->render('details_realisation/show.html.twig', [
            'details_realisation' => $detailsRealisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_details_realisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailsRealisation $detailsRealisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailsRealisationType::class, $detailsRealisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_details_realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('details_realisation/edit.html.twig', [
            'details_realisation' => $detailsRealisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_realisation_delete', methods: ['POST'])]
    public function delete(Request $request, DetailsRealisation $detailsRealisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsRealisation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($detailsRealisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_details_realisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
