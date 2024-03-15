<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/search')]
class JobSearchController extends AbstractController
{
    #[Route('/jobs', name: 'app_job_search')]
    public function search(): Response
    {
        return $this->render('job_search/index.html.twig', [
            'controller_name' => 'JobSearchController',
        ]);
    }
}
