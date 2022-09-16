<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Form\TodolistType;
use App\Repository\TodolistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;
/**
 * @Route("/todolist")
 */
class TodolistController extends AbstractController
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
     * @Route("/", name="app_todolist_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Todolist::class)->findAll();

        $todolistRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        $currentuser = $this->security->getUser();
        return $this->render('todolist/index.html.twig', [
            'todolists' => $todolistRepository,
            'currentuser' =>$currentuser,
        ]);

    }

    /**
     * @Route("/new", name="app_todolist_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TodolistRepository $todolistRepository): Response
    {
        $todolist = new Todolist();
        $form = $this->createForm(TodolistType::class, $todolist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todolistRepository->add($todolist);
            return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('todolist/new.html.twig', [
            'todolist' => $todolist,
            'form' => $form->createView(),
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{ChangeId}", name="app_todolist_show", methods={"GET"})
     */
    public function show(Todolist $todolist): Response
    {
        $currentuser = $this->security->getUser();
        return $this->render('todolist/show.html.twig', [
            'todolist' => $todolist,
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{ChangeId}/edit", name="app_todolist_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Todolist $todolist, TodolistRepository $todolistRepository): Response
    {
        $form = $this->createForm(TodolistType::class, $todolist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todolistRepository->add($todolist);
            return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
        }
        $currentuser = $this->security->getUser();
        return $this->render('todolist/edit.html.twig', [
            'todolist' => $todolist,
            'form' => $form->createView(),
            'currentuser' =>$currentuser,
        ]);
    }

    /**
     * @Route("/{ChangeId}", name="app_todolist_delete", methods={"POST"})
     */
    public function delete(Request $request, Todolist $todolist, TodolistRepository $todolistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todolist->getChangeId(), $request->request->get('_token'))) {
            $todolistRepository->remove($todolist);
        }

        return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
    }
}
