<?php

namespace App\Controller;

use App\Entity\Series;
use App\Form\SeriesType;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\SearchBarType;


#[Route('/series', name: 'series_')]
class SeriesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, SeriesRepository $seriesRepository): Response
    {
        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $series = $seriesRepository->findLikeName($search);
        } else {
            $series = $seriesRepository->findAll();
        }

        return $this->render('series/index.html.twig', [
            'series' => $series,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $series = new Series();
        $form = $this->createForm(SeriesType::class, $series);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($series);
            $entityManager->flush();

            return $this->redirectToRoute('series_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('series/new.html.twig', [
            'series' => $series,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id, SeriesRepository $seriesRepository): Response
    {
        $series = $seriesRepository->findOneBy(['id' => $id]);

        if (!$series) {
            throw $this->createNotFoundException('Serie inexistant');
        }
        return $this->render('series/show.html.twig', [
            'series' => $series,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Series $series, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeriesType::class, $series);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('series_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('series/edit.html.twig', [
            'series' => $series,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Series $series, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $series->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($series);
            $entityManager->flush();
        }

        return $this->redirectToRoute('series_index', [], Response::HTTP_SEE_OTHER);
    }
}
