<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use App\Repository\FilmsRepository;
use App\Repository\SeasonRepository;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Films;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/filmAdmin', name: 'filmAdmin')]
    public function filmAdmin(FilmsRepository $filmsRepository): Response
    {
        $films = $filmsRepository->findAll();
        $actors = [];
        foreach ($films as $film) {
            $actors[] = $film->getActors();
        }


        return $this->render('admin/filmAdmin.html.twig', [
            'films' => $films,
            'actors' => $actors,

        ]);
    }

    #[Route('/seriesAdmin', name: 'seriesAdmin')]
    public function seriesAdmin(SeriesRepository $seriesRepository): Response
    {
        $series = $seriesRepository->findAll();

        return $this->render('admin/seriesAdmin.html.twig', [
            'series' => $series
        ]);
    }

    #[Route('/seasonAdmin', name: 'seasonAdmin')]
    public function seasonAdmin(SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->findAll();

        return $this->render('admin/seasonAdmin.html.twig', [
            'season' => $season
        ]);
    }

    #[Route('/actorAdmin', name: 'actorAdmin')]
    public function actorAdmin(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render('admin/actorAdmin.html.twig', [
            'actors' => $actors
        ]);
    }

    #[Route('/categoryAdmin', name: 'categoryAdmin')]
    public function categoryAdmin(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();

        return $this->render('admin/categoryAdmin.html.twig', [
            'category' => $category
        ]);
    }
}
