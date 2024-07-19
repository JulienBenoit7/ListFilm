<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Form\SearchBarType;
use App\Repository\ActorRepository;
use App\Repository\FilmsRepository;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $actors = $this->actorRepository->findByName($search);
        } else {
            $actors = $this->actorRepository->findAll();
        }

        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($actor);
            $entityManager->flush();

            return $this->redirectToRoute('actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actor/new.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{actorName}', name: 'show')]
    public function show(string $actorName, ActorRepository $actorRepository, FilmsRepository $filmsRepository, SeriesRepository $seriesRepository): Response
    {
        $actors = $actorRepository->findOneBy(['name' => $actorName]);
        $films = $filmsRepository->findByActor($actors);
        $series = $seriesRepository->findByActor($actors);

        return $this->render('actor/show.html.twig', [
            'actors' => $actors,
            'films' => $films,
            'series' => $series,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Actor $actor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Actor $actor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actor->getId(), $request->get('_token'))) {
            $entityManager->remove($actor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actor_index', [], Response::HTTP_SEE_OTHER);
    }
}
