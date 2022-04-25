<?php

namespace App\Controller;

use App\Entity\Forum;
use App\Form\ForumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/front/forum")
 */
class ForumController extends AbstractController
{
    /**
     * @Route("/", name="app_forum_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $forums = $entityManager
            ->getRepository(Forum::class)
            ->findAll();

        return $this->render('front/forum/index.html.twig', [
            'forums' => $forums,
        ]);
    }

    /**
     * @Route("/new", name="app_forum_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $forum = new Forum();
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($forum);
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/forum/new.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idFrm}", name="app_forum_show", methods={"GET"})
     */
    public function show(Forum $forum): Response
    {
        return $this->render('front/forum/show.html.twig', [
            'forum' => $forum,
        ]);
    }

    /**
     * @Route("/{idFrm}/edit", name="app_forum_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/forum/edit.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{idFrm}/addlike", name="addlikeFront", methods={"GET", "POST"})
     */
    public function addLike(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

            $forum->setLikes($forum->getLikes()+1);
            $entityManager->flush();

            return $this->redirectToRoute('back_forum_index', [], Response::HTTP_SEE_OTHER);

       
    }

    /**
     * @Route("/{idFrm}/adddislike", name="adddislikeFront", methods={"GET", "POST"})
     */
    public function addDislike(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

            $forum->setReport($forum->getReport()+1);
            $entityManager->flush();

            return $this->redirectToRoute('back_forum_index', [], Response::HTTP_SEE_OTHER);

       
    }

    /**
     * @Route("/{idFrm}", name="app_forum_delete", methods={"POST"})
     */
    public function delete(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forum->getIdFrm(), $request->request->get('_token'))) {
            $entityManager->remove($forum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
