<?php

namespace App\Controller;

use App\Entity\Cheptel;
use App\Entity\GroupeTraitement;
use App\Entity\Historique;
use App\Entity\Traitement;
use App\Form\GroupeTraitementType;
use App\Repository\GroupeTraitementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/groupe/traitement')]
class GroupeTraitementController extends AbstractController
{
    #[Route('/', name: 'app_groupe_traitement_index', methods: ['GET'])]
    public function index(GroupeTraitementRepository $groupeTraitementRepository): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->render('groupe_traitement/index.html.twig', [
            'groupe_traitements' => $groupeTraitementRepository->findAll(),
        ]);
        }
        return $this->render('error/authentificationUser.html.twig');
    }

    #[Route('/new', name: 'app_groupe_traitement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $groupeTraitement = new GroupeTraitement();
        $form = $this->createForm(GroupeTraitementType::class, $groupeTraitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("creation de groupe de traitement");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->persist($groupeTraitement);
            $entityManager->flush();

            return $this->redirectToRoute('app_groupe_traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_traitement/new.html.twig', [
            'groupe_traitement' => $groupeTraitement,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_groupe_traitement_show', methods: ['GET'])]
    public function show(GroupeTraitement $groupeTraitement): Response
    {
        return $this->render('groupe_traitement/show.html.twig', [
            'groupe_traitement' => $groupeTraitement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_groupe_traitement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GroupeTraitement $groupeTraitement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $historique = new Historique();
        $historique->setAction("modification de groupe traitement");
        $historique->setDateAction(new DateTime());
        $entityManager->persist($historique);
        $form = $this->createForm(GroupeTraitementType::class, $groupeTraitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_groupe_traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_traitement/edit.html.twig', [
            'groupe_traitement' => $groupeTraitement,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_groupe_traitement_delete', methods: ['POST'])]
    public function delete(Request $request, GroupeTraitement $groupeTraitement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        if ($this->isCsrfTokenValid('delete'.$groupeTraitement->getId(), $request->request->get('_token'))) {
            $historique = new Historique();
            $historique->setAction("suppression de groupe de traitement");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->remove($groupeTraitement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_groupe_traitement_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('error/authentification.html.twig');
    }
}
