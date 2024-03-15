<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployerJobController extends AbstractController
{
    #[Route('/employer/job_search', name: 'app_employer_job')]
    public function index(): Response
    {
        return $this->render('employer_job/index.html.twig', [
            'controller_name' => 'EmployerJobController',
        ]);
    }
}
