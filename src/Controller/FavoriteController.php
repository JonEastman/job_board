<?php

namespace App\Controller;

use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    #[Route('/user/favorites', name: 'app_favorites')]
    public function favorites(): Response
    {
        $user = $this->getUser();

        //$jobs = $user->getFavorites();
        $jobs = [];

        return $this->render('favorite/favorites.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/user/favorites/add/{id}', name: 'app_favorites_add', methods: ['POST'])]
    public function add(Job $job): Response
    {
        $user = $this->getUser();

        // Todo Add job to favorites list



        // TODO make Ajax in the future
        return $this->redirectToRoute('app_job_view', [
            'id' => $job->getId()
        ]);
    }

    #[Route('/user/favorites/remove/{id}', name: 'app_favorites_remove', methods: ['POST'])]
    public function remove(Job $job): Response
    {
        $user = $this->getUser();

        // Todo Remove job from favorites list



        // TODO make Ajax in the future
        return $this->redirectToRoute('app_job_view', [
            'id' => $job->getId()
        ]);
    }
}
