<?php

namespace App\Controller;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use App\Repository\ReclamationRepository;

/**
 * @Route("back/reclamation")
 */
class ReclamationControllerBack extends AbstractController
{
    /**
     * @Route("/", name="back_reclamation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager , ReclamationRepository $repository, Request $request): Response
    {
     /*   $reclamations = $entityManager
        ->getRepository(Reclamation::class)
        ->findAll();
**/
        $data=new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $reclamations =$repository->findSearch($data);
        
        return $this->render('back/reclamation/index.html.twig', [
        'reclamations' => $reclamations,
        'form' => $form->createView()
    ]);
}

    /**
     * @Route("/new", name="back_reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           
            $entityManager->persist($reclamation);
            $entityManager->flush();
            
            

            return $this->redirectToRoute('back_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRec}", name="back_reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{idRec}/edit", name="back_reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('back_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRec}", name="back_reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdRec(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
}
