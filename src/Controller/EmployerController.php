<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployerController extends AbstractController
{
    #[Route('/employer/dashboard', name: 'app_employer_dashboard')]
    public function dashboard(): Response
    {
        $jobs = [];

        return $this->render('employer/dashboard.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/employer/user/profile', name: 'app_employer_profile')]
    public function profile(): Response
    {
        $user = $this->getUser();

        return $this->render('employer/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/employer/user/profile/edit', name: 'app_employer_profile_edit')]
    public function editProfile(): Response
    {
        $user = $this->getUser();

        $form = null;

        return $this->render('employer/profile_edit.html.twig', [
            'user' => $user,
            'form' => $form, // ->createView()
        ]);
    }

    #[Route('/employer/company', name: 'app_employer_company')]
    public function company(): Response
    {
        $user = $this->getUser();
        $company = null;

        return $this->render('employer/company.html.twig', [
            'user' => $user,
            'company' => $company,
        ]);
    }

    #[Route('/employer/company/edit', name: 'app_employer_company_edit')]
    public function editCompany(): Response
    {
        $user = $this->getUser();
        $company = null;
        $form = null;

        return $this->render('employer/company_edit.html.twig', [
            'user' => $user,
            'company' => $company,
            'form' => $form,
        ]);
    }
}
