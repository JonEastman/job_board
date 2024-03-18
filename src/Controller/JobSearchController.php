<?php

namespace App\Controller;

use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/search')]
class JobSearchController extends AbstractController
{
    #[Route('/jobs', name: 'app_job_search')]
    public function search(Request $request): Response
    {
        // Default jobs with pagination
        $jobs = [];

        $form = null;

        $searchQuery = $request->query->get('q');
        if ($searchQuery) {

            $jobs = [''];
        }

        return $this->render('job_search/search.html.twig', [
            'jobs' => $jobs,
            'form' => $form, // ->createView()
        ]);
    }

    #[Route('/jobs/{id}', name: 'app_job_view')]
    public function view(Job $job): Response
    {
        return $this->render('job_search/view.html.twig', [
            'job' => $job,
        ]);
    }

    #[Route('/jobs/{id}/apply', name: 'app_job_apply')]
    public function apply(Job $job): Response
    {

        // Todo - create form with additional information.

        // Submit form and create application and set status



        return $this->render('job_search/apply.html.twig', [
            'job' => $job,
        ]);
    }
}
