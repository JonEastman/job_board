<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Job;
use App\Service\ApplicationManager;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployerJobController extends AbstractController
{
    #[Route('/employer/jobs', name: 'app_employer_jobs')]
    public function jobs(): Response
    {
        $jobs = [];

        return $this->render('employer_job/jobs.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/employer/jobs/new', name: 'app_employer_new_job')]
    public function new(): Response
    {
        $form = null;

        return $this->render('employer_job/new.html.twig', [
            'form' => $form, // ->createView()
        ]);
    }

    #[Route('/employer/jobs/{id}', name: 'app_employer_view_job')]
    public function view(Job $job): Response
    {
        // Todo Add User / Employer Validation / Security

        return $this->render('employer_job/view.html.twig', [
            'job' => $job,
        ]);
    }

    #[Route('/employer/jobs/{id}/edit', name: 'app_employer_edit_job')]
    public function edit(Job $job): Response
    {
        // Todo Add User / Employer Validation / Security

        $form = null;

        return $this->render('employer_job/edit.html.twig', [
            'job' => $job,
            'form' => $form, // ->createView()
        ]);
    }

    #[Route('/employer/jobs/{id}/applications', name: 'app_employer_job_applications')]
    public function applications(Job $job): Response
    {
        // Todo Add User / Employer Validation / Security

        $applications = [];

        return $this->render('employer_job/applications.html.twig', [
            'job' => $job,
            'applications' => $applications,
        ]);
    }

    #[Route('/employer/jobs/{id}/applications/{application_id}', name: 'app_employer_view_job_application')]
    public function viewApplication(
        Job $job,
        #[MapEntity(id: 'application_id')]
        Application $application
    ): Response
    {
        // Todo Add User / Employer Validation / Security

        return $this->render('employer_job/applications_view.html.twig', [
            'job' => $job,
            'application' => $application,
        ]);
    }

    #[Route(
        '/employer/jobs/{id}/applications/{application_id}/decline',
        name: 'app_employer_decline_job_application',
        methods: ['POST']
    )]
    public function declineApplication(
        Job $job,
        #[MapEntity(id: 'application_id')]
        Application $application,
        ApplicationManager $applicationManager
    ): Response
    {
        // Todo Add User / Employer Validation / Security

        // Decline the application
        $applicationManager->declineApplication($application);

        $this->addFlash('success', 'Application was declined');

        return $this->redirectToRoute('app_employer_job_applications', [
            'id' => $job->getId(),
        ]);
    }

    #[Route(
        '/employer/jobs/{id}/applications/{application_id}/accept',
        name: 'app_employer_accept_job_application',
        methods: ['POST']
    )]
    public function acceptApplication(
        Job $job,
        #[MapEntity(id: 'application_id')]
        Application $application,
        ApplicationManager $applicationManager
    ): Response
    {
        // Todo Add User / Employer Validation / Security

        $applicationManager->acceptApplication($application);

        $this->addFlash('success', 'Application was accepted');

        return $this->redirectToRoute('app_employer_job_applications', [
            'id' => $job->getId(),
        ]);
    }
}
