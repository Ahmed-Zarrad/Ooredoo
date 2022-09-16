<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        $currentuser = $this->security->getUser();
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController','currentuser' =>$currentuser ,
        ]);
    }
}
