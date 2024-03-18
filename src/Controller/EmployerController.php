<?php

namespace App\Controller;

use App\Form\CompanyType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function editProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('success', 'Profile has been updated');

            return $this->redirectToRoute('app_employer_profile');
        }

        return $this->render('employer/profile_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
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
    public function editCompany(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $company = null;

        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('success', 'Company has been updated');

            return $this->redirectToRoute('app_employer_company');
        }

        return $this->render('employer/company_edit.html.twig', [
            'user' => $user,
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
}
