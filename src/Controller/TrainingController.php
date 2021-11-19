<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/training")
 */
class TrainingController extends AbstractController
{
    /**
     * @Route("/", name="training_index", methods={"GET"})
     */
    public function index(): Response
    {
        $trainings = $this->getUser()->getTraining();
        return $this->render('training/index.html.twig', [
            "trainings" => $trainings
        ]);
    }

    /**
     * @Route("/new", name="training_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $training->setUser($this->getUser());
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('training_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training/new.html.twig', [
            'training' => $training,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="training_show", methods={"GET"})
     */
    public function show(Training $training): Response
    {
        $this->denyAccessUnlessGranted('view',$training);

        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training): Response
    {
        $this->denyAccessUnlessGranted('view',$training);

        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training/edit.html.twig', [
            'training' => $training,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="training_delete", methods={"POST"})
     */
    public function delete(Request $request, Training $training): Response
    {
        $this->denyAccessUnlessGranted('view',$training);

        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('training_index', [], Response::HTTP_SEE_OTHER);
    }
}
