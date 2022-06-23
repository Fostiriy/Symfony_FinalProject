<?php

namespace App\Controller;

use App\Entity\Toy;
use App\Form\ToyType;
use App\Repository\ToyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/toy")
 */
class ToyController extends AbstractController
{
    /**
     * @Route("/", name="app_toy_index", methods={"GET"})
     */
    public function index(ToyRepository $toyRepository): Response
    {
        return $this->render('toy/index.html.twig', [
            'toys' => $toyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_toy_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ToyRepository $toyRepository): Response
    {
        $toy = new Toy();
        $form = $this->createForm(ToyType::class, $toy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toyRepository->add($toy, true);

            return $this->redirectToRoute('app_toy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('toy/new.html.twig', [
            'toy' => $toy,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_toy_show", methods={"GET"})
     */
    public function show(Toy $toy): Response
    {
        return $this->render('toy/show.html.twig', [
            'toy' => $toy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_toy_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Toy $toy, ToyRepository $toyRepository): Response
    {
        $form = $this->createForm(ToyType::class, $toy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toyRepository->add($toy, true);

            return $this->redirectToRoute('app_toy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('toy/edit.html.twig', [
            'toy' => $toy,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_toy_delete", methods={"POST"})
     */
    public function delete(Request $request, Toy $toy, ToyRepository $toyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$toy->getId(), $request->request->get('_token'))) {
            $toyRepository->remove($toy, true);
        }

        return $this->redirectToRoute('app_toy_index', [], Response::HTTP_SEE_OTHER);
    }
}
