<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Traitement;
use App\Form\TraitementType;
use App\Repository\CheptelRepository;
use App\Repository\GroupeTraitementRepository;
use App\Repository\TraitementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/traitement')]
class TraitementController extends AbstractController
{
    #[Route('/', name: 'app_traitement_index', methods: ['GET'])]
    public function index(TraitementRepository $traitementRepository): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->render('traitement/index.html.twig', [
            'traitements' => $traitementRepository->findAll(),
        ]);
        }
        return $this->render('error/authentificationUser.html.twig');
    }

    #[Route('/new', name: 'app_traitement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $traitement = new Traitement();
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("creation de traitement");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->persist($traitement);
            $entityManager->flush();

            return $this->redirectToRoute('app_traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement/new.html.twig', [
            'traitement' => $traitement,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/show/{id}', name: 'app_traitement_show', methods: ['GET'])]
    public function show(Traitement $traitement): Response
    {
        return $this->render('traitement/show.html.twig', [
            'traitement' => $traitement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traitement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Traitement $traitement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("modification de traitement");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('app_traitement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement/edit.html.twig', [
            'traitement' => $traitement,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/delete/{id}', name: 'app_traitement_delete', methods: ['POST'])]
    public function delete(Request $request, Traitement $traitement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        if ($this->isCsrfTokenValid('delete'.$traitement->getId(), $request->request->get('_token'))) {
            $historique = new Historique();
            $historique->setAction("suppression de traitement");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->remove($traitement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_traitement_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route("/carnet", name: "carnet_sanitaire")]
    public function carnetSanitaire(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
        $dateDebut = $request->query->get('dateDebut');
        $dateFin = $request->query->get('dateFin');

        $traitements = [];

        if ($dateDebut && $dateFin) {
            // Convertissez les chaînes de date en objets DateTime
            $dateDebut = new \DateTime($dateDebut);
            $dateFin = new \DateTime($dateFin);

            // Utilisez la méthode du dépôt pour récupérer les traitements dans la plage de dates
            $traitements = $entityManager
                ->getRepository(Traitement::class)
                ->findBetweenDates($dateDebut, $dateFin);

            // Formatez les objets DateTime pour les rendre compatibles avec Twig
            $dateDebut = $serializer->normalize($dateDebut, null, [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d']);
            $dateFin = $serializer->normalize($dateFin, null, [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d']);
        }

        return $this->render('traitement/carnet_sanitaire.html.twig', [
            'traitements' => $traitements,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
        ]);
        }
        return $this->render('error/authentificationUser.html.twig');
    }

    #[Route("/recherche", name: "recherche_traitement")]
    public function searchTraitement(Request $request, GroupeTraitementRepository $groupeTraitementRepository, CheptelRepository $cheptelRepository): Response
    {
        $matricule = $request->query->get('matricule');
        $nomCheptel = $request->query->get('nomCheptel');
        $traitements = [];

        if ($matricule) {
            // Utiliser la méthode du repository pour récupérer les traitements par matricule
            $traitements = $groupeTraitementRepository->findTraitementWithMatricule($matricule);
        } elseif ($nomCheptel) {
            // Utiliser la méthode du repository pour récupérer les traitements par nom de cheptel
            $traitements = $cheptelRepository->findTraitementWithNomCheptel($nomCheptel);
        }

        return $this->render('traitement/recherche.html.twig', [
            'traitements' => $traitements,
            'matricule' => $matricule,
            'nomCheptel' => $nomCheptel,
        ]);
    }
}
