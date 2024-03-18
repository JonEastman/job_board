<?php

namespace App\Service;

use App\Entity\Application;
use Doctrine\ORM\EntityManagerInterface;

class ApplicationManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NotificationManager $notificationManager
    )
    {
    }

    public function declineApplication(Application $application): void
    {
        $applicant = $application->getApplicant();

        $application->setStatus(Application::APPLICATION_STATUS_DECLINED);

        $this->entityManager->flush();

        // Todo - Write a more friendly decline message
        $emailText = sprintf(
            "Hello %s, We are sorry to inform you that your application was not accepted.",
            $applicant->getFirstName()
        );

        // Send "mock" notification
        $this->notificationManager->sendEmail(
            $applicant->getEmail(),
            $emailText
        );
    }

    public function acceptApplication(Application $application): void
    {
        $applicant = $application->getApplicant();

        $application->setStatus(Application::APPLICATION_STATUS_ACCEPTED);

        $this->entityManager->flush();

        $emailText = sprintf(
            "Hello %s, We are excited to inform you that your application was accepted!",
            $applicant->getFirstName()
        );

        // Send "mock" notification
        $this->notificationManager->sendEmail(
            $applicant->getEmail(),
            $emailText
        );
    }

    public function withdrawApplication(Application $application): void
    {
        $applicant = $application->getApplicant();

        $application->setStatus(Application::APPLICATION_STATUS_WITHDRAWN);

        $this->entityManager->flush();

        $emailText = sprintf(
            "Hello %s, This email confirms that your application was withdrawn.",
            $applicant->getFirstName()
        );

        // Send "mock" notification
        $this->notificationManager->sendEmail(
            $applicant->getEmail(),
            $emailText
        );
    }
}
