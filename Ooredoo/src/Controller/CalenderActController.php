<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CalenderActController extends AbstractController
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
     * @Route("/calender/act", name="app_calender_act")
     */
    public function index(ActivityRepository $calendar):Response
    {
        $events = $calendar->findAll();

        $rdvs = [];
        foreach ($events as $event) {
            $rdvs[] = [
                'changeId' => $event->getChangeId(),
                'title' => $event->getTitle(),
                'date' => $event->getDate()->format('Y-m-d'),
                'ok' => $event->getStatus(),
                'owner' => $event->getOwner(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),


            ];
        }

        $data = json_encode($rdvs);
        $currentuser = $this->security->getUser();
        return $this->render('calender_act/index.html.twig',['currentuser' =>$currentuser,'data'=>$data,]);
    }
}
