<?php

namespace App\Controller;

use App\Entity\UseRestriction;
use App\Form\UseRestrictionType;
use App\Repository\UseRestrictionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/use/restriction")
 */
class UseRestrictionController extends AbstractController
{
    /**
     * @Route("/", name="app_use_restriction_index", methods={"GET"})
     */
    public function index(UseRestrictionRepository $useRestrictionRepository): Response
    {
        return $this->render('use_restriction/index.html.twig', [
            'use_restrictions' => $useRestrictionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_use_restriction_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UseRestrictionRepository $useRestrictionRepository): Response
    {
        $useRestriction = new UseRestriction();
        $form = $this->createForm(UseRestrictionType::class, $useRestriction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $useRestrictionRepository->add($useRestriction, true);

            return $this->redirectToRoute('app_use_restriction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('use_restriction/new.html.twig', [
            'use_restriction' => $useRestriction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_use_restriction_show", methods={"GET"})
     */
    public function show(UseRestriction $useRestriction): Response
    {
        return $this->render('use_restriction/show.html.twig', [
            'use_restriction' => $useRestriction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_use_restriction_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UseRestriction $useRestriction, UseRestrictionRepository $useRestrictionRepository): Response
    {
        $form = $this->createForm(UseRestrictionType::class, $useRestriction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $useRestrictionRepository->add($useRestriction, true);

            return $this->redirectToRoute('app_use_restriction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('use_restriction/edit.html.twig', [
            'use_restriction' => $useRestriction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_use_restriction_delete", methods={"POST"})
     */
    public function delete(Request $request, UseRestriction $useRestriction, UseRestrictionRepository $useRestrictionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$useRestriction->getId(), $request->request->get('_token'))) {
            $useRestrictionRepository->remove($useRestriction, true);
        }

        return $this->redirectToRoute('app_use_restriction_index', [], Response::HTTP_SEE_OTHER);
    }
}
