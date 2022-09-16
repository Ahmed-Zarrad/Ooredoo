<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/activity")
 */
class ActivityController extends AbstractController
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
     * @Route("/", name="app_activity_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Activity::class)->findAll();

        $activityRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        $currentuser = $this->security->getUser();
        return $this->render('activity/index.html.twig', [
            'activities' => $activityRepository,'currentuser' =>$currentuser ,
        ]);
    }

    /**
     * @Route("/new", name="app_activity_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ActivityRepository $activityRepository): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activityRepository->add($activity);
            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();

        return $this->render('activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),'currentuser' =>$currentuser ,
        ]);
    }

    /**
     * @Route("/{ChangeId}", name="app_activity_show", methods={"GET"})
     */
    public function show(Activity $activity): Response
    {
        $currentuser = $this->security->getUser();
        return $this->render('activity/show.html.twig', [
            'activity' => $activity,'currentuser' =>$currentuser ,
        ]);
    }

    /**
     * @Route("/{ChangeId}/edit", name="app_activity_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Activity $activity, ActivityRepository $activityRepository): Response
    {
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activityRepository->add($activity);
            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();

        return $this->render('activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),'currentuser' =>$currentuser ,
        ]);
    }

    /**
     * @Route("/{ChangeId}", name="app_activity_delete", methods={"POST"})
     */
    public function delete(Request $request, Activity $activity, ActivityRepository $activityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getChangeId(), $request->request->get('_token'))) {
            $activityRepository->remove($activity);
        }

        return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
    }
}
