<?php

namespace App\Controller;

use App\Entity\Cheptel;
use App\Entity\Historique;
use App\Form\CheptelType;
use App\Repository\CheptelRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cheptel')]
class CheptelController extends AbstractController
{
    #[Route('/', name: 'app_cheptel_index', methods: ['GET'])]
    public function index(CheptelRepository $cheptelRepository): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('cheptel/index.html.twig', [
                'cheptels' => $cheptelRepository->findAll(),
            ]);
        }
        return $this->render('error/authentificationUser.html.twig');
    }

    #[Route('/new', name: 'app_cheptel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
            $cheptel = new Cheptel();
            $historique = new Historique();
            $form = $this->createForm(CheptelType::class, $cheptel);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $historique->setAction("création de cheptel");
                $historique->setDateAction(new DateTime());

                $entityManager->persist($cheptel);
                $entityManager->persist($historique);
                $entityManager->flush();

                return $this->redirectToRoute('app_cheptel_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('cheptel/new.html.twig', [
                'cheptel' => $cheptel,
                'form' => $form,
            ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_cheptel_show', methods: ['GET'])]
    public function show(Cheptel $cheptel): Response
    {
        return $this->render('cheptel/show.html.twig', [
            'cheptel' => $cheptel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cheptel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cheptel $cheptel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {


        $form = $this->createForm(CheptelType::class, $cheptel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historique = new Historique();
            $historique->setAction("modification de cheptel");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('app_cheptel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cheptel/edit.html.twig', [
            'cheptel' => $cheptel,
            'form' => $form,
        ]);
        }
        return $this->render('error/authentification.html.twig');
    }

    #[Route('/{id}', name: 'app_cheptel_delete', methods: ['POST'])]
    public function delete(Request $request, Cheptel $cheptel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN')) {
        if ($this->isCsrfTokenValid('delete'.$cheptel->getId(), $request->request->get('_token'))) {
            $historique = new Historique();
            $historique->setAction("suppression de cheptel");
            $historique->setDateAction(new DateTime());
            $entityManager->persist($historique);
            $entityManager->remove($cheptel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cheptel_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('error/authentification.html.twig');
    }


}
