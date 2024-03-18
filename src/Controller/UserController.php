<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function dashboard(): Response
    {
        $user = $this->getUser();
        $jobs = [];

        return $this->render('user/dashboard.html.twig', [
            'user' => $user,
            'jobs' => $jobs,
        ]);
    }

    #[Route('/user/profile', name: 'app_user_profile')]
    public function profile(): Response
    {
        $user = $this->getUser();

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/profile/edit', name: 'app_user_profile_edit')]
    public function editProfile(): Response
    {
        $user = $this->getUser();

        $form = null;

        return $this->render('user/profile_edit.html.twig', [
            'user' => $user,
            'form' => $form, // ->createView()
        ]);
    }
}
