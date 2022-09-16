<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Bestpractice;
use App\Entity\Cases;
use App\Entity\Todolist;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class BackHomeController extends AbstractController
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
     * @Route("/back/home", name="app_back_home")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $countu = $repository->countu();
        $repository = $this->getDoctrine()->getRepository(Todolist::class);
        $countt = $repository->countt();
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        $counta = $repository->counta();
        $repository = $this->getDoctrine()->getRepository(Cases::class);
        $countc = $repository->countc();
        $repository = $this->getDoctrine()->getRepository(Bestpractice::class);
        $countb = $repository->countb();
        $currentuser = $this->security->getUser();
        return $this->render('back_home/index.html.twig', [
            'countu' =>$countu ,'countt' =>$countt,'counta' =>$counta,'countc' =>$countc,'countb' =>$countb,'currentuser' =>$currentuser ,
        ]);
    }
}
