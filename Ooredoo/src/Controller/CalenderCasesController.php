<?php

namespace App\Controller;

use App\Repository\CasesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CalenderCasesController extends AbstractController
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
     * @Route("/calender/cases", name="app_calender_cases")
     */
    public function index(CasesRepository  $calendar): Response
    {
        $events = $calendar->findAll();

        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'caseId' => $event->getCaseId(),
                'title' => $event->getTitle(),
                'node' => $event->getNode(),
                'severity' => $event->getSeverity(),
                'status' => $event->getStatus(),
                'start' => $event->getStart()->format('Y-m-d'),
                'end' => $event->getEnd()->format('Y-m-d'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),


            ];
        }

        $data = json_encode($rdvs);
        $currentuser = $this->security->getUser();

        return $this->render('calender_cases/index.html.twig',['currentuser' =>$currentuser,'data'=>$data,]);
    }
}