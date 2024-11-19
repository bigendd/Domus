<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Entity\DetailsRealisation;
use App\Form\RealisationType;
use App\Form\DetailsRealisationType;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/realisation')]
final class RealisationController extends AbstractController
{
    #[Route(name: 'app_realisation_index', methods: ['GET'])]
    public function index(RealisationRepository $realisationRepository): Response
    {
        return $this->render('realisation/index.html.twig', [
            'realisations' => $realisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_realisation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer un objet Realisation
        $realisation = new Realisation();

        // Créer un formulaire pour l'entité Realisation
        $form = $this->createForm(RealisationType::class, $realisation);

        // Gérer la soumission du formulaire Realisation
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer la soumission des détails associés
            $detailsRealisation = new DetailsRealisation();
            $detailsRealisation->setCheminImage($form->get('detailsRealisations')->getData());

            // Lier le DetailsRealisation à la Realisation
            $realisation->addDetailsRealisation($detailsRealisation);

            // Persister la Realisation et ses DetailsRealisation
            $entityManager->persist($realisation);
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'La réalisation et ses détails ont été enregistrés avec succès.');

            // Redirection vers la page de la nouvelle réalisation ou une autre page
            return $this->redirectToRoute('app_realisation_index', ['id' => $realisation->getId()]);
        }

        return $this->render('realisation/new.html.twig', [
            'form' => $form->createView(),
            'realisation' => $realisation,
        ]);
    }
    
    

    #[Route('/{id}', name: 'app_realisation_show', methods: ['GET'])]
    public function show(Realisation $realisation): Response
    {
        return $this->render('realisation/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_realisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Realisation $realisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_realisation_delete', methods: ['POST'])]
    public function delete(Request $request, Realisation $realisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->get('_token'))) {
            $entityManager->remove($realisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_realisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
