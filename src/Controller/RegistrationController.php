<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\RegistrationEmployerType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        Security $security
    ): Response
    {
        // Check if User is logged in already
        if ($this->isGranted('ROLE_USER')) {

            $this->addFlash('error', 'You are already logged in');

            return $this->redirectToRoute('app_home');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $security->login($user);

            return $this->redirectToRoute('app_user_dashboard');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/register/employer', name: 'app_register_employer')]
    public function employerRegister(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        Security $security
    ): Response
    {
        // Check if User is logged in already
        if ($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_EMPLOYER')) {

            $this->addFlash('error', 'You are already logged in');

            return $this->redirectToRoute('app_employer_dashboard');
        }

        $user = new User();
        $form = $this->createForm(RegistrationEmployerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Create & setup company
            $company = new Company();
            $company->setName($form->get('company')->getData());
            $company->setPhone($form->get('company_phone')->getData());
            $company->addUser($user);

            $user->setCompany($company);
            $user->setRoles(['ROLE_EMPLOYER']);

            $entityManager->persist($company);
            $entityManager->persist($user);
            $entityManager->flush();

            $security->login($user);

            return $this->redirectToRoute('app_employer_dashboard');
        }

        return $this->render('registration/register_employer.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
