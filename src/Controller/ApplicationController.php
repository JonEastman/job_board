<?php

namespace App\Controller;

use App\Entity\Application;
use App\Service\ApplicationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApplicationController extends AbstractController
{
    #[Route('/user/applications', name: 'app_applications')]
    public function applications(): Response
    {
        $user = $this->getUser();

        $applications = [];

        return $this->render('application/applications.html.twig', [
            'user' => $user,
            'applications' => $applications,
        ]);
    }

    #[Route('/user/applications/{id}', name: 'app_applications_view')]
    public function view(Application $application): Response
    {
        $user = $this->getUser();

        // Todo Add User / Application Validation / Security



        return $this->render('application/view.html.twig', [
            'user' => $user,
            'application' => $application,
        ]);
    }

    #[Route('/user/applications/{id}/withdraw', name: 'app_applications_withdraw', methods: ['POST'])]
    public function withdraw(Application $application, ApplicationManager $applicationManager): Response
    {
        // Todo Add User / Application Validation / Security


        $applicationManager->withdrawApplication($application);

        // TODO make Ajax in the future
        return $this->redirectToRoute('app_applications_view', [
            'id' => $application->getId()
        ]);
    }
}
