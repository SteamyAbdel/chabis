<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Veterinaire;
use App\Form\VeterinaireType;
use App\Repository\VeterinaireRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/veterinaire')]
class VeterinaireController extends AbstractController
{
    #[Route('/', name: 'app_veterinaire_index', methods: ['GET'])]
    public function index(VeterinaireRepository $veterinaireRepository): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->render('veterinaire/index.html.twig', [
            'veterinaires' => $veterinaireRepository->findAll(),
        ]);
        }
        return $this->render('error/authentificationUser.html.twig');
    }

    #[Route('/new', name: 'app_veterinaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $veterinaire = new Veterinaire();
        $form = $this->createForm(VeterinaireType::class, $veterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("creation de veterinaire");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->persist($veterinaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/new.html.twig', [
            'veterinaire' => $veterinaire,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_veterinaire_show', methods: ['GET'])]
    public function show(Veterinaire $veterinaire): Response
    {
        return $this->render('veterinaire/show.html.twig', [
            'veterinaire' => $veterinaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_veterinaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Veterinaire $veterinaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $form = $this->createForm(VeterinaireType::class, $veterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("modification de veterinaire");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/edit.html.twig', [
            'veterinaire' => $veterinaire,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_veterinaire_delete', methods: ['POST'])]
    public function delete(Request $request, Veterinaire $veterinaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        if ($this->isCsrfTokenValid('delete'.$veterinaire->getId(), $request->request->get('_token'))) {
            $historique = new Historique();
            $historique->setAction("suppression de veterinaire");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->remove($veterinaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_veterinaire_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('error/authentification.html.twig');
    }
}
