<?php

namespace App\Controller;

use App\Entity\ToyCategory;
use App\Form\ToyCategoryType;
use App\Repository\ToyCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/toy/category")
 */
class ToyCategoryController extends AbstractController
{
    /**
     * @Route("/", name="app_toy_category_index", methods={"GET"})
     */
    public function index(ToyCategoryRepository $toyCategoryRepository): Response
    {
        return $this->render('toy_category/index.html.twig', [
            'toy_categories' => $toyCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_toy_category_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ToyCategoryRepository $toyCategoryRepository): Response
    {
        $toyCategory = new ToyCategory();
        $form = $this->createForm(ToyCategoryType::class, $toyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toyCategoryRepository->add($toyCategory, true);

            return $this->redirectToRoute('app_toy_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('toy_category/new.html.twig', [
            'toy_category' => $toyCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_toy_category_show", methods={"GET"})
     */
    public function show(ToyCategory $toyCategory): Response
    {
        return $this->render('toy_category/show.html.twig', [
            'toy_category' => $toyCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_toy_category_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ToyCategory $toyCategory, ToyCategoryRepository $toyCategoryRepository): Response
    {
        $form = $this->createForm(ToyCategoryType::class, $toyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toyCategoryRepository->add($toyCategory, true);

            return $this->redirectToRoute('app_toy_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('toy_category/edit.html.twig', [
            'toy_category' => $toyCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_toy_category_delete", methods={"POST"})
     */
    public function delete(Request $request, ToyCategory $toyCategory, ToyCategoryRepository $toyCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$toyCategory->getId(), $request->request->get('_token'))) {
            $toyCategoryRepository->remove($toyCategory, true);
        }

        return $this->redirectToRoute('app_toy_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
