<?php

namespace App\Controller;

use App\Entity\Chevre;
use App\Entity\Historique;
use App\Form\ChevreType;
use App\Repository\ChevreRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chevre')]
class ChevreController extends AbstractController
{
    #[Route('/', name: 'app_chevre_index', methods: ['GET'])]
    public function index(ChevreRepository $chevreRepository): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('chevre/index.html.twig', [
                'chevres' => $chevreRepository->findAll(),
            ]);
        }
        return $this->render('error/authentificationUser.html.twig');
        }


    #[Route('/new', name: 'app_chevre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $chevre = new Chevre();
        $historique = new Historique();
        $form = $this->createForm(ChevreType::class, $chevre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique->setAction("création de Chevre");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($chevre);
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('app_chevre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chevre/new.html.twig', [
            'chevre' => $chevre,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_chevre_show', methods: ['GET'])]
    public function show(Chevre $chevre): Response
    {
        return $this->render('chevre/show.html.twig', [
            'chevre' => $chevre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chevre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chevre $chevre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $form = $this->createForm(ChevreType::class, $chevre);
        $form->handleRequest($request);
        $historique = new Historique();

        if ($form->isSubmitted() && $form->isValid()) {
            $historique->setAction("modification de chevre");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('app_chevre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chevre/edit.html.twig', [
            'chevre' => $chevre,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_chevre_delete', methods: ['POST'])]
    public function delete(Request $request, Chevre $chevre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {

        if ($this->isCsrfTokenValid('delete'.$chevre->getId(), $request->request->get('_token'))) {
            $historique = new Historique();
            $historique->setAction("suppression de chevre");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->remove($chevre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chevre_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('error/authentification.html.twig');
    }
}
