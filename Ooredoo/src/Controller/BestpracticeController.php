<?php

namespace App\Controller;

use App\Entity\Bestpractice;
use App\Form\BestpracticeType;
use App\Repository\BestpracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;
/**
 * @Route("/bestpractice")
 */
class BestpracticeController extends AbstractController
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
     * @Route("/", name="app_bestpractice_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Bestpractice::class)->findAll();

        $bestpracticeRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        $currentuser = $this->security->getUser();
        return $this->render('bestpractice/index.html.twig', [
            'bestpractices' => $bestpracticeRepository,'currentuser' =>$currentuser ,
        ]);
    }

    /**
     * @Route("/new", name="app_bestpractice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BestpracticeRepository $bestpracticeRepository): Response
    {
        $bestpractice = new Bestpractice();
        $form = $this->createForm(BestpracticeType::class, $bestpractice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bestpracticeRepository->add($bestpractice);
            return $this->redirectToRoute('app_bestpractice_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('bestpractice/new.html.twig', [
            'bestpractice' => $bestpractice,
            'form' => $form->createView(),
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{Node}", name="app_bestpractice_show", methods={"GET"})
     */
    public function show(Bestpractice $bestpractice): Response
    {
        $currentuser = $this->security->getUser();
        return $this->render('bestpractice/show.html.twig', [
            'bestpractice' => $bestpractice,'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{Node}/edit", name="app_bestpractice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bestpractice $bestpractice, BestpracticeRepository $bestpracticeRepository): Response
    {
        $form = $this->createForm(BestpracticeType::class, $bestpractice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bestpracticeRepository->add($bestpractice);
            return $this->redirectToRoute('app_bestpractice_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('bestpractice/edit.html.twig', [
            'bestpractice' => $bestpractice,
            'form' => $form->createView(),'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{Node}", name="app_bestpractice_delete", methods={"POST"})
     */
    public function delete(Request $request, Bestpractice $bestpractice, BestpracticeRepository $bestpracticeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestpractice->getNode(), $request->request->get('_token'))) {
            $bestpracticeRepository->remove($bestpractice);
        }

        return $this->redirectToRoute('app_bestpractice_index', [], Response::HTTP_SEE_OTHER);
    }
}
