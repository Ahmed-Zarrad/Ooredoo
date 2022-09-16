<?php

namespace App\Controller;

use App\Repository\TodolistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CalenderController extends AbstractController
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
     * @Route("/calender", name="app_calender")
     */
    public function index(TodolistRepository  $calendar)
    {
        $events = $calendar->findAll();

        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'changeId' => $event->getChangeId(),
                'title' => $event->getTitle(),
                'date' => $event->getDate()->format('Y-m-d'),
                'owner' => $event->getOwner(),
                'nok' => $event->getNOK(),
                'ok' => $event->getOK(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),


            ];
        }

        $data = json_encode($rdvs);
        $currentuser = $this->security->getUser();
        return $this->render('calender/index.html.twig', ['currentuser' =>$currentuser,'data'=>$data,]);
    }
}