<?php

namespace App\Controller;

use App\Entity\Cases;
use App\Form\CasesType;
use App\Repository\CasesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/cases")
 */
class CasesController extends AbstractController
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
     * @Route("/", name="app_cases_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Cases::class)->findAll();

        $casesRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        $currentuser = $this->security->getUser();
        return $this->render('cases/index.html.twig', [
            'cases' => $casesRepository,'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/new", name="app_cases_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CasesRepository $casesRepository): Response
    {
        $case = new Cases();
        $form = $this->createForm(CasesType::class, $case);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $casesRepository->add($case);
            return $this->redirectToRoute('app_cases_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('cases/new.html.twig', [
            'case' => $case,
            'form' => $form->createView(),
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{CaseId}", name="app_cases_show", methods={"GET"})
     */
    public function show(Cases $case): Response
    {
        $currentuser = $this->security->getUser();
        return $this->render('cases/show.html.twig', [
            'case' => $case,
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{CaseId}/edit", name="app_cases_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cases $case, CasesRepository $casesRepository): Response
    {
        $form = $this->createForm(CasesType::class, $case);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $casesRepository->add($case);
            return $this->redirectToRoute('app_cases_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('cases/edit.html.twig', [
            'case' => $case,
            'form' => $form->createView(),
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{CaseId}", name="app_cases_delete", methods={"POST"})
     */
    public function delete(Request $request, Cases $case, CasesRepository $casesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$case->getCaseId(), $request->request->get('_token'))) {
            $casesRepository->remove($case);
        }

        return $this->redirectToRoute('app_cases_index', [], Response::HTTP_SEE_OTHER);
    }
}
